<?php

include("connect.php");
session_start();
$CID = $_SESSION['CID'];

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



if(isset($_POST['add_to_wishlist_button'])){

    $CID = $_SESSION['CID'];
    $SID = $_SESSION['SID'];


    $sql_select = "select * 
                   from  Wishlist 
                   where SID = '$SID' and CID = '$CID'";

    $result = mysqli_query($con, $sql_select);

    if ($result->num_rows == 1) {
        echo "<script type='text/javascript'>alert('Course is already in wishlist!');</script>";
    }
    else{
        $wishlist_sql = "insert into Wishlist (SID, CID) VALUES  ($SID, $CID)";


        $result = mysqli_query($con, $wishlist_sql);
        if( $result)
        {
            echo "<script type='text/javascript'>alert('Course added to wishlist!');</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('Database Error!');</script>";
        }

    }

}

if(isset($_POST['buy_button'])){
    $CID = $_SESSION['CID'];
    $SID = $_SESSION['SID'];

    $sql_buy = "INSERT INTO Enrolls (SID, CID, date)
                VALUES ('$SID', '$CID', CURDATE());";
    $result = mysqli_query($con, $sql_buy);
    if ($result) {
        header("location: course_page.php");
    }
    else
    {
        echo "<script type='text/javascript'>alert('Course Could not be bought!');</script>";
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
    <title>View Course</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="View-Course.css" media="screen">
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
    <meta property="og:title" content="View Course">
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
<section class="u-clearfix u-section-1" id="sec-a686">
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
<section class="u-border-12 u-border-palette-4-light-1 u-clearfix u-section-2" id="carousel_f056">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1"><?php echo $row['course_name']; ?></h2>
        <h6 class="u-text u-text-2">Instructor(s) :&nbsp;</h6>
        <h6 class="u-text u-text-3"><?php echo $instructor_names_string; ?>&nbsp;</h6>
        <h6 class="u-text u-text-4">About the Course:<span style="font-weight: 700;"></span>
        </h6>
        <h6 class="u-text u-text-5">Price :&nbsp;</h6>
        <?php
        if($cost == "Free"){
            echo "<h6 class=\"u-text u-text-6\">".$cost."</h6>";
        }
        else if($discount_rate == 0.0){
            echo "<h6 class=\"u-text u-text-6\">".$cost."₺</h6>";
        }
        else{
            echo "<h6 class=\"u-text u-text-6\"><del>".$cost."₺</del><br>" .$new_price. "₺</h6>";
        }
        ?>
        <h6 class="u-text u-text-7">Rating :&nbsp;</h6>
        <h6 class="u-text u-text-8"><?php echo $rating; ?></h6>
        <p class="u-text u-text-9"><?php echo $description; ?></p>
        <h6 class="u-text u-text-10"><br>Category:&nbsp;</h6>
        <h6 class="u-text u-text-11"><?php echo $category; ?></h6>
        <h6 class="u-text u-text-12"><?php echo $level; ?></h6>
        <h6 class="u-text u-text-13">Level:&nbsp;</h6>
        <h6 class="u-text u-text-14"><?php echo $content_string; ?><span style="font-weight: 700;"></span>
        </h6>


        <div class="u-form u-form-2">
            <form action="#" method="POST">
                <div class="u-align-right u-form-group u-form-submit">
                    <a class="u-btn u-btn-submit u-button-style u-palette-2-light-2 u-btn-2">Buy<br>
                    </a>
                    <button name="buy_button" type="submit" value="submit" class="u-form-control-hidden">
                </div>
            </form>
        </div>
        <div class="u-form u-form-1">
            <form action="#" method="POST">
                <div class="u-align-right u-form-group u-form-submit">
                    <a class="u-btn u-btn-submit u-button-style u-palette-2-light-2 u-btn-1">Add to Wishlist</a>
                    <button name="add_to_wishlist_button" type="submit" value="submit" class="u-form-control-hidden">
                </div>
            </form>
        </div>

        <h6 class="u-text u-text-15">&nbsp;Course Comments</h6>
        <div class="u-expanded-width u-table u-table-responsive u-table-1">
            <table class="u-table-entity">
                <colgroup>
                    <col width="22.1%">
                    <col width="77.9%">
                </colgroup>
                <tbody class="u-table-alt-palette-1-light-3 u-table-body">
                <tr style="height: 34px;">
                    <td class="u-table-cell">Graduated Student Name </td>
                    <td class="u-table-cell">Comment </td>
                </tr>

                <?php
                while($comments_row = mysqli_fetch_array($comments_result)) {
                    $cur_student_name = $comments_row['name'];
                    $cur_comment = $comments_row['comment'];

                    echo "<tr style=\"height: 34px;\">";
                    echo "<td class=\"u-table-cell\">" . $cur_student_name . "</td>";
                    echo "<td class=\"u-table-cell\">" . $cur_comment . "</td>";
                }

                ?>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>
