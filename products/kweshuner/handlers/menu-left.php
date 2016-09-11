<?php

// H4X0RZ PR3V3N7I0N
if(!defined('KWESHUNER')){header("location:error.php?H4X0R");}

?> <!-- Base Container -->
 <table border="0" width="100%" style="border-collapse: collapse;">
  <tr>
   <!-- Left Menu Bar -->
   <td width="20%" style="vertical-align:top;">
<?php

// Navibar
$menu['caption'] = "Navigation";
$menu['content'] = loadNavi($navigation);
$menu['id']      = "navigation";
include("menu_show.php");

// List of Quizzes
$menu['caption'] = "Quizzes";
$menu['content'] = listQuizzes($src, "form");
$menu['id']      = "quizzes";
include("menu_show.php");

// Theme Information
$menu['caption'] = "Theme Information";
$menu['content'] = "<strong>Name:</strong> GlossyClearlooks-compact<br /><strong>Version:</strong> 0.0.1 Pre-Alpha<br /><strong>Information:</strong> Based on a <a href=\"http://www.gnome.org/\">GNOME</a> theme, Glossy.<br /><strong>Completion Status:</strong> 80%";
$menu['id']      = "themeinfo";
include("menu_show.php");

?>
   </td>
