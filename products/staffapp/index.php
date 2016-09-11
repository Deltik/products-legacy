<?php
if ($_POST['form'] == 1){
// Start up variable session
session_start();

// Neatness Process
$_POST['fullname'] = ucwords(strtolower($_POST['fullname']));

// Lets get the position request parsed
$position = "<strong>Applied For:</strong> ";
if ($_POST['position'][0] == "null" && $_POST['positiontype'] == true){
 $position = $position.$_POST['positiontype'];
}
if ($_POST['position'][0] != "null"){
  for ($i=0;$i<=count($_POST['position'])-1;$i++){
  if ($i!=count($_POST['position'])-1){
   $position = $position.$_POST['position'][$i].", ";
  }
  if ($i==count($_POST['position'])-1 && $i != 0){
   $position = $position."and ".$_POST['position'][$i];
  } elseif ($i==count($_POST['position'])-1 && $i == 0) {
   $position = $position.$_POST['position'][$i];
  }
 }
}
if ($_POST['position'][0] != "null" && $_POST['positiontype'] == true){
$position = $position."<br /><strong>Also Applied For:</strong> ".$_POST['positiontype'];
}

// Application Generation
$app = "<h2>";
$app = $app.$_POST['fullname']."</h2><table style=\"background:lightblue;border:ridge\"><tr><td>".$position."</td></tr></table><h3>Section 1 - Contact Information</h3><p>";
$app = $app."<strong>Username:</strong> ".$_POST['username']."<br />";
$app = $app."<strong>Email:</strong> ".$_POST['email']."<br />";
$app = $app."<strong>Backup Email:</strong> ".$_POST['email2']."<br />";
$app = $app."<strong>MSN Messenger:</strong> ".$_POST['msn']."<br />";
$app = $app."<strong>Yahoo! Messenger:</strong> ".$_POST['yim']."<br />";
$app = $app."<strong>AOL Instant Messenger:</strong> ".$_POST['aim']."<br />";
$app = $app."<strong>ICQ Messenger:</strong> ".$_POST['icq']."<br />";
$app = $app."<strong>Facebook Profile:</strong> <a href=\"".$_POST['facebook']."\">".$_POST['facebook']."</a><br />";
$app = $app."<strong>Other Contact Information:</strong> ".$_POST['othercontact']."<br />";
$app = $app."<strong>Preferred Contact Method(s):</strong> ".$_POST['prefercontact']."<br />";
$app = $app."<strong>Typical Response Time and Fastest Contact Method:</strong> ".$_POST['responsetime']."<br /></p>";
$app = $app."<h3>Section 2 - About ".$_POST['fullname']."</h3><p>";
$app = $app."<strong>".$_POST['fullname']." is from:</strong> ".$_POST['place']."<br />";
$app = $app."<strong>The weather is:</strong> ".$_POST['weather']."<br />";
$app = $app."<strong>Personal History:</strong> ".$_POST['personalhistory']."<br />";
$app = $app."<strong>Motivation:</strong> ".$_POST['motivation']."<br />";
$app = $app."<strong>Worst Thing That Has Ever Happened To ".$_POST['fullname'].":</strong> ".$_POST['worstthing']."<br />";
$app = $app."<strong>Favourite Memory:</strong> ".$_POST['favmemory']."<br />";
$app = $app."<strong>Favourite Music:</strong> ".$_POST['typeofmusic']."<br />";
$app = $app."<strong>Favourite Entertainment:</strong> ".$_POST['typeofshow']."<br />";
$app = $app."<strong>Favourite Game:</strong> ".$_POST['typeofgame']."<br />";
$app = $app."<strong>Favourite Literature Genre:</strong> ".$_POST['typeofstory']."<br />";
$app = $app."<strong>Interests and Hobbies:</strong> ".$_POST['interests']."<br />";
$app = $app."<strong>If ".$_POST['fullname']." could have anything in the world, it would be:</strong> ".$_POST['haveonething']."<br />";
$app = $app."<strong>".$_POST['fullname']." wants to be:</strong> ".$_POST['aspirations']."<br />";
$app = $app."<strong>Plans to get there by:</strong> ".$_POST['plantogetthere']."<br /></p>";
$app = $app."<h3>Section 4 - The Position</h3><p>";
$app = $app."<strong>Available:</strong> ".$_POST['available']."<br />";
$app = $app."<strong>Time Conflicts:</strong> ".$_POST['conflicts']."<br />";
$app = $app."<strong>Life Priority:</strong> ".$_POST['priority']."<br />";
$app = $app.$position."<br />";
$app = $app."<strong>Independence:</strong> ".$_POST['supervision']."<br />";
$app = $app."<strong>Solver or Questioner?:</strong> ".$_POST['problemsolver']."<br />";
$app = $app."<strong>Instruction Follower?:</strong> ".$_POST['followinstructions']."<br />";
$app = $app."<strong>Complaint Handler?:</strong> ".$_POST['handlecomplaints']."<br />";
$app = $app."<strong>Convincing?</strong> ".$_POST['manipulation']."<br />";
$app = $app."<strong>Skills:</strong> ".$_POST['skills']."<br />";
$app = $app."<strong>Experience:</strong> ".$_POST['experiences']."<br />";
$app = $app."<strong>Commitment:</strong> ".$_POST['commitment']."<br /></p>";
$app = $app."<h3>Section 5 - The Tough Questions</h3><p>";
$app = $app."<strong>Last Lied:</strong> ".$_POST['liedlast']."<br />";
$app = $app."<strong>Last Disagreement:</strong> ".$_POST['disagree']."<br />";
$app = $app."<strong>Last Time ".$_POST['fullname']." Helped Someone:</strong> ".$_POST['lasttimehelped']."<br />";
$app = $app."<strong>Last Major Problem Solved:</strong> ".$_POST['lastproblem']."<br />";
$app = $app."<strong>Last Joke:</strong> ".$_POST['senseofhumour']."<br />";
$app = $app."<strong>Most Important Person:</strong>".$_POST['mostimportant']."<br />";
$app = $app."<strong>Elimination:</strong> ".$_POST['eliminate']."<br />";
$app = $app."<strong>How To Fight Poverty:</strong> ".$_POST['fightpoverty']."<br />";
$app = $app."<strong>How To Fight Crime:</strong> ".$_POST['fightcrime']."<br />";
$app = $app."<strong>How To Handle Disablities:</strong> ".$_POST['fightdisability']."<br />";
$app = $app."<strong>How To Fight Corruption:</strong> ".$_POST['fightcorruption']."<br />";
$app = $app."<strong>Life in 24 Hours</strong> ".$_POST['24hours']."<br />";
$app = $app."<strong>Largest Flaw:</strong> ".$_POST['largestflaw']."<br />";
$app = $app."<strong>Something To Steal:</strong> ".$_POST['stealsomething']."<br />";
$app = $app."<strong>If... Friend Breaks Rules:</strong> ".$_POST['brokenrules']."<br />";
$app = $app."<strong>If... Friend Steals Computer:</strong> ".$_POST['brokenrules2']."<br />";
$app = $app."<strong>If... Friend Breaks Law:</strong> ".$_POST['brokenrules3']."<br />";
$app = $app."<strong>If... Friend Breaks Law, but Not Likely To Get Caught:</strong> ".$_POST['brokenrules4']."<br />";
$app = $app."<strong>If... Friend Hack Hackback:</strong> ".$_POST['brokenrules5']."<br />";
$app = $app."<strong>Worst Thing Done:</strong> ".$_POST['correction']."<br />";
$app = $app."<strong>Education System Flaw(s):</strong> ".$_POST['educationflaw']."<br />";
$app = $app."<strong>Leadership Traits:</strong> ".$_POST['leadertraits']."<br />";

// PRINT: Header
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="icon" href="http://www.deltik.org/favicon.ico" type="image/gif">
<title>Deltik Staff Application</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta http-equiv="content-language" content="en-us">
<meta http-equiv="content-style-type" content="text/css">
<body>
';

// PRINT: Submit Form
echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
<h2>Overview</h2>
Below is how your staff application will look like submitted. If you made any mistakes, you might be able to change it by pressing "Back" on your browser if it supports refilling the form again. Your application will be submitted when you press "Submit Application".
<p>
<input type="hidden" name="form" value="2" />
<input type="hidden" name="email" value="'.$_POST['email'].'" />
<input type="hidden" name="email2" value="'.$_POST['email2'].'" />
<input type="hidden" name="fullname" value="'.$_POST['fullname'].'" />
';
$_SESSION['app'] = $app;
if ($_POST['email'])
echo '<input type="checkbox" name="sendcopy1" id="sendcopy1" /><label for="sendcopy1">Send a copy to '.$_POST['email'].'</label><br />';
if ($_POST['email2'])
echo '<input type="checkbox" name="sendcopy2" id="sendcopy2" /><label for="sendcopy2">Send a copy to '.$_POST['email2'].'</label><br />';
echo '
<br />
<input type="submit" value="Submit Application" />
</p>
</form>
';

// PRINT: Application Overview
echo '<div id="application"><table style="background:lightgreen;border:ridge;width:100%;"><tr><td>';
echo stripslashes($app);
echo '</td></tr></table></div>
</body></html>';
die;
}

if ($_POST['form'] == 2){
session_start();

$email = $_POST['email'];
$email2 = $_POST['email2'];

$to = "webmaster@deltik.org";
$subject = "[Deltik] Staff Application from ".$_POST['fullname'];
$message = stripslashes($_SESSION['app']);
$from = "Deltik Mail System <mail@deltik.org>";
$headers = "From: $from\r\nReply-To: $email\r\nContent-Type: text/html; charset=\"iso-8859-1\"\r\nContent-Transfer-Encoding: 7bit";
mail($to,$subject,$message,$headers);

if ($_POST['sendcopy1'])
mail($email,$subject,$message,$headers);

if ($_POST['sendcopy2'])
mail($email2,$subject,$message,$headers);

echo '<h2>Application Submitted</h2>
We have received your application and will follow up when we have a chance.<br /><br />

If you do not receive a position, please understand this is only because we have assessed we are not the right place for you. You are free to submit another application if you believe otherwise.
';
die();
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="icon" href="http://www.deltik.org/favicon.ico" type="image/gif">
<title>Deltik Staff Application</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta http-equiv="content-language" content="en-us">
<meta http-equiv="content-style-type" content="text/css">
<style type="text/css">
body,td,th {
 font-family: Sans, FreeSans, Verdana, Arial, Times, Times New Roman, Monospace, Courier, Courier New;
 font-size: 14px;
 color: #333333;
}
body {
 background-color: green;
 margin-left: 0px;
 margin-top: 0px;
 margin-right: 0px;
 margin-bottom: 0px;
 background-image: url('volunteer.php_files/physical.gif');
}
p {
 margin-top:0;
 padding-top:0;
 text-align:justify;
}
a:link {
 color: #008DC7;
}
a:visited {
 color: #008DC7;
}
a:hover {
 color: #00A9E3;
}
a:active {
 color: #008DC7;
}
#main-container {
 background-color: green;
 background: url('volunteer.php_files/physical.gif') repeat-x;
 width: 100%;
}
#content-container {
 width: 95%;
 margin: 0 auto;
 height: 100%;
}
.concon {
 width: 95%;
 margin: 0 auto;
 height: 100%;
}
#logo-container {
 padding: 32px 0;
}
#nav-left {
 float: left;
 width: 158px;
 background: lightgreen repeat-y left;
 text-align: right;
 color: #FFFFFF;
 padding-bottom: 10000px;
 margin-bottom: -10000px;
}
a.nav:link, a.nav:visited, a.nav:active {
 border-top: 1px solid #BE890C;
 margin: 0 10px;
 color: #FFFFFF;
 font-weight: bold;
 text-decoration: none;
 display: block;
 width: auto;
 padding: 4px 4px 4px 0px;
 font-size: 18px;
}
a.nav:hover {
 border-top: 1px solid #BE890C;
 margin: 0 10px;
 background-color: #CB920C;
 font-weight: bold;
 text-decoration: none;
 display: block;
 width: auto;
 padding: 5px 6px 5px 0px;
 font-size: 18px;
}
#mainpage {
 background-color: #FFFFFF;
 border-right: 12px lightgreen solid;
 float: left;
 padding-left: 15px;
 padding-right: 15px;
 padding-bottom: 10000px;
 margin-bottom: -10000px;
 width: auto;
 padding-top: 5px;
}
#box {
 overflow: hidden;
}
#top {
 margin:0;
 padding:0;
 color:#FFFFFF;
 font-weight:bold;
 background:lightgreen;
}
#bottom {
 margin:0;
 padding:0;
 color:#FFFFFF;
 font-weight:bold;
 font-size:10px;
 background:lightgreen;
}
h1,h2,h3,h4,h5,h6 {
 font-weight: bold;
}
h2,h3,b.h2 {
 font-size: 18px;
 color: #185D94;
 margin: 2px;
 margin-bottom:0;
 padding-bottom:0;
 margin-top:18px;
}
h3 {
margin-top:0px;
}
h1 {
 font-size:48pt;
 color: #FFFFFF;
 margin:0;
 padding:0;
 position:relative;
 top:26px;
}
#footer {
 padding: 0;
 font-size: 10px;
 color: #FFFFFF;
 position: relative;
 padding-top:0;
 margin-top:4px;
}
#footer img {
 padding: 0 5px;
}
#footer-left {
 float: left;
 width: 150px;
 margin:0;
 margin-left:16px;
}
#footer-right {
 float: right;
 width: 100%;
 text-align: right;
 margin:0;
 margin-right:16px;
}
#footer-right a:link, #footer-right a:active, #footer-right a:visited {
 font-size: 11px;
 color: #FFFFFF;
 text-decoration: none;
}
#footer-right a:hover {
 font-size: 11px;
 color: #FFFFFF;
 text-decoration: underline;
}
.quote {
 border: 1px dotted #E9CE7C;
 background-color: #FBF5E6;
 padding: 4px;
 margin: 0;
 font-size: 10pt;
 width: 230px;
 height:60px;
 text-align: justify;
}
#buttons-left {
 text-align: right;
 border-top: 1px solid #BE890C;
 margin: 0 10px;
 padding-top:4px;
}
#buttons-left img {
 padding: 2px 0;
}
#bar {
 border-top: 1px solid #BE890C;
 margin: 0 10px;
 padding: 0;
}
a.wb:link, a.wb:visited, a.wb:active {
 width: 100%;
 height: 30px;
 color: #FFFFFF;
 font-size: 18px;
 background:#298ad1 url('http://ismywebsite.com/i/widebutton.gif');
 background-repeat: no-repeat;
 text-align:center;
 padding-top:8px;
 margin-bottom:8px;
 display: block;
}
a.wb:hover {
 font-weight: bold;
 text-decoration: none;
}
a.b:link, a.b:visited, a.b:active {
 width: 160px;
 height: 30px;
 color: #FFFFFF;
 font-size: 18px;
 background-image: url('http://ismywebsite.com/i/button.gif');
 background-repeat: no-repeat;
 text-align: center;
 display: block;
 padding: 8px 3px;
 float: left;
}
.b:hover {
 font-weight: bold;
 text-decoration: none;
}
input.b {
 width: 293px;
 height: 30px;
 color: #FFFFFF;
 font-size: 18px;
 background-image: url('http://ismywebsite.com/wall/i/293button.gif');
 background-repeat: no-repeat;
 text-align: center;
 display: block;
 padding: 8px 3px;
}
td {
 vertical-align:top;
}
td.a {
 text-align:center;
 background:#F3F3ED;
 font-weight:bold;
 font-size:12pt;
 border:1px dotted #BABD82;
 padding:4px;
}
td.t {
 font-weight:bold;
 text-align:center;
 border:1px dotted #BABD82;
 border-bottom:none;
 background:#F3F3ED;
 padding-bottom:4px;
}
td.l {
 background:#F3F3ED;
 border:1px dotted #BABD82;
 border-right:none;
 text-align:right;
 font-weight:bold;
 padding-right:4px;
}
td.m {
 background:#F3F3ED;
 text-align:center;
}
td.n {
 background:#F9F9F3;
 text-align:center;
}
table.note {
 width:100%;
 border:1px dotted #E9CE7C;
 padding:0;
 background-color:#FBF5E6;
 margin:6px 0;
}
td.note {
 padding:8px;
 padding-bottom:0;
}
p.note {
 width:586px;
 border:1px dotted #E9CE7C;
 background-color:#FBF5E6;
 padding:6px;
 color:#68633C;
}
table.bar {
 width:100%;
 border:1px dotted #BABD82;
 padding:0;
 background:#F3F3ED;
}
td.bar {
 text-align:center;
 font-weight:bold;
 padding:1px;
}
a.bar {
 text-decoration:none;
}
img.bar {
 width:72px;
 height:72px;
 border:none;
}
input.bar {
 width:72px;
 height:72px;
}
td.z {
 background:#F3F3ED;
 font-size:12pt;
 border:1px dotted #BABD82;
 padding:4px;
}

.note {
 width:586px;
 border:1px dotted #E9CE7C;
 background-color:#FBF5E6;
 padding:6px;
 color:#68633C;
}
img{
border: 0;
}
</style>
<script type="text/javascript">
var file = 'home';
var xmlhttp;

function setContent(value) {
 if (document.getElementById) {
  var mainpage = document.getElementById('mainpage');
 }

 mainpage.innerHTML = value;
 scroll(0,0);
}

function startAJAX() {
 try {
 xmlhttp = new XMLHttpRequest();
 } catch(err1) {
 var ieXmlHttpVersions = [];
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp.8.0";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp.7.0";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp.6.0";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp.5.0";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp.4.0";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp.3.0";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "MSXML2.XMLHttp";
 ieXmlHttpVersions[ieXmlHttpVersions.length] = "Microsoft.XMLHttp";

 var i;
 for (i=0;i < ieXmlHttpVersions.length;i++) {
 try {
 xmlhttp = new ActiveXObject(ieXmlHttpVersions[i]);
 break;
 } catch (err2) {
 }
 }
 }

 if (typeof xmlhttp == "undefined") {
 setContent("<h1>XMLHttp cannot be created!</h1>");
 return false;
 } else {
 return xmlhttp;
 }
}

function showPage() {
 if (xmlhttp.readyState==4) {
  setContent(xmlhttp.responseText);
  scroll(0,0);
 }
}

function getPage(page) {
 var myurl = "gc.php?p="+page+"&t="+Date.parse(new Date());
 if ((xmlhttp = startAJAX())) {
 xmlhttp.open("GET",myurl,true);
 xmlhttp.onreadystatechange=showPage;
 xmlhttp.send(null);
 } else {
 alert ("AJAX failed");
 }
}

function loadPage(value) {
 setContent('<h1>Page Loading</h1><p>If load does not complete, please report this error to <a href="mailto:deltik@gmx.com">deltik@gmx.com</a>. Thanks for your patience.</p>');
 getPage(value);
}

function fixLinks() {
 var text = document.location.href;
 var tp = text.indexOf("#")+1;
 if (tp > 0) {
 loadPage(text.slice(tp));
 }

 var test;
 for (var count = 1;count < 9999;count ++) {
 if ((test = document.getElementById('link'+count))) {
 text = test.href;
 tp = text.indexOf('?p=');
 if (tp < 0) {
 var pp = text.indexOf('.');
 test.href = "#"+text.slice(7, pp);
 } else {
 test.href = "#"+text.slice(tp + 3);
 }
 } else {
 break;
 }
 }
}

function gEl(value) {
 if (document.getElementById) {
 return document.getElementById(value);
 } else if (document.layers) {
 return document.layers[value];
 } else if (document.all) {
 return document.all[value];
 }
}


function hidePiece(name) {
 gEl(name).style.display="none";
}

function showPiece(name) {
 gEl(name).style.display="";
}</script>
</head>
<body><div id="tp"></div><div id="main-container"><div id="content-container" class="concon"><div id="logo-container"><h1><img src="http://www.deltik.org/images/deltik.png" alt="Deltik" height="60" width="190"></h1></div><div id="box"><div id="top" style="background:lightgreen;height:16">&nbsp;</div>

<table style="border-collapse:collapse;background:lightgreen;"><tr><td>
<div id="nav-left"><a href="#www" class="nav" onclick="getPage('home')" id="link1" title="Home">Deltik <img src="volunteer.php_files/freehosting.gif" alt="&gt;" border="0" height="13" width="7"></a>
<a href="#about" class="nav" onclick="getPage('about')" id="link2" title="About">Automni <img src="volunteer.php_files/freehosting.gif" alt="&gt;" border="0" height="13" width="7"></a>
<div id="buttons-left" style="font-size: 4px;"><br />
</div>
</div>
</td><td>
<div id="mainpage">
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<input type="hidden" value="1" name="form" />

<h2>Deltik Staff Application</h2>
Welcome to the Deltik Staff Application Form. You will be interviewed with professional and personal questions. Aim to fill in as many fields as possible. You may skip questions, but this will lower your chances of receiving a position.<br /><br />
All information submitted must be valid and to the best of your knowledge,
and you must notify us of any changes in this information.<br><br>

All positions are volunteer-based, unless volunteers make it possible to offer some in return.<hr><code id="staff"><strong>Current Staff:</strong><br /><br />
<?php
$read = "";
$file = fopen("staff.txt", "r") or exit("Unable to read staff information!");
//Output a line of the file until the end is reached
while(!feof($file))
  {
  $read = $read.fgets($file)."<br />";
  }
$read = str_replace("\n", "", $read);
echo $read;
$read = str_replace("\\","\\\\", $read);
fclose($file);
?></code>
<script type="text/javascript">
hideStaff();
function hideStaff() {
 document.getElementById("staff").innerHTML="<input type=\"button\" value=\"Show Staff\" onclick=\"showStaff();\" />";
}
function showStaff() {
 document.getElementById("staff").innerHTML='<?php echo $read; ?>'+"<input type=\"button\" value=\"Hide Staff\" onclick=\"hideStaff();\" />";
}
</script>
<hr>

<h2>Section 1 - Contact Information</h2>
Communication is very important. The more ways you are reachable, the better, as long as you can keep on top of them all.<br><br>

Enter your Deltik username, if you have one: <input name="username" value="" type="text"><br><br>

Please enter your full name here: <input name="fullname" value="" type="text"><br><br>

<div id="takepick"></div>
<script type="text/javascript">
takePickButton();
function takePickButton() {
 document.getElementById("takepick").innerHTML='<input type="button" value="Click Here to Pick Your Position Now" onclick="takePick();" />';
}
function takePick() {
 document.getElementById("takepick").innerHTML=document.getElementById("position").innerHTML;
 document.getElementById("position").innerHTML='<strong>What type of position would you like to help with? Type in your position or select it from the dropdown menu (select more than one by holding Control).</strong><br><textarea cols="64" rows="6" disabled="disabled">(fill this in at the top, if you have not done so already)</textarea><select multiple="multiple" size="6" disabled="disabled"><option>(choose at the top)</option></select>';
}
</script><br>

Please enter a valid email address. It must be checked often, as this
is our primary method of communication for non-urgent matters.<br>
<input name="email" size="80" value="" type="text"><br><br>

Please enter a valid <b>secondary</b> email address, in case the above email does not work or to ensure you receive messages faster.<br>
<input name="email2" size="80" value="" type="text"><br><br>

<!-- SKIP
Phone calls are typically only used for urgent communication. It is extremely unlikely for us to call you. You may skip this field with no deducted chance of getting a position. If you have a phone number, enter it here (include area code): <input name="phone" value="" type="text"><br><br>

Phoning the number above, who is likely to answer?<br>
<input name="phoneanswer" size="80" value="" type="text"><br><br>

What time do you typically answer the phone (please convert to GMT or specify the timezone)?<br>
<input name="phonetime" size="80" value="" type="text"><br><br>

Is there any time when you would not appreciate being called?<br>
<input name="phonenotime" size="80" value="" type="text"><br><br>

If you have a second phone number we can try, enter it here (include area code): <input name="phone2" value="" type="text"><br><br>

Phoning the number above, who is likely to answer?<br>
<input name="phoneanswer2" size="80" value="" type="text"><br><br>

What time do you typically answer the phone (please convert to GMT or specify the timezone)?<br>
<input name="phonetime2" size="80" value="" type="text"><br><br>

Is there any time when you would not appreciate being called?<br>
<input name="phonenotime2" size="80" value="" type="text"><br><br>
SKIP -->

Do you have an MSN Messenger handle? Enter it here.<br>
<input name="msn" size="80" value="" type="text"><br><br>

Do you have a Yahoo! Messenger handle? Enter it here.<br>
<input name="yim" size="80" value="" type="text"><br><br>

Do you have an AIM handle? Enter it here.<br>
<input name="aim" size="80" value="" type="text"><br><br>

Do you have an ICQ handle? Enter it here.<br>
<input name="icq" size="80" value="" type="text"><br><br>

Do you use Facebook? Include a link to your profile here.<br>
<input name="facebook" size="80" value="" type="text"><br><br>

Please include any additional contact information below (use as much space as you need).<br>
<textarea name="othercontact" cols="64" rows="6"></textarea><br><br>

Which method(s) of contact do you prefer we use?<br>
<input name="prefercontact" size="80" value="" type="text"><br><br>

What is your typical response time? Which methods are best for a fast response?<br>
<textarea name="responsetime" cols="64" rows="6"></textarea><hr>

<h2>Section 2 - About You</h2>
This section is a brief introduction to you as a person. It helps us
understand you on a more personal level, and assess how well you will
fit in with our team and community.<br><br>

Where are you from? <input name="place" size="60" value="" type="text"><br><br>

How is the weather at the moment? <input name="weather" value="" size="60" type="text"><br><br>

Can you tell us a bit about your personal history?<br>
<textarea name="personalhistory" cols="64" rows="6"></textarea><br><br>

What motivates you most to do a good job?<br>
<textarea name="motivation" cols="64" rows="6"></textarea><br><br>

What is the worst thing that has ever happened to you?<br>
<textarea name="worstthing" cols="64" rows="6"></textarea><br><br>

What is your favourite memory, and why?<br>
<textarea name="favmemory" cols="64" rows="6"></textarea><br><br>

What type of music do you listen to?<br>
<textarea name="typeofmusic" cols="64" rows="6"></textarea><br><br>

What is your favourite movie, TV show, or play/performance?<br>
<textarea name="typeofshow" cols="64" rows="6"></textarea><br><br>

What is your favourite game? (Any kind allowed, including sports.)<br>
<textarea name="typeofgame" cols="64" rows="6"></textarea><br><br>

What type of books/stories do you typically read or listen to?<br>
<textarea name="typeofstory" cols="64" rows="6"></textarea><br><br>

What are your interests and hobbies?<br>
<textarea name="interests" cols="64" rows="6"></textarea><br><br>

If you could have anything in the world, but only one thing, what would it be?<br>
<textarea name="haveonething" cols="64" rows="6"></textarea><br><br>

What do you aspire/want to be in life?<br>
<textarea name="aspirations" cols="64" rows="6"></textarea><br><br>

How do you plan to get there?<br>
<textarea name="plantogetthere" cols="64" rows="6"></textarea><hr>

<h2>Section 3 - Why You're Here (undefined)</h2>
We've excluded this section, because it is unneccasary.
<!-- SKIP
This section helps a lot to get a feel for your understanding of our
service, and your dedication as a webmaster. It's also to get an
impression of what we can improve, and what direction you see is best.<br><br>

What brought you to Deltik in the first place?<br>
<textarea name="firstplace" cols="64" rows="6"></textarea><br><br>

Do you own any websites, and where are they hosted?<br>
<textarea name="websitesandhosted" cols="64" rows="6"></textarea><br><br>

How hard do you work on your websites typically?<br>
<textarea name="hardwork" cols="64" rows="6"></textarea><br><br>

How much of your life has gone into web development?<br>
<textarea name="timetodev" cols="64" rows="6"></textarea><br><br>

What was your primary reason for signing up with Deltik, if you did?<br>
<textarea name="primaryjoinreason" cols="64" rows="6"></textarea><br><br>

What was your hesitation to sign up with Deltik?<br>
<textarea name="primaryjoinhesitation" cols="64" rows="6"></textarea><br><br>

If you could change just one thing about the site, what would it be?<br>
<textarea name="changeonething" cols="64" rows="6"></textarea><br><br>

How do you think you can contribute to that change?<br>
<textarea name="contribute" cols="64" rows="6"></textarea><br><br>

What would you change next, after fixing that?<br>
<textarea name="changeonething2" cols="64" rows="6"></textarea><br><br>

How do you think you can contribute to that change?<br>
<textarea name="contribute2" cols="64" rows="6"></textarea><br><br>

What is one final thing you would fix?<br>
<textarea name="changeonething3" cols="64" rows="6"></textarea><br><br>

How do you think you can contribute to that change?<br>
<textarea name="contribute3" cols="64" rows="6"></textarea><br><br>

Can you see any bugs/glitches on the website?<br>
<textarea name="bugsglitch" cols="64" rows="6"></textarea><br><br>

If you were able to donate to Deltik, would you? Why/why not?<br>
<input name="donate" size="80" value="" type="text"><br><br>

What do you hope to take away from your experience here?<br>
<textarea name="takeaway" cols="64" rows="6"></textarea><hr>
SKIP -->

<h2>Section 4 - Take Your Pick</h2>
This is where we get down to choosing the best role for you. More
options mean more chance we will find a fit, but too many can mean you
get a position that might not be right for you.<br><br>

When are you usually available to help?<br>
<textarea name="available" cols="64" rows="6"></textarea><br><br>

What else would conflict with your time here?<br>
<textarea name="conflicts" cols="64" rows="6"></textarea><br><br>

What is your priority in life at the moment?<br>
<textarea name="priority" cols="64" rows="6"></textarea><br><br>

<div id="position"><strong>What type of position would you like to help with? Type in your position or select it from the dropdown menu (select more than one by holding Control).</strong><br>
<textarea name="positiontype" cols="64" rows="6"></textarea>
<select name="position[]" multiple="multiple" size="6">
<option value="null" selected="selected">None of these</option>
<optgroup label="&nbsp;"></optgroup>
<optgroup label="Automni">
<option value="Automni CMS Coder">CMS Coder</option>
<option value="Automni Human Resources Director">Human Resources Director</option>
<option value="Automni Website Administrator" disabled="disabled">Website Administrator</option>
<option value="Automni Website Moderator" disabled="disabled">Website Moderator</option>
<option value="Support Specialist" disabled="disabled">Support Specialist</option>
<option value="Analyst" disabled="disabled">Analyst</option>
</optgroup>
<optgroup label="Deltik">
<option value="Deltik Website Administrator">Website Administrator</option>
<option value="Deltik Website Moderator">Website Moderator</option>
<option value="Deltik Programmer/Scripter">Programmer/Scripter</option>
<option value="Deltik Support Specialist">Support Specialist</option>
<option value="Deltik Human Resources Director">Human Resources Director</option>
<option value="Deltik Analyst">Analyst</option>
</optgroup>
</select><br><br></div>

How much supervision do you require? How independent are you?<br>
<textarea name="supervision" cols="64" rows="6"></textarea><br><br>

Are you a problem-solver or do you usually ask for help?<br>
<textarea name="problemsolver" cols="64" rows="6"></textarea><br><br>

Do you follow instructions by the book, or deviate when you there is a better way of doing things? (Or where in between?)<br>
<textarea name="followinstructions" cols="64" rows="6"></textarea><br><br>

How effective are you at handling complaints?<br>
<textarea name="handlecomplaints" cols="64" rows="6"></textarea><br><br>

Are you good at encouraging change in others?<br>
<textarea name="manipulation" cols="64" rows="6"></textarea><br><br>

What skills do you bring to the job?<br>
<textarea name="skills" cols="64" rows="6"></textarea><hr>

What past experiences would help you with this job?<br>
<textarea name="experiences" cols="64" rows="6"></textarea><hr>

How positive are you of your commitment to Deltik?<br>
<textarea name="commitment" cols="64" rows="6"></textarea><hr>

<h2>Section 5 - The Tough Questions</h2>
This is your interview nightmare. Everybody has to go through it. Prepare to be interogated, and let's hope you come out clean.<br><br>

Please make doubly sure all answers are completely honest.<br><br>

When was the last time you lied to or misled somebody?<br>
<textarea name="liedlast" cols="64" rows="6"></textarea><br><br>

When was the last time you had a disagreement and how did you resolve it?<br>
<textarea name="disagree" cols="64" rows="6"></textarea><br><br>

When was the last time you helped someone else?<br>
<textarea name="lasttimehelped" cols="64" rows="6"></textarea><br><br>

What was the last major problem you solved?<br>
<textarea name="lastproblem" cols="64" rows="6"></textarea><br><br>

What was the last joke you made? How well was it received?<br>
<textarea name="senseofhumour" cols="64" rows="6"></textarea><br><br>

What is the purpose of friendship, to you?<br>
<textarea name="friendpurpose" cols="64" rows="6"></textarea><br><br>

Who is the most important person in the world?<br>
<textarea name="mostimportant" cols="64" rows="6"></textarea><br><br>

If you could eliminate just one religion, race, or nation, what would be your pick and why?<br>
<textarea name="eliminate" cols="64" rows="6"></textarea><br><br>

What is the most effective way to fight global poverty?<br>
<textarea name="fightpoverty" cols="64" rows="6"></textarea><br><br>

What is the most effective way to deal with criminals?<br>
<textarea name="fightcrime" cols="64" rows="6"></textarea><br><br>

What is the most effective way to deal with disabilities?<br>
<textarea name="fightdisability" cols="64" rows="6"></textarea><br><br>

What is the most effective way to deal with government corruption?<br>
<textarea name="fightcorruption" cols="64" rows="6"></textarea><br><br>

If you were to die in 24 hours, how would you spend it?<br>
<textarea name="24hours" cols="64" rows="6"></textarea><br><br>

What is your largest flaw?<br>
<textarea name="largestflaw" cols="64" rows="6"></textarea><br><br>

If you could steal anything from anyone, what would it be?<br>
<textarea name="stealsomething" cols="64" rows="6"></textarea><br><br>

You discovered your friend was breaking the rules, but no one was hurt as a result. How long would you keep it a secret for?<br>
<textarea name="brokenrules" cols="64" rows="6"></textarea><br><br>
You discover that a couple of years ago, your friend broke into a house
and stole somebody else's computer. No one knows it was him, and he
insists that he will never steal again, but he's not willing to return
the computer or make it up to the victim. What would be your reaction?<br>
<textarea name="brokenrules2" cols="64" rows="6"></textarea><br><br>
Your friend begs you to keep secret an illegal action, but you believe
there should never have been such a law in the first place. You know
the law is cracking down, and you could both be in huge trouble. Would
you still keep her secret and why?<br>
<textarea name="brokenrules3" cols="64" rows="6"></textarea><br><br>

How would you react in the above situation, if the chances of getting caught were very slim?<br>
<textarea name="brokenrules4" cols="64" rows="6"></textarea><br><br>
Your friend runs a website, and due to a security vulnerability it gets
hacked and he loses a week's worth of work. He learns who did it and
discovers a vulnerability in their network that would do serious
damage. He asks you if he should launch a counter-attack. What do you
advise him?<br>
<textarea name="brokenrules5" cols="64" rows="6"></textarea><br><br>

What is the worst thing you have done in your life? What did you do to correct any damage done?<br>
<textarea name="correction" cols="64" rows="6"></textarea><br><br>

What problems can you see with the education system in your region, if any?<br>
<textarea name="educationflaw" cols="64" rows="6"></textarea><br><br>

What do you think are the most important traits of a leader?<br>
<textarea name="leadertraits" cols="64" rows="6"></textarea>

<hr>
Last chance to verify everything before you submit this form! You will not be able to change anything after this point.<br><br>

Please ensure that all answers are correct to the best of your knowledge.<br><br>

<input name="go" value="Submit Application" type="submit">
</form>


</div>
</td></tr></table>
<br clear="all">
</div>

</div>

</div>

<div class="concon">
<div id="bottom" style="background:lightgreen;height:16">&nbsp;
</div>
<div id="footer">
<div id="footer-left">
© 2006-2009 <a href="http://www.azoundria.com/">Azoundria</a>
</div><div id="footer-right">
<a href="#www" onclick="getPage('home')" id="link9">Home</a> | <a href="#ask" onclick="getPage('ask')" id="link10">Contact</a> | <a href="http://forum.ismywebsite.com/">Forum</a> | <a href="#join" onclick="getPage('rules')" id="link11">Terms Of Service</a> | <a href="#privacy" onclick="getPage('privacy')" id="link12">Privacy Policy</a> | <a href="#ads" onclick="getPage('ads')" id="link13">Advertising</a> | <a href="#wall" onclick="getPage('wall')" id="link14">Donations (IsMyWall)</a></div></div>
</div>
</body></html>
