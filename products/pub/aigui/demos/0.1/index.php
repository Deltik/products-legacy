<?php

// Load Core File
include_once ("core.php");

// If data sent or requesting a robot...
if ($_REQUEST['send'] || $_REQUEST['robot'])
  {
  $robot = $_REQUEST['robot'];
  if ($robot == "lauren")
    $reply_proc = processLauren($_REQUEST['session'], $_REQUEST['send']);
  elseif ($robot == "elbot")
    $reply_proc = processElbot($_REQUEST['session'], $_REQUEST['send']);
  elseif ($robot == "kyle")
    $reply_proc = processKyle($_REQUEST['session'], $_REQUEST['send']);
  elseif ($robot == "splotchy")
    $reply_proc = processSplotchy($_REQUEST['session'], $_REQUEST['send']);
  elseif ($robot == "aier")
    $reply_proc = processAIer($_REQUEST['session'], $_REQUEST['send']);
  else
    $reply_proc = processALICE($_REQUEST['session'], $_REQUEST['send']);
  $reply = implode("\n", $reply_proc);
  
  // Tell me what happened
  header("Content-type: text/plain");
  die($reply);
  }

// If requesting the current support status...
if (strtolower($_REQUEST['action']) == "supportstatus")
  {
  die(generateSupportStatus());
  }

// If requesting AI descriptions...
if (strtolower($_REQUEST['action']) == "descriptions")
  {
  die(generateDescriptionTable());
  }

?>    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
 <!-- System Style -->
 <link rel="stylesheet" href="style.css" type="text/css" media="all" />
 <!-- System Script -->
 <script type="text/javascript" src="library.js"></script>
 <title>Artificial Intelligence Chat</title>
</head>
<body bgcolor="#CCFFFF">
<!-- Main Content Holder -->
<div class="main_container">
 <!-- Floating Header -->
 <div class="float_top" id="title">
  <h1>A. L. I. C. E.</h1>
 </div>
 <!-- Conversation Container -->
 <div id="convo">
  <!--<div class="mi"><div class="mitext"><code>12:34:56 PM</code><br />Hi</div></div><br />
  <div class="yu"><div class="yutext"><code>12:34:56 PM</code><br />Hi</div></div><br />
  <div class="mi"><div class="mitext"><code>12:34:56 PM</code><br />Hi</div></div><br />
  <div class="yu"><div class="yutext"><code>12:34:56 PM</code><br />Hi</div></div><br />-->
 </div>
</div>
<!-- Floating Textbox Holder -->
<div class="float_bottom">
 <!-- AJAX Status -->
 <div id="status">
  
 </div>
 <!-- Horizontal Rule -->
 <hr />
 <!-- Input Holder -->
 <table class="inputbox">
  <tr>
   <td width="50%">
    <!-- Textbox -->
    <textarea class="inputbox" id="textbox" onkeydown="if (event.keyCode == 13) send(this.value);" onkeyup="if (event.keyCode == 13) this.value = '';"></textarea>
   </td>
   <td width="50%">
   <!-- Control Panel -->
   <fieldset style="height: 82px; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px;"><legend>Control Panel</legend>
    <label for="session">Session ID:</label> <input type="text" id="session" />
    <select name="robot" id="robot" onchange="changeRoom(this.value);">
     <option value="alice">A.L.I.C.E.</option>
     <option value="lauren">Lauren</option>
     <option value="elbot">Elbot</option>
     <option value="kyle">Kyle</option>
     <option value="splotchy">Splotchy</option>
     <option value="aier">AI-er</option>
    </select>
    <input type="button" onclick="toggleHelpBox();" value="?" style="float: right;" /><br />
    <label for="miname">My Name:</label> <input type="text" id="miname" /><input type="button" id="getminame" value="Get" onclick="getMiName(false);" /><input type="button" id="setminame" value="Set" onclick="setMiName();" /><br />
    <label for="topic">Current Topic:</label> <input type="text" id="topic" /><input type="button" id="gettopic" value="Get" onclick="getTopic(false);" /><input type="button" id="settopic" value="Set" onclick="setTopic();" /><br />
   </fieldset>
   </td>
  </tr>
 </table>
</div>
<!-- Help Box -->
<div id="helpbox">
 <div class="hbnest">
  <center>
   <h1>Chatbot Unified Graphical User Interface</h1>
  </center>
  <!-- Support Status -->
  <h2>Support Status</h2>
  <!-- Dynamically Loaded Table Nest -->
  <span id="sstablenest"><img src="images/ajaxload.gif" alt="Loading..." /></span>
  <div id="sslegend">
   <h3>Legend:</h3>
   <table>
    <tr>
     <td><img src="images/yes.png" alt="Yes" /></td>
     <td>Working well</td>
    </tr>
    <tr>
     <td><img src="images/warning.png" alt="Yes, with remarks" /></td>
     <td>Working with some problems</td>
    </tr>
    <tr>
     <td><img src="images/question.png" alt="Unknown" /></td>
     <td>Not yet tested</td>
    </tr>
    <tr>
     <td><img src="images/no.png" alt="No" /></td>
     <td>Not working / On progress</td>
    </tr>
    <tr>
     <td><img src="images/cant.png" alt="Can't" /></td>
     <td>Not supported / Won't work / Too difficult to make work</td>
    </tr>
   </table>
  </div>
  <br />
  <!-- Descriptions -->
  <h2>Descriptions</h2>
  <!-- Dynamically Loaded Table Nest -->
  <span id="detablenest"><img src="images/ajaxload.gif" alt="Loading..." /></span>
 </div>
</div>
<!-- JavaScript & jQuery -->
<script type="text/javascript">
/***************\
| CONFIGURATION |
\***************/
var entireConvo = new Array();
session = document.getElementById("session").value;
robot = "alice";
robotName = document.getElementById("robot").options[document.getElementById("robot").selectedIndex].text;
statusMessage = null;

/***********\
| FUNCTIONS |
\***********/

// Send Message
//  Usage: send(DATA);
function send(text)
  {
  // Update Session ID
  if (session != $("#session").val)
    {
    session = document.getElementById("session").value;
    }
  
  $.ajax({
    url: '?session='+session+'&robot='+robot+'&send='+text,
    success: function(data) {
      $('#convo').append(process(data));
      scrollTo(0, 99999999999);
    }
  });
  }

// Process Data
//  Usage: process(DATA);
function process(results)
  {
  // Split the results into the level that JavaScript wants to read
  var resultsExploded = Array();
  resultsExploded = results.split("\n");
  
  // Read Headers
  session = resultsExploded[0];
  document.getElementById("session").value = session;
  sentTime = resultsExploded[1];
  replyTime = resultsExploded[2];
  
  // Try to connect the entire conversation
  // First, find a match in the conversations
  var matched = 0;
  var x = 0; var y = 0;
  for (x in entireConvo)
    {
    for (y in resultsExploded)
      {
      if (entireConvo[x] == resultsExploded[y])
        {
        matched = y;
        var matchedx = x;
        break;
        }
      }
    }
  if (matchedx > 0)
    x = matchedx;
   /*alert(x+" | "+y+" | "+matched+"\n\n"+entireConvo+"\n\n"+resultsExploded);*/ /*alert(entireConvo);*/
  // If there was a match...
  if (matched > 0)
    {
    matched ++;
    var i = 0;
    y = resultsExploded.length-1;
    for (i = matched; i < y; i ++)
      {
      entireConvo[x+i-matched+1] = resultsExploded[i];
      }
    }
  else
    {
    matched = 5;
    y = resultsExploded.length-1;
    var j = 0;
    for (i = matched; i < y; i ++)
      {
      entireConvo[j] = resultsExploded[i];
      j ++;
      }
    }
  
  // Determine "Control Panel" Variables
  // "My Name"
  getMiName(true);
  getTopic(true);
  
  // Give the stuff that looks nice...
  results = "";
  var i = 0;
  for (i = matched; i < y; i ++)
    {
    var resultExploded = resultsExploded[i];
    resultExploded = resultExploded.replace("mi> ", '<div class="mi"><div class="mitext"><code>'+resultsExploded[1]+'</code><br />');
    resultExploded = resultExploded.replace("yu> ", '<div class="yu"><div class="yutext"><code>'+resultsExploded[2]+'</code><br />');
    results = results + resultExploded + '</div></div><br />';
    }
  
  return results;
  }

// Get My Name
//  Usage: getMiName([RETROSPECTIVE_BOOL]);
function getMiName(retro)
  {
  if (retro == true)
    {
    for (x in entireConvo)
      {
      messageProc = entireConvo[x];
      messageProc = messageProc.replace("yu> Your name is", "");
      messageProc = messageProc.replace("yu> I thought you said you were called", "");
      messageProc = messageProc.replace("yu> Well, you just said that you were called", "");
      if (messageProc != entireConvo[x])
        {
        miName = messageProc;
        miName = miName.replace(", seeker", "");
        miName = miName.replace("?", "");
        miName = miName.replace(".", "");
        $("#miname").val($.trim(miName));
        }
      if (messageProc == "yu> You haven't told me your name." || messageProc == "yu> I don't know your name." || messageProc.toLowerCase().indexOf("what is your name") > -1)
        $("#miname").val("unknown person");
      }
    }
  else
    {
    send("What is my name?");
    }
  }

// Get Current Topic
//  Usage: getTopic([RETROSPECTIVE_BOOL]);
function getTopic(retro)
  {
  if (retro == true)
    {
    for (x in entireConvo)
      {
      messageProc = entireConvo[x];
      messageProc = messageProc.replace("yu> I believe we were talking about ", "");
      messageProc = messageProc.replace("yu> The topic is ", "");
      if (messageProc != entireConvo[x])
        {
        currentTopic = messageProc.replace(".", "");
        if (currentTopic == "")
          currentTopic = "nothing";
        $("#topic").val($.trim(currentTopic));
        }
      }
    }
  else
    {
    send("What are we chatting about?");
    }
  }

// Set My Name
//  Usage: setMiName([TEXT]);
function setMiName(name)
  {
  if (!name)
    name = document.getElementById("miname").value;
  send("My name is "+name+".");
  }

// Set Current Topic
//  Usage: setTopic([TEXT]);
function setTopic(topic)
  {
  if (!topic)
    topic = document.getElementById("topic").value;
  send("We are talking about "+topic+".");
  }

// Change Chatroom
//  Usage: changeRoom([VALUE]);
function changeRoom(value)
  {
  if (!value)
    robot = document.getElementById("robot").value;
  else
    robot = value;
  
  // Reset EVERYTHING!!!
  document.getElementById("convo").innerHTML = "";
  document.getElementById("session").value = "";
  document.getElementById("miname").value = "";
  document.getElementById("topic").value = "";
  entireConvo = new Array();
  session = "";
  robotName = document.getElementById("robot").options[document.getElementById("robot").selectedIndex].text;
  document.getElementById("title").innerHTML = "<h1>" + robotName + "</h1>";
  }

// Toggle Help Box
//  Usage: toggleHelpBox();
function toggleHelpBox()
  {
  $("#helpbox").toggle();
  statusMessage = '<img src="images/ajaxload.gif" alt="Loading..." />';
  $.ajax({
    url: '?action=supportstatus',
    success: function(data) {
      $('#sstablenest').html(data);
      scrollTo(0, 0);
    }
  });
  $.ajax({
    url: '?action=descriptions',
    success: function(data) {
      $('#detablenest').html(data);
      scrollTo(0, 0);
    }
  });
  statusMessage = null;
  }

/***********\
| EXECUTION |
\***********/

// On Send
$("#convo").ajaxSend(function(e, r)
  {
  if (statusMessage)
    $("#status").html(statusMessage);
  else
    $("#status").html(robotName + " is typing...");
  });

// On Receive
$("#convo").ajaxStop(function(e, r)
  {
  $("#status").html("");
  });
</script>
</body>
</html>
