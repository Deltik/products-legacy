<?php

// Load Configuration File
include_once ("config.php");

// Start the global SQL connections
//  Leech CMS's connection
$MY_sql = new Sql($sql['type'], $sql['user'], $sql['pass'], $sql['host'], $sql['pref'], $sql['base']);

$LOGUNTU = new Core();

// Initialize Theme Information File
$LOGUNTU->theme();

// Generate Navibar
if (function_exists('navibar'))
  {
  $return = navibar($navi);
  if (!defined('LOGUNTU_NAVIBAR') && !$return)
    define("LOGUNTU_NAVIBAR", "<span style=\"color: red;\"><strong>ERROR!</strong> The navigation panel failed to load! I guess you're stuck here until somebody fixes it. Contact Deltik at <a href=\"mailto:webmaster@deltik.org\">webmaster@deltik.org</a> to report this problem if it isn't fixed promptly.</span>");
  elseif (!defined('LOGUNTU_NAVIBAR') && $return)
    define("LOGUNTU_NAVIBAR", $return);
  }
else
  {
  foreach ($navi as $innerHTML => $href)
    {
    $temp .= "     <li><a href=\"$href\">$innerHTML</a></li>\n";
    }
  autodefine("LOG2LOG_NAVIBAR", $temp, TRUE);
  }

/*******\
| CLASS |
\*******/
class Core
  {
  // Output Theme
  //  Usage: $OBJECT_VAR->display();
  public function display()
    {
    if (!include ("themes/".LOGUNTU_THEME."/index.php"))
      {
      die("<div style=\"background: pink; border: red groove;\"><center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>Loguntu cannot load the theme execution file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.</div>");
      }
    }
  
  // Load Theme Information
  //  Usage: $OBJECT_VAR->theme();
  public function theme()
    {
    if (!include ("themes/".LOGUNTU_THEME."/theme.php"))
      {
      return false;
      }
    }
  }

/***********\
| FUNCTIONS |
\***********/

// Autoload
//  Usage: (none)
function __autoload($class)
  {
  include_once ("classes/$class.php");
  }

// Safe Define
//  Usage: autodefine(CONSTANTNAME, DATA_FINAL);
function autodefine($constant_name, $data, $case_insensitive = false)
  {
  if (!defined($constant_name))
    define($constant_name, $data, $case_insensitive);
  }

// Line Indent
//  Usage: indent(STRING, INT_SPACES);
function indent($string, $num_of_spaces)
  {
  $string_split = explode("\n", $string);
  unset($spaces);
  for ($i = 0; $i < $num_of_spaces; $i ++)
    $spaces .= " ";
  foreach ($string_split as $key => $string_line)
    {
    $string_split[$key] = $spaces.$string_line;
    }
  return implode("\n", $string_split);
  }

?>
