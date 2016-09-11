<?php

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){exit;}

// Title of This Script
$title = "Kweshuner";

// File/Directory Locations
$src           = "quizzes";
$handler_dir   = "handlers";
$dependent_dir = "dependents";
$js_src        = "$dependent_dir/functions.js";
$css_src       = "$dependent_dir/style.css";

// Minimalistic Mode (no styles; only basics)
//   0 == Disabled (normal); false == Disabled (normal)
//   1 == Enabled (special); true  == Enabled (special)
// ONLY ENABLE IF YOU WANT STYLES DISABLED!!!
// This is useful for plain quizzes/tests/surveys.
$minimalistic = false;

// Footer Configuration
//    0 == Disabled; false == Disabled
//    1 == Enabled ; true  == Enabled
//  $license == Creative Commons Attribution-Share Alike 3.0 United States License
//  $credits == POWERED BY KWESHUNER QUIZ SCRIPT
//  $w3cveri == Valid XHTML 1.0 Transitional
//  $footrhr == Footer Horizontal Rule
$license = 1;
$credits = 1;
$w3cveri = 1;
$footrhr = 1;

// Welcome Text
$welcome = 'Welcome to Kweshuner!';

// Navigation
$navigation = array(
              
              // array(TITLE, SRC, MODE)
              array("Home", "", "reload"),
              array("Administration CP", "admin.php", "ajax")
              
              );

// Users and Passwords
$access = array(
          
          // User => Password (MD5)
          "Deltik" => "d41d8cd98f00b204e9800998ecf8427e",
          "kweshuner" => "098f6bcd4621d373cade4e832627b4f6"

          );


// Logo
$logo_src = "images/kweshuner.png";
$logo_height = "";
$logo_width  = "190px";

?>
