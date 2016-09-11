<?php

var_dump(strtohex(pack("f", 11/3)));
var_dump(unpack("f", hextostr("ABAA6A40")));

  function strtohex($x)
    { 
    $s = '';
    foreach (str_split($x) as $c)
      $s .= sprintf("%02X", ord($c));
    return $s;
    }
  function hextostr($x)
    {
    $s = '';
    foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
      $s .= chr(hexdec($h));
    return $s;
    }
?>
