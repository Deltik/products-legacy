<?php
/**
 * MuSeSPinger
 *  Administration System
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

// Start PHP Session
session_start();

// Get Core Information
include ("core.php");

// Logout
if ($_REQUEST['action'] == "logout")
{
	unset($_SESSION['password']);
	header("Location: ".$_SERVER['PHP_SELF']);
}

// Import Password
if ($_REQUEST['password'])
{
	$_SESSION['password'] = $_REQUEST['password'];
	header("Location: ".$_SERVER['PHP_SELF']);
}
if ($_SESSION['password'])
	$PASSWORD = $_SESSION['password'];

($PASSWORD == ISUP_PASSWORD) ? define('ISUP_AUTHENTICATED', true) : define('ISUP_AUTHENTICATED', false);

// Save (+ Authentication Check)
if ($_REQUEST['save'] && ISUP_AUTHENTICATED)
{
	$isup_name = $_REQUEST['isup_name'];
	$isup_network = $_REQUEST['isup_network'];
	$isup_password = $_REQUEST['isup_password'];
	$isup_online = $_REQUEST['isup_online'];
	$isup_offline = $_REQUEST['isup_offline'];
	$isup_midline = $_REQUEST['isup_midline'];
	$isup_noline = $_REQUEST['isup_noline'];
	$isup_method = $_REQUEST['isup_method'];
	($_REQUEST['isup_method_local'] == "yes") ? $isup_method_local = true : $isup_method_local = false;
	$isup_locations = explode("\n", $_REQUEST['isup_locations']);
	foreach ($isup_locations as $key => $isup_location)
		$isup_locations[$key] = trim($isup_location);
	// Generate configuration file
	$config = '<?php
/**
 * MuSeSPinger
 *  Configuration File
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

// Title
define(\'ISUP_NAME\', '.var_export($isup_name, true).');

// MuSeSPinger Network
//  The URL of the MuSeSPinger network to join
//  To disable networking, comment out the line below.
define(\'ISUP_NETWORK\', '.var_export($isup_network, true).');

// Administration Password
define(\'ISUP_PASSWORD\', '.var_export($isup_password, true).');

// Images
$online  = '.var_export($isup_online, true).';
$offline = '.var_export($isup_offline, true).';
$midline = '.var_export($isup_midline, true).';
$noline  = '.var_export($isup_noline, true).';

// Method
//  cURL              - The most detailed
//  fsockopen         - The friendliest
//  file_get_contents - The dumbest
define(\'ISUP_METHOD\', '.var_export($isup_method, true).');

// Network Host
define(\'ISUP_NETWORK_LOCAL\', '.var_export($isup_network_local, true).');
$isup_locations =
'.var_export($isup_locations, true).';';
	// Actually Save
	/* DEMO MODE */#$result = @file_put_contents('config.php', $config);
	// Error Check
	if ($result != strlen($config))
	{
		$error = "Could not save the configuration file! Check the write permissions for the configuration file on the server (<code>chmod 777 config.php</code>).";
		/* DEMO MODE */ $error = "The configuration file cannot be saved in demo mode.";
	}
	else
	{
		header("Location: ".$_SERVER['PHP_SELF']);
		// DEPRECATED: Success message is no longer used
		$success = "Configuration file was successfully updated!";
	}
}

?><!DOCTYPE html>
<html>
<head>
 <title>Admin Center - <?=ISUP_NAME?></title>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body onload="start();">
<!-- Main Container -->
<div id="main">
<span class="glow"><?=ISUP_NAME?></span>
<br />
<span style="font-size: 18px;"><strong>Mu</strong>ltiple <strong>Se</strong>rver <strong>S</strong>tatus <strong>Pinger</strong> v<?=ISUP_VERSION?>
<br />
Administration Center</span>
<hr />
<?php

// Password Check
if (!ISUP_AUTHENTICATED)
{
?>
<div style="position: fixed; width: 100%; height: 100%; top: 0px; left: 0px; z-index: 998; background: black; opacity: 0.7;"></div>
<div style="text-align: center; position: absolute; width: 100%; top: 120px; z-index: 999;">
<div style="vertical-align: middle; background: white; border: 1px solid black; padding: 8px; margin: 0px auto; width: 250px;">
 <form action="<?=$_SERVER['PHP_SELF']?>">
  <!-- DEMO MODE --><p>DEMO MODE PASSWORD: <code>demo</code></p>
  <input type="password" name="password" placeholder="Password" />
 </form>
</div>
</div>
<?php
}
else
{
	if ($error)
	{
		echo "<div style=\"background: pink; border: 1px solid red;\"><h1 style=\"color: red;\">ERROR!</h1><h2>".$error."</h2></div>";
	}
	if ($success)
	{
		echo "<div style=\"background: lightgreen; border: 1px solid green;\"><h2>".$success."</h2></div>";
	}
?>
<div align="center">
<form action="<?=$_SERVER['PHP_SELF']?>">
<table>
	<thead>
		<th colspan="2">Basic Configuration</th>
	</thead>
	<tbody>
		<tr>
			<td>Service Name</td>
			<td><input type="text" name="isup_name" value="<?=ISUP_NAME?>" /></td>
		</tr>
		<tr>
			<td>Administration Password</td>
			<td><input type="password" name="isup_password" value="<?=ISUP_PASSWORD?>" /></td>
		</tr>
		<tr>
			<td>Pinger Method</td>
			<td>
				<select name="isup_method"><?php $append = " selected=\"selected\""; ?>
					<option value="cURL"<?php if (ISUP_METHOD == "cURL") echo $append; ?>>cURL (most detailed)</option>
					<option value="fsockopen"<?php if (ISUP_METHOD == "fsockopen") echo $append; ?>>fsockopen (friendliest)</option>
					<option value="file_get_contents"<?php if (ISUP_METHOD == "file_get_contents") echo $append; ?>>file_get_contents (dumbest)</option>
				</select>
			</td>
		</tr>
	</tbody>
	<thead>
		<th colspan="2">Images</th>
	</thead>
	<tbody>
		<tr>
			<td><img src="<?=$online?>" id="online_i" alt="Online (image not found)" /></td>
			<td><input type="text" name="isup_online" id="online" value="<?=$online?>" onkeyup="iUpdate(this.id);" /></td>
		</tr>
		<tr>
			<td><img src="<?=$offline?>" id="offline_i" alt="Offline (image not found)" /></td>
			<td><input type="text" name="isup_offline" id="offline" value="<?=$offline?>" onkeyup="iUpdate(this.id);" /></td>
		</tr>
		<tr>
			<td><img src="<?=$midline?>" id="midline_i" alt="w/Issues (image not found)" /></td>
			<td><input type="text" name="isup_midline" id="midline" value="<?=$midline?>" onkeyup="iUpdate(this.id);" /></td>
		</tr>
		<tr>
			<td><img src="<?=$noline?>" id="noline_i" alt="Unknown (image not found)" /></td>
			<td><input type="text" name="isup_noline" id="noline" value="<?=$noline?>" onkeyup="iUpdate(this.id);" /></td>
		</tr>
	</tbody>
	<thead>
		<th colspan="2">Mirroring</th>
	</thead>
	<tbody>
		<tr>
			<td>Network To Join (URL)</td>
			<td><input type="text" name="isup_network" value="<?=ISUP_NETWORK?>" /></td>
		</tr>
	</tbody>
	<thead>
		<th colspan="2">This Mirror</th>
	</thead>
	<tbody>
		<tr>
			<td>Enable Network Here</td>
			<td><input type="checkbox" name="isup_network_local" value="yes" checked="<?php if (ISUP_NETWORK_LOCAL) echo 'checked'; ?>" /></td>
		</tr>
		<tr>
			<td>Mirror List</td>
			<td><textarea name="isup_locations" id="isup_locations" onkeyup="adaptTextareaSize();" size="25"><?php echo implode("\n", $isup_locations); ?></textarea></td>
		</tr>
	</tbody>
</table>
<input type="submit" value="Save" name="save" id="submit" />
</form>
</div>

<!-- Footer Container -->
<div id="footer" style="height: 150px;">
<table style="height: 150px; width: 100%; border-collapse: collapse;">
	<tbody>
		<tr>
			<td style="width: 1px; border-right: 1px solid black; padding-right: 4px;"><span style="font-family: sans-serif,Sans; font-size: 36px; font-weight: bold;">News from <a href="http://www.deltik.org/" target="_blank">Deltik</a></span></td>
			<td><div style="overflow: auto; height: 150px; text-align: left;"><?php $result = @file_get_contents("http://products.deltik.org/musespinger/update/?version=".ISUP_VERSION); if (!$result) $result = ISUP_NAME." cannot find the MuSeSPinger news information from Deltik. Check at the <a href=\"http://products.deltik.org/\" target=\"_blank\">Deltik Official Website</a> or the <a href=\"http://www.deltik.org/\" target=\"_blank\">Deltik Products Website</a> for information."; echo $result; ?></div></td>
		</tr>
	</tbody>
</table>
</div>

<!-- Floating Containers -->
<!-- Go-to Site Link -->
<span style="position: fixed; top: 0px; left: 0px; padding: 8px; background: #0080ff; color: white; font-size: 12px; border-right: 4px #0080ff outset; border-bottom: 4px #0080ff outset; border-radius: 0px 0px 15px 0px; -moz-border-radius: 0px 0px 15px 0px; -webkit-border-radius: 0px 0px 15px 0px;" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='default';" onclick="if(!disable)window.open(document.getElementById('gotosite').href);"><a href="." style="color: white;" id="gotosite" onmouseover="disable=true;" onmouseout="disable=false;">Go to <?=ISUP_NAME?></a></span>
<!-- Report Problems Link -->
<span style="position: fixed; top: 0px; right: 0px; padding: 8px; background: #666666; color: white; font-size: 12px; border-left: 4px #666666 outset; border-bottom: 4px #666666 outset; border-radius: 0px 0px 0px 15px; -moz-border-radius: 0px 0px 0px 15px; -webkit-border-radius: 0px 0px 0px 15px;" onmouseover="this.style.cursor='pointer';" onmouseout="this.style.cursor='default';" onclick="if(!disable)window.open(document.getElementById('logout').href);"><a href="?action=logout" style="color: white;" id="logout" onmouseover="disable=true;" onmouseout="disable=false;">Log Out</a></span>
<?php
}
?>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
/***********\
| FUNCTIONS |
\***********/

/**
 * Initialize
 */
function start()
{
	adaptTextareaSize();
}

/**
 * Adapt Input Textarea Size
 */
function adaptTextareaSize()
{
	// Get the current input
	var soFar = $('#isup_locations').val();
	// Break the input by line
	soFarItems = soFar.split("\n");
	// Check column size
	var maxCol = 25;
	for (i in soFarItems)
	{
		if (soFarItems[i].length > maxCol)
			maxCol = soFarItems[i].length;
	}
	// Check row size
	var maxRow = 3;
	if (soFarItems.length > maxRow)
	maxRow = soFarItems.length;
	// Set
	$('#isup_locations').attr('rows', maxRow);
	$('#isup_locations').attr('cols', maxCol);
}

/**
 * Image Update
 * @param String myId The ID value of the input field
 */
function iUpdate(myId)
{
	// Update image
	$('#'+myId+'_i').attr('src', $('#'+myId).val());
}
</script>
</body>
</html>
