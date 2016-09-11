<?php

// Initialize Software
include_once ("core.php");

//$MY_sql->focus($mydb['base']);
$projects_resource = $MY_sql->query("SELECT * FROM `projects` ORDER BY `name`"); //die(print_r($MY_sql->error($MY_sql->handle)));
$projects = $MY_sql->r2array($projects_resource);

// Display Header
echo '<!DOCTYPE html>
<html>
<head>
 <title>Products - Deltik</title>
</head>
<body>';

// Projects List Header
echo "<table width=\"100%\">
 <thead>
  <th>Name</th>
  <th>Summary</th>
  <th>Owner</th>
  <th>Version</th>
  <th>Status</th>
  <th>Release</th>
 </thead>
 <tbody>
";

// Find Unlisted Projects
$handle = opendir("pub");
while ($file = readdir($handle))
  {
  if ($file != "." && $file != ".." && is_dir("pub/".$file))
    {
    $dont_list = false;
    foreach ($projects as $project)
      {
      if ($project['name_unix'] == $file)
        {
        $dont_list = true;
        break;
        }
      }
    if (!$dont_list)
      $projects_unlisted[] = $file;
    }
  }
foreach ($projects_unlisted as $project_unlisted)
  {
  $projects[] = array(//"id" => 0,
                      "name" => "<code>$project_unlisted</code>",
                      "name_unix" => $project_unlisted,
                      "summary" => "<em>This project has no summary description included.</em>",
                      "description" => "<em>This project has no description included.</em>",
                      "version" => "",
                      "created" => filectime("pub/$project_unlisted"),
                      "activity" => -2
                      );
  }

// Go through each project...
foreach ($projects as $project)
  {
  // Determine the Project Owner
  $user_owner_resource = $MY_sql->query("SELECT `id_user` FROM `projects_members` WHERE `id_project` = ".$project['id']." AND `permissions` = 5");
  $user_owner_id = @$MY_sql->r2array($user_owner_resource);
  $user_owner_id = $user_owner_id[0]['id_user'];
  $user_owner = $LEECH->listUsers(array('id' => $user_owner_id));
  $username_owner = $user_owner[0]['username'];
  if (!$username_owner) $username_owner = "</a><em>(unknown)</em><a>";
  
  // Correspond Activity Code
  switch ($project['activity'])
    {
    case -9: $status = "<span style=\"color: darkgray;\">Terminated</span>"; break;
    case -5: $status = "<span style=\"color: gray;\">Suspended</span>"; break;
    case -2: $status = "<span style=\"color: purple;\">Unlisted</span>"; break;
    case -1: $status = "<span style=\"font-weight: bold;\">Up For Adoption</span>"; break;
    case 0:  $status = "<span style=\"color: red;\">Inactive</span>"; break;
    case 1:  $status = "<span style=\"color: gold;\">Planning</span>"; break;
    case 2:  $status = "<span style=\"color: orange;\">Improving</span>"; break;
    case 3:  $status = "<span style=\"color: green;\">Promoting</span>"; break;
    case 4:  $status = "<span style=\"color: blue;\">Expanding</span>"; break;
    default: $status = "<em>(unknown)</em>"; break;
    }
  
  // Determine Release
  if (file_exists("pub/{$project['name_unix']}"))
    {
    $release = "<a href=\"pub/{$project['name_unix']}/\">Released</a>";
    }
  else
    {
    $release = "Unreleased";
    }
  
  // Determine Demo Link
  $name = $project['name_unix'];
  if (file_exists("pub/$name/demos/latest"))
    {
    $name = "<a href=\"pub/$name/demos/latest/\">{$project['name']}</a>";
    }
  elseif (file_exists("pub/$name/demos"))
    {
    $name = "<a href=\"pub/$name/demos/\">{$project['name']}</a>";
    }
  else
    {
    $name = $project['name'];
    }
  
  // Display Project Row
  echo "  <tr>
   <td>$name</td>
   <td>{$project['summary']}</td>
   <td><a href=\"http://www.deltik.org/user.php?id.$user_owner_id\" target=\"_blank\">$username_owner</a></td>
   <td>{$project['version']}</td>
   <td>$status</td>
   <td>$release</td>
  </tr>";
  }
echo " </tbody>
</table>
";

// Ad-hoc Old Products Page
echo '<p style="font-size: 10px;"><a href="index.old.php">Old Products List</a></p>';

// Display Footer
echo '</body>
</html>';

?>
