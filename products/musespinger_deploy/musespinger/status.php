<?php
/**
 * MuSeSPinger
 *  Status Checker
 * 
 * License:
 *  This file is part of MuSeSPinger.
 *  
 *  MuSeSPinger is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  MuSeSPinger is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with MuSeSPinger.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// Required includes
include ("core.php");

// Import URL
$url = $_REQUEST['data'];

/**
 * fsockopen
 */
if (ISUP_METHOD == "fsockopen" && function_exists('fsockopen'))
{
	// Process the data and determine the port
	$data = $url.":";
	$data2 = str_replace("::", ":", $data);
	list($url, $port) = explode(':', $data2);
	
	// If the port is empty, use 80
	if (empty($port))
	{
		$port = 80;
	}
	
	// Take out the trailing slash
	if (strstr($url, "/"))
	{
		$url = substr($url, 0, strpos($url, "/"));
	}
	
	// Test the server
	$status = @fsockopen($url, $port, $errno, $errstr, 8);
	
	if ($_REQUEST['action'] == "info")
	{
		header("Content-type: text/plain");
		die (json_encode(array("error" => $errstr, "code" => $errno)));
	}
	elseif ($_REQUEST['action'] == "output")
	{
		header("Content-type: text/plain");
		die ($status);
	}
	elseif ($_REQUEST['action'] == "reason")
	{
		header("Content-type: text/plain");
		die("$errstr ($errno)");
	}
	
	// Get the proper image
	if (!$status)
	{
		header("Content-type: ".mime_content_type($offline));
		include ($offline);
		die();
	}
	else
	{
		header("Content-type: ".mime_content_type($online));
		include ($online);
		die();
	}
}

/**
 * cURL
 */
elseif (ISUP_METHOD == "cURL" && function_exists('curl_version'))
{
	// Set up cURL to MuSeSPinger's specifications
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 1);
	curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_NOBODY, 1);
	curl_setopt($curl, CURLOPT_FILETIME, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	// Load the URL
	$result = curl_exec($curl);

	// TODO: Some kind of comment here
	if ($_REQUEST['action'] == "info")
	{
		header("Content-type: text/plain");
		die (json_encode(curl_getinfo($curl)));
	}
	elseif ($_REQUEST['action'] == "output")
	{
		header("Content-type: text/plain");
		die ($result);
	}
	elseif ($_REQUEST['action'] == "reason")
	{
		header("Content-type: text/plain");
		$info = curl_getinfo($curl);
		$http_code = $info['http_code'];
	
		$chart = array(0   => "The site isn't loading.",
			       200 => "The page loaded with no problem.",
			       201 => "The server stopped responding.",
			       202 => "The server stopped responding.",
			       203 => "The server loaded data from somewhere else.",
			       204 => "The page is blank.",
			       205 => "The server refused to return any content.",
			       206 => "The server sent only some of the content.",
			       300 => "The server offered multiple choices for us to follow.",
			       301 => "The server is redirecting us in a way that will never complete.",
			       302 => "The server is redirecting us in a way that will never complete.",
			       303 => "The server is redirecting us in a way that will never complete.",
			       304 => "The server didn't return any data because it thinks that we have the data already.",
			       305 => "The server wants us to use a proxy.",
			       306 => "The server thought it would be funny to return the fake error that we got.",
			       307 => "The server is redirecting us in a way that will never complete.",
			       400 => "We sent a bad request to the server.",
			       401 => "We are not allowed to view the page.",
			       402 => "We have to pay to view the page.",
			       403 => "We need to log in to view the page.",
			       404 => "The page was not found.",
			       405 => "The method we sent to the server is not acceptable.",
			       406 => "The server refused to take our request.",
			       407 => "The server wants us to use a proxy.",
			       408 => "The server waited too long for us.",
			       409 => "There is a battle going on between us and someone else.",
			       410 => "Gone. That's all we know.",
			       411 => "The server needs us to specify a request length.",
			       412 => "We didn't meet the conditions that the server requires.",
			       413 => "Our request was larger than what the server wants to process.",
			       414 => "Our request URI was too long for the server to process.",
			       415 => "We uploaded something that the server didn't like.",
			       416 => "The server can't send us more than it has.",
			       417 => "We didn't meet the conditions that the server requires.",
			       418 => "The server is actually a teapot.",
			       444 => "The server refused to return any content.",
			       500 => "The server made an uh-oh.",
			       501 => "The server isn't capable of answering us.",
			       502 => "The server network has a problem.",
			       503 => "The server is in maintenance mode.",
			       504 => "The server's network is being too slow.",
			       505 => "The server needs a software upgrade.",
			       );
	
		$reason = $chart[$http_code];
		if (!$reason) $reason = "$http_code Error";
		die ($reason);
	}
	else
	{
		$info = curl_getinfo($curl);
		$http_code = $info['http_code'];
	
		// On Warning
		if ($http_code == 201 || $http_code == 202 || $http_code == 204 || $http_code == 205 || $http_code >= 400 && $http_code < 500)
		{
		header("Content-type: ".mime_content_type($midline));
		include ($midline);
		die();
		}
	
		// On Success
		if ($http_code >= 200 && $http_code < 300)
		{
		header("Content-type: ".mime_content_type($online));
		include ($online);
		die();
		}
	
		// On Error
		if ($http_code >= 400 || $http_code < 200)
		{
		header("Content-type: ".mime_content_type($offline));
		include ($offline);
		die();
		}
	
		// On Who-Knows-What
		header("Content-type: ".mime_content_type($noline));
		include ($noline);
		die();
	}
}

/**
 * file_get_contents
 */
elseif (ISUP_METHOD == "file_get_contents" && function_exists('file_get_contents'))
{
	// Primitive fix for URL
	if (!strstr($url, '://'))
		$url = "http://$url";
	
	// Load the URL
	$result = file_get_contents($url);

	if ($_REQUEST['action'] == "info")
	{
		header("Content-type: text/plain");
		die (json_encode(array("result" => $result)));
	}
	elseif ($_REQUEST['action'] == "output")
	{
		header("Content-type: text/plain");
		die ($result);
	}
	elseif ($_REQUEST['action'] == "reason")
	{
		header("Content-type: text/plain");
		if ($result) die ("The page loaded.");
		else die ("The page failed to load.");
	}
	
	// Get the proper image
	if ($result)
	{
		header("Content-type: ".mime_content_type($online));
		include ($online);
		die();
	}
	else
	{
		header("Content-type: ".mime_content_type($offline));
		include ($offline);
		die();
	}
}

/**
 * None of the above
 */
else
{
	// Failed!
	if ($_REQUEST['action'] == "info")
	{
		header("Content-type: text/plain");
		die ('{"error":"This server is not capable of running MuSeSPinger with method '.ISUP_METHOD.'."}');
	}
	elseif ($_REQUEST['action'] == "output")
	{
		header("Content-type: text/plain");
		die ('MuSeSPinger: Fatal Error');
	}
	elseif ($_REQUEST['action'] == "reason")
	{
		header("Content-type: text/plain");
		die('This server is not capable of running MuSeSPinger with method '.ISUP_METHOD.'.');
	}
	else
	{
		header("Content-type: ".mime_content_type($noline));
		include ($noline);
		die();
	}
}
?>
