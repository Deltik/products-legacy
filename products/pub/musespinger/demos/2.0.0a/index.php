<?php
// PHP Data Initialization
require('config.php');
require('language.php');
$version = "2.0.0a";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $lang['title']; ?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<script type="text/javascript">
function process()
{
var dataarray=document.getElementById("data").value.split(" ");
var table='<table align="center" border="1">';
var limit=document.getElementById("limit").value;
if (dataarray.length > limit)
 dataarray.length = limit;
for (i=0;i<dataarray.length;i++)
{
var foo = new Date; // Generic JS date object
var unixtime_ms = foo.getTime(); // Returns milliseconds since the epoch
var unixtime = parseInt(unixtime_ms / 1000);
table=table+'<tr><td>'+dataarray[i]+'</td><td><img src="status.php?data='+dataarray[i]+'&time='+unixtime+'" /></td></tr>';
}
table=table+'</table>';
document.getElementById("result").innerHTML=table;
}
</script>
<body>
<?php
if ($_POST['update']) {
$i = 0;
do {
 $i++;
 }
while (!@file_get_contents($updsrv[$i]."?version=$version") && $i < count($updsrv[$i]));
$response = file_get_contents($updsrv[$i-1]."?version=$version");
$response = explode("<br />", $response);
$server = $updsrv[$i-1];
$i = 0; $b = 0; $logon = 0; $changelog = null;
foreach($response as $value) {
 if ($i == 0)
 $serverver = substr($value, 9);
 if ($value == "Changelog BEGIN")
 $logon = $i;
 if ($logon && $logon != $i && $value != "Changelog END")
 $changelog = "$changelog$value<br />";
 if ($value == "Changelog END")
 $logon = 0;
 if ("Files: " == substr($value, 0, 7))
 $b = substr($value, 7)+1;
 if ($b > 0 && "Files: " != substr($value, 0, 7))
 $files = $files.'[]'.$value;
 $i++; $b--;
 }
$files = explode("[]", $files);
if (version_compare($version, $serverver, "<")) {
 echo '<div id="notify">An update is available for MuSeSPinger on this server.<br /><strong>New Version: </strong>'.$serverver.'<br /><strong>Installed Version: </strong>'.$version.'<br /><strong>What\'s New:</strong><br />'.$changelog.'</div>';
 echo '<div id="desc">Starting Update...<br />';
 $failed = 0;
 for ($i=1; $i < count($files); $i++) {
 echo 'Downloading <strong>'.$files[$i].'</strong>...';
 if(@!copy($server.$files[$i].'.upd', $files[$i])) {
 echo ' <code style="color:red;">[FAIL]</code>';
 $failed = 1;
 } else {
 echo ' <code>[PASS]</code>';
 }
 echo '<br />';
 }
 if($failed) {
 echo '<code style="color:red;">The update failed. Failure is usually caused by incorrect permissions set on the server. Notify the webmaster at '.$_SERVER['SERVER_NAME'].' and tell him/her to set the permissions to 777. If the update still fails, then the server is incapable of the PHP "copy()" function.</code>';
 } else {
 echo '<code>The update was successful. Reload this page to start using MuSeSPinger v'.$serverver.'.</code>';
 }
 echo '</div><br /><br />';
 }
 }
?>
<center>
 <div id="title"><?php echo $lang['title'].'<span style="font-size:10px">'.$version.'</span>'; ?></div>
 <div id="desc"><?php echo $lang['desc']; ?></div>
 <table id="table">
 <tr>
 <td><?php echo $lang['1,1']; ?></td>
 <td><?php echo $lang['1,2']; ?></td>
 </tr>
 <tr>
 <td><?php echo $lang['2,1']; ?></td>
 <td><?php echo $lang['2,2']; ?></td>
 </tr>
 <tr>
 <td><?php echo $lang['ports']; ?></td>
 <td><fieldset><legend><?php echo $lang['legend']; ?></legend><div id="result"><?php echo $lang['premsg']; ?></div></fieldset></td>
 </tr>
 </table>
 <input type="hidden" value="<?php echo $limit; ?>" id="limit" />
<?php
// Update Checker
$i = 0;
do {
 $i++;
 }
while (!@file_get_contents($updsrv[$i]."?version=$version") && $i < count($updsrv[$i]));
$response = file_get_contents($updsrv[$i-1]."?version=$version");
$response = explode("<br />", $response);
$server = $updsrv[$i-1];
$i = 0; $logon = 0; $changelog = null;
foreach($response as $value) {
 if ($i == 0)
 $serverver = substr($value, 9);
 if ($value == "Changelog BEGIN")
 $logon = $i;
 if ($logon && $logon != $i && $value != "Changelog END")
 $changelog = "$changelog$value<br />";
 if ($value == "Changelog END")
 $logon = 0;
 $i++;
 }
if (version_compare($version, $serverver, "<"))
 echo '<br /><div id="notify">An update is available for MuSeSPinger on this server.<br /><strong>New Version: </strong>'.$serverver.'<br /><strong>Installed Version: </strong>'.$version.'<br /><strong>What\'s New:</strong><br />'.$changelog.'<form action="'.$_SERVER['PHP_SELF'].'" method="post"><input type="submit" value="Click here to update" name="update" /></form></div>';
?>
</center>
</body>
</html>


