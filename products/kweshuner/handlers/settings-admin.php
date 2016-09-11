<?php

// H4X0RZ PR3V3N7I0N
define("KWESHUNER","admin");@include("auth.php");if(!$user_bool||!$pass_bool){header("location:error.php?H4X0R");}

echo '
This... is going to be... very... mean. <strong>AARGH!!!</strong><br />
<form>
<table width="100%">
 <tr>
  <td>Title</td>
  <td><input type="text" id="title" name="title" value="'.$title.'" style="width: 100%;" /></td>
 </tr>
 <tr>
  <td>Quizzes Directory</td>
  <td><input type="text" id="src" name="src" value="'.$src.'" style="width: 100%;" /></td>
 </tr>
 <tr>
  <td>Handlers Directory</td>
  <td><input type="text" id="handler_dir" name="handler_dir" value="'.$handler_dir.'" style="width: 100%;" /></td>
 </tr>
 <tr>
  <td>Dependents Directory</td>
  <td><input type="text" id="dependent_dir" name="dependent_dir" value="'.$dependent_dir.'" style="width: 100%;" /></td>
 </tr>
 <tr>
  <td>JavaScript Location</td>
  <td><input type="text" id="js_src" name="js_src" value="'.$js_src.'" style="width: 100%;" /></td>
 </tr>
 <tr>
  <td>Stylesheet Location</td>
  <td><input type="text" id="css_src" name="css_src" value="'.$css_src.'" style="width: 100%;" /></td>
 </tr>
 <tr>
  <td>Minimalistic Mode</td>
  <td><input type="checkbox" id="minimalistic" name="minimalistic" selected="'; if ($minimalistic) { echo "selected"; } else { echo "unselected"; } echo '" style="width: 100%;" /></td>
 </tr>
</table>
</form>
';

?>
