<?php
/*********************************************************************************
** Original script created by ZAPPERPOST (http://www.deltik.org/user.php?id.1),		**
** Webmaster of Deltik (http://www.Deltik.org) 		** This file holds preferences		**
** that are unique to this server, made by JRD (jrdgames@gmail.com),				**
** Webmaster of J'R'D' Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)	**
*********************************************************************************/
/*****************************************************************
** Any variable in config.php can be overridden here.			 	**
** This file will not be changed by updates.						**
** Instead you will be notified if there are any changes for this file.	**
*****************************************************************/
// Set to true to make the files be backed up whenever an update is done.
// Set to false to not make backups. Backups will be placed in dated directories
$bou = true;// Backup On Update, true or false
$backpath = 'backups';// Directory where you want backups to be stored. Remember, no trailing slash.
$backdir = date("m-d-y");// Name template for the directory that will be made when backups are taken. Remember, no trailing slash.
// There are multiple update servers, Here you can choose the one you want to use
// Uncomment the line below for the server you would like to use
//$update = 'http://www.deltik.org/Deltik/';// (Default) 
// $update = 'http://imw-status.jrdltd.ismywebs.com/';
?>