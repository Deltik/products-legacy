<?php

/************************************\
|              IsMyChat              |
|       Index File (index.php)       |
|------------------------------------|
| Version: 0.0.1 PRE-ALPHA           |
| By: Deltik (webmaster@deltik.org)  |
|     iJames (riffy888@gmail.com)    |
| Website: http://ismychat.be.ma/    |
|   1) http://www.deltik.org/        |
|   2) http://clubpenguinrush.com/   |
\************************************/

// TODO:
// Tier 3:
//   Make the whole thing work
//
// Tier 2:
//   
//
// Tier 1:
//
//

// Call Core File (which loads the configuration in the "System Initiation" section)
if (!include("core.php"))
  {
  die("<div style=\"background: pink; border: red groove;\"><center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>IsMyChat cannot load the core file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.</div>");
  }

// Let the theme do the rest!
if (!include ($system['themes']."/".$system['theme']."/index.php"))
  {
  die("<div style=\"background: pink; border: red groove;\"><center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>".$system['title']." cannot load the theme file!</h2></center><p>The theme settings are probably invalid. Contact the webmaster at ".$system['url']." and report this error so that it may be fixed.</div>");
  }

?>
