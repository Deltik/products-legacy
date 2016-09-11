<?php

/************************************\
|              IsMyChat              |
|        Core File (core.php)        |
|------------------------------------|
| Version: 0.0.1 PRE-ALPHA           |
| By: Deltik (webmaster@deltik.org)  |
|     iJames (riffy888@gmail.com)    |
| Website: http://ismychat.be.ma/    |
|   1) http://www.deltik.org/        |
|   2) http://clubpenguinrush.com/   |
\************************************/

/*******************\
| System Initiation |
\*******************/

// Get configuration
include_once ("config.php");

// VERSION
$system['version'] = "0.0.1a-nightly1";

// Initiate SQL
$sql_resource = startSQL($sql['type'], $sql['user'], $sql['pass'], $sql['base'], $sql['host'], $sql['pref']);

// Load more configuration stored in the database
$prefs = query("SELECT * FROM `".SQL_PREFIX."configuration`");
$prefs = SQLArray($prefs);
foreach ($prefs as $name => $data)
  {
  eval('$system[\''.$name.'\'] = "'.$data.'";');
  }

// Set universal time zone
date_default_timezone_set('GMT');

// Security definition
$definition = $system['definition'];
define($definition, true);

/*********************\
| Load System Classes |
\*********************/
// Open the system bin
$path = $system['class']."/";
$dir_handle = @opendir($path) or die("<center><h1 style=\"color:red;\">FATAL ERROR!</h1><h2>$title cannot load the core classes directory!</h2></center><p>Contact the webmaster at ".$_SERVER['SERVER_NAME']." and report this error so that it may be fixed.");
// Autoload
//  Usage: (null)
if (!function_exists('__autoload'))
  {
  function __autoload($class_name)
    {
    global $system, $definition;
    include_once $system['class']."/".$class_name.'.php';
    }
  }
$start = new System();

/*************\
| SQL Classes |
\*************/

// Start SQL
//  Usage: startSQL(TYPE, USERNAME, PASSWORD, DATABASE, SERVER, PREFIX);
function startSQL($sql_type = "mysql", $sql_user = "root", $sql_pass = "", $sql_base = "root", $sql_src = "localhost", $sql_prefix = "")
  {
  if ($sql_type = "mysql")
    {
    $sql_resource = mysql_connect($sql_src, $sql_user, $sql_pass);
    mysql_select_db($sql_base);
    }
  query("USE $sql_base");
  define("SQL_TYPE", $sql_type);
  define("SQL_PREFIX", $sql_prefix);
  define("SQL_RESOURCE", $sql_resource);
  return $sql_resource;
  }

// SQL Query
//  Usage: query(SQL_COMMAND);
function query($command)
  {
  if (!SQL_TYPE)
    {
    return false;
    }
  if (SQL_TYPE == "mysql")
    {
    return mysql_query($command);
    }
  if (SQL_TYPE == "pgsql")
    {
    echo "ERROR! PostgreSQL is not supported yet!";
    }
  }

// SQL To Array
//  Usage: SQLArray(RESULT_RESOURCE);
function SQLArray($resource)
  {
  $result_raw = $resource;
  $i = 0;
  while ($row = mysql_fetch_assoc($result_raw))
    {
    $array[$i] = $row;
    $i ++;
    }
  if (count($array[0]) == 2)
    {
    foreach ($array as $iteration => $array_a)
      {
      $i = 0;
      foreach ($array_a as $name => $data)
        {
        $title[$i] = $name;
        $i ++;
        }
      $array2[$array_a[$title[0]]] = $array_a[$title[1]];
      }
    $array = $array2;
    }
  elseif (!$array[1])
    {
    $array = $array[0];
    }
  return $array;
  }

?>
