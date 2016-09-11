<?php
/**
 * WebDeb Software Package System
 *  Execution
 *   Core File
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

/********\
| SYSTEM |
\********/
define("WEBDEB_VERSION", "1.0.0", true);
define("WEBDEB_VERSION_DEB", "2.0", true);
$mimes_supported = array("application/x-gzip",
                         "multipart/x-gzip",
                         "application/x-bzip",
                         "application/x-bzip2",
                         "application/x-tar",
                        );

/***********\
| FUNCTIONS |
\***********/

// Error Reception
//  Usage: error([ID_INT, MORE_INFORMATION]);
function error($int = -1, $details = null)
  {
  switch($int)
    {
    case 404:
      $err = "File Not Found";
      break;
    case 415:
      $err = "Unsupported Media Type";
      break;
    default:
      $int = null;
      $err = "Unknown Error";
    }
  if ($details)
    $details = "<h3><strong>More Information:</strong> $details</h3>";
  
  // DEBUG:
  die("<div style=\"background: pink; color: red; border: red groove; -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px;  font-family: sans; text-align: center;\"><h1>WebDeb ".$int." Error</h1><h2>".$err."</h2>$details</div>");
  }

// Failsafe Get Mime Type
//  Usage: mime_content_type(FILENAME);
//  Returns: STRING
if (!function_exists('mime_content_type'))
  {
  // If Fileinfo extension is installed...
  if (function_exists('finfo_file'))
    {
    function mime_content_type($file)
      {
      $finfo = finfo_open(FILEINFO_MIME);
      $mimetype = finfo_file($finfo, $file);
      finfo_close($finfo);
      return $mimetype;
      }
    }
  // ... otherwise, use this method, which !Windows because Linux is better.
  else
    {
    function mime_content_type($file)
      {
      return trim(exec('file -bi '.escapeshellarg($file)));
      }
    }
  }

// Create Temporary File With Data
//  Usage: createTempFile(DATA);
//  Returns: STRING_FILENAME
function createTempFile($data)
  {
  $tmp_filename = tempnam(sys_get_temp_dir(), "webdeb_");
  $tmp_handle = fopen($tmp_filename, "w");
  fwrite($tmp_handle, $data);
  fclose($tmp_handle);
  return $tmp_filename;
  }

// Do Everything for Me to Get a File List and Data from a Supported File
//  Usage: doEverythingForMeToGetAFileListAndData(ARRAY_WEBDEB_EXTRACT_AR);
//  Returns: ARRAY_FILENAME_TO_FILEDATA
function doEverythingForMeToGetAFileListAndData($entry)
  {
  // Preface:
  //  It's a complicated procedure to read a DEB package.
  //  Reading the data hasn't even started yet. That's another story...
  //  Another really long and complicated story...
  //  We shall get there... eventually. The compressed data must be read first.
  //  What's the compression method? Don't look at me; I don't know.
  //  So... This method uses mime types to get the compression method.
  
  // WebDeb supports three file types because PHP and Debian support those:
  //  - gzip
  //  - bzip2
  //  - tar
  // The following code simplifies given mime types to a more basic level.
  if (strpos($entry['mime'], "gzip") !== false)
    $entry_type = "gz";
  elseif (strpos($entry['mime'], "bzip") !== false)
    $entry_type = "bz";
  elseif (strpos($entry['mime'], "tar") !== false)
    $entry_type = "tar";
  else
    return false;
  
  // Store the data of the entry for imminent use.
  $tmp_filename = createTempFile($entry['data']);
  
  // Convert TAR.GZ to TAR
  if ($entry_type == "gz")
    {
    $tmp_handler = gzopen($tmp_filename, "r");
    while (!gzeof($tmp_handler))
      {
      $tmp_decompressed .= gzgetc($tmp_handler);
      }
    }
  // Convert TAR.BZ or TAR.BZ2 to TAR
  elseif ($entry_type == "bz")
    {
    $tmp_handler = bzopen($tmp_filename, "r");
    $tmp_proc = "BLAH";
    while ($tmp_proc != "")
      {
      $tmp_proc = bzread($tmp_handler, 1);
      $tmp_decompressed .= $tmp_proc;
      }
    }
  // Not sure...
  else
    {
    return false;
    }
  
  // Everything should now be TAR. Save a temporary TAR file.
  $tmp_filename = createTempFile($tmp_decompressed);
  
  // Start a new TAR object from the third-party TAR class.
  __autoload("tar");
  $tmp_handler = new tar();
  
  // Open the temporary TAR file.
  if (!$tmp_handler->openTAR($tmp_filename))
    return false;
  
  return $tmp_handler->files;
  }

// Read Control File
//  Usage: readControlFile(CONTROL_DATA);
//  Returns: ARRAY
function readControlFile($data)
  {
  // Preface:
  //  Reading a DEB package hasn't even started yet.
  //  The control file must be interpreted in a way that PHP can understand.
  //  That would be converting it into an array.
  //  This method does not use regular expressions to read the control file.
  //  Wish it luck! (Eh, not really.)
  
  // Break each line of the control file into a primitive array.
  $data_array_primitive = explode("\n", $data);
  
  // Allez, allez allez allez! Allez, allez allez allez!
  // GO!
  $i = 0;
  foreach ($data_array_primitive as $key => $data_item_primitive)
    {
    $beginning = substr($data_item_primitive, 0, 1);
	$beginning2 = substr($data_item_primitive, 0, 2);
    if ($beginning != " " && strpos($data_item_primitive, ":") !== FALSE)
      {
      $data_item_primitive = explode(":", $data_item_primitive);
      $data_item_key = strtolower(array_shift($data_item_primitive));
      $data_item = trim(implode(":", $data_item_primitive));
	  $data_array[$data_item_key] = $data_item;
	  $i ++;
      }
	elseif ($beginning == " " && $beginning2 != " .")
	  {
	  $extension = substr($data_item_primitive, 1);
	  $keys = array_keys($data_array);
	  $data_array[$keys[$i - 1]] .= $extension;
	  }
	elseif ($beginning == " " && $beginning2 == " .")
	  {
	  $keys = array_keys($data_array);
	  $data_array[$keys[$i - 1]] .= "\n";
	  }
	else
	  {
	  continue;
	  }
    }
  
  return $data_array;
  }

// Autoload
//  Usage: (none)
function __autoload($class_name)
  {
  include_once ("classes/$class_name.php");
  }

?>