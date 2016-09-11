<?php
/**
 * Log2Log Online Chat Log Converter
 *  Formats
 *   Deltik Standard Non-XML Chat Log Format
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

class Deltik
  {
  // Format Handler Information
  public $name   = "Deltik Standard Non-XML Chat Log Format";
  public $unix   = "deltikhuman";
  public $display= "Deltik Human";
  public $client = "Deltik";
  
  // Handler Process Configuration
  public  $log    = null;
  private $append = false;
  private $count  = 0;
  
  /**
   * Standardize Log
   */
  public function load($log_raw)
    {
    // Add to current log, or make a new one?
    if (!$this->append)
      {
      $this->start();
      }
    
    // TODO
    
    // Add one to the total chat log entry count.
    $count ++;
    // Globalize the chat log entry count variable.
    $this->count = $count;
    // Globalize the local standardized log variable.
    $this->log = $final;
    // Also, return it. :)
    return $this->log;
    }
  
  /**
   * Generate Log from Standardized Log
   * @returns: array Each custom log
   */
  public function generate($log)
    {
    // Go through each log.
    foreach ($log['data'] as $log_item)
      {
      // TODO
      }
    }
  
  /**
   * Prepare the Standardized Log
   */
  public function start()
    {
    $this->unsetLog();
    $final['client'] = $this->client;
    $this->log = $final;
    $this->append = true;
    return true;
    }
  
  /**
   * Unset the Standardized Log
   */
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
  
  /**
   * Process Log2Log "From" Request
   * @param array $raw Imported structure and data
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
  
  /**
   * Public Information
   *  @returns array Format class information for Log2Log
   */
  public function info()
    {
    $from = false;
    $to   = false;
    $instructions = "<h1>This doesn't work yet!</h1>";
    $return = array("name"         => $this->display,
                    "from"         => $from,
                    "to"           => $to,
                    "instructions" => $instructions,
                   );
    return $return;
    }
  }

?>
