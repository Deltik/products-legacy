This script originaly only contained index.php with a built in update feature and on/offline.gif.
It was written by ZAPPERPOST (http://www.deltik.org/user.php?id.1), Webmaster of Deltik (http://www.Deltik.org)

This script has been re-written and modified by JRD (jrdgames@gmail.com), Webmaster of J,R,D, Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)
This script now has more functionality, it can now produce server status on a webpage or in an image, 
it also has the capability to update itself when update.php is viewed or ?systemupdate=nowplease is appended to the end of either index.php or img.php, 
it will only update files that have been specified by the update server and, unless stated otherwise in serverprefs.php, 
it will make backups of the updated files incase a rollback is neccessary.
All files have comments to explain what is going on.
Make sure the folder containing img.php is chmoded to 777.

Current files and features:
index.php
	-Get status of IMW servers on a custom port or the default.
	-Get status of custom servers on a custom port or the default.
	-Change to update.php.
img.php
	-Get status of IMW servers on a custom port or the default.
	-Default status for default servers is saved for quick retrieval and will last for
	 one hour unless a forced update is requested by appending ?update=1 to the end of the url.
	-Get status of custom servers on a custom port or the default.
	-Run update.php in silent mode.
update.php
	-Checks to see if there are any updates available.
	-If backups are wanted:
		-Makes sure there is a backup directory.
		-Makes a sub-directory for new backups.
		-Backs up current files before updating.
	-Lists updated files.
	-Shows success or failure on updateable files.
	-Updates files, looping through files that need to be updated.
config.php
	-Holds variables for centralization.
	-Node list is set here.
	-Disabled node list is set here.
serverprefs.php
	-Contains server specific variables.
	-All variables from config.php can be customised here.
	-Not updated by update.php unless absolutely neccessary.
ver.txt (Update server only)
	-Contains version number on line one.
	-Contains any files that need updating, each on its own line.
	-Files to be listed as "file.ext.latest".
