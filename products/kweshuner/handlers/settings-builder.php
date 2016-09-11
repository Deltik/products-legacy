<?php

$title = $_REQUEST['title'];
$src = $_REQUEST['src'];
$handler_dir = $_REQUEST['handler_dir'];
$dependent_dir = $_REQUEST['dependent_dir'];
$js_src = $_REQUEST['js_src'];
$css_src = $_REQUEST['css_src'];
$minimalistic = $_REQUEST['minimalistic'];
$license = $_REQUEST['license'];
$credits = $_REQUEST['credits'];
$w3cveri = $_REQUEST['w3cveri'];
$footrhr = $_REQUEST['footrhr'];
$welcome = addslashes($_REQUEST['welcome']);
$logo_src = addslashes($_REQUEST['logo_src']);
$logo_height = addslashes($_REQUEST['logo_height']);
$logo_width = addslashes($_REQUEST['logo_width']);

if ($minimalistic)
 {
 $minimalistic = "true";
 } else {
 $minimalistic = "false";
 }
if ($license)
 {
 $license = "1";
 } else {
 $license = "0";
 }
if ($credits)
 {
 $credits = "1";
 } else {
 $credits = "0";
 }
if ($w3cveri)
 {
 $w3cveri = "1";
 } else {
 $w3cveri = "0";
 }
if ($footrhr)
 {
 $footrhr = "1";
 } else {
 $footrhr = "0";
 }

$shell = '<?php

// H4X0RZ PR3V3N7I0N
if(!defined(\'KWESHUNER\')){exit;}

// Title of This Script
$title = "'.$title.'";

// File/Directory Locations
$src           = "'.$src.'";
$handler_dir   = "'.$handler_dir.'";
$dependent_dir = "'.$dependent_dir.'";
$js_src        = "'.$js_src.'";
$css_src       = "'.$css_src.'";

// Minimalistic Mode (no styles; only basics)
//   0 == Disabled (normal); false == Disabled (normal)
//   1 == Enabled (special); true  == Enabled (special)
// ONLY ENABLE IF YOU WANT STYLES DISABLED!!!
// This is useful for plain quizzes/tests/surveys.
$minimalistic = '.$minimalistic.';

// Footer Configuration
//    0 == Disabled; false == Disabled
//    1 == Enabled ; true  == Enabled
//  $license == Creative Commons Attribution-Share Alike 3.0 United States License
//  $credits == POWERED BY KWESHUNER QUIZ SCRIPT
//  $w3cveri == Valid XHTML 1.0 Transitional
//  $footrhr == Footer Horizontal Rule
$license = '.$license.';
$credits = '.$credits.';
$w3cveri = '.$w3cveri.';
$footrhr = '.$footrhr.';

// Welcome Text
$welcome = \''.$welcome.'\';

// Navigation
$navigation = array(
              
              // Link Name => HREF
              "Administration CP" => "admin.php"
              
              );

// Users and Passwords
$access = array(
          
          // User => Password (MD5)
          "Deltik" => "d41d8cd98f00b204e9800998ecf8427e",
          "kweshuner" => "098f6bcd4621d373cade4e832627b4f6"

          );


// Logo
$logo_src = "'.$logo_src.'";
$logo_height = "'.$logo_height.'";
$logo_width  = "'.$logo_width.'";

?>';

header("Content-type: text/plain");

echo $shell;

?>
