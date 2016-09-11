<?php
/**
 * Log2Log Online Chat Log Converter
 *  Themes
 *   Humanome
 *    Theme Execution File
 */

// This is a very primitive theme that was thrown together.
// Just... do something, okay?

// Security: Check if executing from Log2Log
if (!defined('LOGUNTU_VERSION'))
  header("Location: http://www.20b.org/");

// Initialize Theme Information
include ("theme.php");

// Fallback default constants, if necessary
autodefine('LOGUNTU_TITLE', "Loguntu");
autodefine('LOGUNTU_LOGO', "<div id=\"logo\">&nbsp;</div>");
autodefine('LOGUNTU_TAGLINE', "Online Chat Log Storage");
autodefine('LOGUNTU_NAVIBAR', "<span style=\"color: red;\"><strong>ERROR!</strong> The navigation panel failed to load! I guess you're stuck here until somebody fixes it. Contact Deltik at <a href=\"mailto:webmaster@deltik.org\">webmaster@deltik.org</a> if this isn't fixed promptly.</span>");
autodefine('LOGUNTU_BODY', "No content here.");
autodefine('LOGUNTU_FOOTER', "");

/***********\
| EXECUTION |
\***********/
?><!DOCTYPE html>
<html>
<head>
 <title><?=LOGUNTU_TITLE?></title>
 <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
 <link rel="stylesheet" href="<?=$theme['css']?>" type="text/css" media="all" />
 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
 <script type="text/javascript" src="<?=$theme['js']?>"></script>
 <link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
<!-- Container for Everything -->
<div id="everything">
 <!-- Top Container -->
 <div id="header">
  <!-- Logo -->
<?=indent(LOGUNTU_LOGO, 2)?>

 </div>
<?=indent(LOGUNTU_NAVIBAR, 1)?>

 <!-- Middle Container -->
 <div id="body">
  <!-- Content -->
<?=indent(LOGUNTU_BODY, 2)?>

 </div>
 <!-- Bottom Container -->
 <div id="footer">
<?=indent(LOGUNTU_FOOTER, 2)?>

 </div>
</div>
</body>
</html>
