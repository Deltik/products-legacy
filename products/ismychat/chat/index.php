<?php

$serverhost = explode('.', $_SERVER["HTTP_HOST"]);
$sub = $serverhost[0];
array_shift($serverhost);
$domain = implode('.', $serverhost);
if ($sub == "www")
  {
  $sub = "";
  }
if ($_REQUEST['room'])
  {
  $room = $_REQUEST['room'];
  }
  else
  {
  $room = $sub;
  }

header("Content-type: text/plain");

echo "Requested Room: ".$room."\n";
echo "@ Domain: ".$domain."\n";

?>
