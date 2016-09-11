<?php

header("Content-type: text/plain");
//error_reporting(E_ALL);

include ("../classes/Matrix.php");
include ("../classes/MaText.php");

$array1 = array(array(5, 0),
                array(3, 9),
                );

$array2 = array(array(3, 8),
                array(1, 4),
                );

$array3 = array(array(7, 2, 5, 4, 1),
                array(3, 6, -5, 6, 75),
                array(8, 4, 3, 2, 1),
                array(5, 6, 8, 7, 4),
                array(5, 6, 3, 2, 4),
                );

$string1 = base64_encode("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?");
$list1 = array(22, 22, 61, 53, 28, 34, 1, 38, 24, 22, 13, 37);

$generic = new Matrix();
$matrix1 = new Matrix($array);
$matrix2 = new Matrix($array);
$matext  = new MaText();

$something = $generic->determinant($array3);

$something = $matext->makeList($string1);
//$something = $matext->makeText($list1);
$something = $matext->encrypt($array1, $something);
$something = $matext->decrypt($array1, $something);

$something = $matext->makeFile($something);
$something = $matext->readFile($something);

$something = $matext->makeText($something);

var_dump($something);

?>
