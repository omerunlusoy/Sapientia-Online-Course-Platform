<?php

include("connect.php");


if(isset($_POST['but_upload'])){
    $maxsize = 5242880; // 5MB
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
        $name = $_FILES['file']['name'];

        $cur_dir = getcwd();
        $target_dir = $cur_dir . "/upload/" ;
        $target_file = $target_dir . $_FILES["file"]["name"];
        $target_dir2 =  "upload/" ;
        $target_file2 = $target_dir2 . $_FILES["file"]["name"];
        session_start();
        $_SESSION['target_file'] = $target_file2;



        // Select file type
        $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

        // Check extension
        if( in_array($extension,$extensions_arr) ){

            // Check file size
            if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                $_SESSION['message'] = "File too large. File must be less than 5MB.";
            }else{
                // Upload

                if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
                    // Insert record
                    header("location: add_lecture.php");
                }



            }

        }else{
            $_SESSION['message'] = "Invalid file extension.";
        }
    }else{
        $_SESSION['message'] = "Please select a file.";
    }
    //header('location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
    <title>Upload and Store video to MySQL Database with PHP</title>
</head>
<body>

<!-- Upload response -->
<?php
if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<form method="post" action="" enctype='multipart/form-data'>
    <input type='file' name='file' />
    <input type='submit' value='Upload' name='but_upload'>
</form>

</body>
</html>