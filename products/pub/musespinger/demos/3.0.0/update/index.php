<?php
/**
 * MuSeSPinger
 *  Direct News Feeder
 *
 * Formerly:
 *  MuSeSPinger Updater: Server-Side Script
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

$version = "3.0.0";
$version_client = $_REQUEST['version'];

if (version_compare($version_client, "3", ">="))
{
	header("Content-type: text/plain");
	if (version_compare($version_client, $version, "<"))
		echo "<h1>A new version of MuSeSPinger is available! <a href=\"http://products.deltik.org/pub/musespinger/releases/$version/\" target=\"_blank\">Click here</a> to download.</h1>";
	echo "<p>The latest version of MuSeSPinger is v$version. You are using v$version_client.</p>";
	echo "<p><a href=\"http://products.deltik.org/pub/musespinger/CHANGELOG\" target=\"_blank\">Changelog</a></p>";
	die();
}

####################################################
## DEPRECATED: Backwards compatibility code below ##
####################################################

$files = array(
"<span style=\"font-weight: bold; color: red;\">STOP RIGHT THERE! The MuSeSPinger v2 series is no longer being supported, and the automatic download system has been taken down. Please manually download and install <a href=\"http://products.deltik.org/pub/musespinger/releases/$version/\">MuSeSPinger v$version</a>.</span>");
$fixedfiles = array();
$filesdel = array(
);
$changelog = array(
"2.0.0a" => "Initial Release",
"2.0.1a" => "Added Background Communications",
"2.0.1a1" => "Update System Test",
"2.0.1a2" => "Fixed Update System",
"2.0.1a3" => "Cleaned up source code to meet the Deltik Programming Syntax Standard",
"2.0.1a4" => "Fixed a critical Update Manager bug in which only the last update server was considered for use",
"2.1.0a" => "Improved update system to eliminate 500 Internal Server Errors",
"2.1.0b" => "Implemented image output feature",
"3.0.0+" => "Completely rewritten. <span style=\"font-weight: bold; color: red;\">STOP RIGHT THERE! The MuSeSPinger v2 series is no longer being supported, and the automatic download system has been taken down. Please manually download and install <a href=\"http://products.deltik.org/pub/musespinger/releases/$version/\">MuSeSPinger v$version</a>.</span>",
);

// Tell everybody the latest version if something requests it
if ($_REQUEST['data'] == "version"){
  die ($version);
  }

// Send Updated File (v2.1.0a and above)
if ($_REQUEST['file'])
  {
  // if() Security Check
  if (strpos("/", $_REQUEST['file']) === false)
    {
    die(file_get_contents($_REQUEST['file'].".txt"));
    }
    else
    {
    die("H4X0R PR3V3NT!0N");
    }
  }

// Outputting the instructions for the client. The order is very strict!
//   So, this is what happens:
//   The client sends their version to the server.
//   Then the server handles that version appropriately.

if (version_compare($_REQUEST['version'], "2.1.0a", "<=")){
  echo "Version: $version";
  echo '<br />';
  echo "Changelog BEGIN<br />";
  $i = 0;
  foreach($changelog as $v => $value) {
    if (version_compare($_REQUEST['version'], $v, "<") && version_compare($v, $version, "<="))
      echo '&bull; '.$value.' in v'.$v.'.<br />';
    $i++;
    }
  echo "Changelog END<br />";
  echo "Files: ".count($files);
  echo '<br />';
  for ($i=0; $i<count($files); $i++){
    echo $files[$i];
    echo '<br />';
    }
  echo "Configuration Files: ".count($fixedfiles);
  echo '<br />';
  for ($i=0; $i<=count($fixedfiles); $i++){
    echo $fixedfiles[$i];
    echo '<br />';
    }
  }

?>
