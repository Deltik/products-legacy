<?php
/************\
| Class: Sql |
\************/

class Sql
  {
  // Variables
  public $handle = '';
  public $type = '';
  public $prefix = '';
  public $database = '';
  
  // Constructor
  //  Usage: $OBJECT_VAR = new Sql(TYPE, USERNAME, PASSWORD, SERVER, PREFIX[, DATABASE]);
  public function __construct($sql_type = "mysql", $sql_user = "root", $sql_pass = "", $sql_src = "localhost", $sql_prefix = "", $sql_base = null)
    {
    $this->type = $sql_type;
    $this->prefix = $sql_pref;
    $this->database = $sql_base;
    
    if ($sql_type == "mysql")
      $this->handle = mysql_connect($sql_host, $sql_user, $sql_pass);
    elseif ($sql_type == "pgsql")
      $this->handle = pg_connect("host=$sql_host user=$sql_user password=$sql_pass");
    elseif ($sql_type == "sqlite")
      $this->handle = sqlite_open($sql_base, 0666, $error);
    }
  
  // Query
  //  Usage: $OBJECT_VAR->query(QUERY);
  public function query($query)
    {
    $this->focus($this->database);
    if ($this->type == "mysql")
      return mysql_query($query, $this->handle);
    elseif ($this->type == "pgsql")
      return pg_query($this->handle, $query);
    elseif ($this->type == "sqlite")
      return sqlite_query($this->handle, $query);
    }
  
  // Query (alias)
  //  Usage: $OBJECT_VAR->q(QUERY);
  public function q($query)
    {
    return $this->query($query);
    }
  
  // SQL Select Database
  //  Usage: $OBJECT_VAR->focus(DATABASE_NAME);
  public function focus($database)
    {
    if ($this->type == "mysql")
      return mysql_select_db($database, $this->handle);
    elseif ($this->type == "sqlite")
      return true;
    else
      return mysql_query("USE `$database`", $this->handle);
    }
  
  // SQL Result Resource to Array
  //  Usage: $OBJECT_VAR->r2Array(RESOURCE);
  public function r2Array($result)
    {
    if ($this->type == "mysql")
      while ($array[] = mysql_fetch_assoc($result));
    if ($this->type == "pgsql")
      while ($array[] = pg_fetch_assoc($result));
    elseif ($this->type == "sqlite")
      return sqlite_fetch_array($result, SQLITE_ASSOC);
    array_pop($array);
    return $array;
    }
  
  // SQL Table to Array
  //  Usage: $OBJECT_VAR->t2Array(TABLE);
  public function t2Array($table)
    {
    $result = query("SELECT * FROM `$table`");
    $array = r2array($result);
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
    if ($this->type == "sqlite")
      return sqlite_num_rows($resource);
    }
  
  // SQL Escape String
  //  Usage: $OBJECT_VAR->es(STRING);
  public function es($string)
    {
    if ($this->type == "mysql")
      return mysql_real_escape_string($string);
    elseif ($this->type == "pgsql")
      return pg_escape_string($string);
    else
      return addslashes($string);
    }
  
  // SQL Close
  //  Usage: $OBJECT_VAR->close(RESOURCE);
  public function close($resource = null)
    {
    if ($this->type == "mysql")
      return mysql_close($resource);
    elseif ($this->type == "pgsql")
      return pg_close($resource);
    elseif ($this->type == "sqlite")
      return sqlite_close($resource);
    }
  
  // SQL Error
  //  Usage: $OBJECT_VAR->error(RESOURCE);
  public function error($result = null)
    {
    if ($this->type == "mysql")
      return mysql_error($result);
    elseif ($this->type == "pgsql")
      return pg_result_error($result);
    elseif ($this->type == "sqlite")
      return sqlite_error_string(sqlite_last_error($result));
    }
  }

?>
