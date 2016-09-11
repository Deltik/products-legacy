<?php

if ($_REQUEST['a'] == "ajaxauth")
 {
 @include ("../config.php");
 
 $user_bool = false;
 $pass_bool = false;
 foreach ($access as $user => $pass)
  {
  if ($user == $_REQUEST['u'])
   $user_bool = true;
  if ($user == $_REQUEST['u'] && $pass == md5($_REQUEST['p']))
   $pass_bool = true;
  }
 
 if (!$user_bool && $_REQUEST['u'])
  echo "Incorrect username. ";
 if (!$_REQUEST['u'])
  echo "Enter a username. ";
 if (!$pass_bool && $_REQUEST['p'])
  echo "Incorrect password.";
 if (!$_REQUEST['p'])
  echo "Enter a password.";
 if ($user_bool && $pass_bool)
  echo "<input type=\"button\" value=\"Log In\" onclick=\"login('username', 'password', 'body');\"></input>";
 die();
 }

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){header("location:error.php?H4X0R");}

if (KWESHUNER == "admin")
 {
 @include ("../config.php");
 
 $user_bool = false;
 $pass_bool = false;
 foreach ($access as $user => $pass)
  {
  if ($user == $_REQUEST['u'])
   $user_bool = true;
  if ($user == $_REQUEST['u'] && $pass == md5($_REQUEST['p']))
   $pass_bool = true;
  }
 
 if (!$user_bool || !$pass_bool)
  echo '
<form action="" method="post">
 <div style="text-align: center; font-size: 12px;">Please log in to proceed to the administration control panel...</div>
 <table>
  <tr>
   <td style="font-family: Monospace, FreeMono, Courier;"><label for="username">Username: </label></td>
   <td style="font-family: Monospace, FreeMono, Courier;"><input style="background: #EDECEB; border: none; font-size: 14px; font-family: Monospace, FreeMono, Courier;" type="text" id="username" name="username" onkeypress="checkAuth(\'username\', \'password\', \'authstatus\');" onkeyup="checkAuth(\'username\', \'password\', \'authstatus\');" /></td>
  </tr>
  <tr>
   <td style="font-family: Monospace, FreeMono, Courier;"><label for="password">Password: </label></td>
   <td style="font-family: Monospace, FreeMono, Courier;"><input style="background: #EDECEB; border: none; font-size: 14px; font-family: Monospace, FreeMono, Courier;" type="password" id="password" name="password" onkeypress="checkAuth(\'username\', \'password\', \'authstatus\');" onkeyup="checkAuth(\'username\', \'password\', \'authstatus\');" /></td>
  </tr>
 </table>
<div style="text-align: center; font-size: 12px;" id="authstatus">Enter a username. Enter a password.</div>
</form><img style="display: none;" src="images/x.gif" onload="checkLogin(\'username\', \'password\');" />
';
 }

?>
