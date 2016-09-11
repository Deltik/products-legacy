<?php
/*********************************************************************************
** Original script created by ZAPPERPOST (http://www.deltik.org/user.php?id.1),		**
** Webmaster of Deltik (http://www.Deltik.org)								**
** Revised with looping by JRD (jrdgames@gmail.com),							**
** Webmaster of J'R'D' Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)	**
*********************************************************************************/
// Settings
require_once('config.php');

$online = '<img src="online.gif" border="0" alt="Online" />';// HTML for the online image
$offline = '<img src="offline.gif" border="0" alt="Offline" />';// HTML for the offline image
$servers = $nodelist;// The servers are in the nodelist array
$header = "IsMyWebsite Node Status List.";// Default header to use
$stitle = 'Node';// Default title for nodes

if(isset($_POST['custom']) && addslashes($_POST['custom']) == true) {
	$pcustom = addslashes($_POST['custom']);// Security
	$cus = explode(",", $pcustom);// Get the servers into an array
	$servers = $cus;// The servers are in the cus array
	$header = "Custom Server Status List.";// Header to use for custom requests
	$stitle = 'Server';// Title to use for custom servers
	$cust = 1;// This is a custom check
}

if(isset($_GET['systemupdate']) && addslashes($_GET['systemupdate']) == "nowplease") {// Check to see if we should update the system
	header('Location: update.php');// Go to update.php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>IsMyWebsite Server Status Checker</title>

<script type="text/javascript">
function disable()
{
document.getElementById("submit").disabled=true;
document.getElementById("status").innerHTML="Loading...";
document.getElementById("reset").disabled=true;
}
</script>
</head>
<body>
<center>
<?php

if($_POST == FALSE)
  exit('To begin the IsMyWebsite Server Status Check, click &quot;Go&quot;.<br/>
<br/>
<span style="color: #FF0000"><b>The more URLs you enter, the longer the test will take. Do not cancel the test, or else you will have to reload.</b></span><br/>
<br/>
<form action=" " method="post">
  <input type="text" name="custom" id="custom" />
  Custom server(s) to test (default: [blank] Checks the current IsMyWebsite nodes); For multiple, separate with a comma.<br/>
  <input type="text" name="port" value="'.$defaultport.'" size="4" maxlength="5" id="port" />
  Port (default: '.$defaultport.')<br/>
  <input type="submit" value="Go" id="submit" onclick="disable()" />
  <input type="reset" name="Reset" value="Erase" id="reset" />
</form>
<br/>
<fieldset>
<legend> Status: </legend>
<h1 id="status">Waiting for submit...</h1>
</fieldset>
<br/>
<br/>
<u>Ports:</u><br/>
80 = HTTP<br/>
21 = FTP<br/>
3306 = MySQL<br/>
2082 = cPanel<br/>
2083 = Secure cPanel<br/>
2086 = cPanel WHM<br/>
2095 = cPanel Webmail');

$pport = addslashes($_POST['port']);// Security
$port = (isset($_POST['port']))? $pport : $defaultport;// $which port are we going to use

if($port <= 0 || $port >= 65535) {// Port is wrong, using default
	echo '<span style="color: #FF0000">Error: The port you specified, '.$pport.', is not a valid port number, so the default of '.$defaultport.', HTTP, will be used.</span><br/>';
	$port = $defaultport;
	}

echo "<h2>$header</h2>";
echo '<b><span style="color: #00FF00">Port Checked</span></b>: <b><span style="color: #0000FF">'.$port.'</span></b>';
echo '<table border="1">';
	foreach($servers as $num => $node) {// Loop through the nodes
		if($cust == 1) {// If this list is custom then we have to increment num otherwise it will start as 0
			$num++;
		}
		echo '<tr><td>';
		echo "$stitle $num - $node";// Server title num - url
		echo '</td><td>';
		if($cust != 1 && in_array($num, $disablednodelist)) {// If this node is disabled
			echo $offline;
		} else {// This node is not disabled
			if(! $sock = @fsockopen($node, $port, $num, $error, 5)) {// If the server is offline show this image \/
				echo $offline;
			} else {// Otherwise show this image \/
				echo $online;
				fclose($sock);
			}
		}
		echo '</td></tr>';
	}
	echo '</table>';
echo 'Created by <a href="http://www.deltik.org/user.php?id.1">ZAPPERPOST</a>, Webmaster of <a href="http://www.deltik.org">Deltik</a> <br/>
<br/>
<form action=" " method="post">
  <input type="hidden" name="port" value="'.$port.'" />
  <input type="hidden" name="custom" value="'.$pcustom.'" />
  <input type="submit" value="Reload/Refresh" />
</form>
<form action=" " method="post">
  <input type="submit" value="    Do It Again!    " />
</form>';
?>
</center>
</body>
</html>