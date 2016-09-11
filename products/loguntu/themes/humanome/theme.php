<?php
/**
 * Loguntu
 *  Themes
 *   Humanome
 *    Theme Data File
 */

// Theme
$theme['title']       = "Humanome";
$theme['version']     = "1.0.0";
$theme['author']      = "Deltik";
$theme['email']       = "webmaster@deltik.org";
$theme['website']     = "http://www.deltik.org/";
$theme['date']        = "07 April 2011";
$theme['description'] = "Designed by Deltik, made with GIMP";

define("THEME_REL", "themes/".LOGUNTU_THEME."/");

// Style
$theme['css'] = THEME_REL."style.css";
$theme['js']  = THEME_REL."script.js";

/***********\
| FUNCTIONS |
\***********/

if (!function_exists("navibar"))
  {
  function navibar($navi = null)
    {
    $temp = '<!-- Navibar -->
<div id="navibar" class="navibar">
 <ul>
';
    foreach ($navi as $innerHTML => $href)
      {
      if ($_SERVER['PHP_SELF'] != $href)
        $temp .= "  <a href=\"$href\"><li>$innerHTML</li></a>\n";
      else
        $temp .= "  <a href=\"$href\"><li class=\"selected\">$innerHTML</li></a>\n";
      }
    $temp .= ' </ul>
</div>';
    
    define("LOGUNTU_NAVIBAR", $temp, TRUE);
    
    return $temp;
    }
  }

?>
