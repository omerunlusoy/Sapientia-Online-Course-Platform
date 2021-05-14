<?php

include("connect.php");

session_start();
$CID = $_SESSION['CID'];
$SID = $_SESSION['SID'];

$sections_sql = "select * 
                from Section 
                where CID = '$CID'";

$sections_result = mysqli_query($con, $sections_sql);
if($sections_result){
}
else{
    echo "<script type='text/javascript'>alert('Database Error!');</script>";
}



if(isset($_POST['view_button'])){
    $_SESSION['CID'] = $_POST['view_button'];

    header("location: view_course.php");
}

if(isset($_POST['view_quiz_button'])){
    $a = $_POST['view_quiz_button'];
    echo "<script type='text/javascript'>alert('$a');</script>";

}

if(isset($_POST['view_lecture_button'])){
    $_SESSION['CID'] = $_POST['view_lecture_button'];

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
    <title>Contents</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Contents.css" media="screen">
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
    <meta property="og:title" content="Contents">
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
<section class="u-border-15 u-border-palette-2-light-3 u-clearfix u-section-2" id="carousel_f056">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1">Contents</h2>
        <div class="u-table u-table-responsive u-table-1">
            <table class="u-table-entity">

                <colgroup>
                    <col width="14.3%">
                    <col width="14.3%">
                    <col width="14.3%">
                    <col width="14.3%">
                    <col width="14.3%">
                    <col width="12.7%">
                    <col width="15.7%">
                </colgroup>
                <?php
                while($comments_row = mysqli_fetch_array($sections_result)) {
                    $section_name = $comments_row['section'];
                    $section_title = $comments_row['title'];


                    echo "<thead class=\"u-palette-4-base u-table-header u-table-header-1\">
                    <tr style=\"height: 58px;\">
                    <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Section " . $section_name . "</th>
                    <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">" . $section_title . "</th>
                </tr>
                </thead>";

                    $lectures_sql = "select * 
                                    from Lecture
                                    where CID = '$CID' and section = '$section_name'
                                    order by content_num";

                    $quizes_sql = "select * 
                                    from Quiz
                                    where CID = '$CID' and section = '$section_name'
                                    order by content_num";


                    $lectures_result = mysqli_query($con, $lectures_sql);
                    $quizes_result = mysqli_query($con, $quizes_sql);
                    //echo "<script type='text/javascript'>alert($lectures_result->num_rows);</script>";
                    //echo "<script type='text/javascript'>alert($quizes_result->num_rows);</script>";

                    if(!$lectures_result || !$quizes_result){
                        echo "<script type='text/javascript'>alert('Database Error!');</script>";
                    }

                    $lectures_row = mysqli_fetch_array($lectures_result);
                    $quizes_row = mysqli_fetch_array($quizes_result);

                    while($lectures_row != null || $quizes_row != null){

                        if($lectures_row != null){
                            $lecture_content_num = $lectures_row['content_num'];
                            $lecture_title = $lectures_row['title'];
                        }
                        if($quizes_row != null){
                            $quiz_content_num = $quizes_row['content_num'];
                            $quiz_title = $quizes_row['title'];
                        }

                        if($lectures_row == null || ($quizes_row != null && $quiz_content_num < $lecture_content_num)){

                            echo "<tbody class=\"u-table-body\">

                            <tr style=\"height: 85px;\">
                            <td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-29\">Quiz: " . $quiz_title . "</td>
                            
                            <td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"view_quiz_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$section_name .$lecture_content_num .">Solve Quiz</button>
                                     </form>
                            </td>
                            </tr>
                            </tbody>";

                            if($quizes_row = mysqli_fetch_array($quizes_result)){
                                $quiz_content_num = $quizes_row['content_num'];
                                $quiz_title = $quizes_row['title'];
                            }
                            else{
                                $quizes_row = null;
                            }

                        }
                        else if($lectures_row != null){
                            echo "<tbody class=\"u-table-body\">

                            <tr style=\"height: 85px;\">
                            <td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-29\">Lecture: " . $lecture_title . "</td>
                            
                            <td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"view_lecture_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$section_name.$lecture_content_num .">View Lecture</button>
                                     </form>
                            </td>
                            </tr>
                            </tbody>";

                            if($lectures_row = mysqli_fetch_array($lectures_result)){
                                $lecture_content_num = $lectures_row['content_num'];
                                $lecture_title = $lectures_row['title'];
                            }
                            else{
                                $lectures_row = null;
                            }
                        }
                    }
                }

                ?>

            </table>
        </div>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>