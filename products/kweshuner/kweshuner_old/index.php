<?php

/***********************\
| Kweshuner Quiz Script |
|-----------------------|
| Version: 0.0.1 ALPHA  |
\***********************/

// TODO:
// Tier 3:
//   Clean up the whole thing
//   Make the quiz work
//
// Tier 2:
//   
//


    ///////////////////////////
    //                       //
    // Bear with the mess!!! //
    //                       //
    ///////////////////////////

if (!$_REQUEST['page']){
  // Header
  header("Content-type: text/html");
  
  // Display Main Page
  
  // Header Data
  echo '    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="?page=theme-css" type="text/css" media="all" />
<script type="text/javascript" src="?page=js"></script>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Kweshuner</title>
  </head>';

  echo '
  <body bgcolor="#EDECEB" style="margin: 0px;padding: 0px;">
<div id="mainpage">
    <table border="0" width="100%" style="font-family: Sans;border-collapse: collapse;font-size:12px;">
      <tr>

        <td width="auto"><img src="images/kweshuner.png" alt="Kweshuner" />
        </td>
        <td width="75%" style="background:url(images/topbar-background.png);opacity:0.4;filter:alpha(opacity=40)">
        </td>
        <td width="20%">...
        </td>
      </tr>
    </table>
    <table border="0" width="100%" style="font-family: Sans;border-collapse: collapse;">
      <tr>
        <td width="20%" style="vertical-align:top;">
<div id="menu">
<table class="c12">
<tr>
<td class="c1"><img src="images/menu-top-left.png" alt="["></td>

<td class="c3">
<div class="c2">Kweshuner</div>
</td>
<td class="c4"><img src="images/menu-top-right.png" alt="]"></td>
</tr>
<tr>
<td class="c5">&nbsp;</td>
<td class="c6">';

  // Navibar
  echo '<a href="# What are you looking at?" onclick="LoadPage(\'?page=admin\', \'main\');">Administration CP</a><br /><a href="?page=admindebug&file=test.txt">Admin Debug</a>';
  echo '<form action="'.$_SERVER['PHP_SELF'].'"><select name="file" id="file" style="border-color:#7ea5d4;background:#90b3de;"><option value="null" onclick="document.getElementById(\'main\').innerHTML=\'No quiz file selected\'" selected="selected">Choose a Quiz</option><option disabled="disabled">--</option>';
  $path = ".";
  $dir_handle = @opendir($path) or die("Unable to open $path");
  while ($file = readdir($dir_handle)) 
    {
      if (substr($file, -4) == ".txt") {
        $data = file_get_contents($file);
	$datarray = explode("\n", $data);
        echo '<option value="'.$file.'" onclick="LoadPage(\'?page=adminparse&file='.$file.'\',\'quiz\');" id="'.$file.'">'.$datarray[0].'</option>';
      }
    }
  closedir($dir_handle);
  echo '</select></form><br />Status:<br /><div id="status">&nbsp;</div>';

  echo '
</td>
<td class="c7">&nbsp;</td>
</tr>
<tr class="c11">
<td class="c8">&nbsp;</td>
<td class="c9">&nbsp;</td>
<td class="c10">&nbsp;</td>
</tr>

</table>
</div>
<div id="menu">
<table class="c12">
<tr>
<td class="c1"><img src="images/menu-top-left.png" alt="["></td>
<td class="c3">
<div class="c2">Theme Information</div>
</td>
<td class="c4"><img src="images/menu-top-right.png" alt="]"></td>
</tr>
<tr>
<td class="c5">&nbsp;</td>
<td class="c6"><strong>Name:</strong> Clearlooks-compact<br /><strong>Version:</strong> 0.0.1 Pre-Alpha<br /><strong>Information:</strong> Based on a <a href="http://www.gnome.org/">GNOME</a> theme, Clearlooks.</td>

<td class="c7">&nbsp;</td>
</tr>
<tr class="c11">
<td class="c8">&nbsp;</td>
<td class="c9">&nbsp;</td>
<td class="c10">&nbsp;</td>
</tr>
</table>
</div>
<div id="menu">
<table class="c12">
<tr>
<td class="c1"><img src="images/menu-top-left.png" alt="["></td>
<td class="c3">
<div class="c2">Theme Progress</div>

</td>
<td class="c4"><img src="images/menu-top-right.png" alt="]"></td>
</tr>
<tr>
<td class="c5">&nbsp;</td>
<td class="c6">Completion Status: 20%</td>
<td class="c7">&nbsp;</td>
</tr>
<tr class="c11">
<td class="c8">&nbsp;</td>
<td class="c9">&nbsp;</td>
<td class="c10">&nbsp;</td>
</tr>
</table>
</div>
        </td>

        <td width="auto" style="vertical-align:top;font-size:12px;"><div id="main">';

  // Main Content
  echo 'Kweshuner is currently under development.<br /><br /><div style="font-size:16px;text-align:center;"><br />Upcoming info on Kweshuner will be posted here soon.</div>';

  echo '</div>
        </td>
        <td width="20%" style="vertical-align:top;">
<div id="menu">
<table class="c12">
<tr>
<td class="c1"><img src="images/menu-top-left.png" alt="["></td>
<td class="c3">
<div class="c2">Kweshuner</div>

</td>
<td class="c4"><img src="images/menu-top-right.png" alt="]"></td>
</tr>
<tr>
<td class="c5">&nbsp;</td>
<td class="c6">Being written. The theme you see right here is being developed, and will be used in Kweshuner.</td>
<td class="c7">&nbsp;</td>
</tr>
<tr class="c11">
<td class="c8">&nbsp;</td>
<td class="c9">&nbsp;</td>
<td class="c10">&nbsp;</td>
</tr>
</table>
</div>
<div id="menu">
<table class="c12">
<tr>
<td class="c1"><img src="images/menu-top-left.png" alt="["></td>
<td class="c3">
<div class="c2">Kweshuner Progress</div>
</td>
<td class="c4"><img src="images/menu-top-right.png" alt="]"></td>
</tr>
<tr>
<td class="c5">&nbsp;</td>
<td class="c6">Completion Status: 40%</td>
<td class="c7">&nbsp;</td>
</tr>

<tr class="c11">
<td class="c8">&nbsp;</td>
<td class="c9">&nbsp;</td>
<td class="c10">&nbsp;</td>
</tr>
</table>
</div>
<div id="menu">
<table class="c12">
<tr>
<td class="c1"><img src="images/menu-top-left.png" alt="["></td>
<td class="c3">
<div class="c2">Translate Kweshuner</div>
</td>
<td class="c4"><img src="images/menu-top-right.png" alt="]"></td>
</tr>
<tr>
<td class="c5">&nbsp;</td>
<td class="c6"><div id="google_translate_element"></div><script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: \'en\'
  }, \'google_translate_element\');
}
</script><script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script></td>
<td class="c7">&nbsp;</td>
</tr>

<tr class="c11">
<td class="c8">&nbsp;</td>
<td class="c9">&nbsp;</td>
<td class="c10">&nbsp;</td>
</tr>
</table>
</div>
        </td>
      </tr>
    </table><hr />
  <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10-blue"
        alt="Valid XHTML 1.0 Transitional" height="31" width="88" border="no" /></a>

  </p>
<center><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/us/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/us/88x31.png" /></a><br /><span xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dc:title" rel="dc:type">Kweshuner</span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Nicholas Liu and Siddarth Kaki</span> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/us/">Creative Commons Attribution-Share Alike 3.0 United States License</a>.</center>
</div>
  </body>
</html>

';
  }

define("KWESHUNER", TRUE);
include ('config.php');

if ($_REQUEST['page'] == 'admin' && $access[$_REQUEST['user']] == md5($_REQUEST['pass'])){
  // Header
  header("Content-type: text/html");
  
  // Display Admin Page
  echo '    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="?page=theme-css" type="text/css" media="all" />
<script type="text/javascript" src="?page=js"></script>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Kweshuner</title>
  </head>
  <body bgcolor="#EDECEB" style="margin: 0px;padding: 0px;">';

  // Body
  // Dynamic Content Container
  echo '<div id="mainpage">';
  
  // Quiz Preferences
  echo '<fieldset><legend>Quiz Preferences</legend></select></form></fieldset>';

  // Status Report
  echo '<fieldset><legend>Status</legend><div id="status">Idle</div></fieldset>';
  
  // Quiz Content
  echo '<fieldset><legend>Quiz</legend><div id="quiz">No quiz file selected</div></fieldset>';
  
  // Footer
  echo '<hr />
  


    </div>
  </body>
</html>';
  die();
  }

if ($_REQUEST['page'] == 'admin' && $access[$_REQUEST['user']] != md5($_REQUEST['pass'])){
  // Header
  header("Content-type: text/html");
  
  // Login Field
  echo 'Login Alpha Testing<br />';
  
  echo '<center>';
  echo '<table><tr><td>Username</td><td><input type="text" id="user" /></td></tr><tr><td>Password</td><td><input type="password" id="pass" /></td></tr></table>';
  echo '<input type="submit" id="login" onclick="LoadPage(\'?page=admin&user=\'+document.getElementById(\'user\').value+\'&pass=\'+document.getElementById(\'pass\').value, \'main\');" value="Login" />';
  echo '</center>';
  }

if ($_REQUEST['page'] == 'adminparse'){
  $data = /*base64_decode(*/file_get_contents($_REQUEST['file'])/*)*/;
  $datarray = explode("\n", $data);
  $config[1] = 1; $i = null; $b = 2; $line = 1;
  // Parser (inefficient, but works fine)
/*********************\
| CONFIG Information: |
| 0: Informational    |
| 1: Radio Buttons    |
| 2: Check Boxes      |
| 3: Short Answer     |
| 4: Textarea         |
\*********************/
  foreach($datarray as $value)
    {
    // Start Datahead Processor
    if ($b == 2){
      echo '<span id="'.$line.'"><span style="cursor:pointer;font-size:36px;" onclick="edit('.$line.');">'.$value.'</span></span>';
      echo '<input type="hidden" id="file" value="'.$_REQUEST['file'].'" /><br /><br />';
      }
    if ($b == 1){
      echo '<span id="'.$line.'"><span style="cursor:pointer;font-size:18px;" onclick="edit('.$line.');">'.$value.'</span></span><hr /><div id="kweshuns"><table style="border-collapse:collapse;">';
      }
    // End Datahead Processor
    
    // Start Configuration Parser
    if (substr($value, 0, 4) == "cfg "){
      $config = explode("|", substr($value, 4));
      $i = $config[1]+1;
      }
    // End Configuration Parser
    
    // Prompt
    if ($i == $config[1]){
      echo '<span id="'.$line.'"><tr><td width="100%"><button style="border-color:#7ea5d4;background:#90b3de;cursor:pointer;width:100%" onclick="edit('.$line.');">'.str_replace("<img","<img height='64px'",$value).'</button></td><td><img height="18px" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/X_mark.svg/525px-X_mark.svg.png" style="cursor:pointer;" /></td></tr></span>';
      }
    $i--;$b--;$line++;
    }
  die("</div>");
  }

if ($_REQUEST['page'] == 'edit'){
  $line = $_REQUEST['line']-1;
  $file = $_REQUEST['file'];
  $data = file($file);
  $config = explode("|", substr($data[$line-1], 4));
  echo '<center><br /><form name="editor"><input style="background:#90b3de;" id="'.($line+1).'e" type="text" size="100" onkeydown="save('.($line+1).', title);" onkeyup="save('.($line+1).', title);" onchange="save('.($line+1).', title);" value=\''.str_replace("'", "&#39;", $data[$line]).'\' /><br /><br /><table style="border-collapse:collapse"><tr><td>&nbsp;</td><td><img height="18px" src="http://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Checkmark_green.svg/417px-Checkmark_green.svg.png" /></td><td><img height="18px" src="http://upload.wikimedia.org/wikipedia/commons/thumb/6/64/Purple_question_mark.svg/450px-Purple_question_mark.svg.png" /></td><td><img height="18px" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/X_mark.svg/525px-X_mark.svg.png" /></td></tr>';
  for ($i=1;$i<=$config[1];$i++){
    $checked = 0;
    if (substr($data[$line+$i], 0, 1) == "*")
      $checked = 1;
    if (substr($data[$line+$i], 0, 1) == "^")
      $checked = 2;
    if (substr($data[$line+$i], 0, 1) == " ")
      $checked = 3;
    echo '<tr><td><img height="18px" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/X_mark.svg/525px-X_mark.svg.png" style="cursor:pointer;" /> <input type="text" style="background:white;" id="'.($line+$i+1).'e" size="75" onkeydown="save('.($line+$i+1).', \'bool'.($line+$i+1).'\');" onkeyup="save('.($line+$i+1).', \'bool'.($line+$i+1).'\');" onchange="save('.($line+$i+1).', \'bool'.($line+$i+1).'\');" value=\''.str_replace("'", "&#39;", stripslashes(substr($data[$line+$i], 1))).'\' /></td><td><input onclick="save('.($line+$i+1).', this.value);" type="radio" name="bool'.($line+$i+1).'" value="true"';
    
    if ($checked == 1)
      echo 'checked="checked"';
    echo ' /></td><td><input onclick="save('.($line+$i+1).', this.value);" type="radio" name="bool'.($line+$i+1).'" value="null"';
    
    if ($checked == 2)
      echo 'checked="checked"';
    echo ' /></td><td><input onclick="save('.($line+$i+1).', this.value);" type="radio" name="bool'.($line+$i+1).'" value="false"';
    
    if ($checked == 3)
      echo 'checked="checked"';
    echo ' /></td></tr>';
    }
  echo '</table></form></center><input type="button" style="cursor:pointer;" onclick="LoadPage(\'?page=adminparse&file='.$file.'\',\'quiz\');" value="Close" />';
  }

if ($_REQUEST['page'] == 'save'){
  echo 'Idle';
  $data = /*base64_decode(*/file_get_contents($_REQUEST['file'])/*)*/;
  $datarray = explode("\n", $data);
  $prefix = $_REQUEST['prefix'];
  if ($prefix == "true"){
    $prefix = "*";
    } elseif ($prefix == "false"){
    $prefix = " ";
    } elseif ($prefix == "null"){
    $prefix = "^";
    }
  $i = 1;
  foreach($datarray as $value) {
    if ($i == $_REQUEST['line'])
      $datarray[$_REQUEST['line']-1] = $prefix.stripslashes($_REQUEST['data']);
    $i++;
    }
  $data = implode("\n", $datarray);
  file_put_contents($_REQUEST['file'], $data);
  }

if ($_REQUEST['page'] == 'admindebug'){
  $data = /*base64_decode(*/file_get_contents($_REQUEST['file'])/*)*/;
  $datarray = explode("\n", $data);
  $config[1] = 1; $i = null; $b = 2;
  // Parser (inefficient, but works fine)
/*********************\
| CONFIG Information: |
| 0: Informational    |
| 1: Radio Buttons    |
| 2: Check Boxes      |
| 3: Short Answer     |
| 4: Textarea         |
\*********************/
  foreach($datarray as $value)
    {
    // Start Datahead Processor
    if ($b == 2){
      echo '<b>Title: </b>';
      }
    if ($b == 1){
      echo '<b>Subtitle: </b>';
      }
    // End Datahead Processor
    
    // Start Configuration Parser
    if (substr($value, 0, 4) == "cfg "){
      echo '<br /><b style="color:blue">Configuration: </b>';
      $config = explode("|", substr($value, 4));
      $i = $config[1]+1;
      }
    // End Configuration Parser
    
    // Prompt
    if ($i == $config[1]){
      echo '<b style="color:darkorange">Prompt: </b>';
      }
    
    // Correct Answer Mark
    if (substr($value, 0, 1) == '*' && ($config[0] == 1 || $config[0] == 2)){
      echo '<b style="color:green">CORRECT </b>';
      $value = substr($value, 1);
      }
    
    // Start If CONFIG 1
    if ($config[0] == 0 && $i > -1 && $i < $config[1]){
      echo '<b>Information: </b>';
      }
    // End If CONFIG 1
    
    // Start If CONFIG 1
    if ($config[0] == 1 && $i > -1 && $i < $config[1]){
      echo '<b>Radio: </b>';
      }
    // End If CONFIG 1
    
    // Start If CONFIG 2
    if ($config[0] == 2 && $i > -1 && $i < $config[1]){
      echo '<b>Checkbox: </b>';
      }
    // End If CONFIG 2

    // Start If CONFIG 3
    if ($config[0] == 3 && $i > -1 && $i < $config[1]){
      echo '<b>Text Input: </b>';
      }
    // End If CONFIG 3

    // Start If CONFIG 4
    if ($config[0] == 4 && $i > -1 && $i < $config[1]){
      echo '<b>Textarea: </b>';
      }
    // End If CONFIG 4
    
    echo $value."<br />";
    $i--;$b--;
    }
    echo "<br />Original:<br /><code><pre>".$data."</pre></code>";
  }

// All of the CSS data goes here
if ($_REQUEST['page'] == 'theme-css'){
  header("Content-type: text/css");
  echo '/* Universal */
body {
	background-color: #EDECEB;
}

body, td {
	font-family: Sans, Arial, Tahoma, Verdana;
	margin: 0px;
	padding: 0px;
	text-align: left;
}

.caption {
	overflow:hidden;
	height:14px;
	vertical-align:middle;
	font-size:12px;
	text-align:center;
	font-family:Sans;
	font-weight:bold;
	color:#ffffff;
}

a {
	color: #4E76A8;
}

a.visit:visited {
	color: #7AA1D1;
}

a:hover, a.visit:hover {
	color: #000000;
}

img {
	border: 0px;
}

form {
	margin: 0px;
}

table {
	margin-left: auto;
	margin-right: auto;
}

ul {
	margin-top: 0px;
	margin-bottom: 0px;
}
 table.c12 {border-collapse: collapse;}
 tr.c11 {font-size:8px;}
 td.c10 {background: url(images/menu-bottom-right.png) repeat-x;overflow:hidden;}
 td.c9 {background: url(images/menu-bottom.png) repeat-x;overflow:hidden;}
 td.c8 {background: url(images/menu-bottom-left.png) repeat-x;overflow:hidden;}
 td.c7 {background:#EDECEB url(images/menu-right.png) right repeat-y;overflow:hidden;}
 td.c6 {background:#EDECEB; font-family:Sans;font-size:12px;width:100%}
 td.c5 {background:#EDECEB url(images/menu-left.png) repeat-y;overflow:hidden;}
 td.c4 {background:url(images/menu-top-right.png) no-repeat;overflow:hidden;vertical-align:top;}
 td.c3 {background:url(images/menu-top.png);}
 div.c2 {overflow:hidden;height:14px;vertical-align:middle;font-size:12px;text-align:center;font-family:Sans;font-weight:bold;color:#ffffff;}
 td.c1 {background:url(images/menu-top-left.png) no-repeat; overflow:hidden;vertical-align:top;}
';
 die();
  }

// All of the JavaScript data goes here
if ($_REQUEST['page'] == "js") {
  header("Content-type: text/javascript");
  echo 'function LoadPage(page,usediv,msg) {
         // Set up request varible
         try {xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");}  catch (e) { alert("Error: Could not load page.");}
         //Show page is loading
         if (!msg){
         document.getElementById(usediv).innerHTML = \'<img src="images/ajax-loader.gif" alt="Loading..." />\';}
         else {
         document.getElementById(usediv).innerHTML = msg;}
         document.getElementById("mainpage").style.cursor = "progress";
         //send data
         xmlhttp.onreadystatechange = function(){
                 //Check page is completed and there were no problems.
                 if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                        //Write data returned to page, if usediv exists
                        if (usediv){
                        document.getElementById(usediv).innerHTML = xmlhttp.responseText; document.getElementById("status").innerHTML = "Idle";}
                        document.getElementById("mainpage").style.cursor = "default";
                 }
         }
         xmlhttp.open("GET", page);
         xmlhttp.send(null);
         //Stop any link loading normaly
         return xmlhttp.readyState;
}
var selected=0;
var recall=null;
function edit(line){
  if (line <= 2)
    LoadPage("?page=edit&line="+line+"&file="+document.getElementById("file").value,line+"");
  if (line > 2)
    LoadPage("?page=edit&line="+line+"&file="+document.getElementById("file").value,"kweshuns");
  selected=line;
  }
function save(line, bool){
  if (bool && bool.substring(0, 4) == "bool"){
    theButtons = document.getElementsByName(bool);
    length = theButtons.length;
    for (i = 0; i < length; i++) {
      if (theButtons[i].checked) {
        bool = theButtons[i].value;
        }
      }
    }
  if (!bool){
    
    }
  LoadPage("?page=save&line="+line+"&file="+document.getElementById("file").value+"&data="+document.getElementById(line+"e").value+"&prefix="+bool,"status","Updating...");
  }';
  die();
  }
?>
