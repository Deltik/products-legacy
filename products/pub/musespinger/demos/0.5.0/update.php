<?php
/*********************************************************************************
** Original script created by ZAPPERPOST (http://www.deltik.org/user.php?id.1),		**
** Webmaster of Deltik (http://www.Deltik.org) ** Made into a separate file that can		**
** individually update the nodelist or any of the other files by JRD (jrdgames@gmail.com),	**
** Webmaster of J'R'D' Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)	**
*********************************************************************************/
// Settings
if($silent != true) {
	require_once('config.php');
}
error_reporting(0);//E_WARNING
$cur = $currentversion;// Current version moved to config.php incase it is needed in other places
$ver = file($update.'ver.txt', FILE_IGNORE_NEW_LINES);//file_get_contents($update.'ver.txt');
$files = $ver;// This is the list of files
unset($files['0']);// Remove the version from the file list

if($ver != FALSE && version_compare($ver['0'], $cur, '>')) {// We need to update...(float)$ver['0'] > (float)$cur
	if($silent != true) {
		echo ("There is an update for the IsMyWebsite Server Status Checker:<br/>Current Version: ".$cur."<br/>Latest Version: ".$ver['0']."<br/><br/>");
	}
	if(is_writable('index.php')) {// We are going to update...
		if($silent != true) {
			echo 'Running automatic update...';
		}
		if($bou == true) {// If we are allowed to make backups...
			if(!is_dir($backpath)) {
				mkdir($backpath);// If the backup path doesn't exist, create it
			}
			if(!is_dir($backpath.'/'.$backdir)) {
				mkdir($backpath.'/'.$backdir);// If the backup dir we need doesn't exist, create in
			}
			$backloc = $backpath.'/'.$backdir.'/';// Join the backpath and the backdir into an easier to use string
		}
		foreach($files as $num => $file) {// Take the files one at a time
			$file = rtrim($file);// Remove white space from file
			$fname = substr($file, 0, -7);// Get filename by removing file extension
			$error = '<span style="color: #FF0000"><b>[FAILED]</b> Error: Unable to copy '.$fname.'!</span>';// Set the error message
			if($silent != true) {
				echo "<br />$num. Downloading $fname...";
			}
			if(copy($update.$file, $file.'.tmp')) {// Download the new file and hold it temporarily
				if(copy($fname, $backloc.$fname)) {// Backup the current file
					if(copy($file.'.tmp', $fname) && unlink($file.'.tmp')) {// Put the new file in place (Rename would not work when the file already existed so we have to use copy and then delete the temporary file)
						if($silent != true) {
							echo '<br /><span style="color: #00CC00"><b>[SUCCESS]</b> Update of '.$fname.' completed.</span>';
						}
					} else {
						if($silent != true) {
							echo $error;
						}
					}
				} else {
					if($silent != true) {
						echo $error;
					}
				}
			} else {
				if($silent != true) {
					echo $error;
				}
			}
		}
	} else {// We can't update...
		if($silent != true) {
			echo 'Unable to write to file. Please CHMOD this to 777 and try again. This current version will still work.';
		}
	}
} else {// There are no updates...
	if($silent != true) {
		echo "There are no updates available for the IsMyWebsite Server Status Checker.";
	}
}
?>