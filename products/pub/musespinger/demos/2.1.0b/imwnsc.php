<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IMWNSC</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript">
function LoadPage(page,usediv) {
         // Set up request varible
         try {xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP");}  catch (e) { alert("Error: Could not load page.");}
         document.getElementById("main").style.cursor = "progress";
         //send data
         xmlhttp.onreadystatechange = function(){
                 //Check page is completed and there were no problems.
                 if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
                        //Write data returned to page, if usediv exists
                        if (usediv){
                        document.getElementById(usediv).innerHTML = xmlhttp.responseText; document.getElementById("status").innerHTML = "Idle";}
                        document.getElementById("main").style.cursor = "default";
                 }
         }
         xmlhttp.open("GET", page);
         xmlhttp.send(null);
         //Stop any link loading normaly
         return xmlhttp.readyState;
}
var selected=0;
var recall=null;

function loadMuSeSPinger() {
  LoadPage("http://products.deltik.org/musespinger/index.php", "main");
  }
</script>
</head>
<body>
<span id="main">
<center>
 <div id="title">IsMyWebsite Node Status Checker<span style="font-size:10px">v1.0.0</span></div>
 <div id="desc">Below are the statii of the IsMyWebsite nodes. If you would like to check the status of another IP address or check another port, click <a href="#home" onclick="loadMuSeSPinger();">here</a>.</div>
<?php
// Here, arrays are defined!

$domains = "ismyw.com ismywe.com ismywi.com ismywt.com ismywall.com ismywb.com ismyws.com";
$hosts   = "SmokeyHosts Felweb OSHS Aquarius Addora Nixism HighLayer";
$ips     = "67.227.134.77 67.212.165.114 85.234.157.140 74.86.154.10 66.116.153.66 66.7.196.78 70.38.66.227";
$header  = "Node Domain Host IP";
$ports   = "80 21 22 110";

$domains = explode(" ", $domains);
$hosts   = explode(" ", $hosts);
$ips     = explode(" ", $ips);
$header  = explode(" ", $header);
$ports   = explode(" ", $ports);

// Start Table
echo ' <table id="table">
  <tr>
';

// Load Header
for ($i = 0; $i < count($header); $i++)
 {
 echo "  <th>".$header[$i]."</th>\n";
 }

// Finish Header
for ($i = 0; $i < count($ports); $i++)
 {
 echo "  <th>".$ports[$i]."</th>\n";
 }
echo '  </tr>';

// LODE DA INFERMASHUN!!!1!
for ($i = 0; $i < count($domains); $i++)
 {
 $n = $i+1;
 echo "  <tr>\n";
 echo "   <td>".$n."</td>\n";
 echo "   <td>".$domains[$i]."</td>\n";
 echo "   <td>".$hosts[$i]."</td>\n";
 echo "   <td>".$ips[$i]."</td>\n";
 for ($p = 0; $p < count($ports); $p++)
  {
  echo "   <td><img src=\"status.php?data=".$domains[$i].":".$ports[$p]."&time=".time()."\" /></td>\n";
  }
 echo "  </tr>\n";
 }

// End Table
echo ' </table>
';

?>
<br />
<span id="disclaimer" style="font-family: sans; font-size: 10px;">Powered by <a href="http://products.deltik.org/musespinger" style="color: #000000;">MuSeSPinger</a></span>
</span>

<!-- START: Required IsMyWebsite Ad -->
<div id='floatdiv' style='  
    position:absolute;  
    left:0px;top:0px;'><div style="text-align:center;background:white;opacity:0.4;filter:alpha(opacity=40);cursor:pointer;font-family:sans;" onclick="closeAd();">Close Advert</div>
<script type="text/javascript" src="http://links.ismywebsite.com?i=1281"></script>
</div>

<script type='text/javascript'>
var floatingMenuId="floatdiv";var floatingMenu={targetX:-128,targetY:-145,hasInner:typeof(window.innerWidth)=="number",hasElement:typeof(document.documentElement)=="object"&&typeof(document.documentElement.clientWidth)=="number",menu:document.getElementById?document.getElementById(floatingMenuId):document.all?document.all[floatingMenuId]:document.layers[floatingMenuId]};floatingMenu.move=function(){floatingMenu.menu.style.left=floatingMenu.nextX+"px";floatingMenu.menu.style.top=floatingMenu.nextY+"px"};floatingMenu.computeShifts=function(){var a=document.documentElement;floatingMenu.shiftX=floatingMenu.hasInner?pageXOffset:floatingMenu.hasElement?a.scrollLeft:document.body.scrollLeft;if(floatingMenu.targetX<0){floatingMenu.shiftX+=floatingMenu.hasElement?a.clientWidth:document.body.clientWidth}floatingMenu.shiftY=floatingMenu.hasInner?pageYOffset:floatingMenu.hasElement?a.scrollTop:document.body.scrollTop;if(floatingMenu.targetY<0){if(floatingMenu.hasElement&&floatingMenu.hasInner){floatingMenu.shiftY+=a.clientHeight>window.innerHeight?window.innerHeight:a.clientHeight}else{floatingMenu.shiftY+=floatingMenu.hasElement?a.clientHeight:document.body.clientHeight}}};floatingMenu.calculateCornerX=function(){if(floatingMenu.targetX!="center"){return floatingMenu.shiftX+floatingMenu.targetX}var a=parseInt(floatingMenu.menu.offsetWidth);var b=floatingMenu.hasElement?(floatingMenu.hasInner?pageXOffset:document.documentElement.scrollLeft)+(document.documentElement.clientWidth-a)/2:document.body.scrollLeft+(document.body.clientWidth-a)/2;return b};floatingMenu.calculateCornerY=function(){if(floatingMenu.targetY!="center"){return floatingMenu.shiftY+floatingMenu.targetY}var a=parseInt(floatingMenu.menu.offsetHeight);var b=floatingMenu.hasElement&&floatingMenu.hasInner&&document.documentElement.clientHeight>window.innerHeight?window.innerHeight:document.documentElement.clientHeight;var c=floatingMenu.hasElement?(floatingMenu.hasInner?pageYOffset:document.documentElement.scrollTop)+(b-a)/2:document.body.scrollTop+(document.body.clientHeight-a)/2;return c};floatingMenu.doFloat=function(){var d,b;floatingMenu.computeShifts();var c=floatingMenu.calculateCornerX();var d=(c-floatingMenu.nextX)*0.07;if(Math.abs(d)<0.5){d=c-floatingMenu.nextX}var a=floatingMenu.calculateCornerY();var b=(a-floatingMenu.nextY)*0.07;if(Math.abs(b)<0.5){b=a-floatingMenu.nextY}if(Math.abs(d)>0||Math.abs(b)>0){floatingMenu.nextX+=d;floatingMenu.nextY+=b;floatingMenu.move()}setTimeout("floatingMenu.doFloat()",20)};floatingMenu.addEvent=function(b,d,c){if(typeof b[d]!="function"||typeof b[d+"_num"]=="undefined"){b[d+"_num"]=0;if(typeof b[d]=="function"){b[d+0]=b[d];b[d+"_num"]++}b[d]=function(h){var g=true;h=(h)?h:window.event;for(var f=b[d+"_num"]-1;f>=0;f--){if(b[d+f](h)==false){g=false}}return g}}for(var a=0;a<b[d+"_num"];a++){if(b[d+a]==c){return}}b[d+b[d+"_num"]]=c;b[d+"_num"]++};floatingMenu.init=function(){floatingMenu.initSecondary();floatingMenu.doFloat()};floatingMenu.initSecondary=function(){floatingMenu.computeShifts();floatingMenu.nextX=floatingMenu.calculateCornerX();floatingMenu.nextY=floatingMenu.calculateCornerY();floatingMenu.move()};if(document.layers){floatingMenu.addEvent(window,"onload",floatingMenu.init)}else{floatingMenu.init();floatingMenu.addEvent(window,"onload",floatingMenu.initSecondary)}function closeAd(){document.getElementById("floatdiv").innerHTML=""};
</script>
<!-- END: Required IsMyWebsite Ad -->

</body>
</html>

