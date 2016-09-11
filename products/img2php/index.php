<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Advanced Image To PHP Converter</title>
<style type="text/css">
<!--
.title {
	background: #CCFFCC;
	border: 4px solid #008800;
	color: #008800;
	font-weight: bold;
	font-size: xx-large;
	text-align: center;
}
.error {
	border: 4px solid #FF0000;
	background: #FFCCCC;
	font-size: 75%;
	font: "Courier New", Courier, monospace;
	text-align: center;
}
.form {
	border: 4px solid #0000FF;
	background: #CCCCFF;
}
.fields {
	border: 2px ridge #0000FF;
	background: #FFFF88;
}
.about {
	background: #888888;
	border: 4px solid #000000;
	color: #FFFFFF;
	text-align: center;
}
-->
</style>
<script type="text/javascript">
function exitHelp()
{
document.getElementById('notices').innerHTML='';
}
function encodingMethodHelp()
{
document.getElementById('notices').innerHTML='<div class="error"><strong>Encoding gives your PHP images the ability to work.</strong> Without the encoding, images would be corrupt, as well as your PHP script. The recommended encoding method is "<strong>uuencode</strong>" because it has a wider set of characters that gives the images a smaller inflation at 22%, unlike <strong>base64</strong>, which has about a 33% inflation. Either one is fine, but uuencode is smaller.<br /><br /><input type="button" value="Close" onclick="exitHelp()" /></div>';
}
function compressionMethodHelp()
{
document.getElementById('notices').innerHTML='<div class="error"><strong>Compression shrinks your image(s) to take up a smaller space.</strong> <em>Compression is not recommended if your server doesn\'t support compression.</em> <strong>bzcompress</strong> usually performs best. You can choose from <strong>gzcompress</strong> or <strong>gzdeflate</strong> as other methods.<br /><br /><input type="button" value="Close" onclick="exitHelp()" /></div>';
}
function closeCredits()
{
document.getElementById('about').innerHTML='<input type="button" value="About" onclick="credits()" />';
}
function credits()
{
document.getElementById('about').innerHTML='<input type="button" value="Close About" onclick="closeCredits()" /><h1>About</h1>Advanced Image to PHP Converter (<strong>credits pending creation</strong>)<br /><a href="http://www.deltik.org/"><img src="deltikLogo.png" border="no" /></a>';
}
function process()
{
document.getElementById('notices').innerHTML='<div class="error">Processing... Please Wait...</div>';
document.getElementById('form').submit();
}
</script>
</head>
<body bgcolor="#D2B48C">
<?php
if ($_POST == TRUE)
{

}
?>
<div class="title">
  <p>Advanced Image to PHP Converter</p>
</div>
<br />
<a id="notices">
<div class="error"><strong>ERROR</strong>: JavaScript is not detected on your browser. JavaScript is <strong>REQUIRED</strong> to run the Image to PHP Converter.<br />
  &bull; If you have JavaScript on your browser, please enable it.<br />
  &bull; If your browser does not support JavaScript please switch to another browser that does support JavaScript.</div>
</p>
</a> <br />
<script type="text/javascript">
document.getElementById('notices').innerHTML='';
</script>
<form action="" method="post" enctype="multipart/form-data" class="form" id="form">
  <p>
    <input type="file" name="file1" id="file1" class="fields" />
  </p>
  <table>
    <tr>
      <td><center>
          <select name="encode" id="encode" class="fields">
            <option value="uuencode" selected="selected">uuencode</option>
            <option value="base64">base64</option>
          </select>
        </center></td>
      <td><center>
          <label for="encode">Encoding Method</label>
          <a onclick="encodingMethodHelp()"><img src="question_16x16.gif" alt="[?]" width="16" height="16" /></a><br />
        </center></td>
    </tr>
    <tr>
      <td><center>
          <select name="compress" id="compress" class="fields">
            <option value="bzcompress" selected="selected">bzcompress</option>
            <option value="gzcompress">gzcompress</option>
            <option value="gzdeflate">gzdeflate</option>
            <option value="None">None</option>
          </select>
        </center></td>
      <td><center>
          <label for="compress">Compression Method</label>
          <a onclick="compressionMethodHelp()"><img src="question_16x16.gif" alt="[?]" width="16" height="16" /></a><br />
        </center></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="submit" value="Submit" onclick="process()" />
  </p>
  <?php echo $ver ?>
</form>
<br />
<div class="about" id="about">
  <input type="button" value="About" onclick="credits()" />
</div>
</body>
</html>
