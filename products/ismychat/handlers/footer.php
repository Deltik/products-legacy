<?php

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){header("location:error.php?H4X0R");}

?>
</div><?php

if ($footrhr) 
 echo '
<!-- Footer Divider -->
<div id="footer">
 <!-- Footer Horizontal Rule -->
 <hr />';

?>

 <!-- Footer -->
 <div onmouseover="this.style.background='lightblue';" onmouseout="this.style.background='';"><?php

if ($w3cveri && !$license)
 echo '
  <!-- Valid XHTML 1.0 Transitional -->
  <div class="credits"><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="[Valid XHTML 1.0 Transitional]" height="31" width="88" border="no" /></a></span>';

if ($license && !$w3cveri)
 echo '
  <!-- Creative Commons Attribution-Share Alike 3.0 United States License -->
  <div class="credits"><a href="http://creativecommons.org/licenses/by-sa/3.0/us/"><img alt="[Creative Commons License]" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/us/88x31.png" /></a><br /><span>Kweshuner</span> by <span>Nicholas Liu and Siddarth Kaki</span> is licensed under a <a href="http://creativecommons.org/licenses/by-sa/3.0/us/">Creative Commons Attribution-Share Alike 3.0 United States License</a>.<br /></div>';

if ($w3cveri && $license)
 echo '
  <!-- Valid XHTML 1.0 Transitional -->
  <!-- Creative Commons Attribution-Share Alike 3.0 United States License -->
  <div class="credits"><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="[Valid XHTML 1.0 Transitional]" height="31" width="88" border="no" /></a><a href="http://creativecommons.org/licenses/by-sa/3.0/us/"><img alt="[Creative Commons License]" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/us/88x31.png" /></a><br /><span>Kweshuner</span> by <span>Nicholas Liu and Siddarth Kaki</span> is licensed under a <a href="http://creativecommons.org/licenses/by-sa/3.0/us/">Creative Commons Attribution-Share Alike 3.0 United States License</a>.<br /></div>';

if ($credits)
 echo '

  <!--
       ########################################
       #   POWERED BY KWESHUNER QUIZ SCRIPT   #
       # http://products.deltik.org/kweshuner #
       ########################################
                                                -->

  <div class="credits">Powered by <a href="http://products.deltik.org/kweshuner/">Kweshuner Quiz Script</a></div>';
?>
 </div>
</div>
</body>
</html>
