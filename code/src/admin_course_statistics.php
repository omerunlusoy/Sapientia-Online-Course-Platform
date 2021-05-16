<?php
include("connect.php");
session_start();
$CID = $_SESSION['CID'];

//enroll count
$sql_student_count = "select count(*) as student_count
       from Enrolls 
       where CID = '$CID'";

$result1 = mysqli_query($con, $sql_student_count);

//rating
$sql_rating = "select *
               from Course
               where CID = '$CID'";
$result2 = mysqli_query($con, $sql_rating);

//refund request
$sql_refund = "select count(*) as refund_count
               from Complaint_Entry_Student
               where CID = '$CID' and refund_request = 1";
$result3 = mysqli_query($con, $sql_refund);

if($result1 && $result2 && $result3 )
{
    $row1= mysqli_fetch_array($result1);
    $student_count = $row1['student_count'];
    $_SESSION['student_count'] = $student_count;
    $row2 = mysqli_fetch_array($result2);
    $course_rating = $row2['rating'];
    $course_name = $row2['course_name'];
    $_SESSION['course_rating'] = $course_rating;
    $_SESSION['course_name'] = $course_name;
    $row3 = mysqli_fetch_array($result3);
    $refund_request = $row3['refund_count'];
    $_SESSION['refund_request'] = $refund_request;
}
else
{
    echo "<script type='text/javascript'>alert('Database Error!');</script>";
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
    <title>Statistics</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Statistics_admin.css" media="screen">
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
    <meta property="og:title" content="Statistics">
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
<section class="u-clearfix u-section-1" id="sec-cb0a">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="add_admin.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-1">Add Admin</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">**</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-3">**</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">**</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-6">**</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-7">**</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-8">Main Page</a>
    </div>
</section>
<section class="u-border-15 u-border-palette-2-light-3 u-clearfix u-section-2" id="carousel_f056">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1"><span class="u-icon u-icon-1"><svg class="u-svg-content" viewBox="0 0 480 480" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M272,176.232h-64c-4.418,0-8,3.582-8,8v224c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-224    C280,179.813,276.418,176.232,272,176.232z M264,400.232h-48v-208h48V400.232z"></path>
</g>
</g><g><g><path d="M464,144.232h-64c-4.418,0-8,3.582-8,8v256c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-256    C472,147.813,468.418,144.232,464,144.232z M456,400.232h-48v-240h48V400.232z"></path>
</g>
</g><g><g><path d="M368,320.232h-64c-4.418,0-8,3.582-8,8v80c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-80    C376,323.813,372.418,320.232,368,320.232z M360,400.232h-48v-64h48V400.232z"></path>
</g>
</g><g><g><path d="M80,208.232H16c-4.418,0-8,3.582-8,8v192c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-192    C88,211.813,84.418,208.232,80,208.232z M72,400.232H24v-176h48V400.232z"></path>
</g>
</g><g><g><path d="M176,256.232h-64c-4.418,0-8,3.582-8,8v144c0,4.418,3.582,8,8,8h64c4.418,0,8-3.582,8-8v-144    C184,259.813,180.418,256.232,176,256.232z M168,400.232h-48v-128h48V400.232z"></path>
</g>
</g><g><g><path d="M432.465,7.769c-17.801-0.128-32.335,14.198-32.463,31.999c-0.065,8.988,3.626,17.595,10.183,23.743l-66.4,121.784    c-6.015-1.665-12.404-1.37-18.24,0.84L263.776,93.44c11.835-13.125,10.789-33.36-2.337-45.194s-33.36-10.789-45.194,2.337    c-8.695,9.644-10.701,23.586-5.077,35.29L162.6,126.296c-13.324-9.719-31.884-7.544-42.6,4.992L79.272,110.92    c3.694-17.283-7.323-34.288-24.605-37.981c-17.283-3.694-34.288,7.322-37.981,24.605c-3.694,17.283,7.322,34.288,24.605,37.981    c2.205,0.471,4.454,0.708,6.709,0.707c9.225-0.03,17.982-4.064,24-11.056l40.728,20.368c-3.843,17.25,7.026,34.35,24.276,38.193    c17.25,3.843,34.35-7.026,38.193-24.276c1.563-7.015,0.719-14.352-2.397-20.829l48.568-40.424    c8.371,6.195,19.299,7.759,29.072,4.16l61.752,92.696c-11.803,13.154-10.707,33.386,2.448,45.189    c13.154,11.803,33.386,10.707,45.189-2.448c11.658-12.993,10.752-32.931-2.036-44.813l66.4-121.784    c2.55,0.666,5.173,1.01,7.808,1.024c17.801,0.128,32.335-14.198,32.463-31.999S450.265,7.898,432.465,7.769z M48,120.232    c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S56.837,120.232,48,120.232z M144,168.232c-8.837,0-16-7.163-16-16    s7.163-16,16-16s16,7.163,16,16S152.837,168.232,144,168.232z M240,88.232c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16    S248.837,88.232,240,88.232z M336,232.232c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S344.837,232.232,336,232.232z     M432,56.232c-8.837,0-16-7.163-16-16s7.163-16,16-16s16,7.163,16,16S440.837,56.232,432,56.232z"></path>
</g>
</g><g><g><path d="M472,424.232H8c-4.418,0-8,3.582-8,8v32c0,4.418,3.582,8,8,8h464c4.418,0,8-3.582,8-8v-32    C480,427.813,476.418,424.232,472,424.232z M464,456.232H16v-16h448V456.232z"></path>
</g>
</g></svg><img></span>&nbsp;<?php echo $_SESSION['course_name']; ?>  Statistics
        </h2>
        <h6 class="u-text u-text-2">Number of Enrolled Students&nbsp; :</h6>
        <h6 class="u-text u-text-3"><?php echo $_SESSION['student_count']; ?></h6>
        <h6 class="u-text u-text-4">Rating&nbsp; :</h6>
        <h6 class="u-text u-text-5"><?php echo $_SESSION['course_rating']; ?></h6>
        <h6 class="u-text u-text-6">Number Of Refund Requests:</h6>
        <h6 class="u-text u-text-7"><?php echo $_SESSION['refund_request']; ?></h6>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>