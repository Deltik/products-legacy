<?php
/**
 * Loguntu
 *  Settings
 */

// Loguntu Theme
define('LOGUNTU_THEME', "humanome");

// Apparent Version Number
define('LOGUNTU_VERSION', "1.0dev");

// Log2Log Path (with trailing slash)
define('LOGUNTU_LOG2LOG_PATH', "../log2log/");

// SQL Configuration
$sql['type'] = "sqlite";
$sql['user'] = null;
$sql['pass'] = "L0g5*F+W!";
$sql['base'] = dirname(__FILE__)."/sqlite/loguntu.sqlite";
$sql['host'] = null;
$sql['pref'] = "";

// SQL Class Path
define('LOGUNTU_SQLCLASS_PATH', "../../my/classes/Sql.php");

// Navibar
$navi = array("Home" => dirname($_SERVER['PHP_SELF'])."/index.php",
              "Features" => dirname($_SERVER['PHP_SELF'])."/features.php",
              "Login" => dirname($_SERVER['PHP_SELF'])."/login.php",
              );

?>
