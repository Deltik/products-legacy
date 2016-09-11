<?php
if(!defined($definition)){die("H4X0R PR3V3NT!0N");}

/*****************\
| Class: Template |
\*****************/
/*********************\
| Class: ThemeDefault |
\*********************/

class Template
  {
  // Constructor
  //  Usage: $OBJECT_VAR = new Template();
  public function __construct()
    {
    # NOTHING HERE
    }
  
  // Execute Function
  //  Usage: $OBJECT_VAR->func(ACTION, PARAMETERS_ARRAY);
  public function func($action, $parameters)
    {
    # Theme
    global $system, $definition;
    @include_once ($system['themes']."/".$system['theme']."/theme.php");
    if (class_exists("Theme"))
      {
      $theme = new Theme();
      }
      else
      {
      $theme = new ThemeDefault();
      }
    $action = strtolower($action);
    if (stripos($action, "login") === TRUE)
      $theme->loginForm($parameters);
    
    # System
    }
  }

class ThemeDefault
  {
  
  }

?>
