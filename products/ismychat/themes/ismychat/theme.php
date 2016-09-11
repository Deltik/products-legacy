<?php

// H4X0RZ PR3V3N7I0N
if(!defined($definition)){die("H4X0R PR3V3NT!0N");}

// Theme
$theme['title']       = "IsMyChat";
$theme['version']     = "1.0.0";
$theme['author']      = "Deltik";
$theme['email']       = "webmaster@deltik.org";
$theme['website']     = "http://www.deltik.org/";
$theme['date']        = "08/11/2010";
$theme['description'] = "Default theme for IsMyChat";

define("THEME_REL", $system['themes']."/".$system['theme']."/");

// Style
$theme['css'] = THEME_REL."css/style.css";
$theme['js']  = THEME_REL."ajax.js";
// TODO: The rest of this

// The following are optional, but recommended for best style. If they are not filled out, the default style will be used.

// Theme Class
class Theme
  {
  // Constructor
  //  Usage: $OBJECT_VAR = new Theme();
  public function __construct()
    {
    # NOTHING HERE
    }
  
  // Execute Function
  //  Usage: $OBJECT_VAR->func(ACTION, PARAMETERS_ARRAY);
  public function func($action, $parameters)
    {
    $action = strtolower($action);
    if (stripos($action, "login") === TRUE)
      $this->loginForm($parameters);
    }
  
  // Login Form
  //  Usage: $OBJECT_VAR->func("loginForm", PARAMETERS_ARRAY);
  private function loginForm($parameters)
    {
    if (!$parameters || $parameters['mode'] == "full")
      return '    <table style="margin: 8px;">
     <tr>
      <td><label for="username">Username</label></td><td><input name="username" type="text" id="username" size="30"></td>
     </tr>
     <tr>
      <td><label for="password">Password</label></td><td><input name="password" type="password" id="password" size="30"></td>
     </tr>
     <tr>
      <td class="submit"></td><td><input type="submit" value="Log In"></td>
     </tr>
    </table>';
    }
  }

/*******************\
| LEGACY CODE BELOW |
|    DEPRECATED!    |
|    DO NOT USE!    |
\*******************/

// Show Link
//  Usage: showLink(innerHTML, HREF[, TITLE, NAME]);
if (!function_exists("showLink")) {
  function showLink($link_innerHTML, $link_href, $link_title, $link_name)
    {
    return "  <a href=\"".$link_href."\" class=\"menulnk\" title=\"".$link_title."\" name=\"".$link_name."\">".$link_innerHTML."</a>\n";
    }
  }

// Indicator Applet
//  Usage: indicate(TITLE, CONTENT[, URGENCY]);
if (!function_exists("indicate")) {
  function indicate($title = "Notice", $content = "Something incorrect has happened.", $urgency = 3)
    {
    # Life Lesson: You can't avoid math. (example follows)
    $constant = 50;
    $red = 200+11*$urgency;
    $green = 255-11*$urgency;
    $blue  = 200-11*$urgency;
    $red_darker = $red-$constant;
    $green_darker = $green-$constant;
    $blue_darker = $blue-$constant;
    $red_darkest = $red_darker-2*$constant;
    $green_darkest = $green_darker-2*$constant;
    $blue_darkest = $blue_darker-2*$constant;
    echo "<div style=\"background-color: rgb($red, $green, $blue); border: 1px rgb($red_darker, $green_darker, $blue_darker) dotted; color: rgb($red_darkest, $green_darkest, $blue_darkest); padding: 6px; margin: 6px;\"><strong>$title</strong><br />$content</div>\n";  
    }
  }

// CP Builder
//  Usage: cpBuild(CATEGORY_ARRAY, ITEMS_ARRAY[, QUANTITY_PER_ROW]);
if (!function_exists("cpBuild")) {
  function cpBuild($category_array, $items_array, $items_per_row = 5)
    {
    echo "<fieldset><legend>".$category_array['legend']."</legend>";
    echo "<table>\n <tr style=\"text-align: center;\">\n";
    foreach ($items_array as $item_array)
      {
      echo "  <td width=\"". 100/$items_per_row ."%\"><a href=\"".$item_array['href']."\">".$item_array['img']."</a><br /><a href=\"".$item_array['href']."\">".$item_array['innerHTML']."</a></td>\n";
      }
    echo " </tr>\n</table>";
    echo "</fieldset>";
    }
  }

// Login Form
//  Usage: loginForm();
if (!function_exists("loginForm")) {
  function loginForm()
    {
    return '
<form action="" method="post">
 <label for="user" id="ulabel">Username: </label><input type="text" name="user" id="user" />
 <label for="pass" id="plabel">Password: </label><input type="password" name="pass" id="pass" /> <input type="submit" value="Log In" />
 <a href="'.$page_infix.'bin/nocp">(options)</a>
</form>';
    }
  }

?>
