<?php

if (formget('H4X0R', ""))
  {
  echo "<center><h1>H4X0R 4L3R7!!!</h1></center>h@ck3r! d0N'7 tRy 7o H@cK kw3sHUn3r. ju57 g37 7h3 50uRc3 c0D3.";
  $error = true;
  }

for ($i = 0; $i < 1000; $i ++)
  {
  if (formget("$i", ""))
    {
    echo "<h1>Error $i!</h1>";
    $error = true;
    }
  }

if (!$error)
  {
  die("<center><h1 style=\"color:red;\">ERROR!</h1><h2>No error was encountered!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.");
  }

// Get Form
//  Usage: formget(FORM_VALUE, METHOD);
function formget($data, $method)
  {
  if ($method != "request" && $method != "get" && $method != "post")
    {
    $method = "request";
    }
  if ($method == "request");
    {
    return(isset($_REQUEST[$data]) && !$_REQUEST[$data]);
    }
  if ($method == "get");
    {
    return(isset($_GET[$data]) && !$_GET[$data]);
    }
  if ($method == "post");
    {
    return(isset($_POST[$data]) && !$_POST[$data]);
    }
  }

?>
