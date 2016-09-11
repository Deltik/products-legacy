<?php
/**
 * Log2Log Online Chat Log Converter
 *  Themes
 *   Burnt Incandescent
 *    Theme Execution File
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

// This is a very primitive theme that was thrown together.
// Just... do something, okay?

// Security: Check if executing from Log2Log
if (!defined('LOG2LOG_VERSION'))
  header("Location: http://www.20b.org/");

// Initialize Theme Information
include ("theme.php");

// Fallback default constants, if necessary
autodefine('LOG2LOG_TITLE', "Log2Log");
autodefine('LOG2LOG_LOGO', "Log2Log");
autodefine('LOG2LOG_TAGLINE', "Chat Log Converter");
autodefine('LOG2LOG_NAVIBAR', "<span style=\"color: red;\"><strong>ERROR!</strong> The navigation panel failed to load! I guess you're stuck here until somebody fixes it. Are you the webmaster of this Log2Log site and need help fixing this problem? Contact Deltik at <a href=\"mailto:webmaster@deltik.org\">webmaster@deltik.org</a>.</span>");
autodefine('LOG2LOG_PREALPHA_DIAGNOSTICS', "<fieldset><legend>Log2Log Pre-Alpha Diagnostics</legend>The diagnostics for Log2Log Development Release failed to load. Are you sure this is a pre-alpha release of Log2Log? Did you break Log2Log?</fieldset>");
autodefine('LOG2LOG_DEV_DIAGNOSTICS', LOG2LOG_ALPHA_DIAGNOSTICS);
autodefine('LOG2LOG_ALPHA_DIAGNOSTICS', "<fieldset><legend>Log2Log Alpha Diagnostics</legend>The diagnostics for Log2Log Alpha failed to load. Are you sure this is an alpha release of Log2Log? Did you break Log2Log?</fieldset>");
autodefine('LOG2LOG_BETA_DIAGNOSTICS', "<fieldset><legend>Log2Log Beta Diagnostics</legend>The diagnostics for Log2Log Beta failed to load. Are you sure this is a beta release of Log2Log? Did you break Log2Log?</fieldset>");
autodefine('LOG2LOG_RC_DIAGNOSTICS', "<fieldset><legend>Log2Log RC Diagnostics</legend>The diagnostics for Log2Log Release Candidate failed to load. Are you sure this is a release candidate release of Log2Log? Did you break Log2Log?</fieldset>");
autodefine('LOG2LOG_GAMMADELTA_DIAGNOSTICS', LOG2LOG_RC_DIAGNOSTICS);
autodefine('LOG2LOG_RTM_DIAGNOSTICS', "<fieldset><legend>Log2Log RTM Diagnostics</legend>The diagnostics for Log2Log New Release Preview failed to load. Are you sure this version of Log2Log is for release to marketing? Did you break Log2Log?</fieldset>");
autodefine('LOG2LOG_GA_DIAGNOSTICS', "<fieldset><legend>Advanced Information</legend>The development diagnostics of Log2Log failed to load.</fieldset>");
autodefine('LOG2LOG_MENU1', LOG2LOG_NAVIBAR);
if (strpos(LOG2LOG_VERSION, "pre") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_PREALPHA_DIAGNOSTICS);
elseif (strpos(LOG2LOG_VERSION, "dev") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_DEV_DIAGNOSTICS);
elseif (strpos(LOG2LOG_VERSION, "a") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_ALPHA_DIAGNOSTICS);
elseif (strpos(LOG2LOG_VERSION, "b") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_BETA_DIAGNOSTICS);
elseif (strpos(LOG2LOG_VERSION, "rc") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_RC_DIAGNOSTICS);
elseif (strpos(LOG2LOG_VERSION, "pl") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_GAMMADELTA_DIAGNOSTICS);
elseif (strpos(LOG2LOG_VERSION, "rtm") !== false)
  autodefine('LOG2LOG_MENU2', LOG2LOG_RTM_DIAGNOSTICS);
autodefine('LOG2LOG_BODY', "No content here.");

/***********\
| EXECUTION |
\***********/
?>    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
 <link rel="stylesheet" href="<?=$theme['css']?>" type="text/css" media="all" />
 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
 <script type="text/javascript" src="<?=$theme['js']?>"></script>
 <title><?=LOG2LOG_TITLE?></title>
</head>
<body>
<!-- Main Container -->
<div id="main" class="main">
 <!-- Top Bar -->
 <div id="cap" class="cap">
  <!-- Logo -->
  <span id="logo">
   <?=LOG2LOG_LOGO?>
  </span>
  <br />
  <?=LOG2LOG_TAGLINE?>
 </div>
 <!-- Base Container -->
 <table id="base" class="base">
  <tr>
   <!-- Left Menu Bar -->
   <td id="menuleft" class="menuleft">
<?=LOG2LOG_MENU1?>
   </td>
   <!-- Separator -->
   <td>&nbsp;</td>
   <!-- Body -->
   <td id="body" class="body">
<?=LOG2LOG_BODY?>
   </td>
   <!-- Separator -->
   <td>&nbsp;</td>
   <!-- Right Menu Bar -->
   <td id="menuright" class="menuright">
<?=LOG2LOG_MENU2?>
   </td>
  </tr>
 </table>
</div>
</body>
</html>
