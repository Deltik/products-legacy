<?php

/*******************\
| Kweshuner Classes |
\*******************/

/* FUNCTIONS *\

listQuizzes
getQuiz
filterExtention
quizPermissions
quizTitle

\*           */

// List Quizzes
//  Usage: listQuizzes(QUIZ_SOURCE_DIRECTORY);
function listQuizzes($src, $type = "array")
 {
 // Change the directory to the quizzes source
 chdir($src);
 // List the source directory
 $dir_ls = scandir(getcwd());
 // Filter Extentions by PHP
 $dir_ls = filterExtention($dir_ls, "php");
 if ($type == "array")
  return $dir_ls;
 if ($type == "form")
  {
  $form = "\n       <form action=\"".$_SERVER['PHP_SELF']."\">\n        <select name=\"file\" id=\"file\">\n         <option value=\"null\" onclick=\"unloadQuiz();\">Choose a Quiz</option>\n         <option disabled=\"disabled\">--</option>\n";
  foreach ($dir_ls as $file)
   {
   $permissions = quizPermissions($src, $file);
   if ($permissions)
    {
    $form.="         <option onclick=\"loadQuiz(this);\" id=\"$file\">".quizTitle($src, $file)."</option>\n";
    }
   }
  $form.="        </select>\n       </form>\n      ";
  return $form;
  }
 }

// Get Quiz Contents
//  Usage getQuiz(SOURCE, FILENAME);
function getQuiz($src, $file, $type = "array")
 {
 chdir($src);
 $data = file_get_contents($file);
 if ($type == "array")
  $data = explode("\n", $data);
 return $data;
 }

// Filter Extention
//  Usage: filterExtention(DIRECTORY_LISTING_ARRAY, EXTENTION);
function filterExtention($array, $ext)
 {
 $i = 0;
 foreach ($array as $item)
  {
  if (substr($item, -strlen($ext)-1) == ".".$ext)
   {
   $array2[$i] = $item;
   $i++;
   }
  }
 return $array2;
 }

// Quiz Permissions
//  Usage: quizPermissions(SOURCE, FILENAME);
function quizPermissions($src, $file)
 {
 $permissions = true;
 $data = getQuiz($src, $file, "array");
 $infoline = $data[1];
 $infoline = explode("|", $infoline);
 if ($infoline[1] != "open")
  $permissions = false;
 return $permissions;
 }

// Quiz Title
//  Usage: quizTitle(SOURCE, FILENAME);
function quizTitle($src, $file)
 {
 $data = getQuiz($src, $file, "array");
 return $data[2];
 }

?>
