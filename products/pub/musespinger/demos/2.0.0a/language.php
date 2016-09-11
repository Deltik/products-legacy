<?php
/*
+ ----------------------------------------------------------------------------+
|     MuSeSPinger
|     Language File
|
|     Last Modified: 2008/11/27
+----------------------------------------------------------------------------+
*/

// Configuration always required
require('config.php');

// Language Name
$lang['name'] = 'English';

// Title
$lang['title'] = 'MuSeSPinger';

// Description/Explanation of MuSeSPinger
$lang['desc'] = 'MuSeSPinger stands for <strong>Mu</strong>ltiple <strong>Se</strong>rver <strong>S</strong>tatus <strong>Pinger</strong>. You can check websites to see if they are online or offline by the masses. You may check up to <strong>'.$limit.'</strong> URLs. To check multiple servers, separate each URL with a space. To check a port other than 80 for a URL, add a colon (&quot;:&quot;) after the URL, then the port number. <strong>The more URLs you enter, the longer the test will take.</strong>';

// Display in the table (left to right, coordinates are in the array)
$lang['1,1'] = 'Server(s) to test:';
$lang['1,2'] = '<textarea name="data" cols="50" rows="3" id="data"></textarea>';
$lang['2,1'] = '<input name="output" type="radio" id="output" checked="CHECKED" /><label for="table">Table </label><br /><input name="output" type="radio" id="output" /><label for="image">Image</label>';
$lang['2,2'] = '<input type="button" value="Go" id="submit" onclick="process()" /><input type="button" name="Reset" value="Clear" id="reset" onclick="restart()" />';
$lang['ports'] = '<strong>Port Ideas:</strong><br/>80 = HTTP<br/>21 = FTP<br/>3306 = MySQL<br/>2082 = cPanel<br/>2083 = Secure cPanel<br/>2086 = cPanel WHM<br/>2095 = cPanel Webmail';

// Fieldset Legend
$lang['legend'] = 'Status';

// Status Message before Submit (Waiting for submit...)
$lang['premsg'] = '<h1 id="statusmsg">Waiting for submit...</h1>';
?>
