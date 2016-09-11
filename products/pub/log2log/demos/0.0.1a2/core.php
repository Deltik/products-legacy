<?php
/**
 * Log2Log Online Chat Log Converter
 *  Execution
 *   Core File
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

/********\
| SYSTEM |
\********/
// Load the configuration file.
include_once ("config.php");

// Version Number
autodefine("LOG2LOG_VERSION", "0.0.1a2", true);

// Give the rest of the script the core class.
$LOG2LOG = new Core();

// Standard Format Information
autodefine("LOG2LOG_FORMAT", "Log2Log");
define("LOG2LOG_FORMAT_SERVICEICON_SRC", "?serviceicon=Log2Log");

// Initialize Theme Information File
$LOG2LOG->theme();

// Generate Navibar
if (function_exists('navibar'))
  {
  $return = navibar($navi);
  if (!defined('LOG2LOG_NAVIBAR') && !$return)
    define("LOG2LOG_NAVIBAR", "<span style=\"color: red;\"><strong>ERROR!</strong> The navigation panel failed to load! I guess you're stuck here until somebody fixes it. Are you the webmaster of this Log2Log site and need help fixing this problem? Contact Deltik at <a href=\"mailto:webmaster@deltik.org\">webmaster@deltik.org</a>.</span>");
  elseif (!defined('LOG2LOG_NAVIBAR') && $return)
    define("LOG2LOG_NAVIBAR", $return);
  }
else
  {
  foreach ($navi as $innerHTML => $href)
    {
    $temp .= "     <li><a href=\"$href\">$innerHTML</a></li>\n";
    }
  autodefine("LOG2LOG_NAVIBAR", $temp, TRUE);
  }

// Development Diagnostics & Advanced Information
autodefine('LOG2LOG_ALPHA_DIAGNOSTICS', "<fieldset><legend>Log2Log Alpha Diagnostics</legend>
<strong>Version:</strong> ".LOG2LOG_VERSION."<br />
<strong>Theme:</strong> ".LOG2LOG_THEME."<br />
</fieldset>");

/********************\
| EXECUTION SETTINGS |
\********************/
ini_set('memory_limit', '2048M');
set_time_limit(0);
ini_set('short_open_tag', 'On');

/*******\
| CLASS |
\*******/
class Core
  {
  /****************\
  | CORE VARIABLES |
  \****************/
  public $formats;
  
  /***********\
  | FUNCTIONS |
  \***********/
  // Initializing Function
  //  Usage: $OBJECT_VAR = new Core();
  function __construct()
    {
    $this->formats = $this->loadFormats();
    }
  
  // Load Formats
  //  Usage: $this->loadFormats();
  private function loadFormats()
    {
    $FORMATS = array();
    $directory = "formats";
    $handle = opendir($directory);
    while (false !== ($file = readdir($handle)))
      {
      $file_full = $directory."/".$file;
      if ($file != ".." && $file != "." && substr($file, -4) == ".php" && is_file($file_full))
        {
        $class = substr($file, 0, -4);
        eval('$temp = new '.$class.'();');
        if (method_exists($temp, 'info'))
          {
          $info = $temp->info();
          $FORMATS[$temp->unix] = $info;
          if (file_exists("images/services/$class.png"))
            $FORMATS[$temp->unix]['image'] = "images/services/$class.png";
          elseif (method_exists($class, 'icon'))
            $FORMATS[$temp->unix]['image'] = "?serviceicon=$class";
          }
        }
      }
    return $FORMATS;
    }
  
  // Import Submitted Data from Archive
  //  Usage: $OBJECT_VAR->import();
  public function import()
    {
    // TODO: Actually support these file types.
    // XXX: Log2Log will pretend to support these file types until a fix is
    //      released that will actually support these file types.
    $mimes_supported = array("application/x-gzip" => "gzip",
                             "multipart/x-gzip" => "gzip",
                             "application/x-bzip" => "bzip",
                             "application/x-bzip2" => "bzip",
                             "application/x-tar" => "tar",
                             "application/x-compressed" => "zip",
                             "application/x-zip-compressed" => "zip",
                             "application/zip" => "zip",
                             "multipart/x-zip" => "zip",
                            );
    $type_to_extension = array("gzip" => ".tar.gz",
                               "bzip" => ".tar.bz2",
                               "tar"  => ".tar",
                               "zip"  => ".zip",
                              );
    // XXX: The Deltik Organization has been stymied as to why files are still
    //      successfully uploaded even when PHP returns error value 4. For this
    //      reason, UPLOAD_ERR_NO_FILE are accepted until somebody figures out
    //      why in the world PHP reports a failure to upload when everything is
    //      working as it should. :\
    if ($_FILES['file']['error'] == 0 || /*XXX*/$_FILES['file']['error'] == 4/*XXX*/)
      {
      // Use third-party class "TAR File Manager"
      include_once ("classes/tar.php");
      $archive_type = $mimes_supported[$_FILES['file']['type']];
      if (!$archive_type)
        {
        log2log_debug_warning("core", "File type not supported!");
        }
      else
        {
        // Set up a working environment for the archive.
        // Don't get lost; save where we are before it's too late!
        $dir_cur = getcwd();
        // Path to Default Temporary Directory
        $tmp = sys_get_temp_dir();
        // Move to the temporary work environment.
        chdir($tmp);
        
        // Unique ID
        $file_id = uniqid("log2log-").$type_to_extension[$archive_type];
        file_put_contents($file_id, file_get_contents($_FILES['file']['tmp_name']));
        
        // Have the archive class open up the archive
        $archive = new tar();
        if ($archive_type == "gzip")
          $archive->openTar($file_id, TRUE);
        elseif ($archive_type == "tar")
          $archive->openTar($file_id, FALSE);
        else
          die("<html><head><title>Help! - Deltik</title></head><body><em>The Deltik Organization has issued the following message to you:</em><p>HELP US! You have sent to Log2Log a file type that we would like to support but currently don't support. This is a very popular file type, and it would be a shame not to be able to support it. If you would like to assist us in making compatibility with <strong>$archive_type</strong>, contact Deltik at <a href=\"mailto:webmaster@deltik.org\">webmaster@deltik.org</a>.</p></body></html>");
        
        // Make the Log2Log arrayed file-directory structure
        foreach ($archive->files as $key => $info)
          {
          $from_data[$info['name']] = $info['file'];
          }
        
        // Return the final imported "from" data
        return $from_data;
        }
      }
    
    // Failed to import selected data...
    return false;
    }
  
  // Export Converted Data into Archive
  //  Usage: $OBJECT_VAR->export(ARRAY{DIRECTORY_STRING, CONTENT_STRING});
  public function export($log_export)
    {
    // Don't get lost; save where we are before it's too late!
    $dir_cur = getcwd();
    // Path to Default Temporary Directory
    $tmp = sys_get_temp_dir();
    // Unique Temporary Directory Name
    $tmproot = uniqid("log2log-");
    // Final Base Path of Temporary Log Structure and Data
    $tmp = $tmp."/".$tmproot;
    // Make the Final Base Path
    chdir("/");
    mkdir("./".$tmp, 0777, true);
    
    // Store Array Data into Real Temporary Files
    foreach ($log_export as $log_file_path => $log_file_data)
      {
      chdir($tmp);
      $path_parts = pathinfo($log_file_path);
      @mkdir($path_parts["dirname"], 0777, true);
      chdir($path_parts["dirname"]);
      file_put_contents($path_parts["basename"], $log_file_data);
      }
    chdir($dir_cur);
    
    // Make an Archive out of the Real Files
    // Use third-party class "TAR File Manager"
    include_once ("classes/tar.php");
    $archive = new tar();
    $filename = "log2log-".date("Y-m-d_H-i-s_OT").".tar.gz";
    chdir($tmp);
    foreach ($log_export as $log_file_path => $log_file_data)
      {
      $path_parts = pathinfo($log_file_path);
      chdir($tmp);
      $archive->addFile($path_parts['dirname']."/".$path_parts['basename']);
      }
    $archive->toTar($filename, true);
    
    // Force-download the archive, if possible.
    if (!headers_sent())
      {
      header("Content-Type: application/x-gzip");
      header("Content-Disposition: attachment; filename=\"$filename\"");
      header("Content-Length: ".strlen(file_get_contents($filename)));
      header("Content-Transfer-Encoding: binary");
      header("Cache-Control: no-cache, must-revalidate, max-age=60");
      header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
      readfile($filename);
      die();
      }
    else
      {
      log2log_debug_error("core", "Could not initiate download; headers already sent.");
      }
    }
  
  // Output Theme
  //  Usage: $OBJECT_VAR->display();
  public function display()
    {
    if (!include ("themes/".LOG2LOG_THEME."/index.php"))
      {
      die("<div style=\"background: pink; border: red groove;\"><center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>Log2Log cannot load the theme execution file!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.</div>");
      }
    }
  
  // Load Theme Information
  //  Usage: $OBJECT_VAR->theme();
  public function theme()
    {
    if (!include ("themes/".LOG2LOG_THEME."/theme.php"))
      {
      return false;
      }
    }
  }

// Autoload
//  Usage: (none)
function __autoload($class)
  {
  if (file_exists("formats/$class.php"))
    include_once ("formats/$class.php");
  elseif (file_exists("classes/$class.php"))
    include_once ("classes/$class.php");
  else
    return false;
  }

// Standardize Date String for PHP
//  Usage: standardizeStrToTime(FORMAT, STRING_DATE);
//  Example: standardizeStrToTime("l, Y F d (H:i:s)", "Wednesday, 2010 June 30 (16:43:17)");
//  Returns: TIMESTAMP
function standardizeStrToTime($format, $date)
  {
  $format_characters = array("d", "j", "D", "l", "S", "z", "F", "M", "m", "n", "Y", "y", "a", "A", "g", "h", "G", "H", "i", "s", "u", "e", "O", "P", "T", "U");
  $format_cruft = str_replace($format_characters, "", $format);
  $format_cruft_array = str_split($format_cruft);
  
  $format_nice = str_split(str_replace($format_cruft_array, "", $format));
  
  $date_proc = $date;
  $date_nice = array();
  foreach ($format_cruft_array as $format_cruft_item)
    {
    $cruft_pos = strpos($date_proc, $format_cruft_item);
    if ($cruft_pos > 0)
      $date_nice[] = substr($date_proc, 0, $cruft_pos);
    $date_proc = substr_replace($date_proc, "", 0, $cruft_pos+1);
    }
  
  if (count($format_nice) != count($date_nice))
    return false;
  
  $combined_nice = array();
  foreach ($format_nice as $key => $format_item)
    {
    $combined_nice[$format_item] = $date_nice[$key]; 
    }
  $d = $combined_nice;
  
  // TODO: Compatibility with all $format_characters
  
  // XXX: Only compatible with Meebo timestamps
  $return = strtotime("{$d['m']}-{$d['F']}-{$d['Y']} {$d['H']}:{$d['i']}:{$d['s']}");
  
  return $return;
  }

// Set Time Zone
//  Usage: setTimeZone(STRING_TIMEZONE);
function setTimeZone($timezone)
  {
  $timezones = DateTimeZone::listAbbreviations();
  if ($timezones[strtolower($timezone)])
    {
    $timezone = $timezones[strtolower($timezone)][0]['timezone_id'];
    $succeeded = date_default_timezone_set($timezone);
    if ($succeeded)
      {
      log2log_debug_info("core", "Successfully tentatively set the timezone to $timezone");
      }
    else
      {
      log2log_debug_warning("core", "Was unable to set the timezone to $timezone");
      }
    }
  elseif (date_default_timezone_set($timezone))
    {
    log2log_debug_info("core", "Successfully set the timezone to $timezone");
    }
  else
    {
    log2log_debug_warning("core", "Was unable to set the timezone to ".$timezone);
    }
  }

// Hexadecimal to String
//  Usage: hextostr(STRING_HEXADECIMAL);
function hextostr($x)
  { 
  $s = '';
  foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
    $s .= chr(hexdec($h));
  return $s;
  } 

// String to Hexadecimal
//  Usage: strtohex(STRING);
function strtohex($x)
  { 
  $s = '';
  foreach (str_split($x) as $c)
    $s .= sprintf("%02X", ord($c));
  return $s;
  }

// Line Indent
//  Usage: indent(STRING, INT_SPACES);
function indent($string, $num_of_spaces)
  {
  $string_split = explode("\n", $string);
  unset($spaces);
  for ($i = 0; $i < $num_of_spaces; $i ++)
    $spaces .= " ";
  foreach ($string_split as $key => $string_line)
    {
    $string_split[$key] = $spaces.$string_line;
    }
  return implode("\n", $string_split);
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

// Safe Define
//  Usage: autodefine(CONSTANTNAME, DATA_FINAL);
function autodefine($constant_name, $data, $case_insensitive = false)
  {
  if (!defined($constant_name))
    define($constant_name, $data, $case_insensitive);
  }

// Log Information
//  Usage: log2log_debug_info(STRING_EXECUTOR, STRING_LOGDATA);
function log2log_debug_info($executor, $data)
  {
  global $LOG2LOG_info;
  $LOG2LOG_info[] = "$executor: $data";
  }

// Log Warnings
//  Usage: log2log_debug_warning(STRING_EXECUTOR, STRING_LOGDATA);
function log2log_debug_warning($executor, $data)
  {
  global $LOG2LOG_warning;
  $LOG2LOG_error[] = "$executor: $data";
  }

// Log Errors
//  Usage: log2log_debug_error(STRING_EXECUTOR, STRING_LOGDATA);
function log2log_debug_error($executor, $data)
  {
  global $LOG2LOG_error;
  $LOG2LOG_error[] = "$executor: $data";
  }

/**************\
| DATA CAPTURE |
\**************/

// Time Zone Detector
//  Usage: ?timezone=TIMEZONE
if ($_REQUEST['timezone'])
  {
  setTimeZone($_REQUEST['timezone']);
  }

// Log2Log Image
//  Usage: ?serviceicon=log2log
if ($_REQUEST['serviceicon'])
  {
  header("Content-type: image/png");
  die (file_get_contents("images/services/{$_REQUEST['serviceicon']}.png"));
  }

// Temporary Debug Log Output
//  Usage: ?debug=DEBUGLOG_FILENAME
if ($_REQUEST['debug'])
  {
  $tmp = sys_get_temp_dir();
  $data = @file_get_contents($tmp."/".$_REQUEST['debug']);
  $data_checks = explode("\n", $data);
  if (!$data || $data_checks[0] != "[Log2Log Chat Log Converter]")
    {
    die ("ERROR: Temporary debug log not found! It might have been deleted already.");
    }
  if ($data_checks[1] == "null")
    {
    die ("No data.");
    }
  $log = @json_decode($data_checks[1], true);
  if (!$log)
    {
    die ("ERROR: Temporary debug log is corrupt or invalid! This should not happen and is a rare error usually caused by human intervention of the log file.");
    }
  
  # Parse.
  foreach ($log as $log_item)
    {
    echo "<li>$log_item</li>";
    }
  
  # It's over.
  die();
  }

?>
