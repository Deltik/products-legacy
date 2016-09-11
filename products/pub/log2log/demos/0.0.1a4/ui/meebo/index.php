<?php



?><!DOCTYPE html>
<html lang="en">
<head>
<title>Download Meebo Chat Logs</title>
<meta charset=utf-8 />
<style type="text/css">
body {
	font-family: Tahoma,Arial,sans-serif;
}
@font-face {
	font-family: optimus_princeps;
	src: url('OptimusPrinceps.ttf');
}
.debackground {
	background-image: url('debian-moreblue-seamless.jpg');
	background-color: #679ebb;
}
.burntbackground {
	background-image: url('log2log-background-gradient-bottom.png');
	background-repeat: repeat-x;
	background-position: bottom;
	background-attachment: fixed;
	background-color: #000000;
	color: white;
}
.codebackground {
	background-image: url('voter-source-image.png');
	background-color: #2e3436;
	color: lightgreen;
}
.logbackground {
	background-image: url('log2log-meeboconnect-source-header.png');
	color: red;
}
.problembackground {
	background-image: url('bsod.png');
	background-color: #000080;
	color: red;
}
</style>
<script type="text/javascript">
var disable = false;
</script>
</head>
<body id="body">
<form action="../../convert.php" method="post" enctype="multipart/form-data">
 <!-- Of course, convert from MeeboConnect -->
 <input type="hidden" name="convertfrom" value="meeboconnect">
 <!-- ... and we are converting -->
 <input type="hidden" name="converting" value="true" />
 <!-- Pretty Meebo-like Interface -->
 <div style="background: #FFF4F8; border: 10px solid #EE8800; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; width: 1000px; margin-left: auto; margin-right: auto;">
  <!-- Title Caption -->
  <h1 style="text-align: center; font-size: 48px; color: #ffffff; font-family: 'Arial Rounded MT Bold',Tahoma,sans-serif; text-shadow: 0 0 24px #FF8800, 0 0 8px #FF8800, 0 0 8px #FF8800, 0 0 4px #FF8800, 0 0 4px #FF8800, 0 0 4px #FF8800, 0 0 4px #FF8800;">Download Meebo Chat Logs</h1>
  <!-- Three-Step Sequence -->
  <table width="100%">
   <th style="color: #C57A9B;">Step 1</th>
   <th style="color: #9BC57A;">Step 2</th>
   <th style="color: #7A9BC5;">Step 3</th>
   <tr align="center">
    <td>
     <!-- Fine Print -->
     <div style="background-color: #FFF7FA; width: 280px; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; border: 8px solid #C57A9B; padding: 5px; text-align: right; color: #8B0000; font-size: 10px; height: 143px; line-height: 105%;">
      <p><strong>Privacy Policy:</strong> The official Log2Log MeeboConnect will not store your password longer than necessary to retrieve your chat logs. Additionally, the official Log2Log MeeboConnect will not store fetched chat logs longer than necessary for you to download the converted logs. It will forget your Meebo data as soon as your browser completes the request to this server.</p>
      <p><strong>Disclaimer:</strong> The official Log2Log MeeboConnect is not designed to modify any data on any Meebo accounts. Deltik and Log2Log are not responsible for any data changed on your Meebo account.</p>
     </div>
    </td>
    <td>
     <!-- Configure Downloader -->
     <div style="background-color: #FAFFF7; width: 280px; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; border: 8px solid #9BC57A; padding: 5px; text-align: right; color: #008800; height: 143px;">
      <h3 style="padding: 7px 0 0 54px; margin: 0; font-size: 20px; padding-left: 5px; font-family: 'Arial Rounded MT Bold',Tahoma,sans-serif; font-weight: normal;" align="left">configure downloader</h3>
      <table style="font-family: Tahoma,Arial,sans-serif; font-size: 12px; text-align: right; padding: 12px 12px 0px 0px; margin-left: auto;">
       <tr>
        <td><label for="timezone" style="color: #68A344;">timezone</label></td>
        <td><input type="text" name="timezone" id="timezone" autocomplete="off" style="background: #F0F5E9; border: 1px solid #CFE5B4; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif; color: #CFE5B4;" value="<?=date_default_timezone_get()?>" onfocus="if(this.value=='<?=date_default_timezone_get()?>'){this.style.color='black';this.value='';}" onblur="if(!this.value){this.value='<?=date_default_timezone_get()?>';this.style.color='#CFE5B4';}" /></td>
       </tr>
       <tr>
        <td><label for="threshold" style="color: #68A344;">capture threshold</label></td>
        <td><input type="text" name="threshold" id="threshold" autocomplete="off" style="background: #F0F5E9; border: 1px solid #CFE5B4; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif; color: #CFE5B4;" value="5 (more = less fail, slower)" onfocus="if(this.value=='5 (more = less fail, slower)'){this.style.color='black';this.value='';}" onblur="if(!this.value){this.value='5 (more = less fail, slower)';this.style.color='#CFE5B4';}" /></td>
       </tr>
       <tr>
        <td><label for="convertto" style="color: #68A344;">convert to</label></td>
        <td>
         <select name="convertto" id="convertto" style="background: #F0F5E9; border: 1px solid #CFE5B4; padding-left: 2px; margin: 1px 0; height: 17px; width: 134px; font: 11px Tahoma,Arial,sans-serif;">
          <option value="meebo">Meebo (Raw Export)</option>
          <option value="pidgin">Pidgin HTML</option>
          <option value="json">JSON (Standardized Export)</option>
         </select>
        </td>
       </tr>
      </table>
      <!-- Pop Checklist -->
      <div style="text-align: left; line-height: 50%;">
       <span style="font-size: 10px; font-family: Tahoma,Arial,sans-serif; text-decoration: underline;">checklist before proceeding</span><br />
       <span style="font-size: 8px; font-family: Tahoma,Arial,sans-serif;">✔ Are you logged out of Meebo?</span><br />
       <span style="font-size: 8px; font-family: Tahoma,Arial,sans-serif;">✔ Are you ready to wait a while for this to run?</span>
      </div>
     </div>
    </td>
    <!-- Authentication Interface -->
    <td>
     <div style="background-color: #F7FAFF; width: 280px; border-radius: 8px; -moz-border-radius: 8px; -webkit-border-radius: 8px; border: 8px solid #7A9BC5; padding: 5px; text-align: right; height: 143px;">
      <h3 style="color: #4468A3; padding: 7px 0 0 54px; margin: 0; font-size: 20px; padding-left: 5px; font-family: 'Arial Rounded MT Bold',Tahoma,sans-serif; font-weight: normal;" align="left">sign on to meebo</h3>
      <table style="font-family: Tahoma,Arial,sans-serif; font-size: 12px; text-align: right; padding: 12px 12px 6px 0; margin-left: auto;">
       <tr>
        <td><label for="username" style="color: #4468A3;">meebo id</label></td>
        <td><input type="text" name="username" id="username" autocomplete="off" style="background: #E9F0F5; border: 1px solid #B4CFE5; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif;" /></td>
       </tr>
       <tr>
        <td><label for="password" style="color: #4468A3;">password</label></td>
        <td><input type="password" name="password" id="password" autocomplete="off" style="background: #E9F0F5; border: 1px solid #B4CFE5; padding-left: 2px; margin: 1px 0; height: 13px; width: 130px; font: 11px Tahoma,Arial,sans-serif;" /></td>
       </tr>
       <tr>
        <td colspan="2"><a href="http://www.meebo.com/lostpassword/" target="_blank" style="color: #4468A3; font: 11px Tahoma,Arial,sans-serif; line-height: 14px;">forgot password?</a></td>
       </tr>
      </table>
      <input type="submit" value="Sign On, Fetch Chat Logs, and Convert" style="height: 28px; font: 12px sans-serif; color: #666666;" />
     </div>
    </td>
   </tr>
  </table>
 </div>
</form>
<!-- Credits where credit is due. :) -->
<br />
<table width="100%" style="text-align: center;">
 <thead>
  <th>Provided By</th>
  <th>Underlying Software</th>
  <th>Creator</th>
 </thead>
 <tbody>
  <tr>
   <td width="33.333333333%"><a href="http://www.deltik.org/" onmouseover="document.body.className='debackground';" onmouseout="document.body.className='';"><img src="deltik.png" alt="Deltik" border="none" /></a></td>
   <td width="33.333333333%"><a href="http://products.deltik.org/pub/log2log/demos/latest/" onmouseover="document.body.className='burntbackground';" onmouseout="document.body.className='';" style="font-family: optimus_princeps; font-size: 48px; font-weight: bold; text-decoration: none;"><strong><span style="font-size: 48px; cursor: pointer; cursor: hand;"><span style="color: #000000;">L</span><span style="color: #800000;">o</span><span style="color: #ff0000;">g</span><span style="color: #ff6600;">2</span><span style="color: #ff9900;">L</span><span style="color: #ffcc00;">o</span><span style="color: #ffff00;">g</span></span></strong></a></td>
   <td width="33.333333333%"><a href="mailto:webmaster@deltik.org" onmouseover="document.body.className='codebackground';" onmouseout="document.body.className='';"><img src="deltik_webmaster-v2.png" alt="Deltik Webmaster (Nick Liu)" border="none" /></a></td>
  </tr>
 </tbody>
</table>

<!-- Floating Containers -->
<!-- Help Us Link -->
<span style="position: fixed; bottom: 0px; left: 0px; padding: 8px; background: #00b4ff; color: white; border-right: 4px #00b4ff outset; border-top: 4px #00b4ff outset; border-radius: 0px 15px 0px 0px; -moz-border-radius: 0px 15px 0px 0px; -webkit-border-radius: 0px 15px 0px 0px;" onmouseover="document.body.className='logbackground';this.style.cursor='pointer';" onmouseout="document.body.className='';this.style.cursor='default';" onclick="if(!disable)window.open(document.getElementById('helpus').href);"><a href="http://www.deltik.org/contact.php?subject=[Log2Log]%20I%20Would%20Like%20To%20Help&body=%28Ask%20for%20information%20about%20helping%20to%20develop%20Log2Log%20or%20MeeboConnect.%29" target="_blank" style="color: white;" id="helpus" onmouseover="disable=true;" onmouseout="disable=false;">Help Us</a></span>
<!-- Report Problems Link -->
<span style="position: fixed; bottom: 0px; right: 0px; padding: 8px; background: red; color: white; border-left: 4px red outset; border-top: 4px red outset; border-radius: 15px 0px 0px 0px; -moz-border-radius: 15px 0px 0px 0px; -webkit-border-radius: 15px 0px 0px 0px;" onmouseover="document.body.className='problembackground';this.style.cursor='pointer';" onmouseout="document.body.className='';this.style.cursor='default';" onclick="if(!disable)window.open(document.getElementById('reportproblem').href);"><a href="http://www.deltik.org/contact.php?subject=[MeeboConnect]%20I%20Found%20a%20Problem&body=%28Provide%20details%20of%20your%20problem%20or%20bug%20report%20here.%20Be%20descriptive;%20specify%20items%20like%20what%20types%20of%20accounts%20are%20missing,%20what%20interruptions%20you%20are%20getting,%20et%20cetera.%29" target="_blank" style="color: white;" id="reportproblem" onmouseover="disable=true;" onmouseout="disable=false;">Report Problem</a></span>
</body>
</html>
