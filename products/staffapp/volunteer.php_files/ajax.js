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
}
