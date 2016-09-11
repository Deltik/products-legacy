<?php
/**
 * Log2Log Online Chat Log Converter
 *  Execution
 *   Front Page
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
define('LOG2LOG_TITLE', "Home - Log2Log");
define('LOG2LOG_BODY',
<<<adHocBodyHTML
    <p>Can't download Meebo chat logs? Shot that Adium duck? Pidgin poop?</p>
    <p><strong>Log2Log:</strong> The online solution to chat log conversion!</p>
    <p>
     <span style="text-decoration: underline;">Uses:</span>
     <br />
     <ul>
      <li>Adapting chat logs to switch to a new IM client</li>
      <li>Converting logs into printable and readable transcripts</li>
      <li>Downloading chat logs stranded on Meebo</li>
     </ul>
    </p>
    <p>
     <table width="100%" border="1">
      <thead>
       <th width="2%">Status</th>
       <th width="49%">From</th>
       <th width="49%">To</th>
      </thead>
      <tbody>
       <tr>
        <th>Supported</th>
        <td>
         <img src="images/services/MeeboConnect.png" alt="MeeboConnect" title="Download from Meebo" />
         <img src="images/services/Meebo.png" alt="Meebo" title="Meebo" />
         <img src="images/services/Pidgin.png" alt="Pidgin" title="Pidgin" />
         <img src="images/services/JSON.png" alt="JSON" title="JSON" />
        </td>
        <td>
         <img src="images/services/Meebo.png" alt="Meebo" title="Meebo" />
         <img src="images/services/Pidgin.png" alt="Pidgin" title="Pidgin" />
         <img src="images/services/JSON.png" alt="JSON" title="JSON" />
        </td>
       </tr>
       <tr>
        <th>In Progress</th>
        <td>
         <img src="images/services/Skype.png" alt="Skype" title="Skype" />
         <img src="images/services/Adium.png" alt="Adium" title="Adium" />
         <img src="images/services/Trillian.png" alt="Trillian" title="Trillian" />
         <img src="images/services/Empathy.png" alt="Empathy" title="Empathy" />
        </td>
        <td>
         <img src="images/services/Adium.png" alt="Adium" title="Adium" />
         <img src="images/services/Trillian.png" alt="Trillian" title="Trillian" />
         <img src="images/services/Empathy.png" alt="Empathy" title="Empathy" />
        </td>
       </tr>
       <tr>
        <th>Under Consideration</th>
        <td colspan="2">
         <img src="images/services/Kopete.png" alt="Kopete" title="Kopete" />
         <img src="images/services/Digsby.png" alt="Digsby" title="Digsby" />
        </td>
       </tr>
      </tbody>
     </table>
    </p>
adHocBodyHTML
);

// Display!
$LOG2LOG->display();
?>
