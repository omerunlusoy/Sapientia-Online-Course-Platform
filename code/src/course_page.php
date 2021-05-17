<?php

include("connect.php");
session_start();
$CID = $_SESSION['CID'];
$SID = $_SESSION['SID'];

$course_sql = "select * 
                from  Discount right join Course on Discount.CID = Course.CID
                where Course.CID = '$CID'";

$result = mysqli_query($con, $course_sql);

if ($result->num_rows == 1) {
    $row = mysqli_fetch_array($result);
    $instructor_names_sql = "select Instructor.name as name from Teaches natural join Instructor where Teaches.CID = '$CID'";
    $result2 = mysqli_query($con, $instructor_names_sql);
    $instructor_names_string = "";
    while($row2 = mysqli_fetch_array($result2)){
        $instructor_names_string .= $row2['name'];
        $instructor_names_string .= ", ";
    }
    $instructor_names_string = substr($instructor_names_string, 0, -2);

    $cost = $row['cost'];
    $discount_rate = 0;
    $discount_rate = $row['rate'];
    $new_price = round(((100 - $discount_rate) / 100) * $cost, 2);
    if($cost == 0.0){
        $cost = "Free";
        $new_price = "Free";
    }
    $rating = $row['rating'];
    if($rating == 0.00){
        $rating = "Not rated yet!";
    }

    $category = $row['category'];
    $level = $row['level'];
    $description = $row['description'];


    $quiz_num_sql = "select * from Quiz where CID = '$CID'";
    $lecture_num_sql = "select * from Lecture where CID = '$CID'";
    $quiz_result = mysqli_query($con, $quiz_num_sql);
    $lecture_result = mysqli_query($con, $lecture_num_sql);

    $content_string = "Quiz:  " . $quiz_result->num_rows . ", Lecture: " . $lecture_result->num_rows;

    $comments_sql = "select * 
                        from  Student natural join Certificate
                        where Certificate.CID = '$CID'";

    $comments_result = mysqli_query($con, $comments_sql);

}
else{
    echo "<script type='text/javascript'>alert('Database Error!');</script>";
}



if(isset($_POST['view_contents_button'])){
    header("location: contents.php");
}

if(isset($_POST['post_question_button'])){
    $subject = $_POST['subject'];
    $question = $_POST['question'];

    $question_sql = "insert into QnA_Entry_Student (SID, CID, subject_name, text, date) values ('$SID', '$CID', '$subject', '$question', CURDATE())";
    $comments_result = mysqli_query($con, $question_sql);
    if($comments_result){
        echo "<script type='text/javascript'>alert('Your question has been sent to the instructor.');</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Database Error!');</script>";
    }
}


if(isset($_POST['request_certificate_button'])){
    $certificate_sql = "select * 
                   from Enrolls 
                   where SID = '$SID' and CID = '$CID'";

    $certificate_result = mysqli_query($con, $certificate_sql);
    if(!$certificate_result){
        echo "<script type='text/javascript'>alert('Database Error!');</script>";
    }
    $row_cer = mysqli_fetch_array($certificate_result);
    $progress = $row_cer['progress'];
    if($progress == 100.0){

        // check if the certificate exists
        $certificate_sql = "select * 
                   from Certificate 
                   where SID = '$SID' and CID = '$CID'";
        $certificate_result = mysqli_query($con, $certificate_sql);
        if(!$certificate_result){
            echo "<script type='text/javascript'>alert('Database Error!');</script>";
        }
        if($certificate_result->num_rows == 0){
            // create certificate


            $certificate_text = "";
            $comment = "";
            $certificate_insert_sql = "insert into Certificate (SID, CID, certificate_text, rating, comment, date) values ('$SID', '$CID', '$certificate_text', '$certificate_text', '$comment', CURDATE())";

            $certificate_inser_result = mysqli_query($con, $certificate_insert_sql);
            if(!$certificate_inser_result){
                echo "<script type='text/javascript'>alert('Database Error!');</script>";
            }
            else{
                echo "<script type='text/javascript'>alert('Certificate created.');</script>";
            }

        }
        else{
            echo "<script type='text/javascript'>alert('Certificate is already created.');</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Course is not finished.');</script>";
    }
}





?>


<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Learn Everyday, Join online courses today, Train Your Brain Today!, Learn to enjoyevery minute of your life., Online Learning, Innovations in Online Learning, Education and Learning, 01, 02, 03, 04, Contact Us">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Course Page </title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Course-Page-.css" media="screen">
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
    <meta property="og:title" content="Course Page ">
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
<section class="u-clearfix u-section-1" id="sec-de06">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="student_account.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-1">Account</a>
        <a href="student_notifications.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">Nofitications</a>
        <a href="student_my_courses.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-3">My Courses</a>
        <a href="certificates.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">Certificates</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
        <a href="wishlist.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-6">Wishlist</a>
        <a href="student_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-8">Main Page</a>
    </div>
</section>
<section class="u-border-12 u-border-palette-4-light-1 u-clearfix u-section-2" id="sec-fad2">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <h2 class="u-text u-text-1"><?php echo $row['course_name']; ?></h2>
        <h6 class="u-text u-text-2">Instructor(s) :&nbsp;</h6>
        <h6 class="u-text u-text-3"><?php echo $instructor_names_string; ?>&nbsp;</h6>
        <h6 class="u-text u-text-4">About the Course:<span style="font-weight: 700;"></span>
        </h6>
        <h6 class="u-text u-text-5">Rating :&nbsp;</h6>
        <h6 class="u-text u-text-6"><?php echo $rating; ?></h6>
        <p class="u-text u-text-9"><br><br><?php echo $description; ?></p>
        <h6 class="u-text u-text-10">Category:&nbsp;</h6>
        <h6 class="u-text u-text-11"><?php echo $category; ?></h6>
        <h6 class="u-text u-text-12"><?php echo $level; ?></h6>
        <h6 class="u-text u-text-13">Level:&nbsp;</h6>
        <h6 class="u-text u-text-14"><?php echo $content_string; ?><span style="font-weight: 700;"></span>
        </h6>
        <h6 class="u-text u-text-15">Completeness: <span style="font-weight: 700;"></span>
        </h6>
        <div class="u-form u-form-2">
            <form action="#" method="POST">
                <div class="u-align-right u-form-group u-form-submit">
                    <a class="u-btn u-btn-submit u-button-style u-palette-2-light-2 u-btn-2">View Lectures<br>
                    </a>
                    <button name="view_contents_button" type="submit" value="submit" class="u-form-control-hidden">
                </div>
            </form>

            <form action="#" method="POST">
                <div class="u-align-right u-form-group u-form-submit">
                    <a class="u-btn u-btn-submit u-button-style u-palette-2-light-2 u-btn-2">Request Certificate<br>
                    </a>
                    <button name="request_certificate_button" type="submit" value="submit" class="u-form-control-hidden">
                </div>
            </form>


        </div>
        <h6 class="u-text u-text-16">
            <span style="font-weight: 700;">Ask a Question </span>
        </h6>
        <div class="u-form u-form-1">
            <form action="#" method="POST">
                <div class="u-form-group u-form-name">
                    <label for="name-6797" class="u-label">Subject</label>
                    <input type="text" placeholder="Question Subject" id="name-6797" name="subject" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required="">
                </div>
                <div class="u-form-group u-form-message">
                    <label for="message-6797" class="u-label">Question</label>
                    <textarea placeholder="Question" rows="4" cols="50" id="message-6797" name="question" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required=""></textarea>
                </div>
                <div class="u-align-left u-form-group u-form-submit">
                    <a href="#" class="u-btn u-btn-submit u-button-style u-palette-2-light-2 u-btn-2">Post Question</a>
                    <input type="submit" name="post_question_button" value="submit" class="u-form-control-hidden">
                </div>
            </form>
        </div>
        <a href="student_forum.php" class="u-btn u-button-style u-hover-palette-2-light-1 u-palette-2-light-2 u-btn-3">Go to Course Forum</a>
        <h6 class="u-text u-text-17">To see all Q&amp;A's :<span style="font-weight: 700;"></span>
        </h6>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>