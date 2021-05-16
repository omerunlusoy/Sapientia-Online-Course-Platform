<?php

include("connect.php");

if(isset($_POST['add_question_button']))
{
    session_start();
    $question = $_POST['question'];
    $Opt1 = $_POST['Q1_O1'];
    $Opt2 = $_POST['Q1_O2'];
    $Opt3 = $_POST['Q1_O3'];
    $select_correct_answer = $_POST['select_correct_answer'];
    $section = $_SESSION['section'];


    if($question=="" | $Opt1=="" | $Opt2=="" | $Opt3=="") {
        echo "<script type='text/javascript'>alert('Fill all the fields!');</script>";
    }

    else {
        $CID = $_SESSION['CID'];
        $IID = $_SESSION['IID'];
        $quiz_content_no = $_SESSION['quiz_content_no'];

        $sql = "select count(*) as COUNT1 from Quiz_Question where CID='$CID' and content_num='$quiz_content_no'";

        if($question_count = $con->query($sql)) {
            $row = mysqli_fetch_array($question_count); // Use something like this to get the result
            $question_num = $row['COUNT1'] + 1;

            if($select_correct_answer == "choice1"){
                $sql = "INSERT INTO Quiz_Question (CID, section, content_num, question_num, question_text, choice1, choice2, choice3, answer)
                    VALUES ('$CID', '$section', '$quiz_content_no', '$question_num', '$question', '$Opt1', '$Opt2', '$Opt3', 'choice1');";

                if ($result = $con->query($sql)) {
                    echo "<script type='text/javascript'>alert('Question Added!');</script>";
                }
                else {
                    echo "<script type='text/javascript'>alert('Database Error!');</script>";
                }
            }
            else if($select_correct_answer == "choice2"){
                $sql = "INSERT INTO Quiz_Question (CID, section, content_num, question_num, question_text, choice1, choice2, choice3, answer)
                    VALUES ('$CID', '$section', '$quiz_content_no', '$question_num', '$question', '$Opt1', '$Opt2', '$Opt3', 'choice2');";

                if ($result = $con->query($sql)) {
                    echo "<script type='text/javascript'>alert('Question Added!');</script>";
                }
                else {
                    echo "<script type='text/javascript'>alert('Database Error!');</script>";
                }
            }
            else{
                $sql = "INSERT INTO Quiz_Question (CID, section, content_num, question_num, question_text, choice1, choice2, choice3, answer)
                    VALUES ('$CID', '$section', '$quiz_content_no', '$question_num', '$question', '$Opt1', '$Opt2', '$Opt3', 'choice3');";

                if ($result = $con->query($sql)) {
                    echo "<script type='text/javascript'>alert('Question Added!');</script>";
                }
                else {
                    echo "<script type='text/javascript'>alert('Database Error!');</script>";
                }
            }

        }
        else {
            echo "<script type='text/javascript'>alert('Database Error!');</script>";
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
    <title>Add Quiz Questions</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Add-Quiz-Questions.css" media="screen">
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
    <meta property="og:title" content="Add Quiz Questions">
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
<section class="u-border-18 u-border-palette-4-base u-clearfix u-white u-section-1" id="sec-53a2">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-container-style u-group u-white u-group-1">
            <div class="u-container-layout u-container-layout-1">
                <h2 class="u-text u-text-1">Add Quiz Question</h2>
                <div class="u-form u-form-1">
                    <form action="#" method="POST">
                        <div class="u-form-group u-form-name">
                            <label for="name-7637" class="u-label u-label-1">Question </label>
                            <input type="text" placeholder="Enter Question" id="name-7637" name="question" class="u-border-3 u-border-palette-4-base u-input u-input-rectangle u-white" required="">
                        </div>
                        <div class="u-form-group u-form-group-2">
                            <label for="text-6136" class="u-form-control-hidden u-label u-label-2"></label>
                            <input type="text" placeholder="Enter Option 1" id="text-6136" name="Q1_O1" class="u-border-3 u-border-palette-4-base u-input u-input-rectangle u-white">
                        </div>
                        <div class="u-form-group u-form-group-3">
                            <label for="text-721a" class="u-form-control-hidden u-label u-label-3"></label>
                            <input type="text" placeholder="Enter Option 2" id="text-721a" name="Q1_O2" class="u-border-3 u-border-palette-4-base u-input u-input-rectangle u-white">
                        </div>
                        <div class="u-form-group u-form-group-4">
                            <label for="text-124f" class="u-form-control-hidden u-label u-label-4"></label>
                            <input type="text" placeholder="Enter Option 3" id="text-124f" name="Q1_O3" class="u-border-3 u-border-palette-4-base u-input u-input-rectangle u-white">
                        </div>
                        <div class="u-form-group u-form-select u-form-group-5">
                            <label for="select-e830" class="u-label u-label-5">Correct Option</label>
                            <div class="u-form-select-wrapper">
                                <select id="select-e830" name="select_correct_answer" class="u-border-3 u-border-palette-4-base u-input u-input-rectangle u-white">
                                    <option value='choice1' name="choice1">Option 1</option>
                                    <option value="choice2" name="choice2">Option 2</option>
                                    <option value="choice3" name="choice3">Option 3</option>
                                </select>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                            </div>
                        </div>
                        <div class="u-align-center u-form-group u-form-submit">
                            <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-2 u-radius-15 u-btn-1">Add Question<br>
                            </a>
                            <input type="submit" name="add_question_button" value="submit" class="u-form-control-hidden">
                        </div>
                    </form>
                </div>
                <a href="instructor_main_courses.php" name="finish_button" class="u-btn u-btn-round u-button-style u-hover-palette-2-light-1 u-palette-2-light-2 u-radius-15 u-btn-2">Finish</a>
            </div>
        </div>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>