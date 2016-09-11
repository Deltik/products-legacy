<?php

/******************************\
|    Kweshuner Quiz Script     |
| Administration Control Panel |
|------------------------------|
|     Version: 0.0.2 ALPHA     |
\******************************/

// Load Configuration
define("KWESHUNER", "admin");
if (!@include("config.php"))
  {
  die("<center><h1 style=\"color:red;\">Uh-oh!</h1><h2>Kweshuner Quiz Script cannot load the configuration file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.");
  }

// Call Core File
if (!@include("class.php"))
  {
  die("<center><h1 style=\"color:red;\">Uh-oh!</h1><h2>$title cannot load the core class file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.");
  }

// Variable Transfer
$username = $_REQUEST['u'];
$password = $_REQUEST['p'];

// Loading Sequence (must be followed precicely)
// 1: Authentication
//    Intruder alert!
// 2: Settings
//    GIMME DA P0W3RZ!!!

// 1: Authentication
@include ("$handler_dir/auth.php");
if (!$user_bool || !$pass_bool)
 die();

// 2: Settings
$menu['caption'] = "Configuration";
$menu['content'] = "<div id=\"configdiv\">

<table width=\"100%\">
 <tr>
  <td style=\"text-align: center; width: 20%;\"><a href=\"#\" onclick=\"getPage('$handler_dir/settings-admin.php?u=$username&p=$password', 'configdiv');\"><img src=\"images/icons/configuration.png\" alt=\"[Configuration]\" border=\"none\" /></a><br /><a href=\"#\" onclick=\"getPage('$handler_dir/settings-admin.php?u=$username&p=$password', 'configdiv');\">Settings</a></td>
  <td style=\"text-align: center; width: 20%;\"><a href=\"#\" onclick=\"getPage('$handler_dir/themes-admin.php?u=$username&p=$password', 'configdiv');\"><img src=\"images/icons/theme.png\" alt=\"[Theme]\" border=\"none\" /></a><br /><a href=\"#\" onclick=\"getPage('$handler_dir/themes-admin.php?u=$username&p=$password', 'configdiv');\">Themes</a></td>
  <td style=\"text-align: center; width: 20%;\"><a href=\"#\" onclick=\"getPage('$handler_dir/files-admin.php?u=$username&p=$password', 'configdiv');\"><img src=\"images/icons/edit.png\" alt=\"[Edit Quizzes]\" border=\"none\" /></a><br /><a href=\"#\" onclick=\"getPage('$handler_dir/files-admin.php?u=$username&p=$password', 'configdiv');\">Manage Quizzes</a></td>
  <td style=\"text-align: center; width: 20%;\"><a href=\"#\" onclick=\"getPage('$handler_dir/update-admin.php?u=$username&p=$password', 'configdiv');\"><img src=\"images/icons/update.png\" alt=\"[Update]\" border=\"none\" /></a><br /><a href=\"#\" onclick=\"getPage('$handler_dir/update-admin.php?u=$username&p=$password', 'configdiv');\">Update</a></td>
  <td style=\"text-align: center; width: 20%;\"><a href=\"#\" onclick=\"getExternalPage('http://firefox.com/', 'Mozilla Firefox', 'body');\"><img src=\"images/icons/firefox.png\" alt=\"[Mozilla Firefox]\" border=\"none\" /></a><br /><a href=\"#\" onclick=\"getExternalPage('http://firefox.com/', 'Firefox', 'body');\">Get Firefox</a></td>
 </tr>
</table>

</div>";
$menu['id']      = "configuration";
include("$handler_dir/menu_show.php");

?>
