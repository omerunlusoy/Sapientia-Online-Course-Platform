<?php

include("connect.php");


session_start();
$CID = $_SESSION['CID'];
$sql = "select * from Course where CID='$CID'";

if( $result = $con->query($sql)) {
    $row = mysqli_fetch_array($result);
    $_SESSION['course_name'] = $row['course_name'];
    $_SESSION['IID'] = $row['IID'];
    $_SESSION['description'] = $row['description'];
    $_SESSION['rating'] = $row['rating'];
    $_SESSION['category'] = $row['category'];
    $_SESSION['level'] = $row['level'];
    $_SESSION['cost'] = $row['cost'];
    $_SESSION['quiz_threshold'] = $row['quiz_threshold'];
}
else{
    echo "<script type='text/javascript'>alert('Database Error!');</script>";
}

if(isset($_POST['edit_course_button'])){

    $course_name = $_POST['course_name'];
    $category = $_POST['category'];
    $level = $_POST['level'];
    $description = $_POST['description'];
    $quiz_avg = $_POST['quiz_avg'];
    $price = $_POST['price'];
    $zoom_link = $_POST['zoom_link'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if($course_name=="" | $category==""| $level==""| $description==""| $quiz_avg==""| $price=="") {
        echo "<script type='text/javascript'>alert('Fill all the fields!');</script>";
    }

    $select = 0;
    if(isset($_POST['radiobutton']))
    {
        $select = 1;
    }
    else
    {
        $select = 0;
    }

    $IID = $_SESSION['IID'];
    $sql = "select * from Course where IID='$IID' and course_name='$course_name'";

    if( $result = $con->query($sql)) {
        if ($result->num_rows == 0 || $_SESSION['course_name'] == $course_name){
            $sql = "UPDATE Course SET course_name = '$course_name', description = '$description', category = '$category',
                    level = '$level', cost = '$price', quiz_threshold = '$quiz_avg', discount_allowed = '$select' WHERE CID = '$CID';";
            if( $result = $con->query($sql)) {
                echo "<script type='text/javascript'>alert('Course Updated');</script>";
                header("Location:instructor_main_courses.php");
            }
            else {
                echo "<script type='text/javascript'>alert('query failed!');</script>";
                //header("Location:add_course.php");
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Course name is in use!');</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Database Error!');</script>";
    }


}



?>

<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Edit a Course">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Edit course</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Edit-course.css" media="screen">
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
    <meta property="og:title" content="Edit course">
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
<section class="u-clearfix u-section-1" id="sec-f613">
    <div class="u-clearfix u-sheet u-sheet-1">
        <a href="instructor_account.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-1">Account</a>
        <a href="instructor_forum.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">Forum</a>
        <a href="instructor_main_courses.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-3">My Courses</a>
        <a href="instructor_announcements.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">My Announcements</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
    </div>
</section>
<section class="u-border-8 u-border-palette-4-base u-clearfix u-section-2" id="sec-c539">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-text u-text-1">Edit a Course&nbsp;</h2>
        <div class="u-form u-form-1">
            <form action="#" method="POST">
                <div class="u-form-group u-form-name">
                    <label for="name-6797" class="u-label">Course  Name</label>
                    <input type="text" value='<?php echo $_SESSION["course_name"]; ?>' placeholder="Course Name" id="name-6797" name="course_name" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" required="">
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
                            <option selected value='<?php echo $_SESSION["category"]; ?>'><?php echo $_SESSION["category"]; ?></option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-select u-form-group-3">
                    <label for="select-a426" class="u-label">Level</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-a426"  name="level" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option selected value='<?php echo $_SESSION["level"]; ?>'><?php echo $_SESSION["level"]; ?></option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-message">
                    <label for="message-6797" class="u-label">Description</label>
                    <textarea  placeholder="Description" rows="4" cols="50" id="message-6797" name="description" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" required="" maxlength="100"><?php echo $_SESSION["description"]; ?></textarea>
                </div>
                <div class="u-form-email u-form-group">
                    <label for="email-6797" class="u-label">Price ($)</label>
                    <input type="text" value='<?php echo $_SESSION["cost"]; ?>' placeholder="Price" id="email-6797" name="price" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" required="">
                </div>
                <div class="u-form-group u-form-group-6">
                    <label for="text-3cfa" class="u-label">Min. Quiz Average (.../10)</label>
                    <input type="text" value='<?php echo $_SESSION["quiz_threshold"]; ?>' placeholder="min quiz avg" id="text-3cfa" name="quiz_avg" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                </div>
                <div class="u-form-group u-form-group-7">
                    <label for="text-c34b" class="u-label">Zoom Link</label>
                    <input type="text" placeholder="Enter zoom link" id="text-c34b" name="zoom_link" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                </div>
                <div class="u-form-date u-form-group u-form-partition-factor-2 u-form-group-8">
                    <label for="text-2173" class="u-label">Date</label>
                    <input type="date" placeholder="" id="text-2173" name="date" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle">
                </div>
                <div class="u-form-group u-form-partition-factor-2 u-form-group-9">
                    <label for="text-7e07" class="u-label">Time</label>
                    <input placeholder="" id="text-7e07" name="time" class="u-border-2 u-border-palette-4-base u-input u-input-rectangle" type="text">
                </div>
                <div>
                    <input type="radio" name="radiobutton"  value="Allow Discount">
                    <label class="u-label" for="radiobutton">Allow Discount</label>
                </div>
                <div class="u-align-center u-form-group u-form-submit">
                    <a href="#" class="u-btn u-btn-round u-btn-submit u-button-style u-palette-2-light-2 u-radius-12 u-btn-1">Edit Course</a>
                    <input type="submit" name='edit_course_button' value="submit" class="u-form-control-hidden">
                </div>
            </form>
        </div>
        <a href="add_section.php" class="u-btn u-btn-round u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-radius-25 u-btn-2"><span class="u-icon u-icon-1"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341    c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z    "></path>
</g>
</g><g><g><path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318    c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83    s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z"></path>
</g>
</g></svg><img></span>&nbsp;Add sectıons
        </a>
        <a href="add_lecture.php" class="u-btn u-btn-round u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-radius-25 u-btn-3"><span class="u-icon u-icon-2"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341    c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z    "></path>
</g>
</g><g><g><path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318    c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83    s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z"></path>
</g>
</g></svg><img></span>&nbsp;Add Lecture&nbsp;
        </a>
        <a href="invite_instructor.php" class="u-btn u-btn-round u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-radius-25 u-btn-4"><span class="u-icon u-icon-3"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M367.57,256.909c-9.839-4.677-19.878-8.706-30.093-12.081C370.56,219.996,392,180.455,392,136C392,61.01,330.991,0,256,0    c-74.991,0-136,61.01-136,136c0,44.504,21.488,84.084,54.633,108.911c-30.368,9.998-58.863,25.555-83.803,46.069    c-45.732,37.617-77.529,90.086-89.532,147.743c-3.762,18.066,0.745,36.622,12.363,50.908C25.222,503.847,42.365,512,60.693,512    H307c11.046,0,20-8.954,20-20c0-11.046-8.954-20-20-20H60.693c-8.538,0-13.689-4.766-15.999-7.606    c-3.989-4.905-5.533-11.29-4.236-17.519c20.755-99.695,108.691-172.521,210.24-174.977c1.759,0.068,3.526,0.102,5.302,0.102    c1.793,0,3.578-0.035,5.354-0.104c31.12,0.73,61.05,7.832,89.044,21.14c9.977,4.74,21.907,0.499,26.649-9.478    C381.789,273.582,377.547,261.651,367.57,256.909z M260.878,231.877c-1.623-0.029-3.249-0.044-4.878-0.044    c-1.614,0-3.228,0.016-4.84,0.046C200.465,229.35,160,187.312,160,136c0-52.935,43.065-96,96-96s96,43.065,96,96    C352,187.299,311.555,229.329,260.878,231.877z"></path>
</g>
</g><g><g><path d="M492,397h-55v-55c0-11.046-8.954-20-20-20c-11.046,0-20,8.954-20,20v55h-55c-11.046,0-20,8.954-20,20    c0,11.046,8.954,20,20,20h55v55c0,11.046,8.954,20,20,20c11.046,0,20-8.954,20-20v-55h55c11.046,0,20-8.954,20-20    C512,405.954,503.046,397,492,397z"></path>
</g>
</g></svg><img></span>&nbsp;ıNVITE ıNSTRUCTORS
        </a>
        <a href="add_quiz.php" class="u-btn u-btn-round u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-radius-25 u-btn-5"><span class="u-icon u-icon-4"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M256,0C114.833,0,0,114.833,0,256s114.833,256,256,256s256-114.853,256-256S397.167,0,256,0z M256,472.341    c-119.275,0-216.341-97.046-216.341-216.341S136.725,39.659,256,39.659S472.341,136.705,472.341,256S375.295,472.341,256,472.341z    "></path>
</g>
</g><g><g><path d="M355.148,234.386H275.83v-79.318c0-10.946-8.864-19.83-19.83-19.83s-19.83,8.884-19.83,19.83v79.318h-79.318    c-10.966,0-19.83,8.884-19.83,19.83s8.864,19.83,19.83,19.83h79.318v79.318c0,10.946,8.864,19.83,19.83,19.83    s19.83-8.884,19.83-19.83v-79.318h79.318c10.966,0,19.83-8.884,19.83-19.83S366.114,234.386,355.148,234.386z"></path>
</g>
</g></svg><img></span>&nbsp;Add Quız
        </a>
        <a href="https://nicepage.com/c/gallery-html-templates" class="u-btn u-btn-round u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-radius-25 u-btn-6"><span class="u-icon u-text-white u-icon-5"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M481.996,30.006C462.647,10.656,436.922,0,409.559,0c-27.363,0-53.089,10.656-72.438,30.005L50.826,316.301    c-2.436,2.436-4.201,5.46-5.125,8.779L0.733,486.637c-1.939,6.968,0.034,14.441,5.163,19.542c3.8,3.78,8.892,5.821,14.106,5.821    c1.822,0,3.66-0.25,5.463-0.762l161.557-45.891c6.816-1.936,12.1-7.335,13.888-14.192c1.788-6.857-0.186-14.148-5.189-19.167    L93.869,329.827L331.184,92.511l88.258,88.258L237.768,361.948c-7.821,7.8-7.838,20.463-0.038,28.284    c7.799,7.822,20.464,7.838,28.284,0.039l215.98-215.392C501.344,155.53,512,129.805,512,102.442    C512,75.079,501.344,49.354,481.996,30.006z M143.395,436.158L48.827,463.02l26.485-95.152L143.395,436.158z M453.73,146.575    l-5.965,5.949l-88.296-88.297l5.938-5.938C377.2,46.495,392.88,40,409.559,40c16.679,0,32.358,6.495,44.152,18.29    C465.505,70.083,472,85.763,472,102.442C472,119.121,465.505,134.801,453.73,146.575z"></path>
</g>
</g></svg><img></span>&nbsp;EDIT LECTURES
        </a>
        <a href="https://nicepage.com/c/gallery-html-templates" class="u-btn u-btn-round u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-radius-25 u-btn-7"><span class="u-icon u-text-white u-icon-6"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><g><g><path d="M481.996,30.006C462.647,10.656,436.922,0,409.559,0c-27.363,0-53.089,10.656-72.438,30.005L50.826,316.301    c-2.436,2.436-4.201,5.46-5.125,8.779L0.733,486.637c-1.939,6.968,0.034,14.441,5.163,19.542c3.8,3.78,8.892,5.821,14.106,5.821    c1.822,0,3.66-0.25,5.463-0.762l161.557-45.891c6.816-1.936,12.1-7.335,13.888-14.192c1.788-6.857-0.186-14.148-5.189-19.167    L93.869,329.827L331.184,92.511l88.258,88.258L237.768,361.948c-7.821,7.8-7.838,20.463-0.038,28.284    c7.799,7.822,20.464,7.838,28.284,0.039l215.98-215.392C501.344,155.53,512,129.805,512,102.442    C512,75.079,501.344,49.354,481.996,30.006z M143.395,436.158L48.827,463.02l26.485-95.152L143.395,436.158z M453.73,146.575    l-5.965,5.949l-88.296-88.297l5.938-5.938C377.2,46.495,392.88,40,409.559,40c16.679,0,32.358,6.495,44.152,18.29    C465.505,70.083,472,85.763,472,102.442C472,119.121,465.505,134.801,453.73,146.575z"></path>
</g>
</g></svg><img></span>&nbsp;EDIT quızıez
        </a>
    </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>