<head>
<title>The Technologer Tunnel | <?php echo $_POST["page"];?></title>
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
<input type="text" name="page" value="<?php echo $_POST["page"];?>"><br>
Width of Frame:(You may also use Percentages)<br>
<input type="text" name="width" value="<?php echo $_POST["width"];?>"><br>
Height of Frame:(You may also use Percentages)<br>
<input type="text" name="height" value="<?php echo $_POST["height"];?>"><br>
<input type="submit" value="Go">
</form>
<form action="noform.php" method="post">
<input type="hidden" name="page" value="<?php echo $_POST["page"];?>">
<input type="hidden" name="width" value="<?php echo $_POST["width"];?>">
<input type="hidden" name="height" value="<<?php echo $_POST["height"];?>">
<input type="submit" value="Hide the Form">
</form>
<iframe src="<?php echo $_POST["page"]; ?>" height="<?php echo $_POST["height"]; ?>"width=<?php echo $_POST["width"]; ?>></IFRAME><br>
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