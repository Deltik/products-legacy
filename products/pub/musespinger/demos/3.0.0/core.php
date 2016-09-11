<?php
/**
 * MuSeSPinger
 *  Core File
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

// Include Configuration File
if (!include ("config.php"))
{
	die("<div style=\"background: pink; border: red groove;\"><center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>MuSeSPinger cannot load the configuration file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.</div>");
}

/********\
| SYSTEM |
\********/
define("ISUP_VERSION", '3.0.0');
$output = "Waiting for submit...".
/* DEMO MODE */"<p>DEMO MODE: <a href=\"admin.php\">Administration Control Panel</a></p>";

/***********\
| FUNCTIONS |
\***********/

/**
 * Failsafe Get Mime Type
 */
if (!function_exists('mime_content_type'))
  {
  // If Fileinfo extension is installed...
  if (function_exists('finfo_file'))
    {
    function mime_content_type($file)
      {
      $finfo = finfo_open(FILEINFO_MIME);
      $mimetype = finfo_file($finfo, $file);
      finfo_close($finfo);
      return $mimetype;
      }
    }
  // ... otherwise, use this method, which !Windows because Linux is better.
  else
    {
    function mime_content_type($file)
      {
      return trim(exec('file -bi '.escapeshellarg($file)));
      }
    }
  }

/**************\
| DATA CAPTURE |
\**************/

/**
 * Go
 */
if ($_REQUEST['action'] == "go")
{
	// Break up the input
	$data = explode("\n", $_REQUEST['urls']);
	foreach ($data as $key => $datum) $data[$key] = trim($datum);
	
	// Network joining
	$hosts_raw = @file_get_contents(ISUP_NETWORK."?action=api&command=ls");
	$hosts = @json_decode($hosts_raw, true);
	if (!is_array($hosts)) $hosts = array();
	
	// Render table
	if ($_REQUEST['mode'] != "image")
	{
		$output = "<table>";
		$output .= "<thead>";
		$output .= "<th>URL</th><th>Here</th>";
		for ($i = 0; $i < count($hosts); $i ++)
		{
			$output .= "<th><a href=\"".$hosts[$i]."\">$i</a></th>";
		}
		$output .= "</thead>";
		foreach ($data as $datum)
		{
			$output .= "<tr><td>$datum</td>";
			$output .= "<td><img src=\"status.php?data=".urlencode($datum)."\" alt=\"\" /></td>";
			for ($i = 0; $i < count($hosts); $i ++)
			{
				$output .= "<td><img src=\"".$hosts[$i]."status.php?data=".urlencode($datum)."\" alt=\"\" /></td>";
			}
			$output .= "</tr>";
		}
		$output .= "</table>";
	}
	// Render image
	else
	{
		$output = '<img src="img.php?' . urlencode(implode("\n", $data)) . '&time=' . time() . '" alt="Loading status image...  If the image does not appear within ' . ini_get('max_execution_time') . ' seconds, then the image could not be loaded." />';
	}
	
	// Show rendered output
	if ($_REQUEST['ajax'])
		die ($output);
}

/**
 * API
 */
if ($_REQUEST['action'] == "api")
{
	header("Content-type: text/plain");
	if ($_REQUEST['command'] == "version") die (ISUP_VERSION);
	if ($_REQUEST['command'] == "name") die (ISUP_NAME);
	if (ISUP_NETWORK_LOCAL != true) die ('{"error":"There is no network operating on this mirror.","code":0}');
	if ($_REQUEST['command'] == "ls")
	{
		die (json_encode($isup_locations));
	}
	die();
}
?>
