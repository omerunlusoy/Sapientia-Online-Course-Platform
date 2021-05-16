<?php

include("connect.php");

if(isset($_POST['add_course_button']))
{

    $course_name = $_POST['course_name'];
    $category = $_POST['category'];
    $level = $_POST['level'];
    $description = $_POST['description'];
    $quiz_avg = $_POST['quiz_avg'];
    $price = $_POST['price'];


    if($course_name=="" | $category==""| $level==""| $description==""| $quiz_avg==""| $price=="")
    {
        echo "<script type='text/javascript'>alert('Fill all the fields!');</script>";
    }
    else
    {

        session_start();
        $IID = $_SESSION['IID'];
        $sql = "INSERT INTO Course (IID, course_name, description, category,
                    level, cost, discount_allowed, quiz_threshold)
                VALUES ('$IID', '$course_name', '$description', '$category', '$level', '$price', FALSE, '$quiz_avg');";
        if( $result = $con->query($sql))
        {

            $sql = "select CID from Course where IID='$IID' and course_name='$course_name'";
            if( $result = $con->query($sql))
            {
                $row = mysqli_fetch_array($result);
                $CID = $row['CID'];
                $_SESSION['CID'] = $row['CID'];

                $sql = "INSERT INTO Teaches (IID, CID)
                        VALUES ('$IID', '$CID');";

                if( $result = $con->query($sql))
                {
                    echo "<script type='text/javascript'>alert('Course Added!');</script>";
                    header("Location:instructor_main_courses.php");

                }
                else
                {
                    echo "<script type='text/javascript'>alert('Course cannot be Added!');</script>";
                }



            }
            else
            {
                echo "<script type='text/javascript'>alert('query failed for...!');</script>";
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('query failed!');</script>";
            //header("Location:add_course.php");
        }

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
    <title>Add course</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Add-course.css" media="screen">
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
    <meta property="og:title" content="Add course">
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
<section class="u-clearfix u-section-1" id="sec-cc68">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="instructor_account.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-1">Account</a>
        <a href="instructor_settings.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">Settings</a>
        <a href="instructor_main_courses.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-3">My Courses</a>
        <a href="instructor_notifications.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">Notifications</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
        <a href="instructor_statistics.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-6">Statistics</a>
    </div>
</section>
<section  id="sec-0358">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1" style="text-align:center">Add a Course&nbsp;</h2>
        <div class="u-form u-form-1">
            <form action="#" method="POST"  style="padding: 15px;" >
                <div class="u-form-group u-form-name">
                    <label for="name-6797" class="u-label">Course  Name</label>
                    <input type="text" placeholder="Course Name" id="name-6797" name="course_name" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" required="">
                </div>
                <div class="u-form-group u-form-select u-form-group-2">
                    <label for="select-3cb3" class="u-label">Category</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-3cb3" name="category" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                            <option value="Music">Music</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Math">Math</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="Gardening">Gardening</option>
                            <option value="Pop Culture">Pop Culture</option>
                            <option value="Literature">Literature</option>
                            <option value="Science">Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Medicine">Medicine</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Hand Crafting">Hand Crafting</option>
                            <option value="Sports">Sports</option>
                            <option value="Photography">Photography</option>

                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-select u-form-group-3">
                    <label for="select-a426" class="u-label">Level</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-a426" name="level" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-message">
                    <label for="message-6797" class="u-form-control-hidden u-label">Description</label>
                    <textarea placeholder="Description" rows="4" cols="50" id="message-6797" name="description" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" required="" maxlength="100"></textarea>
                </div>
                <div class="u-form-email u-form-group">
                    <label for="email-6797" class="u-label">Price ($)</label>
                    <input type="text" placeholder="Price" id="email-6797" name="price" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" required="">
                </div>
                <div class="u-form-group u-form-group-6">
                    <label for="text-3cfa" class="u-label">Min. Quiz Average (.../10)</label>
                    <input type="text" placeholder="min quiz avg" id="text-3cfa" name="quiz_avg" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                </div>
                <div class="u-align-center u-form-group u-form-submit">
                    <a href="add_course.php" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-2 u-radius-12 u-btn-1">Add Course</a>
                    <input type="submit" name='add_course_button' value="submit" class="u-form-control-hidden">
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