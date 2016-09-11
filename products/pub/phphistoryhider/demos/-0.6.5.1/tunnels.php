<head>
<title>The Technologer Tunnel | No Website Entered</title>
</head>
<script type="text/javascript"><!--
google_ad_client = "pub-6002461218286378";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
google_ad_channel = "";
google_color_border = "EBEBEB";
google_color_bg = "EBEBEB";
google_color_link = "FFFFFF";
google_color_text = "#010197";
google_color_url = "#0101F1";
google_ui_features = "rc:0";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br>
<form action="tunnel.php" method="POST">
Website Address:<br>
<input type="text" name="page" value="http://"><br>
Width of Frame:(You may also use Percentages)<br>
<input type="text" name="width" value="1024"><br>
Height of Frame:(You may also use Percentages)<br>
<input type="text" name="height" value="768"><br>
<input type="submit" value="Go">
</form>
<iframe src="blank.html" height="150"width="300"></IFRAME><br>
<a href="tunnelabout.php">About</a><br>
<br>
<?php
$version = "version.txt";
$fh = fopen($version, 'r');
$Data = fread($fh, filesize($version));
fclose($fh);
echo $Data;
?>
<center>
<?php include 'license.html';?>
</center>