<?php
if(!defined($definition)){die("H4X0R PR3V3NT!0N");}

/***************\
| Class: System |
\***************/

class System
  {
  // Constructor
  //  Usage: $OBJECT_VAR = new System();
  public function __construct()
    {
    # Generate Title (Flushed @ <title>TITLE</title>)
    global $system;
    $system['title_flush'] = $system['title'].$system['title_seperator'].$system['subtitle'];
    
    # System CSS
    if ($_REQUEST['action'] == "css")
      die($this->css());
    
    # Content Flush
    include ("config.php");
    if (!$_REQUEST['page'])
      {
      $_REQUEST['page'] = 1;
      }
    $Sql = new Sql();
    $page_result = $Sql->query("SELECT * FROM `".$sql['prefix']['base']."pages` WHERE `id` = '".$_REQUEST['page']."'");
    $page = $Sql->fetch_assoc($page_result);
    $page = $page['content'];
    if ($Sql->num_rows($page_result) < 1)
      $page = "The requested page does not exist.";
    $system['content_flush'] = $page;
    }
  
  // System Style
  //  Usage: $OBJECT_VAR->css();
  public function css()
    {
    # Setup
    header("Content-type: text/css");
    global $system;
    # Fonts
    $dir_handle = @opendir($system['fonts']);
    while ($font = readdir($dir_handle))
      {
      if (strtolower(substr($font, -4)) == strtolower(".ttf"))
        {
        $fonts[] = $font;
        }
      }
    echo "/* Fonts */\n";
    foreach ($fonts as $font)
      {
      $font_name = explode(".", $font);
      array_pop($font_name);
      $font_name = implode(".", $font_name);
      echo "@font-face {\n    font-family: ".substr($font, 0, -4).";\n    src: url('".$system['fonts']."/".$font."');\n}\n\n";
      }
    }
  }

?>
