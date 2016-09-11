<?php
/**
 * Log2Log Online Chat Log Converter
 *  Formats
 *   Log2Log Standard JSON
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

class JSON
  {
  // Format Handler Information
  public $name   = "Log2Log JSON";
  public $unix   = "json";
  public $client = "Log2Log";
  
  // Handler Process Configuration
  public  $log    = null;
  private $append = false;
  private $count  = 0;
  
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
  public function processFrom($raw)
    {
    // Step 1/3: Fetch the data.
    //  If the submitted file was not an archive...
    if (!$raw && ($_FILES['file']['error'] == 0 || /*XXX*/$_FILES['file']['error'] == 4/*XXX*/))
      {
      $raw = array(file_get_contents($_FILES['file']['tmp_name']));
      }
    
    // Step 2/3: Process the data.
    $this->log = json_decode(current($raw), true);
    
    // Step 3/3: Submit the Log2Log-standardized chat log array.
    return $this->log;
    }
    
  /**
   * Process Log2Log "To" Request
   * @param array $log Log2Log-standardized chat log array
   */
  public function processTo($log)
    {
    $log = array(date("Y-m-d_H-i-s_OT").".json" => json_encode($log));
    return $log;
    }
  
  /**
   * Public Information
   *  @returns array Format class information for Log2Log
   */
  public function info()
    {
    $from = true;
    $to   = true;
    $instructions = "TEMPLATE";
    $return = array("name"         => $this->name,
                    "from"         => $from,
                    "to"           => $to,
                    "instructions" => $instructions,
                   );
    return $return;
    }
  }

?>
