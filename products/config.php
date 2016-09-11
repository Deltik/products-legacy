<?php

##############################
# CONFIGURABLE OPTIONS BELOW #

// e107 Configuration File Location
$e107_config = "../../public_html/e107_config.php";

// Leech Content Management System
$LEECH_class = "e107";

// My Deltik Database Name
$mydb['type'] = "mysql";
$mydb['user'] = "deltik_main";
$mydb['pass'] = "";
$mydb['base'] = "deltik_main";
$mydb['host'] = "localhost";
$mydb['pref'] = "";

# CONFIGURABLE OPTIONS ABOVE #
##############################

// Transfer e107 Configuration to My Deltik
include_once ($e107_config);

// SQL Configuration
$sql['type'] = "mysql";
$sql['user'] = $mySQLuser;
$sql['pass'] = $mySQLpassword;
$sql['base'] = $mySQLdefaultdb;
$sql['host'] = $mySQLserver;
$sql['pref'] = $mySQLprefix;

?>
