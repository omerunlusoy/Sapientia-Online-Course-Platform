<?php

include("connect.php");
session_start();
$SID = $_SESSION['SID'];
$CID = $_SESSION['CID'];

$sql = "select *
        from Certificate
        WHERE CID = '$CID' and SID = '$SID'";
if( $result = $con->query($sql)) {
    if($row = mysqli_fetch_array($result))
    {
        $yey = $row['comment'];
        $_SESSION['comment'] = $row['comment'];

    }

}

if(isset($_POST['send_comment_button']))
{
    $comment = $_POST['comment'];

    $sql = "UPDATE Certificate SET comment = '$comment'
                               WHERE CID = '$CID' and SID = '$SID';";
    if( $result = $con->query($sql)) {
        echo "<script type='text/javascript'>alert('Comment Added');</script>";
        header("Location:student_my_courses.php");
    }

    header("location: student_my_courses.php");
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
    <title>certificate page</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="certificate-page.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.13.2, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">



    <script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "url": "index.html",
            "logo": "images/SapientiaLogo.PNG"
        }</script>
    <meta property="og:title" content="certificate page">
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
<section class="u-clearfix u-section-1" id="sec-94fa">
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
<section class="u-align-center u-border-13 u-border-palette-2-light-2 u-clearfix u-section-2" id="sec-0fef">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1"><b>Congradulations !!</b>
        </h2>
        <?php

        $SID = $_SESSION['SID'];
        $CID = $_SESSION['CID'];

        $course_sql = "select * 
                       from Course 
                       where CID = $CID";

        $result = mysqli_query($con, $course_sql);

        $row = mysqli_fetch_array($result)

        ?>

        <h3 class="u-text u-text-2"><?php echo $row['course_name']; ?><span style="font-weight: 700;"></span>
        </h3>
        <p class="u-text u-text-3">You have succesfully finished your course ! Now you can continue learning and master the topic!<br>
            <span style="font-style: italic; font-weight: 400;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="font-size: 1.5rem;">Team Sapientia</span>
          </span>
        </p>
        <div class="u-form u-form-1">
            <form action="#" method="POST" >
                <div class="u-form-group u-form-message">
                    <label for="message-6797" class="u-label">Comment Course</label>
                    <input value='<?php echo $_SESSION["comment"]; ?>' placeholder="Enter Your Comment"  rows="4" cols="50" id="message-6797" name="comment" class="u-border-1 u-border-grey-30 u-input u-input-rectangle" required=""></input>
                </div>
                <div class="u-align-center u-form-group u-form-submit">
                    <a href="#" class="u-btn u-btn-submit u-button-style u-palette-2-light-2 u-btn-1">Send Comment<br>
                    </a>
                    <input type="submit" name="send_comment_button" value="submit" class="u-form-control-hidden">
                </div>
            </form>
        </div>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>