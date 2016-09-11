<?php
/**
 * Log2Log Online Chat Log Converter
 *  Formats
 *   Meebo Raw Chat Log Format
 * 
 * License:
 *  This file is part of Log2Log.
 *  
 *  Log2Log is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  Log2Log is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with Log2Log.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

class Meebo
  {
  // Format Handler Information
  public $name   = "Meebo";
  public $unix   = "meebo";
  public $client = "Meebo";
  
  // Handler Process Configuration
  public  $log    = null;
  private $append = false;
  private $count  = 0;
  
  // _MEEBO_CUSTOM Configuration
  private $account    = "_unknown";
  private $protocol   = "_unknown";
  private $with       = "_unknown";
  private $with_alias = "_unknown";
  
  // Standardize Log
  //  Usage: $OBJECT_VAR->load(FILE_CONTENTS);
  public function load($log_raw)
    {
    // Add to current log, or make a new one?
    if (!$this->append)
      {
      $this->start();
      }
    
    // Reset the with_alias
    $this->with_alias = "_unknown";
    
    // Localize the chat log entry count variable.
    $count = $this->count;
    // Localize the global standardized log variable.
    $final = $this->log;
    
    // Reset temporary variables
    $times = array();
    
    $whitespace_fake = array(' ', '\t', '\n', '\r', '\0', '\x0B');
    $whitespace_real = array(" ", "\t", "\n", "\r", "\0", "\x0B");
    
    // Replace whitespace characters with REAL WHITESPACE! :D
    $log_spaced = str_replace($whitespace_fake, $whitespace_real, $log_raw);
    
    // Strip the crufty slashes inside the Meebo file
    $log_stripslashed = stripslashes($log_spaced);
    // Trim cruft off the beginning and end of the log string.
    $log_clean = trim($log_stripslashed, "\"\n")."\n";

    // Retrieve the Meebo log entries' start times.
    $log_each_raw = explode("<br/><hr size=1><div class='ImChatHeader'>", $log_clean);
    array_shift($log_each_raw);
    $log_each_proc = $log_each_raw;
    foreach ($log_each_proc as $key => $log_each_item)
      {
      $log_each_item = explode("</div><hr size=1>", $log_each_item);
      $date_cur_raw = array_shift($log_each_item);
      $log_each_proc[$key] = implode("</div><hr size=1>", $log_each_item);
      $times[] = standardizeStrToTime("l, Y F m (H:i:s)", html_entity_decode($date_cur_raw));
      }

    // For each log entry...
    foreach ($log_each_proc as $key => $log_each_item)
      {
      ## FINAL CONSTRUCTION ##
      $final['data'][$count]['account'] = $this->account;
      $final['data'][$count]['protocol'] = $this->protocol;
      $final['data'][$count]['with'] = $this->with;
      $final['data'][$count]['with_alias'] = $this->with_alias;
      $final['data'][$count]['time'] = $times[$key];
      ########################
      
      // "I'm only gonna break break break break break..." the log.
      $log_chat_entries = explode("<br/>\n", $log_each_item);
      array_pop($log_chat_entries);
      
      // Set the current log time pointer.
      $time_cur = $times[$key];
      
      // Process each chat entry.
      foreach ($log_chat_entries as $key1 => $log_chat_entry)
        {
        // Find out if the entry is a message sent or received.
        $_from = "<span class='ImReceive'>";
        $_to = "<span class='ImSend'>";
        $from = false; $to = false;
        if (substr($log_chat_entry, 0, strlen($_from)) == $_from)
          {
          $from = true;
          $log_chat_entry = substr($log_chat_entry, strlen($_from));
          }
        elseif (substr($log_chat_entry, 0, strlen($_to)) == $_to)
          {
          $to = true;
          $log_chat_entry = substr($log_chat_entry, strlen($_to));
          }
        else
          {
          
          }
        
        // Assign a time to the entry.
        preg_match('/(\\[)((?:(?:[0-1][0-9])|(?:[2][0-3])|(?:[0-9])):(?:[0-5][0-9])(?::[0-5][0-9])?(?:\\s?(?:am|AM|pm|PM))?)(\\])/is', $log_chat_entry, $matches);
        // If entry contains valid Meebo chat log timestamp...
        if (count($matches) == 4)
          {
          // Add the time to the datestamp.
          $date_cur = date("d-F-Y", $time_cur)." ".$matches[2];
          // Convert the added datestamp back to timestamp.
          $time_cur = strtotime($date_cur);
          // Set Log2Log Timestamp Specificity Index
          $specificity = 2;
          // Set Log2Log Message Content Accuracy Index
          $accuracy = 0;
          
          // BUT WAIT!
          // There's more!
          // The first Meebo chat log entry has a Log2Log Timestamp Specificity Index of 0.
          // It is the same value as the header time.
          if ($key1 == 0)
            {
            $time_cur = $times[$key];
            $specificity = 0;
            }
          }
        
        // Get the sender name and get the entry message.
        $log_chat_entry = explode("</span>: ", $log_chat_entry);
        $sender_raw = array_shift($log_chat_entry);
        $log_chat_entry = implode("</span>: ", $log_chat_entry);
        
        // Clean up the sender's name.
        $sender = trim(substr_replace($sender_raw, "", 0, strlen($matches[0])));
        
        // TODO: Clean up the entry message.
        $log_chat_entry = str_replace("<br>", "\n", $log_chat_entry);
        $log_chat_entry = /*htmlspecialchars_decode(html_entity_decode(*/$log_chat_entry/*))*/;
        $log_chat_entry = str_replace("&apos;", "'", $log_chat_entry);
        
        ## FINAL CONSTRUCTION ##
        $final['data'][$count]['chat'][$key1]['time'] = $time_cur;
        if ($from)
          {
          $final['data'][$count]['chat'][$key1]['sender'] = "_with";
          $final['data'][$count]['chat'][$key1]['alias'] = "_with";
          $this->with_alias = $sender;
          }
        elseif ($to)
          {
          $final['data'][$count]['chat'][$key1]['sender'] = "_self";
          $final['data'][$count]['chat'][$key1]['alias'] = $sender;
          }
        else
          {
          $final['data'][$count]['chat'][$key1]['sender'] = "_unknown";
          $final['data'][$count]['chat'][$key1]['alias'] = "_unknown";
          }
        $final['data'][$count]['chat'][$key1]['content'] = $log_chat_entry;
        $final['data'][$count]['chat'][$key1]['specificity'] = $specificity;
        $final['data'][$count]['chat'][$key1]['accuracy'] = $accuracy;
        $final['data'][$count]['with_alias'] = $this->with_alias;
        ########################
        }
      
      // Add one to the total chat log entry count.
      $count ++;
      }
    
    // Globalize the chat log entry count variable.
    $this->count = $count;
    // Globalize the local standardized log variable.
    $this->log = $final;
    // Also, return it. :)
    return $this->log;
    }
  
  // Generate Log From Standardized Log
  //  Usage: $OBJECT_VAR->generate(ARRAY_STANDARDIZED_LOG);
  //  Returns: ARRAY_EACH_CUSTOM_LOG
  public function generate($log)
    {
    // Go through each log.
    foreach ($log['data'] as $log_item)
      {
      // Put the longer variables into something more readily accessible.
      $account    = $log_item['account'];
      $protocol   = $log_item['protocol'];
      $with       = $log_item['with'];
      $with_alias = $log_item['with_alias'];
      $time       = $log_item['time'];
      
      // NOTE: The following code replaces the deprecated use of $i.
      // Store the full path of the log entry into $i.
      $i = "$account|$protocol|$with.txt";
      log2log_debug_info("meebo", "Created directory structure path: $i");
      
      // Initialize the custom log.
      $final[$i] .= '<br/><hr size=1><div class=\'ImChatHeader\'>'.date("l, Y M d", $time).' &#40;'.date("H:i:s", $time).'&#41;</div><hr size=1>';
      
      // Go through each chat entry.
      foreach ($log_item['chat'] as $log_chat_entry)
        {
        // Add slashes (required by chat log format)
        $log_chat_entry = addslashes($log_chat_entry);
        // Make array items more readily accessible.
        $time_cur    = $log_chat_entry['time'];
        $sender      = $log_chat_entry['sender'];
        $alias       = $log_chat_entry['alias'];
        $message     = $log_chat_entry['content'];
        $specificity = $log_chat_entry['specificity'];
        $accuracy    = $log_chat_entry['accuracy'];
        
        // Determine either "send" or "receive"
        if ($sender == "_self" || $sender == $account)
          {
          $sender_type = "ImSend";
          }
        elseif ($sender == "_with" || $sender == $with)
          {
          $sender_type = "ImReceive";
          }
        else
          {
          $sender_color = false;
          }
        
        // Determine the local datestamp.
        $date_cur_local = date("H:i", (int)$time_cur);
        
        // Process the sender alias.
        if ($sender == "_with")
          $alias = $with_alias;
        if ($sender == "_self")
          $alias = $alias;
        if ($alias == "_unknown" && $sender == "_self")
          $alias = "Me";
        if ($alias == "_unknown" && $sender == "_with")
          $alias = "Unknown";
        
        // Create the chat entry header.
        unset ($header);
        if ($sender_type)
          {
          $header .= '<span class=\''.$sender_type.'\'>['.$date_cur_local.'] '.$alias.'<\/span>: ';
          }
        
        // Add to the generated log.
        $final[$i] .= $header.$message.'<br\/>\n';
        }
      }
    
    // Finish the logs by encasing each of them in quotation marks (").
    foreach ($final as $key => $data)
      {
      $final[$key] = '"'.$data.'"';
      }
    
    // Return the generated log.
    return $final;
    }
  
  // Prepare the Standardized Log
  //  Usage: $OBJECT_VAR->start();
  public function start()
    {
    $this->unsetLog();
    $final['client'] = $this->client;
    $this->log = $final;
    $this->append = true;
    return true;
    }
  
  // Unset the Standardized Log
  //  Usage: $OBJECT_VAR->unsetLog();
  public function unsetLog()
    {
    $this->log = null;
    $this->append = false;
    $this->count = 0;
    return true;
    }
  // Unset the Standardized Log (aliases)
  public function delete() { $this->unsetLog(); }
  public function remove() { $this->unsetLog(); }
  public function destroy() { $this->unsetLog(); }
  
  // _MEEBO_CUSTOM: Set Account
  //  Usage: $OBJECT_VAR->setAccount(STRING);
  public function setAccount($account)
    {
    /* PATCH FOR REMOVING "/Meebo" RESOURCE TAG */
    if (strtolower(substr($account, -6)) == strtolower("/Meebo"))
      $account = substr($account, 0, -6);
    /* END PATCH */
    
    $this->account = $account;
    }
  
  // _MEEBO_CUSTOM: Set IM Protocol
  //  Usage: $OBJECT_VAR->setProtocol(STRING);
  public function setProtocol($protocol)
    {
    // TODO: Log2Log protocol names compatibility (libpurple-style)
    
    $this->protocol = $protocol;
    }
  
  // _MEEBO_CUSTOM: Set Other User's Account
  //  Usage: $OBJECT_VAR->setWith(STRING);
  public function setWith($with)
    {
    $this->with = $with;
    }
  
  // Public Information
  //  Usage: $OBJECT_VAR->info();
  //  Returns: ARRAY
  public function info()
    {
    $from = true;
    $to   = true;
    $instructions = "<p><strong>**** USE <a href=\"?convertfrom=MeeboConnect\">MeeboConnect</a> TO DOWNLOAD CHAT LOGS DIRECTLY FROM MEEBO ****</strong><br />Otherwise, upload raw Meebo log files through this converter. This is for advanced users, and logs need to be submitted correctly in order to convert successfully.</p><p>IMPORTANT COMPATIBILITY INSTRUCTIONS:<br />Each log file must be named in the following format to ensure that the account, protocol, and the buddy's account is stored correctly:<br /><span style=\"text-decoration: underline;\">Format:</span> <code>YOUR_ACCOUNT_ID|PROTOCOL|OTHER_ACCOUNT_ID.txt</code><br /><span style=\"text-decoration: underline;\">Example:</span> <code>experimental@meebo.org|jabber|billybobjoebobjoebobjoebobjoebobsteve@jabber.org.txt</code><br /></p>";
    $submission_form_custom = null;
    $return = array("name"         => $this->name,
                    "from"         => $from,
                    "to"           => $to,
                    "instructions" => $instructions,
                    "form"         => $submission_form_custom,
                   );
    return $return;
    }
  
  // Process Log2Log "From" Request
  public function processFrom($raw)
    {
    // Step 1/3: Fetch the data.
    ;;;;;;;;;;
    
    // Step 2/3: Process the data.
    foreach ($raw as $filepath => $raw_item)
      {
      $path_parts = pathinfo($filepath);
      $config_raw = $path_parts['filename'];
      list($account, $protocol, $with) = explode("|", $config_raw);
      
      $this->setAccount($account);
      $this->setProtocol($protocol);
      $this->setWith($with);
      
      $this->load($raw_item);
      }
    
    // Step 3/3: Submit the Log2Log-standardized chat log array.
    return $this->log;
    }
    
  /**
   * Process Log2Log "To" Request
   * @param array $log Log2Log-standardized chat log array
   */
  public function processTo($log)
    {
    return $this->generate($log);
    }
  
  // Service Icon
  //  Usage: $OBJECT_VAR->icon([HEIGHT]);
  //  Returns: Condition !headers_sent(): die(base64_decode(STRING_BASE64_IMAGE_PNG));
  //           Else                     : IMAGE_PNG;
  public function icon($height = 32)
    {
	if ($height >= 0 && $height <= 16)
	  $img = 'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9sBBQIULdZmwIAAAAI0SURBVDjLjZJbSJNxGMZ/39Q2NUizmTpMA4sGXojaSSzFGy9CIyopOtwUFWZXkkEkmnQQhndFBt1IBIJRFFTMUiOIwHTMYio4KW213FqSh23f9NvbRSqSc/VePs/zf97D84cI5arZA4D3Mjv9r441BLpONPqa4ksA3HXbiFruizk8g7jg+waHBD+IzDpEZh1hUR2i2q6POotImri6dUmvRDJRe2u/xG3Ky9D6HuhCXl+XIPP6lOTymMKjMu9x+tbk3TBG7P6xsoTJW6Yz4mqW0OPdMni4KGuRs1XuT1c7touMN8t025YLMrjKCv4XFY+kvyw8aclq+ZvzXTNdkb694u+s7FnEdCscvAOpuIeVUCjRYys3L8G9pdmo80YvrmEUr33tqgaaGuxnak70JvPxfOvQEr7j9WcM2eYq/CKaqtpXNRixJtzUwnplnSmc671T1dmdSW5nCuaJ20eeJqcHysIYFNfbOMslqldP4Xu96aQxR9+mM2QICYkKAgT8IupXxeMM1qU1fbNEjRFg9HRG8UZzvEWnKLsANBH7jxG1bnOr62XUj/TEWPMnjYfn62fuHixezg1UbOC/yt+xr12GGsNhW7W4DyWYomljI4Ha9DtwdqHoFM72GgrAnwqEAAH0gAGYAsZilj/8dK6QU2qSPtA9/uZXdqzWcl+s9+wzDsADBABtoWkaEAP8XDl+e0HP3PNSARKBcuAAkAmsB5IXJoi8grSacI1N1YZi1fwFofVf9/oNNMfr9OQQlj0AAAAASUVORK5CYII=';
	elseif ($height > 16 && $height <= 32)
	  $img = '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';
	elseif ($height > 32 && $height <= 64)
      $img = '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';	
    elseif ($height > 64 && $height <= 128)
	  $img = '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';
	else
	  $img = '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';
    if (!headers_sent())
      {
      header("Content-type: image/png");
      header("Content-length: ".strlen($img));
      die(base64_decode($img));
      }
    else
      {
      return base64_decode($img);
      }
    }
  }

?>
