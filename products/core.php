<?php

// Load Configuration File
include_once ("config.php");

// Start the global SQL connections
//  Leech CMS's connection
$CMS_sql = new Sql($sql['type'], $sql['user'], $sql['pass'], $sql['host'], $sql['pref'], $sql['base']);
//  My Deltik's connection
$MY_sql = new Sql($mydb['type'], $mydb['user'], $mydb['pass'], $mydb['host'], $mydb['pref'], $mydb['base']);

// Start the leech CMS accessor class
eval('$LEECH = new '.$LEECH_class.'($CMS_sql->handle, $sql[\'base\'], $sql[\'pref\']);');

/***********\
| FUNCTIONS |
\***********/

// Autoload
//  Usage: (none)
function __autoload($class)
  {
  include_once ("../my/classes/$class.php");
  }

/**********\
| CATCHERS |
\**********/
if ($_REQUEST['action'] == "status")
  {
  $nodes_resource = $MY_sql->query("SELECT * FROM `nodes` WHERE `id` = ".$_REQUEST['id']);
  if (mysql_error($MY_sql->handle))
    header("Location: images/status/offline.gif");
  $nodes = $MY_sql->r2array($nodes_resource);
  $node = $nodes[0];
  $result = file_get_contents("");
  die();
  }

?>
