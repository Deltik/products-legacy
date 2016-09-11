<?php

/*******\
| SETUP |
\*******/
include_once ("config.php");

/***********\
| FUNCTIONS |
\***********/

// Process A.L.I.C.E.
//  Usage: processALICE([SESSION_ID, DATA_TO]);
function processALICE($session_id = false, $message = false)
  {
  // Log the sending time
  $sent_time = date("d F Y h:i:s A");
  
  // Set the data to be sent
  $postdata = http_build_query(
    array(
      "input" => stripslashes($message)
      )
    );
  // Hey robot... Remember me?
  $opts = array(
    "http" => array(
      "method" => "POST",
      "content" => $postdata
      )
    );
  if ($session_id)
    $opts['http']['header'] = "cookie: botcust2=$session_id";
  $context = stream_context_create($opts);
  // Alright, PHP... Make it happen
  $reply_raw = file_get_contents("http://www.pandorabots.com/pandora/talk?botid=f5d922d97e345aa1&skin=custom_input", false, $context);
  
  // Process what happened
  // Isolate the conversation
  $reply_proc = explode('<font face="Arial" size="2">
<br>', $reply_raw);
  array_shift($reply_proc);
  $reply_proc = implode('<font face="Arial" size="2">
<br>', $reply_proc);
  $reply_proc = explode('<br/>', $reply_proc);
  array_pop($reply_proc);
  $reply_proc = implode('<br/>', $reply_proc);
  
  // Read the conversation
  $reply_proc = explode('<b>', $reply_proc);
  $messages_raw = $reply_proc;
  unset($reply_proc);
  foreach ($messages_raw as $message_raw)
    {
    $message_raw = str_replace('<em> Human: ', 'mi> ', $message_raw);
    $message_raw = str_replace('<em> Human:', 'mi> ', $message_raw);
    $message_raw = str_replace(' ALICE:<em> ', 'yu> ', $message_raw);
    $message_raw = str_replace(' ALICE:<em>', 'yu> ', $message_raw);
    $message_raw = str_replace('</em></b><br>', '', $message_raw);
    $message_raw = str_replace('</em></b>', '', $message_raw);
    if (strlen($message_raw) > 0)
      $reply_proc[] = $message_raw;
    }
  
  // Get the session code the robot assigned
  $session = explode('<input type="hidden" name="botcust2" value="', $reply_raw);
  array_shift($session);
  $session = implode('<input type="hidden" name="botcust2" value="', $session);
  $session = explode('">', $session);
  $session = $session[0];
  
  // Log the reply time
  $reply_time = date("d F Y h:i:s A");
  
  // Make AIGUI headers
  array_unshift($reply_proc, $session, "$sent_time", "$reply_time", "--\n");
  
  // Return processed data
  return $reply_proc;
  }

// Process Lauren
//  Usage: processLauren([SESSION_ID, DATA_TO]);
function processLauren($session_id = false, $message = false)
  {
  // Log the sending time
  $sent_time = date("d F Y h:i:s A");
  
  // Set the data to be sent
  $postdata = http_build_query(
    array(
      "message" => stripslashes($message)
      )
    );
  // Hey robot... Remember me?
  $opts = array(
    "http" => array(
      "method" => "POST",
      "content" => $postdata
      )
    );
  if ($session_id)
    $opts['http']['header'] = "cookie: botcust2=$session_id";
  $context = stream_context_create($opts);
  // Alright, PHP... Make it happen
  $reply_raw = file_get_contents("http://lauren.vhost.pandorabots.com/pandora/talk?botid=f6d4afd83e34564d&skin=input", false, $context);
  
  // Process what happened
  // Isolate the conversation
  $reply_proc = explode('<font face="Arial">

', $reply_raw);
  array_shift($reply_proc);
  $reply_proc = implode('<font face="Arial">

', $reply_proc);
  $reply_proc = explode('<form method="POST" name="f">', $reply_proc);
  array_pop($reply_proc);
  $reply_proc = implode('<form method="POST" name="f">', $reply_proc);
  
  // Read the conversation
  $reply_proc = explode(' <i><b> ', $reply_proc);
  $messages_raw = $reply_proc;
  unset($reply_proc);
  foreach ($messages_raw as $message_raw)
    {
    $message_raw = str_replace('You:</b></i>  ', 'mi> ', $message_raw);
    $message_raw = str_replace('You:</b></i>', 'mi> ', $message_raw);
    $message_raw = str_replace('LaurenBot:</b></i>  ', 'yu> ', $message_raw);
    $message_raw = str_replace('LaurenBot:</b></i>', 'yu> ', $message_raw);
    $message_raw = str_replace('<br> <br>

', '', $message_raw);
    $message_raw = str_replace(' <br>

', '', $message_raw);
    $message_raw = str_replace('<br>', '', $message_raw);
    if (strlen(trim($message_raw)) > 0)
      $reply_proc[] = trim($message_raw);
    }
  
  // Get the session code the robot assigned
  $session = explode('<input type="hidden" name="botcust2" value="', $reply_raw);
  array_shift($session);
  $session = implode('<input type="hidden" name="botcust2" value="', $session);
  $session = explode('">', $session);
  $session = $session[0];
  
  // Log the reply time
  $reply_time = date("d F Y h:i:s A");
  
  // Make AIGUI headers
  array_unshift($reply_proc, $session, "$sent_time", "$reply_time", "--\n");
  
  // Add compatibility whitespace at the end of $reply_proc
  $reply_proc[] = "";
  
  // Return processed data
  return $reply_proc;
  }

// EXPERIMENTAL: Process Elbot
//  Usage: processElbot([SESSION_ID, DATA_TO]);
function processElbot($session_id = false, $message = false)
  {
  // Log the sending time
  $sent_time = date("d F Y h:i:s A");
  
  // Processed received session data
  $session_id = explode(" | ", $session_id);
  $IDENT = $session_id[0];
  $USERLOGID = $session_id[1];
  
  // Set the data to be sent
  $postdata = http_build_query(
    array(
      "ENTRY" => stripslashes($message),
      "IDENT" => $IDENT,
      "USERLOGID" => $USERLOGID
      )
    );
  // Hey robot... Remember me?
  $opts = array(
    "http" => array(
      "method" => "POST",
      "content" => $postdata
      )
    );
  $context = stream_context_create($opts);
  // Alright, PHP... Make it happen
  $reply_raw = file_get_contents("http://elbot_e.csoica.artificial-solutions.com/cgi-bin/elbot.cgi", false, $context);
  
  // Process what happened
  // Isolate the conversation
  $reply_proc = explode(' <!-- Begin Response !--> ', $reply_raw);
  array_shift($reply_proc);
  $reply_proc = implode(' <!-- Begin Response !--> ', $reply_proc);
  $reply_proc = explode(' <!-- End Response !-->', $reply_proc);
  array_pop($reply_proc);
  $reply_proc = implode(' <!-- End Response !-->', $reply_proc);
  
  // Convert the conversation to AIGUI
  $message_raw = $reply_proc;
  unset($reply_proc);
  $reply_proc[] = "mi> ".stripslashes($message);
  $reply_proc[] = "yu> ".$message_raw;
  
  // Get the session code the robot assigned
  // This robot has sessions a little different from others
  $session_proc = explode('<input name="IDENT" value="', $reply_raw);
  array_shift($session_proc);
  $session_proc = implode('<input name="IDENT" value="', $session_proc);
  $session_proc = explode('" type="Hidden">', $session_proc);
  $session = $session_proc[0];
  $session_proc = explode('<input name="USERLOGID" value="', $reply_raw);
  array_shift($session_proc);
  $session_proc = implode('<input name="USERLODID" value="', $session_proc);
  $session_proc = explode('" type="Hidden">', $session_proc);
  $session .= " | ".$session_proc[0];
  
  // Log the reply time
  $reply_time = date("d F Y h:i:s A");
  
  // Make AIGUI headers
  array_unshift($reply_proc, $session, "$sent_time", "$reply_time", "--\n");
  
  // Add compatibility whitespace at the end of $reply_proc
  $reply_proc[] = "";
  
  // Return processed data
  return $reply_proc;
  }

// Process Kyle
//  Usage: processKyle([SESSION_ID, DATA_TO]);
function processKyle($session_id = false, $message = false)
  {
  // Log the sending time
  $sent_time = date("d F Y h:i:s A");
  
  // Set the data to be sent
  $postdata = http_build_query(
    array(
      "input" => stripslashes($message)
      )
    );
  // Hey robot... Remember me?
  $opts = array(
    "http" => array(
      "method" => "POST",
      "content" => $postdata
      )
    );
  if ($session_id)
    $opts['http']['header'] = "cookie: botcust2=$session_id";
  $context = stream_context_create($opts);
  // Alright, PHP... Make it happen
  $reply_raw = file_get_contents("http://demo.vhost.pandorabots.com/pandora/talk?botid=d550917d3e360572&skin=kylereduced", false, $context);
  
  // Process what happened
  // Isolate the conversation
  $reply_proc = explode('<td><FONT FACE="Arial"><font color="WHITE"><span style="font-size:14">', $reply_raw);
  array_shift($reply_proc);
  $reply_proc = implode('<td><FONT FACE="Arial"><font color="WHITE"><span style="font-size:14">', $reply_proc);
  $reply_proc = explode('</font>', $reply_proc);
  $reply_proc = $reply_proc[0];
  
  // Convert the conversation to AIGUI
  $message_raw = $reply_proc;
  unset($reply_proc);
  $reply_proc[] = "mi> ".stripslashes($message);
  $reply_proc[] = "yu> ".$message_raw;
  
  // Get the session code the robot assigned
  $session = explode('<input type="hidden" name="botcust2" value="', $reply_raw);
  array_shift($session);
  $session = implode('<input type="hidden" name="botcust2" value="', $session);
  $session = explode('">', $session);
  $session = $session[0];
  
  // Log the reply time
  $reply_time = date("d F Y h:i:s A");
  
  // Make AIGUI headers
  array_unshift($reply_proc, $session, "$sent_time", "$reply_time", "--\n");
  
  // Add compatibility whitespace at the end of $reply_proc
  $reply_proc[] = "";
  
  // Return processed data
  return $reply_proc;
  }

// Process Splotchy
//  Usage: processSplotchy([SESSION_ID, DATA_TO]);
function processSplotchy($session_id = false, $message = false)
  {
  // Log the sending time
  $sent_time = date("d F Y h:i:s A");
  
  // Set the data to be sent
  $postdata = http_build_query(
    array(
      "input" => stripslashes($message),
      "session_id" => $session_id
      )
    );
  // Hey robot... Remember me?
  $opts = array(
    "http" => array(
      "method" => "POST",
      "enctype" => "multipart/form-data",
      "content" => $postdata
      )
    );
  $context = stream_context_create($opts);
  // Alright, PHP... Make it happen
  $reply_raw = file_get_contents("http://www.algebra.com/cgi-bin/chat.mpl", false, $context);
  
  // Process what happened
  // Isolate the conversation
  $reply_proc = explode('<P><PRE>

', $reply_raw);
  array_shift($reply_proc);
  $reply_proc = implode('<P><PRE>

', $reply_proc);
  $reply_proc = explode('</PRE>', $reply_proc);
  $reply_proc = $reply_proc[0];
  
  // Read the conversation
  $reply_proc = explode('
', $reply_proc);
  $messages_raw = $reply_proc;
  unset($reply_proc);
  foreach ($messages_raw as $message_raw)
    {
    $message_raw = str_replace('you ==> ', 'mi> ', $message_raw);
    $message_raw = str_replace('<B>splotchy ==> ', 'yu> ', $message_raw);
    $message_raw = str_replace('</B>', '', $message_raw);
    if (strlen(trim($message_raw)) > 0)
      $reply_proc[] = trim($message_raw);
    }
  
  // Get the session code the robot assigned
  $session = explode('<input type="hidden" name="session_id" value="', $reply_raw);
  array_shift($session);
  $session = implode('<input type="hidden" name="session_id" value="', $session);
  $session = explode('"  />', $session);
  $session = $session[0];
  
  // Log the reply time
  $reply_time = date("d F Y h:i:s A");
  
  // Make AIGUI headers
  array_unshift($reply_proc, $session, "$sent_time", "$reply_time", "--\n");
  
  // Add compatibility whitespace at the end of $reply_proc
  $reply_proc[] = "";
  
  // Return processed data
  return $reply_proc;
  }

// Process AI-er
//  Usage: processAIer([SESSION_ID, DATA_TO]);
function processAIer($session_id = false, $message = false)
  {
  // Log the sending time
  $sent_time = date("d F Y h:i:s A");
  
  // Set the data to be sent
  $postdata = http_build_query(
    array(
      "input" => stripslashes($message)
      )
    );
  // Hey robot... Remember me?
  $opts = array(
    "http" => array(
      "method" => "POST",
      "content" => $postdata
      )
    );
  /*if ($session_id)
    $opts['http']['header'] = "cookie: botcust2=$session_id";*/
  $context = stream_context_create($opts);
  // Alright, PHP... Make it happen
  $reply_raw = file_get_contents("http://infosbit.ismywebsite.com/ai/er/index.php", false, $context);
  
  // Process what happened
  // Isolate the conversation
  $reply_proc = explode('<!-- START REPLY -->', $reply_raw);
  array_shift($reply_proc);
  $reply_proc = implode('<!-- START REPLY -->', $reply_proc);
  $reply_proc = explode('<!-- END REPLY -->', $reply_proc);
  $reply_proc = $reply_proc[0];
  
  // Convert the conversation to AIGUI
  $message_raw = $reply_proc;
  unset($reply_proc);
  $reply_proc[] = "mi> ".stripslashes($message);
  $reply_proc[] = "yu> ".$message_raw;
  
  // Get the session code the robot assigned
  /*$session = explode('<input type="hidden" name="botcust2" value="', $reply_raw);
  array_shift($session);
  $session = implode('<input type="hidden" name="botcust2" value="', $session);
  $session = explode('">', $session);
  $session = $session[0];*/
  
  // Log the reply time
  $reply_time = date("d F Y h:i:s A");
  
  // Make AIGUI headers
  array_unshift($reply_proc, $session, "$sent_time", "$reply_time", "--\n");
  
  // Add compatibility whitespace at the end of $reply_proc
  $reply_proc[] = "";
  
  // Return processed data
  return $reply_proc;
  }

// Generate Support Status Table
//  Usage: generateSupportStatus();
//  Returns: STRING
function generateSupportStatus()
  {
  // Start the table
  $table = '<table class="sstable">
 <thead>
';
  // Add table header
  include ("config.php");
  foreach ($support_headers as $support_header)
    {
    $table .= "  <th class=\"sstable\">$support_header</th>\r\n";
    }
  // End table header, start table body
  $table .= ' </thead>
 <tbody>
';
  // Add table body
  foreach ($support_items as $key => $support_item)
    {
    $table .= "  <tr class=\"sstable\">\r\n   <th class=\"sstable\">$key</th>\r\n";
    foreach ($support_item as $support_status)
      {
      switch ($support_status)
        {
        case 0:
          $status = "<img src=\"images/yes.png\" alt=\"Yes\" />";
          break;
        case 1:
          $status = "<img src=\"images/warning.png\" alt=\"Yes, with remarks\" />";
          break;
        case 2:
          $status = "<img src=\"images/question.png\" alt=\"Unknown\" />";
          break;
        case 3:
          $status = "<img src=\"images/no.png\" alt=\"No\" />";
          break;
        case 4:
          $status = "<img src=\"images/cant.png\" alt=\"Can't\" />";
          break;
        default:
          $status = "<img src=\"images/question.png\" alt=\"Unknkown\" />";
          break;
        }
      $table .= "   <td class=\"sstable\">$status</td>\r\n";
      }
    $table .= "  </tr>\r\n";
    }
  // End the table
  $table .= '</table>
';
  
  return $table;
  }

// Generate Description Table
//  Usage: generateDescriptionTable();
//  Returns: STRING
function generateDescriptionTable()
  {
  // Start the table
  $table = '<table class="detable">
 <thead>
';
  // Add table header
  include ("config.php");
  $table .= "  <th class=\"detable\">Chatbot</th>\r\n";
  $table .= "  <th class=\"detable\">Information</th>\r\n";
  // End table header, start table body
  $table .= ' </thead>
 <tbody>
';
  // Add table body
  foreach ($descriptions as $key => $description)
    {
    $table .= "  <tr class=\"detable\">\r\n   <th class=\"detable\">$key</th>\r\n";
    $table .= "   <td class=\"detable\">$description</td>\r\n";
    $table .= "  </tr>\r\n";
    }
  // End the table
  $table .= '</table>
';
  
  return $table;
  }

?>
