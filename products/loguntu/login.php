<?php

include ("core.php");

autodefine('LOGUNTU_BODY', <<<body
<form action="" method="post" class="login">
 <p>Log in to Loguntu</p>
 <table>
  <tr>
   <th><label for="username">Username or Email</label></th>
   <td><input type="text" name="username" id="username" /></td>
  </tr>
  <tr>
   <th><label for="username">Password</label></th>
   <td><input type="password" name="password" id="password" /></td>
  </tr>
  <tr>
   <th>Remember Me</th>
   <td><input type="checkbox" name="remember" id="remember" value="remember" /> <a style="float: right;">Forgot password?</a></td>
  </tr>
  <tr>
   <th colspan="2"><input type="submit" name="submit" value="Log in" /></th>
  </tr>
 </table>
</form>
<style type="text/css">
.login {
	margin-left: auto;
	margin-right: auto;
}
.login th {
	text-align: right;
}
</style>
body
);

// Display!
$LOGUNTU->display();
?>
