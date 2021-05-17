<?php

include("connect.php");

session_start();


if(isset($_SESSION['PAGENUM'])){
    $page_num = $_SESSION['PAGENUM'];}
else{$_SESSION['PAGENUM'] = 0;}


if(isset($_POST['right_page'])){
    $_SESSION['PAGENUM'] = $_SESSION['PAGENUM'] + 1;

}

if(isset($_POST['left_page'])){
    if($_SESSION['PAGENUM'] != 0){
        $_SESSION['PAGENUM'] = $_SESSION['PAGENUM'] - 1;
    }
}

if(isset($_POST['ignore_button'])){

    //delete from student complaint
    $cid = $_POST['ignore_button'];
    $sql_delete = "DELETE FROM Complaint_Entry_Instructor WHERE Complaint_ID = $cid ";
    $result = mysqli_query($con, $sql_delete);
    if ($result) {
        echo "<script type='text/javascript'>alert('Complaint Ignored!');</script>";
    }
    else
    {
        echo "<script type='text/javascript'>alert('Database Error1!');</script>";
    }
}

if(isset($_POST['noted_button'])){
    //delete from student complaint
    $cid = $_POST['noted_button'];
    $sql_delete = "DELETE FROM Complaint_Entry_Instructor WHERE Complaint_ID = $cid ";
    $result = mysqli_query($con, $sql_delete);
    if ($result) {
        echo "<script type='text/javascript'>alert('Complaint Noted!');</script>";
    }
    else
    {
        echo "<script type='text/javascript'>alert('Database Error2!');</script>";
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
    <title>instructor complaints</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="admin_main.css" media="screen">
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
    <meta property="og:title" content="student main">
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
<section class="u-clearfix u-section-1" id="sec-75fe">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <a href="add_admin.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-1">Add Admin</a>
        <a href="admin_student_complaints.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">Student Complaints</a>
        <a href="admin_instructor_complaint.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">Instructor Complaints</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-8">Main Page</a>
    </div>
</section>
<section class="u-align-center u-border-7 u-border-palette-4-base u-clearfix u-white u-section-2" id="sec-8092">

    <div class="u-table u-table-responsive u-table-1">
        <h2>Instructor Complaints</h2>
        <table class="u-table-entity u-table-entity-1">
            <?php


            $complaints = "select *
                                       from  Complaint_Entry_Instructor C join Instructor S on C.IID = S.IID
                                       join Course C2 on C2.CID = C.CID";

            $result = mysqli_query($con, $complaints);


            if ($result) {

                echo "<table class=\"u-table-body\">
            <tr class=\"u-palette-4-base u-table-header u-table-header-1\">
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Course Name</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Instructor Name</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Complaint Subject</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Complaint</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Date</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\"></th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\"></th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\"></th>
        
            </tr>";

                while($row = mysqli_fetch_array($result)) {

                    $course_name = $row['course_name'];
                    $_SESSION['IID'] = $row['IID'];
                    $_SESSION['CID'] = $row['CID'];
                    $student_name = $row['name'];
                    $subject = $row['subject_name'];
                    $text = $row['text'];
                    $date = $row['date'];
                    $complaint_id = $row['Complaint_ID'];


                    echo "<tr>";
                    echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-7\">" .$course_name. "</td>";
                    echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$student_name. "</td>";
                    echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$subject. "</td>";
                    echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$text. "</td>";
                    echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$date. "</td>";

                    echo "<td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"ignore_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$complaint_id.">Ignore</button>
                                     </form>
                            </td>";

                        echo "<td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"noted_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$complaint_id.">Noted</button>
                                     </form>
                            </td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
            else {
                echo "<script type='text/javascript'>alert('Database Error!');</script>";
                //header("Location:login.php");
            }
            ?>
        </table>

    </div>
    <form action="#" method="POST">
        <div class="u-form-group u-form-submit">
            <button type="submit" name = "left_page" id = "btn" class="u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4-11">Left</button>
            <button type="submit" name = "right_page" id = "btn" class="u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4-12">Right</button>
        </div>
    </form>
    <p class="u-text u-text-1"><?php echo $_SESSION['PAGENUM'] + 1; ?></p>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>

</body>
</html>
