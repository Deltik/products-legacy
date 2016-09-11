<?php

// CONFIGURATION BELOW
$string = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?";
// CONFIGURATION ABOVE

if ($_REQUEST['data']) $string = $_REQUEST['data'];

header("Content-type: text/plain");

$string_gzdeflate = gzdeflate($string, 9);
$string_gzencode = gzencode($string, 9);
$string_gzcompress = gzcompress($string, 9);
$string_base64 = base64_encode($string);
$string_base64_gzdeflate = base64_encode($string_gzdeflate);
$string_base64_gzencode = base64_encode($string_gzencode);
$string_base64_gzcompress = base64_encode($string_gzcompress);

echo "Original String:\n";
var_dump($string);
echo "\n\n";

echo "base64'd String:\n";
var_dump($string_base64);
echo "\n\n";

echo "base64'd gzdeflate'd String:\n";
var_dump($string_base64_gzdeflate);
echo "\n\n";

echo "base64'd gzencode'd String:\n";
var_dump($string_base64_gzencode);
echo "\n\n";

echo "base64'd gzcompress'd String:\n";
var_dump($string_base64_gzcompress);
echo "\n\n";

echo "gzdeflate'd String:\n";
echo "string(".strlen($string_gzdeflate).")";
echo "\n\n";

echo "Safe Binary base64'd gzdeflate'd String:\n";
var_dump(strtohex($string_base64_gzdeflate));
echo "\n\n";


/***********\
| FUNCTIONS |
\***********/

// Hexadecimal to String
//  Usage: hextostr(STRING_HEXADECIMAL);
function hextostr($x)
  { 
  $s = '';
  foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
    $s .= chr(hexdec($h));
  return $s;
  } 

// String to Hexadecimal
//  Usage: strtohex(STRING);
function strtohex($x)
  { 
  $s = '';
  foreach (str_split($x) as $c)
    $s .= sprintf("%02X", ord($c));
  return $s;
  }
?>
