<?php

$ftp = ftp_connect("automni.com");
ftp_login($ftp, "automni", "*** PASSWORD REMOVED ***");
$list = ftp_nlist($ftp, "/");

for ($i = 0; $i < count($list); $i++)
  {
  if ($list[$i] == ".")
    {
    echo "[Reload]<br />";
    }
  elseif ($list[$i] == "..")
    {
    echo "[Exit Directory]<br />";
    }
  else
    {
    echo $list[$i]."<br />";
    }
  }

?>
