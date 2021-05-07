<?php

include("connect.php");

/*
if(isset($_POST['signUpButton']) == 0)
{
    echo 'nooo';
}

if (($_POST['signUpButton'] == 'submit_s')) {


    $e_mail = $_POST['email_s'];
    $password = $_POST['password_s'];
    $name = $_POST['name_s'];


    if($e_mail=="" | $password=="" | $name =="")
    {
        echo "<script type='text/javascript'>alert('Fill all the fields!');</script>";
    }
    else {
        echo "<script type='text/javascript'>alert('yeyeyey');</script>";

        $sql = "SELECT * FROM Student WHERE e_mail ='$e_mail'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($result->num_rows == 0) {
                $sql2 = "INSERT INTO Student (name, e_mail, password,membership_type) VALUES ('$name','$e_mail', '$password','SLV')";

                if ($result = $con->query($sql2)) {
                    header("location: index.php");
                }

            } else {
                //you already have an account
            }

        } else {
            header("Location:signUp.php");
        }

    }


}
elseif(($_POST['signUpButton'] == 'submit_i'))
{
    $e_mail = $_POST['email_s'];
    $password = $_POST['password_s'];
    $name = $_POST['name_s'];


    if($e_mail=="" | $password=="" | $name =="")
    {
        echo "<script type='text/javascript'>alert('Fill all the fields!');</script>";
    }
    else {
        echo "<script type='text/javascript'>alert('yeyeyey');</script>";

        $sql = "SELECT * FROM Instructor WHERE e_mail ='$e_mail'";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($result->num_rows == 0) {
                $sql2 = "INSERT INTO Instructor (name, e_mail, password) VALUES ('$name','$e_mail', '$password')";

                if ($result = $con->query($sql2)) {
                    header("location: index.php");
                }

            } else {
                //you already have an account
            }

        } else {
            header("Location:signUp.php");
        }

    }
}


*/

?>




<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Learn Everyday, Join online courses today, Train Your Brain Today!, Learn to enjoyevery minute of your life., Online Learning, Innovations in Online Learning, Education and Learning, 01, 02, 03, 04, Contact Us">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Sign Up</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Sign-Up.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.13.2, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">


    <script type="application/ld+json">{
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "url": "index.html",
            "logo": "#"
        }</script>
    <meta property="og:title" content="Sign Up">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
</head>
<body class="u-body"><header class="u-clearfix u-header u-header" id="sec-85c8"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1">
            <img src="#" class="u-logo-image u-logo-image-1">
        </a>
    </div></header>
<section class="u-clearfix u-image u-valign-top u-section-1" id="sec-5c0b">
    <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
        <div class="u-gutter-0 u-layout">
            <div class="u-layout-row">
                <div class="u-align-left u-container-style u-layout-cell u-size-29 u-layout-cell-1">
                    <div class="u-container-layout u-container-layout-1">
                        <h5 class="u-custom-font u-font-pt-sans u-text u-text-1">online learning</h5>
                        <h1 class="u-text u-text-2">Sapientia</h1>
                        <h1 class="u-text u-text-3">
                            <span style="font-size: 2.5rem;">Sign Up for Wisdom</span>
                        </h1>
                        <div class="u-expanded-width u-form u-form-1">
                            <form action="signUpS.php" method="POST">
                                <label for="name_s" class="u-form-control-hidden u-label">Name</label>
                                <input type="text" placeholder="Enter your Name" id="name_s" name="name_s" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
                                <label for="email_s" class="u-form-control-hidden u-label">Email</label>
                                <input type="text" placeholder="Enter a valid email address" id="email_s" name="email_s" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="">
                                <label for="password_s" class="u-form-control-hidden u-label"></label>
                                <input type="password" placeholder="Enter a password" id="password_s" name="password_s" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
                                <button type="submit"   class="u-btn u-btn-submit u-button-style" >Sign Up as Student</button>
                                <button type="submit" class="u-btn u-button-style u-btn-2" formaction="signUpI.php">Sign Up as Instructor</button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="u-align-right u-container-style u-image u-layout-cell u-size-31 u-image-1">
                    <div class="u-container-layout u-valign-bottom u-container-layout-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
<section class="u-backlink u-clearfix u-grey-80">
    <a class="u-link" href="https://nicepage.com/html5-template" target="_blank">
        <span>HTML5 Templates</span>
    </a>
    <p class="u-text">
        <span>created with</span>
    </p>
    <a class="u-link" href="https://nicepage.com/html-website-builder" target="_blank">
        <span>HTML Builder</span>
    </a>.
</section>
</body>
</html>