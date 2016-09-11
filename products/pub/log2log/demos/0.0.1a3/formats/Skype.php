<?php
/**
 * Log2Log Online Chat Log Converter
 *  Formats
 *   Skype
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

class Skype
  {
  // Format Handler Information
  public $name   = "Skype";
  public $unix   = "skype";
  public $client = "Skype";
  
  // Handler Process Configuration
  public  $log    = null;
  public  $log_s  = null;
  private $append = false;
  private $count  = 0;
  
  // Standardize Log
  //  Usage: $OBJECT_VAR->load(FILE_CONTENTS);
  public function load($log_raw)
    {
    // Add to current log, or make a new one?
    if (!$this->append)
      {
      $this->start();
      }
    
    // Convert binary log file to hexadecimal
    $log_hex = $this->strtohex($log_raw);
    // Split hexadecimal values into bytes
    $log_hex_bytes = implode(" ", str_split($log_hex, 2));
    
    // Split hexadecimal bytes into Skype entries (0x6C 0x33 0x33 0x6C)
    $log_hex_entries = explode("6C 33 33 6C", $log_hex_bytes);
    array_shift($log_hex_entries);
    
    // Run through each entry
    foreach ($log_hex_entries as $key => $log_hex_entry)
      {
      // First Explosion - Split UNKNOWN1 and CHAT_MEMBERS
      $log_hex_entry = explode("E0 03 ", $log_hex_entry);
      $UNKNOWN1 = array_shift($log_hex_entry);
      $log_hex_entry = implode("E0 03 ", $log_hex_entry);
      // Second Explosion - Split CHAT_MEMBERS and TIMESTAMP
      $log_hex_entry = explode("00 00 E5 03 ", $log_hex_entry);
      $CHAT_MEMBERS = array_shift($log_hex_entry);
      $log_hex_entry = implode("00 00 E5 03 ", $log_hex_entry);
      // Third Explosion - Split TIMESTAMP and SENDER
      $log_hex_entry = explode("03 E8 03 ", $log_hex_entry);
      $TIMESTAMP = array_shift($log_hex_entry);
      $log_hex_entry = implode("03 E8 03 ", $log_hex_entry);
      // Fourth Explosion - Split SENDER and UNKNOWN2
      $log_hex_entry = explode("00 00 ", $log_hex_entry);
      $SENDER = array_shift($log_hex_entry);
      $log_hex_entry = implode("00 00 ", $log_hex_entry);
      // Fifth Explosion - Split UNKNOWN2 and CONTENT
      $log_hex_entry = explode("FC 03 ", $log_hex_entry);
      $UNKNOWN2 = array_shift($log_hex_entry);
      $log_hex_entry = implode("FC 03 ", $log_hex_entry);
      // Sixth Explosion - Split CONTENT and UNKNOWN3
      $log_hex_entry = explode("00 00 ", $log_hex_entry);
      $CONTENT = array_shift($log_hex_entry);
      $log_hex_entry = implode("00 00 ", $log_hex_entry);
      // Seventh Explosion - Split UNKNOWN3 and SENDER_ALIAS
      $log_hex_entry = explode("03 EC 03 ", $log_hex_entry);
      $UNKNOWN3 = array_shift($log_hex_entry);
      $log_hex_entry = implode("03 EC 03 ", $log_hex_entry);
      // Eighth Explosion - Split SENDER_ALIAS and UNKNOWN4
      $log_hex_entry = explode("00 04 E2 18 20 ", $log_hex_entry);
      $SENDER_ALIAS = array_shift($log_hex_entry);
      $log_hex_entry = implode("00 04 E2 18 20 ", $log_hex_entry);
      // Ninth Explosion - Split UNKNOWN4 and WITH
      $log_hex_entry = explode("03 D8 18 ", $log_hex_entry);
      $UNKNOWN4 = array_shift($log_hex_entry);
      $log_hex_entry = implode("03 D8 18 ", $log_hex_entry);
      // Tenth Explosion - Split WITH and (CRUFT1)
      $log_hex_entry = explode("00 ", $log_hex_entry);
      $WITH = array_shift($log_hex_entry);
      $log_hex_entry = implode("00 ", $log_hex_entry);
      
      // Clean up the fetched values
      $UNKNOWN1 = str_replace(" ", "", $UNKNOWN1);
      $CHAT_MEMBERS = str_replace(" ", "", $CHAT_MEMBERS);
      $TIMESTAMP = str_replace(" ", "", $TIMESTAMP);
      $SENDER = str_replace(" ", "", $SENDER);
      $UNKNOWN2 = str_replace(" ", "", $UNKNOWN2);
      $CONTENT = str_replace(" ", "", $CONTENT);
      $UNKNOWN3 = str_replace(" ", "", $UNKNOWN3);
      $SENDER_ALIAS = str_replace(" ", "", $SENDER_ALIAS);
      $UNKNOWN4 = str_replace(" ", "", $UNKNOWN4);
      $WITH = str_replace(" ", "", $WITH);
      
      $log_hex_entries[$key] = array($UNKNOWN1, $CHAT_MEMBERS, $TIMESTAMP, $SENDER, $UNKNOWN2, $CONTENT, $UNKNOWN3, $SENDER_ALIAS, $UNKNOWN4, $WITH);
      
      // Process the relevant fetched values
      # Chat Members (TODO) (XXX) (FIXME)
      $withs_raw = $this->hextostr($CHAT_MEMBERS);
      # Weird Arabic-style signed Skype Unix timestamp that makes no sense at all
      $time_cur_hex_raw_array = str_split($TIMESTAMP, 2);
      $time_cur_proc = array_reverse($time_cur_hex_raw_array);
      unset ($time_cur_bin);
      foreach ($time_cur_proc as $i => $time_byte_hex_raw)
        {
        // Convert hexadecimal to binary
        $time_byte_bin_raw = base_convert($time_byte_hex_raw, 16, 2);
        // Dispose of the stupid sign bit, the significant bit
        if ($i != 0)
          $time_byte_bin_proc = substr($time_byte_bin_raw, 1);
        else
          $time_byte_bin_proc = substr($time_byte_bin_raw, 4);
        $time_cur_bin .= $time_byte_bin_proc;
        }
      $time_cur = bindec($time_cur_bin);
      # Sender
      $sender = $this->hextostr($SENDER);
      # Content
      $log_chat_entry = $this->hextostr($CONTENT);
      # Sender's Alias
      $sender_alias = $this->hextostr($SENDER_ALIAS);
      # Other Chat Member; Primitive type of chat indicator
      if (!$WITH)
        $with = "_group";
      else
        $with = $this->hextostr($WITH);
      
      // NOTE: Skype DBBs are so weird that Log2Log Skype must actually compile
      //       the final log every time this function runs. Here, you see that
      //       the log is stored in an easily accessible non-standard Log2Log
      //       format that is flexible between PHP logic and Skype DBB logic.
      // TODO
      
      $final[$key] = array($withs_raw, $time_cur, $sender, $log_chat_entry, $sender_alias, $with);
      }
    
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
    foreach ($log['data'] as $log_item)
      {
      // TODO
      }
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
  
  // _SKYPE_CUSTOM: Hexadecimal to String
  //  Usage: $OBJECT_VAR->hextostr(STRING_HEXADECIMAL);
  function hextostr($x)
    { 
    $s = '';
    foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
      $s .= chr(hexdec($h));
    return $s;
    } 
  
  // _SKYPE_CUSTOM: String to Hexadecimal
  //  Usage: $OBJECT_VAR->strtohex(STRING);
  function strtohex($x)
    { 
    $s = '';
    foreach (str_split($x) as $c)
      $s .= sprintf("%02X", ord($c));
    return $s;
    }
  
  /**
   * Process Log2Log "From" Request
   * @returns array $log Log2Log-standardized chat log array
   */
  public function processFrom()
    { // TODO
    // Step 1/3: Fetch the data.
    
    
    // Step 2/3: Process the data.
    
    
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
  
  // Public Information
  //  Usage: $OBJECT_VAR->info();
  //  Returns: ARRAY
  public function info()
    {
    $from = true;
    $to   = true;
    $instructions = "<h1>This doesn't work yet!</h1>";
    $return = array("name"         => $this->name,
                    "from"         => $from,
                    "to"           => $to,
                    "instructions" => $instructions,
                   );
    return $return;
    }
  }

?>
