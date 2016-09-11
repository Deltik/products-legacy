<?php
/**
 * Log2Log Online Chat Log Converter
 *  Informational
 *   Source Code Download
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

// Call Core File
if (!include("core.php"))
  {
  die("<div style=\"background: pink; border: red groove;\"><center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>Log2Log cannot load the core file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.</div>");
  }

// Display Configuration
define('LOG2LOG_TITLE', "Download - Log2Log");
define('LOG2LOG_BODY', indent(
<<<html
<p>An ad-hoc download link for Log2Log may be available at <a href="http://products.deltik.org/" target="_blank">http://products.deltik.org/</a> or <a href="http://products.deltik.org/download.php" target="_blank">http://products.deltik.org/download.php</a>.</p>
<p>Information or documentation of Log2Log may be available at <a href="http://man.deltik.org/index.php?title=Log2Log" target="_blank">the Deltik Docs article about Log2Log</a>.</p>
html
, 4));

// Display!
$LOG2LOG->display();
?>
