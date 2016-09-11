/* AJAX */

// Get Page
//  Usage: getPage(LOCATION, TARGET_ID[, NOLOADER_BOOLEAN, STATUS_ID, STATUS_STRING]);
function getPage(url, id, noloader, status, statustext)
 {
 // Start AJAX
 startAJAX();
 
 // Open a URL
 xmlhttp.open("GET", url, true);
 // Send data to a URL
 xmlhttp.send(null);

 // Try to get a status ID if none is defined
 if (status == null && document.getElementById("status"))
  var status = "status";
 if (statustext == null)
  var statustext = "<img src=\"images/ajax-loader.gif\" alt=\"Loading...\" />";

 // Show loading progress
 if (noloader == null || noloader == false)
  document.getElementById(id).innerHTML="<img src=\"images/ajax-loader.gif\" alt=\"Loading...\" />";
 if (status)
  document.getElementById(status).innerHTML=statustext;
 
 // When something new happens. Ooh, shiny!
 xmlhttp.onreadystatechange = function()
  {
  if (xmlhttp.readyState == 4 && id)
   document.getElementById(id).innerHTML=xmlhttp.responseText;
  if (status)
   document.getElementById(status).innerHTML="Idle";
  return xmlhttp.responseText;
  }
 }

// Start AJAX
//  Usage: startAJAX();
function startAJAX()
 {
 if (window.XMLHttpRequest)
  {
  // Start AJAX for non-Windoze Ethernet Exploder browsers
  xmlhttp=new XMLHttpRequest();
  }
 else
  {
  // A desperate attempt to get AJAX to work on Windoze Ethernet Exploder
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }

// Turn Links Into Dynamic AJAX Loaders
//  Usage: ajaxifyLinks();
function ajaxifyLinks()
 {
 var anchors = document.getElementsByTagName("a");
 for (var i=0; i < anchors.length; i++)
  {
  // What to do if a link is marked to AJAXify
  if (anchors[i].name == "ajax")
  {
   anchors[i].onclick=Function("getPage('"+anchors[i].href+"', 'body');");
   anchors[i].href="#";
   }
  // What to do if a link is not marked at all
  if (!anchors[i].name)
   {
   anchors[i].onclick=Function("getExternalPage('"+anchors[i].href+"', '"+anchors[i].innerHTML+"', 'body');");
   anchors[i].href="#";
   }
  }
 }

// EXPERIMENTAL: Get External Links Into iFrames
//  Usage: getExternalPage(LOCATION, TITLE, ELEMENT_ID);
function getExternalPage(url, title, id)
 {
 document.getElementById("status").innerHTML="<img src=\"images/ajax-loader.gif\" alt=\"Loading...\" />";
 document.getElementById(id).innerHTML='<table class="tablize" id="'+title+'" width="100%"><tr><td class="topleft"><img src="images/menu-top-left.png" alt="[" /></td><td class="caption"> <div class="captiondiv">'+title+'</div></td><td class="topright"><img src="images/menu-top-right.png" alt="]" /></td></tr><tr><td class="menuleft">&nbsp;</td><td class="contenttd"><iframe src="'+url+'" width="100%" height="'+window.innerHeight+'px" frameborder="no" onload="document.getElementById(\'status\').innerHTML=\'Idle\'"></iframe></td><td class="menuright">&nbsp;</td></tr><tr class="foot"><td class="bottomleft">&nbsp;</td><td class="menubottom">&nbsp;</td><td class="bottomright">&nbsp;</td></tr></table>';
 }

// Load Quiz
//  Usage: loadQuiz(ELEMENT);
function loadQuiz(option)
 {
 document.getElementById("body").innerHTML=option.id;
 }

// Unload Quiz
//  Usage: unloadQuiz();
function unloadQuiz()
 {
 document.getElementById("body").innerHTML="No quiz selected";
 }

// Check Authentication
//  Usage: checkAuth(USERNAME_FIELD, PASSWORD_FIELD, AUTH_STATUS_ID)
function checkAuth(user, pass, stat)
 {
 getPage("admin.php?a=ajaxauth&u="+document.getElementById(user).value+"&p="+document.getElementById(pass).value, stat, false, "status", "Checking Authentication...");
 }

// EXPERIMENTAL: Check Variable Cookie
//  Usage: checkLogin(USERNAME_FIELD, PASSWORD_FIELD)
function checkLogin(user, pass)
 {
 if (typeof username != "undefined" && typeof password != "undefined")
  {
  document.getElementById(user).value = username;
  document.getElementById(pass).value = password;
  login(user, pass, "body");
  }
 }

// Log In
//  Usage: login(USERNAME_FIELD, PASSWORD_FIELD, TARGET_ID)
function login(user, pass, id)
 {
 username = document.getElementById(user).value;
 password = document.getElementById(pass).value;
 getPage("admin.php?u="+document.getElementById(user).value+"&p="+document.getElementById(pass).value, id, false, "status");
 }
