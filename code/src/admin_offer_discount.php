<?php
include("connect.php");
session_start();
$CID = $_SESSION['CID'];
$AID = $_SESSION['AID'];

//price
$sql_price = "select * 
              from Course
              where CID = '$CID'";

$result1 = mysqli_query($con, $sql_price);

//current discount
$sql_rate = "select *
               from Discount
               where CID = '$CID'";
$result2 = mysqli_query($con, $sql_rate);


if($result1 && $result2 )
{
    $row1= mysqli_fetch_array($result1);
    $price = $row1['cost'];
    $_SESSION['cost'] = $price;
    $_SESSION['course_name'] = $row1['course_name'];


    $row2 = mysqli_fetch_array($result2);
    if($result2->num_rows != 0)
    {
        $course_rate = $row2['rate'];
        $_SESSION['course_rate'] = $course_rate;
    }
    else
    {
        $_SESSION['course_rate'] = 0;
    }

}
else
{
    echo "<script type='text/javascript'>alert('Database Error!');</script>";
}

if(isset($_POST['save_button'])){

    if(isset($_POST['new_discount_rate']) && isset($_POST['radiobutton1']))
    {
        //apply new rate
        $new_rate = $_POST['new_discount_rate'];

        if($result2->num_rows != 0)
        {
            $sql_update = "UPDATE Discount SET rate = '$new_rate' WHERE CID = '$CID' and AID = '$AID';";

            if ($result = $con->query($sql_update)) {
                $_SESSION['course_rate'] = $new_rate;
                echo "<script type='text/javascript'>alert('Discount applied!');</script>";
            }

        }
        else {
            $sql_insert = "INSERT INTO Discount (AID, CID, rate)
                VALUES ('$AID','$CID', '$new_rate');";

            if ($result = $con->query($sql_insert)) {
                $_SESSION['course_rate'] = $new_rate;
                echo "<script type='text/javascript'>alert('Discount applied!');</script>";
            }
        }
    }
    else if(isset($_POST['radiobutton2']))
    {
        //delete discount
        $sql = "DELETE FROM Discount WHERE AID='$AID' and CID='$CID';";
        if( $result = $con->query($sql)) {
            echo "<script type='text/javascript'>alert('Discount deleted!');</script>";
            header("Location:admin_offer_discount.php");
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
    <title>Offer Discount</title>
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
        <a href="admin_student_complaints.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-2">Student Complaints</a>
        <a href="admin_instructor_complaint.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-4">Instructor Complaints</a>
        <a href="logout.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-5">Logout</a>
        <a href="admin_main.php" class="u-active-none u-border-2 u-border-palette-1-base u-btn u-btn-rectangle u-button-style u-hover-none u-none u-text-body-color u-btn-8">Main Page</a>
    </div>
</section>
<section class="u-border-15 u-border-palette-2-light-3 u-clearfix u-section-2" id="carousel_f056">
    <h3 class="u-align-center u-text u-text-1"><?php echo $_SESSION["course_name"]; ?></h3>
    <div class="u-form u-form-1">
        <form action="#" method="POST"  style="padding: 10px" >
            <input type="hidden" id="siteId" name="siteId" value="974128024">
            <input type="hidden" id="pageId" name="pageId" value="212977796">
            <div class="u-form-group u-form-name u-form-group-1">
                <label for="name-2c18" class="u-form-control- u-label">Determined Price by Instructor (Discount will be applied to this price)</label>
                <input type="text" id="name-2c18" disabled value='<?php echo $_SESSION["cost"]; ?>' name="price" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="" placeholder="Determined Price">
            </div>
            <div class="u-form-group u-form-group-2">
                <label for="email-2c18" class="u-form-control- u-label">Applied Discount Rate</label>
                <input type="text" placeholder="Discount Rate" disabled value='<?php echo $_SESSION["course_rate"]; ?>' id="email-2c18" name="discount_rate_already" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white" required="required">
            </div>
            <div class="u-form-group u-form-group-3">
                <label for="text-e2c8" class="u-form-control- u-label">New Discount Rate</label>
                <input type="text" placeholder="New Discount Rate" id="text-e2c8" name="new_discount_rate" class="u-border-1 u-border-grey-30 u-input u-input-rectangle u-white">
            </div>
            <div class="u-form-group u-form-radiobutton u-form-group-4">
                <div class="u-form-radio-button-wrapper">
                    <input type="radio" name="radiobutton1" value="Apply Discount">
                    <label class="u-label"  for="radiobutton1">Apply Discount</label>
                    <br>
                    <input type="radio" name="radiobutton2" value="Delete Discount">
                    <label class="u-label" for="radiobutton2">Delete Discount</label>
                    <br>
                </div>
            </div>
            <div class="u-align-center u-form-group u-form-submit u-form-group-5">
                <a href="#" class="u-border-2 u-border-palette-2-light-3 u-border-radius-15 u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-2-dark-1 u-palette-2-light-2 u-btn-1">Save Changes</a>
                <input type="submit" name="save_button" value="submit" class="u-form-control-hidden">
            </div>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>
</body>
</html>