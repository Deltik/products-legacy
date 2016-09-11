<?php

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){header("location:error.php?H4X0R");}

?>    <!-- MENU: ID '<?php echo $menu['id']; ?>' -->
    <table class="tablize" id="<?php echo $menu['id']; ?>">
     <tr>
      <td class="topleft"><img src="images/menu-top-left.png" alt="[" /></td>
      <td class="caption">
       <div class="captiondiv"><?php echo $menu['caption']; ?></div>
      </td>
      <td class="topright"><img src="images/menu-top-right.png" alt="]" /></td>
     </tr>
     <tr>
      <td class="menuleft">&nbsp;</td>
      <td class="contenttd"><?php echo $menu['content']; ?></td>
      <td class="menuright">&nbsp;</td>
     </tr>
     <tr class="foot">
      <td class="bottomleft">&nbsp;</td>
      <td class="menubottom">&nbsp;</td>
      <td class="bottomright">&nbsp;</td>
     </tr>
    </table>
    <!-- END MENU '<?php echo $menu['id']; ?>' -->
