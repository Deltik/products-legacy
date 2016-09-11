<?php

include ("core.php");

$users_resource = $MY_sql->query("SELECT * FROM users");
$users = $MY_sql->r2array($users_resource);

// Display Configuration
autodefine('LOGUNTU_TITLE', "Loguntu");

autodefine('LOGUNTU_BODY', <<<body
TEST
body
);

$error = <<<error
<!-- ### ERROR NOTICE ### -->
<div class="error">
 <table width="100%" style="text-align: center;">
  <tr>
   <td width="1%">
    <img src="images/dialog-error.png" />
   </td>
   <td>
    <div style="color: #a40000; font-weight: bold; text-decoration: underline; margin-bottom: 4px;">Under Construction</div>
    Wear your hard hats. ;)
   </td>
   <td width="1%">
    <img src="images/dialog-error.png" />
   </td>
  </tr>
 </table>
</div>
error;

autodefine('LOGUNTU_LOGO', '<table width="100%" style="border-collapse: collapse;">
 <tr>
  <td><div id="logo">&nbsp;</div></td>
  <td style="width: 1%;">
'.indent($error, 3).'
  </td>
 </tr>
</table>');

// Display!
$LOGUNTU->display();
?>
