<title>IsMyWebsite Server Status Checker</title>

<?php

error_reporting(0);

$cur = '0.4.3';
if($_REQUEST['Update'] == TRUE)
	$cur = $_REQUEST['Update'];
/* DEMO MODE */#$ver = file_get_contents('http://www.deltik.org/Deltik/ver.txt');
if(strstr($ver, $cur) == FALSE && $ver != FALSE) {
	echo ("There is an update for the IsMyWebsite Server Status Checker:<br/>Current Version: ".$cur."<br/>Latest Version: ".$ver."<br/><br/>");
	if(is_writable('index.php')) {
		echo 'Running automatic update...<br/>Downloading online.gif...';
		copy('http://www.deltik.org/Deltik/online.gif', 'online.gif');
		if(!copy('http://www.deltik.org/Deltik/online.gif', 'online.gif'))
			echo '<span style="color: #FF0000"><b>[FAILED]</b> Error: Unable to copy!</span>';
		echo '<br/>Downloading offline.gif...';
		copy('http://www.deltik.org/Deltik/offline.gif', 'offline.gif');
		if(!copy('http://www.deltik.org/Deltik/offline.gif', 'offline.gif'))
			echo '<span style="color: #FF0000"><b>[FAILED]</b> Error: Unable to copy!</span>';
		echo '<br/>Downloading index.php... ';
		copy('http://www.deltik.org/Deltik/update.txt', 'index.php');
		if(!copy('http://www.deltik.org/Deltik/update.txt', 'index.php'))
			echo '<span style="color: #FF0000"><b>[FAILED]</b> Error: Unable to copy!</span>';
		// Check if Updated; If not, then make it Update
		if($_REQUEST['Update'] != TRUE)
			exit('<script type="text/javascript">window.location="?Update='.$cur.'";</script>');
		if($_REQUEST['Update'] == TRUE)
			die('<br/><br/><b>UPDATED! Click <a href="?UPDATED">here</a> to run the script.</b>');
		} else {
		echo 'Unable to write to file. Please CHMOD this to 777 and try again. This current version will still work.';
		}
	}

error_reporting(E_ALL);

?>

<center>
<script type="text/javascript">
function disable()
{
document.getElementById("submit").disabled=true;
document.getElementById("status").innerHTML="Loading...";
document.getElementById("reset").disabled=true;
}
</script>
<?php

if($_POST == FALSE)
  exit('To begin the IsMyWebsite Server Status Check, click &quot;Go&quot;.<br/>
<br/>
<span style="color: #FF0000"><b>The more URLs you enter, the longer the test will take. Do not cancel the test, or else you will have to reload.</b></span><br/>
<br/>
<form action=" " method="post">
  <input type="text" name="custom" id="custom" />
  Custom server(s) to test (default: [blank]); For multiple, separate with a space.<br/>
  <input type="text" name="port" value="80" size="4" maxlength="5" id="port" />
  Port (default: 80)<br/>
  <input type="submit" value="Go" id="submit" onclick="disable()" />
  <input type="reset" name="Reset" value="Erase" id="reset" />
</form>
<br/>
<fieldset>
<legend> Status: </legend>
<h1 id="status">Waiting for submit...</h1>
</fieldset>
<br/>
<br/>
<u>Ports:</u><br/>
80 = HTTP<br/>
21 = FTP<br/>
3306 = MySQL<br/>
2082 = cPanel<br/>
2083 = Secure cPanel<br/>
2086 = cPanel WHM<br/>
2095 = cPanel Webmail');

$port = $_POST['port'];

if($_POST['port'] != TRUE || $_POST['port'] < 0 || $_POST['port'] > 65535) {
	echo '<span style="color: #FF0000">Error: The port you specified, '.$_POST['port'].', is not a valid port number, so the default of 80, HTTP, will be used.</span><br/>';
	$port = 80;
	}

if($_POST['custom'] == TRUE) {
$cus = explode(" ", $_POST['custom']);
$increment = 0;

	echo '<table border="1">';
	echo '<b><span style="color: #00FF00">Port Checked</span></b>: <b><span style="color: #0000FF">'.$port.'</span></b></td>';
	while($increment != count($cus)) {
	echo '<tr><td>Custom '.$increment.' - '.$cus[$increment].'</td>';
	if (! $sock = @fsockopen($cus[$increment], $port, $num, $error, 1))
		echo '<td><img src="offline.gif" /></td>';
	else{
		echo '<td><img src="online.gif" /></td>';
	fclose($sock);
	}
	$increment++;
	echo '</td></tr>';
	}
	echo '</table>';
}

if($_POST['custom'] != TRUE) {
echo '<table border="1">';

echo '<b><span style="color: #00FF00">Port Checked</span></b>: <b><span style="color: #0000FF">'.$port.'</span></b></td>';

echo '<tr><td>Node 1 - IsMyWebsite.com</td>';
$ip = "IsMyWebsite.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 2 - IsMyHost.com</td>';
echo '<td>DIS.</td>';
echo '</td>';

echo '<tr><td>Node 3 - IsMyWs.com</td>';
echo '<td>DIS.</td>';
echo '</td>';

echo '<tr><td>Node 4 - IsNumberOne.org</td>';
echo '<td>DIS.</td>';
echo '</td>';

echo '<tr><td>Node 5 - IsMyWe.com</td>';
$ip = "IsMyWe.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 6 - IsMyWb.com</td>';
$ip = "IsMyWb.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 7 - IsMyHost.net</td>';
$ip = "IsMyHost.net";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 8 - IsMyWebs.com</td>';
$ip = "IsMyWebs.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 9 - IsMyWall.com</td>';
$ip = "IsMyWall.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 10 - IsMyHs.com</td>';
$ip = "IsMyHs.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 11 - IsMyHt.com</td>';
$ip = "IsMyHt.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 12 - IsMySe.com</td>';
$ip = "IsMySe.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 13 - IsMySi.com</td>';
echo '<td>DIS.</td>';
echo '</td>';

echo '<tr><td>Node 14 - IsMySt.com</td>';
$ip = "IsMySt.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 15 - IsMyWi.com</td>';
$ip = "IsMyWi.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td>';

echo '<tr><td>Node 16 - IsMyWt.com</td>';
$ip = "IsMyWt.com";
if (! $sock = @fsockopen($ip, $port, $num, $error, 5))
echo '<td><img src="offline.gif" /></td>';
else{
echo '<td><img src="online.gif" /></td>';
fclose($sock);
}
echo '</td></table>';
}

echo 'Created by <a href="http://www.deltik.org/user.php?id.1">ZAPPERPOST</a>, Webmaster of <a href="http://www.deltik.org">Deltik</a> <br/>
<br/>
<form action=" " method="post">
  <input type="hidden" name="port" value="'.$_POST['port'].'" />
  <input type="hidden" name="custom" value="'.$_POST['custom'].'" />
  <input type="submit" value="Reload/Refresh" />
</form>
<form action=" " method="post">
  <input type="submit" value="    Do It Again!    " />
</form>';

?>
