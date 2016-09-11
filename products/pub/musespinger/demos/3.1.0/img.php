<?php
/**
 * MuSeSPinger
 *  Status Image Render Script
 *
 * TODO: This code was salvaged by the Deltik Organization on 04 February 2011.
 *       The original code was designed for the precessor of MuSeSPinger, IMWNSC (IsMyWebsite Node Status Checker).
 *       Now, this code needs to be cleaned up and integrated into MuSeSPinger.
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

if (!$_SERVER['QUERY_STRING'])
  header("Location: index.php");
else
  header('Content-type: image/png');
/*********************************************************************************
** Original script created by ZAPPERPOST (http://www.deltik.org/user.php?id.1),		**
** Webmaster of Deltik (http://www.Deltik.org)								**
** Converted to a GD image by JRD (jrdgames@gmail.com),						**
** Webmaster of J'R'D' Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)	**
*********************************************************************************/
// Settings
/*require_once('config.php');
if(isset($_GET['update'])) {// Check to see if we should imgupdate the system
	$silent = true;// We want the update to be done silently
	require_once('update.php');// Check for updates and update if neccessary
}*/
$im_file = "status.png";
$defaultport = 80;

$fcheck = (is_file($im_file))? 1 : 0;// Check whether $im_file exists
$fcheck = ($_GET['imgimgupdate'] == 1)? 0 : $fcheck;// Check if a forced imgupdate of the image is wanted
$cust = 0;// This is not a custom check
$servers = $nodelist;// The servers are in the nodelist array
$header = "IsMyWebsite Node Status List.";// Default header to use
$stitle = 'Node';// Default title for nodes
$port = $defaultport;
if(isset($_GET['port']) && $_GET['port'] > 0 && $_GET['port'] < 65535) {
	$port = $_GET['port'];// If a custom port was requested and the port is valid over-ride previously set port 80
}
/*if(isset($_GET['custom'])) {// If a custom check is requested...*/
	$fcheck = 0;// Don't check for a file
	$cust = 1;// This is a custom check
	$_SERVER['QUERY_STRING'] = explode("&", $_SERVER['QUERY_STRING']);
	$_SERVER['QUERY_STRING'] = array_shift($_SERVER['QUERY_STRING']);
	$cus = explode("%0A", $_SERVER['QUERY_STRING']);// Get the servers into an array
	$servers = $cus;// The servers are in the cus array
	$header = "Server Status";// Header to use for custom requests
	if (count($servers) > 1)
	  $header = "Server Statuses";
	$stitle = 'Server';// Title to use for custom servers
/*}*/

// Draw the image
	$imy = 60 + (count($servers) * 25);// We need 60 px for the base image and roughly 25 px per server, this is used for creating the image
	if($port != $defaultport) {// If the port is not the default (80)
		$imy += 20;// Add 20 px to the image height for the port message
	}
	$im = imagecreatetruecolor(300, $imy);// Create a blank image
	imagesavealpha($im, true);
	$trans_colour = imagecolorallocatealpha($im, 0, 0, 0, 127);// Make the bg transparent
	imagefill($im, 0, 0, $trans_colour);// Fill the background with transparency

	$blue = imagecolorallocate($im, 24, 93, 148);// We want a blue color for the text
	$online = imagecreatefrompng('online.png');// Create the image resource for the online image
	$offline = imagecreatefrompng('offline.png');// Create the image resource for the offline image

	$y = 30;// Starting y point for the status message of each node
	imagestring($im, 5, 20, 5, $header, $blue);// Output the image header
	foreach($servers as $num => $node) {// Loop through the nodes
		if($cust == 1) {// If this list is custom then we have to increment num otherwise it will start as 0
			$num++;
		}
		imagestring($im, 4, 10, $y, /*"$stitle $num - $node"*/$node, $blue);// Server title num - url
		if($cust != 1 && in_array($num, $disablednodelist)) {// If this node is disabled
			imagecopymerge($im, $offline, 240, $y, 0, 0, imagesx($offline), imagesy($offline), 100);
		} else {// This node is not disabled
			if(! $sock = @fsockopen($node, $port, $num, $error, 5)) {// If the server is offline show this image \/
				imagecopymerge($im, $offline, 240, $y, 0, 0, imagesx($offline), imagesy($offline), 100);
			} else {// Otherwise show this image \/
				imagecopymerge($im, $online, 240, $y, 0, 0, imagesx($online), imagesy($online), 100);
				fclose($sock);
			}
		}
		$y = $y + 25;// Increment the y point after each node is put on the image
	}
	if($port != $defaultport) {// If the port is not the default (80), show the port checked message
		imagestring($im, 2, (imagesx($im) - 210), (imagesy($im) - 55), "Port Checked: $port.", $blue);
	}
	imagestring($im, 3, 20, (imagesy($im) - 35), "Last imgupdated: ".date('h:i:sa T (P)'), $blue);
	imagestring($im, 1, 20, (imagesy($im) - 20), "Original Script made by ZAPPERPOST, www.deltik.org.", $blue);
	imagestring($im, 1, 25, (imagesy($im) - 10), "Converted to an image by JRD, www.jrdltd.ath.cx.", $blue);
	
	if($cust != 1) {// If the image is not custom
		imagepng($im, 'status.png', 0, NULL);// Save the image to disk
	}
	imagepng($im);// Output the image to the browser
	imagedestroy($online);// Clean up resources by destroying the image handle for the online image
	imagedestroy($offline);// Clean up resources by destroying the image handle for the offline image

imagedestroy($im);// Clean up resources by destroying the main image handle
?>
