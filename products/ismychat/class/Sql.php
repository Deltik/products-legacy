<?php
if(!defined($definition)){die("H4X0R PR3V3NT!0N");}

/************\
| Class: Sql |
\************/

class Sql
  {
  // Variables
  private $handle = '';
  private $type = '';
  public $prefix = '';
  
  // Constructor
  //  Usage: $OBJECT_VAR = new Sql();
  public function __construct()
    {
    include ("config.php");
    $sql_type = $sql['type'];
    $this->type = $sql_type;
    $sql_host = $sql['host'];
    $sql_base = $sql['base'];
    $sql_user = $sql['user'];
    $sql_pass = $sql['pass'];
    $this->prefix = $sql['prefix'];
    
    if ($sql_type == "mysql")
      $this->handle = mysql_connect($sql_host, $sql_user, $sql_pass);
    if ($sql_type == "pgsql")
      $this->handle = pg_connect("host=$sql_host dbname=$sql_base user=$sql_user password=$sql_pass");
    
    $this->query("USE $sql_base");
    }
  
  // Query
  //  Usage: $OBJECT_VAR->query(QUERY);
  public function query($query)
    {
    if ($this->type == "mysql")
      return mysql_query($query, $this->handle);
    if ($this->type == "pgsql")
      return pg_query($this->handle, $query);
    }
  
  // Query (alias)
  //  Usage: $OBJECT_VAR->q(QUERY);
  public function q($query)
    {
    return $this->query($query);
    }
  
  // SQL Fetch Association Array
  //  Usage: $OBJECT_VAR->fetch_assoc(RESOURCE);
  public function fetch_assoc($result)
    {
    if ($this->type == "mysql")
      $array = mysql_fetch_assoc($result);
    if ($this->type == "pgsql")
      $array = pg_fetch_assoc($result);
    return $array;
    }
  
  // SQL Result Resource to Array
  //  Usage: $OBJECT_VAR->r2Array(RESOURCE);
  public function r2Array($result)
    {
    if ($this->type == "mysql")
      while ($array[] = mysql_fetch_assoc($result));
    if ($this->type == "pgsql")
      while ($array[] = pg_fetch_assoc($result));
    array_pop($array);
    return $array;
    }
  
  // SQL Table to Array
  //  Usage: $OBJECT_VAR->t2Array(TABLE);
  public function t2Array($table)
    {
    $result = query("SELECT * FROM `$table`");
    if ($this->type == "mysql")
      while ($array[] = mysql_fetch_assoc($result));
    if ($this->type == "pgsql")
      while ($array[] = pg_fetch_assoc($result));
    array_pop($array);
    return $array;
    }
  
  // SQL Number of Rows
  //  Usage: $OBJECT_VAR->num_rows(RESOURCE);
  public function num_rows($resource)
    {
    if ($this->type == "mysql")
      return mysql_num_rows($resource);
    if ($this->type == "pgsql")
      return pg_num_rows($resource);
    }
  
  // SQL Escape String
  //  Usage: $OBJECT_VAR->es(STRING);
  public function es($string)
    {
    if ($this->type == "mysql")
      return mysql_real_escape_string($string);
    elseif ($this->type = "pgsql")
      return pg_escape_string($string);
    else
      return addslashes($string);
    }
  
  // SQL Error
  //  Usage: $OBJECT_VAR->error(RESOURCE);
  public function error($result = null)
    {
    if ($this->type == "mysql")
      return mysql_error($result);
    if ($this->type == "pgsql")
      return pg_result_error($result);
    }
  }

?>
