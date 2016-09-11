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
  public $name   = "Deltik Standard Non-XML Chat Log Format";
  public $unix   = "deltikhuman";
  public $display= "Deltik Human";
  public $client = "Deltik";
  
  // Public Information
  //  Usage: $OBJECT_VAR->info();
  //  Returns: ARRAY
  public function info()
    {
    $from = true;
    $to   = true;
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
