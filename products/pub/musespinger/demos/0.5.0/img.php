<?php
header('Content-type: image/png');
/*********************************************************************************
** Original script created by ZAPPERPOST (http://www.deltik.org/user.php?id.1),		**
** Webmaster of Deltik (http://www.Deltik.org)								**
** Converted to a GD image by JRD (jrdgames@gmail.com),						**
** Webmaster of J'R'D' Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)	**
*********************************************************************************/
// Settings
require_once('config.php');
if(isset($_GET['systemupdate']) && $_GET['systemupdate'] == "nowplease") {// Check to see if we should update the system
	$silent = true;// We want the update to be done silently
	require_once('update.php');// Check for updates and update if neccessary
}

$fcheck = (is_file($im_file))? 1 : 0;// Check whether $im_file exists
$fcheck = ($_GET['update'] == 1)? 0 : $fcheck;// Check if a forced update of the image is wanted
$cust = 0;// This is not a custom check
$servers = $nodelist;// The servers are in the nodelist array
$header = "IsMyWebsite Node Status List.";// Default header to use
$stitle = 'Node';// Default title for nodes
$port = $defaultport;
if(isset($_GET['port']) && $_GET['port'] > 0 && $_GET['port'] < 65535) {
	$port = $_GET['port'];// If a custom port was requested and the port is valid over-ride previously set port 80
}
if(isset($_GET['custom'])) {// If a custom check is requested...
	$fcheck = 0;// Don't check for a file
	$cust = 1;// This is a custom check
	$cus = explode(",", $_GET['servers']);// Get the servers into an array
	$servers = $cus;// The servers are in the cus array
	$header = "Custom Server Status List.";// Header to use for custom requests
	$stitle = 'Server';// Title to use for custom servers
}

if($fcheck == 1 && date('dG') == date('dG', filemtime($im_file))) {// If $im_file was updated this hour and today call up the saved image
	$im = imagecreatefrompng($im_file);// Create an image handle out of $im_file
	imagesavealpha($im, true);
	$trans_colour = imagecolorallocatealpha($im, 0, 0, 0, 127);// Make the bg transparent

	imagepng($im);// Output the saved image to the browser
} else {// If $im_file was updated last hour make a anew image and save it
	$imy = 60 + (count($servers) * 25);// We need 60 px for the base image and roughly 25 px per server, this is used for creating the image
	if($port != $defaultport) {// If the port is not the default (80)
		$imy += 20;// Add 20 px to the image height for the port message
	}
	$im = imagecreatetruecolor(300, $imy);// Create a blank image
	imagesavealpha($im, true);
	$trans_colour = imagecolorallocatealpha($im, 0, 0, 0, 127);// Make the bg transparent
	imagefill($im, 0, 0, $trans_colour);// Fill the background with transparency

	$blue = imagecolorallocate($im, 24, 93, 148);// We want a blue color for the text
	$online = imagecreatefromgif('online.gif');// Create the image resource for the online image
	$offline = imagecreatefromgif('offline.gif');// Create the image resource for the offline image

	$y = 30;// Starting y point for the status message of each node
	imagestring($im, 5, 20, 5, $header, $blue);// Output the image header
	foreach($servers as $num => $node) {// Loop through the nodes
		if($cust == 1) {// If this list is custom then we have to increment num otherwise it will start as 0
			$num++;
		}
		imagestring($im, 4, 10, $y, "$stitle $num - $node", $blue);// Server title num - url
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
	imagestring($im, 3, 20, (imagesy($im) - 35), "Last updated: ".date('h:i:sa T (P)'), $blue);
	imagestring($im, 1, 20, (imagesy($im) - 20), "Original Script made by ZAPPERPOST, www.deltik.org.", $blue);
	imagestring($im, 1, 25, (imagesy($im) - 10), "Converted to an image by JRD, www.jrdltd.ath.cx.", $blue);
	
	if($cust != 1) {// If the image is not custom
		imagepng($im, 'status.png', 0, NULL);// Save the image to disk
	}
	imagepng($im);// Output the image to the browser
	imagedestroy($online);// Clean up resources by destroying the image handle for the online image
	imagedestroy($offline);// Clean up resources by destroying the image handle for the offline image
}

imagedestroy($im);// Clean up resources by destroying the main image handle
?>