<?php
/**
 * Log2Log Online Chat Log Converter
 *  Informational
 *   Contact the Log2Log Team
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
define('LOG2LOG_TITLE', "Contact - Log2Log");
define('LOG2LOG_BODY', indent(
<<<html
<h1>Questions? Comments? Problems? Suggestions?</h1>
<a href="http://www.deltik.org/contact.php" target="_blank">Contact Deltik through our online form</a> or try one of the methods below:
<p>
 <ul>
  <li><strong>Email:</strong> <a rel='external' href='javascript:window.location="mai"+"lto:"+"webmaster"+"@"+"deltik.org";self.close();' onmouseover='window.status="mai"+"lto:"+"webmaster"+"@"+"deltik.org"; return true;' onmouseout='window.status="";return true;'>webmaster&copy;deltik.org</a></li>
  <li><strong>Phone:</strong> (361) 4-DELTIK</li>
 </ul>
</p>
<h1>Want to help?</h1>
Deltik is looking for volunteers who would like to help expand Log2Log. <a rel='external' href='javascript:window.location="mai"+"lto:"+"webmaster"+"@"+"deltik.org";self.close();' onmouseover='window.status="mai"+"lto:"+"webmaster"+"@"+"deltik.org"; return true;' onmouseout='window.status="";return true;'>Contact Deltik</a> if you would like to help.
html
, 4));

// Display!
$LOG2LOG->display();
?>
