<?php

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){header("location:error.php?H4X0R");}

?>
   <!-- Right Menu Bar-->
   <td width="20%" style="vertical-align:top;">
<?php

$menu['caption'] = "Status";
$menu['content'] = "<div id=\"status\" style=\"text-align: center;\">Idle</div>";
$menu['id']      = "statusmenu";
include("menu_show.php");

$menu['caption'] = $title;
$menu['content'] = "TODO";
$menu['id']      = "other";
include("menu_show.php");

// ALPHA: Kweshuner Progress
$menu['caption'] = "$title Progress";
$menu['content'] = "<strong>Version:</strong> 0.0.2 PRE-ALPHA<br /><strong>Completion Status:</strong> 40%";
$menu['id']      = "kprog";
include("menu_show.php");

?>
   </td>
  </tr>
 </table>
