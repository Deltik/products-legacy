<?php

function loadNavi($navigation)
  {
  unset($navibuild);
  foreach ($navigation as $count)
    {
    if ($count[2] == "ajax" || !strpos($count[1], "://") && !$count[2])
      $navibuild.="<a href=\"".$count[1]."\" name=\"ajax\">".$count[0]."</a><br />";
    if ($count[2] == "reload")
      $navibuild.="<a href=\"\" name=\"donthurtme\">".$count[0]."</a><br />";
    if ($count[2] == "iframe")
      $navibuild.="<a href=\"".$count[1]."\">".$count[0]."</a><br />";
    if ($count[2] == "normal" || strpos($count[1], "://") && !$count[2])
      $navibuild.="<a href=\"".$count[1]."\" name=\"nbsp\">".$count[0]."</a><br />";
    }
  return $navibuild;
  }

?>
