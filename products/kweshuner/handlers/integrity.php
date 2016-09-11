<?php

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){header("location:error.php?H4X0R");}

$files = array(
                // File => If errorlevel
                //   Code 1: Warning
                //   Code 2: Fatal Error
                //   Code 3: Go Minimalistic
                "$handler_dir/auth.php"       => 1,
                "$handler_dir/body.php"       => 3,
                "$handler_dir/cap.php"        => 1,
                "$handler_dir/error.php"      => 1,
                "$handler_dir/footer.php"     => 1,
                "$handler_dir/header.php"     => 2,
                "$handler_dir/menu-left.php"  => 1,
                "$handler_dir/menu-right.php" => 1,
                "$handler_dir/menu_show.php"  => 1,
                "$handler_dir/navi.php"       => 1,
                "$css_src"                    => 2,
                "$js_src"                     => 2
                );

$error = "<div style=\"background: #FFCCCC;\" id=\"error\"><div style=\"text-align:right;\"><img src=\"images/x.gif\" alt=\"[X]\" style=\"margin-top:4px;margin-right:4px;cursor:hand;cursor:pointer;\" onclick=\"document.getElementById('error').innerHTML='';\" onmouseover=\"this.src='images/x-down.gif'\" onmouseout=\"this.src='images/x.gif'\" /></div>";
$errorlevel = 0;

foreach ($files as $file => $iferrorlevel)
  {
  if (!file_exists($file))
    {
    if ($errorlevel < $iferrorlevel)
      $errorlevel = $iferrorlevel;
    if ($iferrorlevel == 1)
      $error.="<strong>Warning:</strong> $file does not exist. Functionality will be reduced without this file.<br />";
    if ($iferrorlevel == 2)
      $error.="<strong>Error:</strong> $file does not exist. It is necessary for styles. Kweshuner will run in Minimalistic Mode if fatal errors are not encountered.<br />";
    if ($iferrorlevel == 3)
      $error.="<strong>Fatal Error:</strong> $file does not exist. Kweshuner cannot function without this file.<br />";
    }
  }

$error.="<br />Contact the webmaster at ".$_SERVER['SERVER_NAME']." to get this fixed.</div>";

// Check Navigation
if (!@include("$handler_dir/navi.php"))
  {
  function loadNavi()
    {
    return "<div style=\"color:red;text-align:center;\"><strong>Uh-oh!</strong><br />Navigation cannot be loaded.</div>";
    }
  }

?>
