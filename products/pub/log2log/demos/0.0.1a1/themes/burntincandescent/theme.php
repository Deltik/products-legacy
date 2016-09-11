<?php
/**
 * Log2Log Online Chat Log Converter
 *  Themes
 *   Burnt Incandescent
 *    Theme Data File
 * 
 * License:
 *  This file is part of Log2Log.
 *  
 *  Log2Log is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  Log2Log is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with Log2Log.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// Theme
$theme['title']       = "Burnt Incandescent";
$theme['version']     = "1.0.0";
$theme['author']      = "Deltik";
$theme['email']       = "webmaster@deltik.org";
$theme['website']     = "http://www.deltik.org/";
$theme['date']        = "07 January 2011";
$theme['description'] = "Designed by Deltik, made with GIMP";

define("THEME_REL", "themes/".LOG2LOG_THEME."/");

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
    $temp = '    <!-- Navibar -->
      <div id="navibar" class="navibar">
';
    foreach ($navi as $innerHTML => $href)
      {
      $temp .= "     <li><a href=\"$href\">$innerHTML</a></li>\n";
      }
    $temp .= '    </div>';
    
    define("LOG2LOG_NAVIBAR", $temp, TRUE);
    
    return $temp;
    }
  }

?>
