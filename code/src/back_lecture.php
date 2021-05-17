<?php


include("connect.php");

session_start();
$section = $_SESSION['section'];
$content_num = $_SESSION['content_num'];
$CID = $_SESSION['CID'];
$SID = $_SESSION['SID'];

$content_num = $_SESSION['content_num'];
if($content_num == 1){
    header("location: contents.php");
}
else{
    $_SESSION['content_num'] = $content_num - 1;
    header("location: lecture.php");
}


?>