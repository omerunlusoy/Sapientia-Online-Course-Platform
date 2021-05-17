<?php

include("connect.php");

session_start();
$section = $_SESSION['section'];
$content_num = $_SESSION['content_num'];
$CID = $_SESSION['CID'];
$SID = $_SESSION['SID'];

$lecture_sql = "select * 
                from Lecture 
                where CID = '$CID' and section = '$section' and content_num = '$content_num'";

$lecture_result = mysqli_query($con, $lecture_sql);
if($lecture_result){
    if($lecture_result->num_rows == 1){
        $row = mysqli_fetch_array($lecture_result);
        $lecture_title = $row['title'];
        $description = $row['description'];
        $target_file = $row['lecture_content'];
    }
    else{
        echo "<script type='text/javascript'>alert('Database Error1!');</script>";
    }
}
else{
    echo "<script type='text/javascript'>alert('Database Error2!');</script>";
}

$note_sql = "select * 
                from Note 
                where SID = '$SID' and section = '$section' and content_num = '$content_num'";
$note_result = mysqli_query($con, $note_sql);
if($note_result){
    if($note_result->num_rows == 0){
        $initial_note = "";
    }
    else{
        $note_row = mysqli_fetch_array($note_result);
        $initial_note = $note_row['text'];
    }
}
else{
    echo "<script type='text/javascript'>alert('Database Error3!');</script>";
}

$exists_sql = "select * 
                   from Take_Lecture 
                   where SID = '$SID' and CID = '$CID' and section = '$section' and content_num = '$content_num'";
$exists_result = mysqli_query($con, $exists_sql);
if($exists_result->num_rows == 0){
    $take_lecture_sql = "INSERT INTO Take_Lecture (SID, CID, section, content_num, isCompleted)
                     VALUES ('$SID', '$CID', '$section', '$content_num', 1)";
    $take_lecture_result = mysqli_query($con, $take_lecture_sql);
    if(!$take_lecture_result){
        echo "<script type='text/javascript'>alert('Database Error4!');</script>";
    }

    // student completed another lecture

    $take_lecture_sql = "select *
                   from Take_Lecture 
                   where SID = '$SID' and CID = '$CID'";

    $lecture_sql = "select * 
                   from Lecture 
                   where CID = '$CID'";

    $take_lecture_result = mysqli_query($con, $take_lecture_sql);
    $lecture_result = mysqli_query($con, $lecture_sql);

    $progress = 100 * ($take_lecture_result->num_rows) / ($lecture_result->num_rows);

    echo "<script type='text/javascript'>alert($CID);</script>";
    echo "<script type='text/javascript'>alert($SID);</script>";
    echo "<script type='text/javascript'>alert($progress);</script>";


    $sql = "UPDATE Enrolls SET progress = '$progress' WHERE CID = '$CID' and SID = '$SID';";

    $lecture_result = mysqli_query($con, $sql);
    if(!$lecture_result){
        echo "<script type='text/javascript'>alert('Database Error!');</script>";
    }
}





if(isset($_POST['back_button'])){
    header("location: contents.php");
}




if(isset($_POST['note_button'])){
    $note_text = $_POST['note_text'];
    // check if it exists

    if($note_result){
        if($note_result->num_rows == 0) {
            // note exists
            $update_sql = "insert into Note (SID, section, content_num, text)
                            values('$SID', '$section', '$content_num', '$note_text')";
            $update_result = mysqli_query($con, $update_sql);
            if($update_result){
            }
            else{
                echo "<script type='text/javascript'>alert('Database Error5!');</script>";
            }
        }
        else{
            // create new note
            $new_note_sql = "update Note 
                            set text = '$note_text' 
                            where SID = '$SID' and section = '$section' and content_num = '$content_num'";
            $update_result = mysqli_query($con, $new_note_sql);
            if($update_result){
            }
            else{
                echo "<script type='text/javascript'>alert('Database Error6!');</script>";
            }
        }
        header("location: lecture.php");
    }
}






?>

<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Learn Everyday, Join online courses today, Train Your Brain Today!, Learn to enjoy every minute of your life., Online Learning, Innovations in Online Learning, Education and Learning, 01, 02, 03, 04, Contact Us">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Lecture</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Lecture.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.13.2, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">



    <script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "url": "index.html",
            "logo": "images/SapientiaLogo.PNG"
        }</script>
    <meta property="og:title" content="Lecture">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
</head>
<body class="u-body"><header class="u-clearfix u-header u-header" id="sec-85c8"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1" data-image-width="521" data-image-height="202">
            <img src="images/SapientiaLogo.PNG" class="u-logo-image u-logo-image-1" data-image-width="196.129">
        </a>
    </div></header>
<section class="u-clearfix u-section-1" id="sec-104b">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="student_account.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-1">Account</a>
        <a href="student_notifications.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">Nofitications</a>
        <a href="student_my_courses.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-3">My Courses</a>
        <a href="student_fill_complaint.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">Fill a Complaint</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
        <a href="certificates.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-6">Certificates</a>
        <a href="wishlist.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-7">Wishlist</a>
        <a href="student_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-8">Main Page</a>
    </div>
</section>
<section class="u-clearfix u-palette-4-light-2 u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-section-2" id="sec-832e">
    <div class="u-uploaded-video u-video u-video-1">
        <div class="embed-responsive embed-responsive-1">
            <iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" class="embed-responsive-item" src=<?php echo $target_file ?> allowfullscreen="true"></iframe>
        </div>
    </div>

    <h3 class="u-text u-text-1"><?php echo $lecture_title ?></h3>
    <p class="u-text u-text-2"><?php echo $description ?><br>
        <br>
        <br>
        <br></p>

    <div class="u-form u-form-3">



        <form   style="margin-left:350px;" action="#" method="POST ">
            <a href="back_lecture.php" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-3 u-radius-27 u-btn-3">Previous</a>
            <input type="submit" name="previous_button1" value="submit" class="u-form-control-hidden">
        </form>
        <form  style="margin-left:550px; margin-top:-100px; " action="#" method="POST">
            <a href="next_lecture.php" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-3 u-radius-27 u-btn-3">Next</a>
            <input type="submit" name="next_button1" value="submit" class="u-form-control-hidden">
        </form>



        <form action="#" method="POST">
            <div class="u-align-right u-form-group u-form-submit">
                <a href="contents.php" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-3 u-radius-27 u-btn-3">Back to Contents</a>
                <input type="submit" name="back_button" value="submit" class="u-form-control-hidden">
            </div>
        </form>
    </div>

    <div class="u-form u-form-4">
        <form action="#" method="POST">
            <div class="u-form-group u-form-message">
                <label for="message-6797" class="u-label">Notepad</label>
                <textarea placeholder="Notes" rows="10" cols="50" id="message-6797" name="note_text" class="u-border-4 u-border-palette-2-light-2 u-input u-input-rectangle" required="required"><?php echo $initial_note ?></textarea>
            </div>
            <div class="u-align-right u-form-group u-form-submit">
                <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-3 u-radius-26 u-btn-4">Save</a>
                <input type="submit" name="note_button" value="submit" class="u-form-control-hidden">
            </div>
        </form>
    </div>

</section>




<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>
