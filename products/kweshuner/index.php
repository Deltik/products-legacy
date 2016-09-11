<?php

/***********************\
| Kweshuner Quiz Script |
|-----------------------|
| Version: 0.0.2 ALPHA  |
\***********************/

// TODO:
// Tier 3:
//   Make the whole thing work
//
// Tier 2:
//   
//

// Load Configuration
define("KWESHUNER", true);
if (!@include("config.php"))
  {
  die("<center><h1 style=\"color:red;\">Uh-oh!</h1><h2>Kweshuner Quiz Script cannot load the configuration file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.");
  }

// Call Core File
if (!@include("class.php"))
  {
  die("<center><h1 style=\"color:red;\">Uh-oh!</h1><h2>$title cannot load the core class file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.");
  }

// Integrity Check
if (!@include("$handler_dir/integrity.php"))
  {
  echo "<div style=\"background: #FFCCCC;\" id=\"error\"><div style=\"text-align:right;\"><img src=\"images/x.gif\" alt=\"[X]\" style=\"margin-top:4px;margin-right:4px;cursor:hand;cursor:pointer;\" onclick=\"document.getElementById('error').innerHTML='';\" onmouseover=\"this.src='images/x-down.gif'\" onmouseout=\"this.src='images/x.gif'\" /></div><center><h1 style=\"color:red;margin:0px;\">Uh-oh!</h1><h2 style=\"margin:0px;\">$title cannot load the integrity checking file!</h2></center><p style=\"margin:0px;\">Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.</div>";
  }

// What to do if error:
//  Code 0: No issue
//  Code 1: Warning
//  Code 2: Go Minimalistic
//  Code 3: Fatal Error
if ($errorlevel == 3)
  die($error);
if ($errorlevel == 2)
  $minimalistic = 1;
if ($errorlevel == 1)
  echo $error;

// What to do if minimalistic:
if ($minimalistic && !@include("$handler_dir/minimalistic.php"))
  {
  die("<div style=\"background: #FFCCCC;\" id=\"error\"><div style=\"text-align:right;\"><img src=\"images/x.gif\" alt=\"[X]\" style=\"margin-top:4px;margin-right:4px;cursor:hand;cursor:pointer;\" onclick=\"document.getElementById('error').innerHTML='Why in the world did you close that out? $title doesn\'t work. Face it! Without this, you would be staring at a blank page.';document.getElementById('error').style.background='';\" onmouseover=\"this.src='images/x-down.gif'\" onmouseout=\"this.src='images/x.gif'\" /></div><center><h1 style=\"color:red;margin:0px;\">Uh-oh!</h1><h2 style=\"margin:0px;\">$title cannot load anything useful!</h2></center><p style=\"margin:0px;\">Minimalistic mode (no styles; only basic output) doesn't even work. Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.</div>");
  }

// Loading Sequence (must be followed precicely)
// 1: Header
//    Render the top of the source code that people see
// 2: Top Bar
//    The cap of what is actually displayed in Kweshuner
// 3: Left Menu Bar
//    The content in the right menu bar
// 4: Body
//    The main content container
// 5: Right Menu Bar
//    The content in the right menu bar
// 6: Footer
//    Render the bottom of the source code that people see

// 1: Header
@include ("$handler_dir/header.php");

// 2: Top Bar
@include ("$handler_dir/cap.php");

// 3: Left Menu Bar
@include ("$handler_dir/menu-left.php");

// 4: Body
@include ("$handler_dir/body.php");

// 5: Right Menu Bar
@include ("$handler_dir/menu-right.php");

// 6: Footer
@include ("$handler_dir/footer.php");
?>
