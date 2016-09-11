<?php
/*********************************************************************************
** Original script created by ZAPPERPOST (http://www.deltik.org/user.php?id.1),		**
** Webmaster of Deltik (http://www.Deltik.org)								**
** Config file added to centralize common variables by JRD (jrdgames@gmail.com),		**
** Webmaster of J'R'D' Ltd (http://www.jrdltd.ath.cx, http://www.jrdltd.ismywebs.com)	**
*********************************************************************************/
// Settings
$im_file = 'status.png';// Filename to save the status image to
$defaultport = 80;// Default port to use
$nodelist = array(// List of nodes to use. NOTE: the KEY should be equal to the node number
	1 => 'IsMyWebsite.com',
	2 => 'IsMyHost.com',
	3 => 'IsMyWs.com',
	4 => 'IsNumberOne.org',
	5 => 'IsMyWe.com',
	6 => 'IsMyWb.com',
	7 => 'IsMyHost.net',
	8 => 'IsMyWebs.com',
	9 => 'IsMyWall.com',
	10=> 'IsMyHs.com',
	11=> 'IsMyHt.com',
	12=> 'IsMySe.com',
	13=> 'IsMySi.com',
	14=> 'IsMySt.com',
	15=> 'IsMyWi.com',
	16=> 'IsMyWt.com',
	);
$disablednodelist = array(2, 3, 4, 13);// List of nodes that are disabled, the order does not matter
$currentversion = '0.5.0';// Current version of the IsMyWebsite Status checker.
/* DEMO MODE */#$update = 'http://www.deltik.org/Deltik/';// Base for all update files

require_once('serverprefs.php');// This require includes server specific information, please keep at the bottom of config.php
?>
