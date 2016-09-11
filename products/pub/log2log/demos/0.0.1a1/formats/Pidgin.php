<?php
/**
 * Log2Log Online Chat Log Converter
 *  Formats
 *   Pidgin HTML
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

class Pidgin
  {
  // Format Handler Information
  public $name   = "Pidgin HTML";
  public $unix   = "pidgin";
  public $client = "Pidgin";
  
  // Handler Process Configuration
  public $log = null;
  private $append = false;
  private $count = 0;
  
  // Standardize Log
  //  Usage: $OBJECT_VAR->load(FILE_CONTENTS);
  public function load($log_raw)
    {
    // Add to current log, or make a new one?
    if (!$this->append)
      {
      $this->initialize();
      }
    
    // Localize the chat log entry count variable.
    $count = $this->count;
    // Localize the global standardized log variable.
    $final = $this->log;
    
    // Reset temporary variables
    $times = array();
    
    // We go'n get the log header information.
    $log_broken = explode("<body><h3>", $log_raw);
    array_shift($log_broken);
    $log_broken = implode("<body><h3>", $log_broken);
    $log_broken = explode("</h3>", $log_broken);
    $log_headers = array_shift($log_broken);
    $log_broken = implode("</h3>", $log_broken);
    // Here, we look at Pidgin's chat log header:
    // "Conversation with _WITH at _DAY_OFWEEK_3LETTERS _DAY_2DIGITS _MONTH_3LETTERS _YEAR_4DIGITS _HOUR_12_2DIGITS:_MINUTE:_SECOND _MERIDIEM _TIMEZONE on _SELF (_PROTOCOL)"
    $log_headers_proc = substr($log_headers, 18);
    $log_headers_proc = explode(" at ", $log_headers_proc);
    $with = array_shift($log_headers_proc);
    $log_headers_proc = implode(" at ", $log_headers_proc);
    $log_headers_proc = explode(" on ", $log_headers_proc);
    $date_cur = array_shift($log_headers_proc);
    $timezone = array_pop(explode(" ", $date_cur));
    $timezone_save = date_default_timezone_get();
    setTimeZone($timezone);
    $time_cur = strtotime($date_cur);
    $log_headers_proc = implode(" on ", $log_headers_proc);
    $log_headers_proc = explode(" (", $log_headers_proc);
    $self = array_shift($log_headers_proc);
    $log_headers_proc = implode(" (", $log_headers_proc);
    $log_headers_proc = explode(")", $log_headers_proc);
    $protocol = array_shift($log_headers_proc);
    
    ## FINAL CONSTRUCTION ##
    $final['data'][$count]['account'] = $self;
    $final['data'][$count]['protocol'] = $protocol;
    $final['data'][$count]['with'] = $with;
    $final['data'][$count]['with_alias'] = "_unknown";
    $final['data'][$count]['time'] = $time_cur;
    ########################
    
    // Now, begin to work with the log entries.
    $log_clean = trim($log_broken);
    
    // Break the clean HTML log into log entries.
    $log_each_raw = explode("<br/>\n", $log_clean);
    // Sometimes, logs haven't been completed.
    // This ensures compatibility with complete and incomplete logs.
    if (substr($log_each_raw[count($log_each_raw)-1], 0, 2) == "</")
      {
      array_pop($log_each_raw);
      }
    $log_each_proc = $log_each_raw;
    
    // For each log entry...
    foreach ($log_each_proc as $key => $log_each_item)
      {
      // If colorless event...
      $temp_colorless = '<font size="2">(';
      if (substr($log_each_item, 0, strlen($temp_colorless)) == $temp_colorless)
        {
        $_sender = "_evt";
        $log_each_item_proc = substr($log_each_item, strlen($temp_colorless));
        }
      // Find out what kind of entry it is.
      // If colorful event... (Determine sender and time.)
      elseif (preg_match_all ('/.*?(#{1}(?:[A-F0-9]){6})(?![0-9A-F]).*?((?:(?:[0-1][0-9])|(?:[2][0-3])|(?:[0-9])):(?:[0-5][0-9])(?::[0-5][0-9])?(?:\\s?(?:am|AM|pm|PM))?)/is', $log_each_item, $matches))
        {
        $sender_color = $matches[1][0];
        $date_cur_local = $matches[2][0];
        // Color Legend:
        //  #16569E : _self
        //  #A82F2F : _with
        //  #FF0000 : Error
        if ($sender_color == "#16569E")
          $_sender = "_self";
        if ($sender_color == "#A82F2F")
          $_sender = "_with";
        if ($sender_color == "#FF0000")
          $_sender = "_evt";
        }
      // If unknown event (improperly formatted)...
      else
        {
        $message = $log_each_item;
        }
      
      // Process the time of current log entry.
      if ($date_cur_local)
        {
        // Add the time to the datestamp.
        $date_cur = date("d-F-Y", $time_cur)." ".$date_cur_local;
        // Convert the added datestamp back to timestamp.
        $time_cur = strtotime($date_cur);
        // Set Log2Log Timestamp Specificity Index
        //  Legend:
        //   null: No time information
        //   -3: Nanoseconds
        //   -2: Microseconds
        //   -1: Milliseconds
        //   0 : Seconds
        //   1 : Ten Seconds
        //   2 : Minutes
        //   3 : Ten Minutes
        //   4 : Hours
        //   5 : Ten Hours
        //   6 : Day
        //   7 : Within a Week of a Date
        //   8 : Within a Month of a Date
        //   9 : Within a Year of a Date
        //   10: Within a Decade of a Date
        //   11: Within a Century of a Date
        //   12: Within a Millenium of a Date
        $specificity = 0;
        // Set Log2Log Message Content Accuracy Index
        //  Legend:
        //   0 : Exactly
        //   1 : Approximately/Very Similar To
        //   2 : Estimated/Similar To
        //   3 : Extrapolated/Guessed
        //   4 : Unconfirmed/Dramatized
        $accuracy = 0;
        }
      
      // Process normal messages.
      if ($_sender == "_self" || $_sender == "_with")
        {
        // Next step: Get the sender's alias.
        $log_each_item_proc = explode("<b>", $log_each_item);
        // Drop the information we already have (sender color and time).
        array_shift($log_each_item_proc);
        // Keep going.
        $log_each_item_proc = implode("<b>", $log_each_item_proc);
        $log_each_item_proc = explode(":</b></font> ", $log_each_item_proc);
        $sender_alias = array_shift($log_each_item_proc);
        $log_each_item_proc = implode(":</b></font> ", $log_each_item_proc);
        // TODO: Clean up the entry message.
        $log_each_item_proc = str_replace(array("&quot;", "&amp;"), array("\"", "&amp;"), $log_each_item_proc);
        $message = $log_each_item_proc;
        }
      // Process event entries.
      elseif ($_sender == "_evt")
        {
        // Invalidate the normal message components.
        $message = null;
        }
      
      ## FINAL CONSTRUCTION ##
      $final['data'][$count]['chat'][$key]['time'] = $time_cur;
      $final['data'][$count]['chat'][$key]['sender'] = $_sender;
      if ($sender_alias)
        {
        $final['data'][$count]['chat'][$key]['alias'] = $sender_alias;
        }
      else
        {
        $final['data'][$count]['chat'][$key1]['alias'] = "_unknown";
        }
      if ($message)
        $final['data'][$count]['chat'][$key]['content'] = $message;
      $final['data'][$count]['chat'][$key]['specificity'] = $specificity;
      $final['data'][$count]['chat'][$key]['accuracy'] = $accuracy;
      if ($sender_alias && $_sender == "_with")
        {
        $final['data'][$count]['with_alias'] = $sender_alias;
        }
      ########################
      }
    
    // Restore System Time Zone
    setTimeZone($timezone_save);
    
    // Add one to the total chat log entry count.
    $count ++;
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
    // NOTE: The usage of $i has been deprecated to fit in the feature of
    //       organized directory structures for each log file.
    $i = 0;
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
      $i = str_replace("%40", "@", "logs/".urlencode($protocol)."/".urlencode($account)."/".urlencode($with)."/".date("Y-m-d.HisOT", $time).".html");
      log2log_debug_info("pidgin", "Created directory structure path: $i");
      
      // Initialize the custom log.
      $final[$i] = '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><title>Conversation with '.$with.' at '.date("D d M Y h:i:s A T", $time).' on '.$account.' ('.$protocol.')</title></head><body><h3>Conversation with '.$with.' at '.date("D d M Y h:i:s A T", $time).' on '.$account.' ('.$protocol.')</h3>'."\r\n";
      
      // Go through each chat entry.
      foreach ($log_item['chat'] as $log_chat_entry)
        {
        // Make array items more readily accessible.
        $time_cur    = $log_chat_entry['time'];
        $sender      = $log_chat_entry['sender'];
        $alias       = $log_chat_entry['alias'];
        $message     = $log_chat_entry['content'];
        $specificity = $log_chat_entry['specificity'];
        $accuracy    = $log_chat_entry['accuracy'];
        
        // Determine the sender color.
        if ($sender == "_self" || $sender == $account)
          {
          $sender_color = "#16569E";
          }
        elseif ($sender == "_with" || $sender == $with)
          {
          $sender_color = "#A82F2F";
          }
        else
          {
          $sender_color = false;
          }
        
        // Determine the local datestamp.
        if ($specificity == 0)
          $date_cur_local = date("h:i:s A", $time_cur);
        elseif ($specificity == 2)
          $date_cur_local = date("h:i A", $time_cur);
        elseif ($specificity == 4)
          $date_cur_local = date("h A", $time_cur);
        elseif ($specificity == 6)
          $date_cur_local = date("Y/m/d", $time_cur);
        else
          $date_cur_local = date("Y/m/d h:i:s A", $time_cur);
        
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
        if ($sender_color)
          {
          $header .= '<font color="'.$sender_color.'"><font size="2">('.$date_cur_local.')</font> <b>'.$alias.':</b></font> ';
          }
        
        // Add to the generated log.
        $final[$i] .= $header.$message."<br/>\r\n";
        }
      
      // Close the log.
      $final[$i] .= "</body></html>";
      
      // Increment the log key.
      // NOTE: The usage of $i has been deprecated to fit in the feature of
      //       organized directory structures for each log file.
      $i ++;
      }
    
    // Return the generated log.
    return $final;
    }
  
  // Prepare the Standardized Log
  //  Usage: $OBJECT_VAR->initialize();
  public function initialize()
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
  
  // Public Information
  //  Usage: $OBJECT_VAR->info();
  //  Returns: ARRAY
  public function info()
    {
    $from = true;
    $to   = true;
    $instructions = "TODO";
    $sumbission_form_custom = null;
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
    //  TODO: Understand the types of files that we're getting.
    foreach ($raw as $raw_item)
      {
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
  public function icon($height = 32)
    {
    if ($height >= 0 && $height <= 16)
      $img = '';
    elseif ($height > 16 && $height <= 32)
      $img = '';
    elseif ($height > 32 && $height <= 64)
      $img = '';	
    elseif ($height > 64 && $height <= 128)
      $img = '';
    else
      $img = '';
    
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
