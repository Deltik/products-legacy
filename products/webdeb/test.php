<?php
/****************\
|     WebDeb     |
| Testing Script |
\****************/

# INITIALIZATION
include_once ("core.php");

# `DEB` CONFIGURATION
$deb['file'] = "test.deb";

# `AR` CONFIGURATION
$ar['global_header'] = "!<arch>\n";

# `DEB` PROCESS
// Initialize the `AR` class.
$Ar = new Ar();

// Load the Debian file.
if (!file_exists($deb['file']))
  {
  error(404, "The specified Debian package declared in variable \$deb['file'] = {$deb['file']} doesn't exist.");
  }
  else
  {
  $pkg_raw = file_get_contents($deb['file']);
  }

// Make sure it's a valid AR archive.
if (substr($pkg_raw, 0, strlen($ar['global_header'])) != $ar['global_header'])
  {
  error(415, "The specified Debian package does not begin with the valid AR global header, <code>{$ar['global_header']}</code>");
  }

// Me: Get rid of the header.
// You: What? Why?!
// Me: Because we don't need it anymore, silly!
$pkg_headless = substr_replace($pkg_raw, "", 0, strlen($ar['global_header']));

// Please note that this is a DEB reader, not an AR reader.
// If you want an AR reader, try <http://pear.php.net/package/File_Archive/>.
// This next part will check the AR archive for the signature debian-binary.

// Read the first file entry.
$entry_first_proc = $Ar->readEntry($pkg_headless);
// Make sure it's "debian-binary" and contains "2.0".
if ($entry_first_proc['file_name'] != "debian-binary" || $entry_first_proc['data'] != WEBDEB_VERSION_DEB)
  {
  error(415, "The first file in the specified Debian package does not begin with <code>debian-binary</code> containing the supported Debian package version, <code>".WEBDEB_VERSION_DEB."</code>.");
  }

// There are two more files in a valid DEB file:
//  - The `control` file
//  - The `data` file
// Try to get and verify both.

// Read the rest of the files, going on the assumption that the file is DEB.
$entry_second_proc = $Ar->readEntry($entry_first_proc['remainder']);
$entry_third_proc = $Ar->readEntry($entry_second_proc['remainder']);
if (!$entry_second_proc || !$entry_third_proc)
  {
  error(415, "There are not three files as required in a valid Debian package.");
  }
// Make sure the file names at least start correctly.
if (substr($entry_second_proc['file_name'], 0, 8) == "control.")
  {
  $control_proc = $entry_second_proc;
  if (substr($entry_third_proc['file_name'], 0, 5) == "data.")
    {
    $data_proc = $entry_third_proc;
    }
    else
    {
    error(415, "The control and data files were not found in the specified Debian package.");
    }
  }
elseif (substr($entry_second_proc['file_name'], 0, 5) == "data.")
  {
  $data_proc = $entry_second_proc;
  if (substr($entry_third_proc['file_name'], 0, 8) == "control.")
    {
    $control_proc = $entry_third_proc;
    }
    else
    {
    error(415, "The control and data files were not found in the specified Debian package.");
    }
  }
else
  {
  error(415, "The control and data files were not found in the specified Debian package.");
  }

// Verify the mime types of the files.
if (!in_array($control_proc['mime'], $mimes_supported) || !in_array($data_proc['mime'], $mimes_supported))
  {
  error(415, "The mime types of the control file or data file are not supported by WebDeb.");
  }

// Self-Explanatory: Do Everything Else For Me To Get A File List And Data
$control_array = doEverythingForMeToGetAFileListAndData($control_proc);
$data_array = doEverythingForMeToGetAFileListAndData($data_proc);

// Identify the control file.
foreach ($control_array as $key => $control_item)
  {
  if ($control_item['name'] == "./control")
    {
	$control_key = $key;
	break;
	}
  }

// Read control data.
$control_file_array = readControlFile($control_array[$control_key]['file']);

echo "<code style=\"color: orange;\"><pre>";
print_r($control_file_array);
echo "</pre></code>";
die();

// Test throwing errors
error();

?>
