<?php
/*
+ ----------------------------------------------------------------------------+
|     MuSeSPinger
|     Configuration File
|
|     Set your settings in this file.
+----------------------------------------------------------------------------+
*/

// Images
$online = 'online.png';
$offline = 'offline.png';

// Limit number of URLs to test
$limit = 25;

// Local Update Servers (for multiple, add a space in between URLs)
// To disable updates, clear out the update server list or put comment tags before it ("//")
// ENTER A FULL URL! INCLUDE THE PROTOCOL (e.g. "http://") AND THE TRAILING SLASH ("/")
/* DEMO MODE */#$updateservers = 'http://products.deltik.org/musespinger/update/ http://ismywebsite.com/about/musespinger/update/';

// DO NOT MODIFY THE BELOW CODE!!!!!!!!
$updsrv = explode(" ", $updateservers);
// DO NOT MODIFY THE ABOVE CODE!!!!!!!!
?>
