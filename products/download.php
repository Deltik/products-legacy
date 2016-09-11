<?php

$products = array(
// Title => SRC
"SmarTime" => "http://www.ticalc.org/pub/83plus/basic/programs/time/smartime.zip",
"MaText" => "http://www.ticalc.org/pub/83plus/basic/programs/algebra/matext.zip",
);

foreach ($products as $title => $src)
 {
 if (strtolower($_REQUEST['p']) == strtolower($title))
  header ("Location: $src");
 }

echo "<h1>Under Construction</h1>";

?>
