<?php


include("connect.php");

session_start();
$section = $_SESSION['section'];
$content_num = $_SESSION['content_num'];
$CID = $_SESSION['CID'];
$SID = $_SESSION['SID'];

$content_num = $_SESSION['content_num'];
$content_num = $content_num + 1;
$exists2_sql = "select * 
                   from Take_Lecture 
                   where SID = '$SID' and CID = '$CID' and section = '$section' and content_num = '$content_num'";

$exists2_result = mysqli_query($con, $exists2_sql);

if ($exists2_result) {
    if ($exists2_result->num_rows > 0) {
        $_SESSION['content_num'] = $content_num;
        header("location: lecture.php");
    }
    else{
        echo "<script type='text/javascript'>alert('This is the last lecture in this section!');</script>";
        header("location: contents.php");
    }
}
else{
    echo "<script type='text/javascript'>alert('Database Error7!');</script>";
}


?>