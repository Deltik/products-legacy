<?php
/**
 * WebDeb Software Package System
 *  Classes
 *   Ar Archive Handler
 * 
 * License:
 *  This file is part of WebDeb.
 *  
 *  WebDeb is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *  
 *  WebDeb is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with WebDeb.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

class Ar
  {
  // Read Entry
  //  $this->readEntry(FILE_ENTRY);
  function readEntry($entry_raw)
    {
    // Make sure the entry is a string and at least 59 characters long
    if (!is_string($entry_raw) || strlen($entry_raw) < 59)
      return false;
    // Store file entry information
    $entry['file_name'] = substr($entry_raw, 0, 15);
    $entry['file_modification_timestamp'] = substr($entry_raw, 16, 11);
    $entry['owner_id'] = substr($entry_raw, 28, 5);
    $entry['group_id'] = substr($entry_raw, 34, 5);
    $entry['file_mode'] = substr($entry_raw, 40, 7);
    $entry['file_size'] = substr($entry_raw, 48, 9);
    $entry['file_magic'] = substr($entry_raw, 58, 1);

    // Clean up file entry information
    foreach ($entry as $key => $entry_item)
      {
      $entry[$key] = trim($entry_item);
      }
    // Make sure the magic is exactly on the 58th byte...
    // ... or YOU'RE DOING IT WRONG!
    if ($entry['file_magic'] != "`")
      return false;
    // You: What if someone called this function including the data?
    // Me: Give them the data.
    // You: But... but--
    // Me: It's operator error if they send the data incorrectly.
    if (strlen($entry_raw) >= 59 + $entry['file_size'])
      {
      $entry['data'] = substr($entry_raw, 60, $entry['file_size']-1);
      // Also add the remainder, if any.
      if (strlen($entry_raw) > 59 + $entry['file_size'])
        {
        $entry['remainder'] = substr($entry_raw, 60 + $entry['file_size']);
        }
      
      // Formula to get the mime type of $entry
      $tmp_filename = tempnam(sys_get_temp_dir(), "webdeb_");
      $tmp_handle = fopen($tmp_filename, "w");
      fwrite($tmp_handle, $entry['data']);
      fclose($tmp_handle);
      $entry['mime'] = mime_content_type($tmp_filename);
      unlink($tmp_filename);
      }
    
    return $entry;
    }
  }

?>
