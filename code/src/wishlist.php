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

if(isset($_POST['view_button'])){
    $_SESSION['CID'] = $_POST['view_button'];

    header("location: view_course.php");
}

if(isset($_POST['buy_button'])){

}


if(isset($_POST['remove_button'])){
    $_SESSION['CID'] = $_POST['remove_button'];
    $CID = $_SESSION['CID'];
    $SID = $_SESSION['SID'];

    $sql_select = "select * 
                   from  Wishlist 
                   where SID = '$SID' and CID = '$CID'";

    $result = mysqli_query($con, $sql_select);

    if ($result->num_rows == 0) {
        echo "<script type='text/javascript'>alert('Database Error!');</script>";
    }
    else{
        $delete_sql = "DELETE FROM Wishlist WHERE CID='$CID' and SID='$SID'";

        $result = mysqli_query($con, $delete_sql);
        if( $result)
        {
            echo "<script type='text/javascript'>alert('Course removed from wishlist!');</script>";
        }
        else
        {
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
    <title>Wishlist</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="student-main.css" media="screen">
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
<section class="u-align-center u-border-7 u-border-palette-4-base u-clearfix u-white u-section-2" id="sec-8092">
        <div class="u-table u-table-responsive u-table-1">
            <h2>Wishlist</h2>
            <table class="u-table-entity u-table-entity-1">
                <?php

                $SID = $_SESSION['SID'];

                $discount_max = 100;
                $discount_min = 0;

                $page_entry_num = 10;

                $page_num = $_SESSION['PAGENUM'] * $page_entry_num;

                $all_courses_sql = "select * 
                                    from  Course left join Discount on Course.CID = Discount.CID left join Wishlist
                                    on Course.CID = Wishlist.CID
                                    where SID = '$SID'
                                    limit $page_num, $page_entry_num";



                $result = mysqli_query($con, $all_courses_sql);

                if ($result) {

                    echo "<table class=\"u-table-body\">
            <tr class=\"u-palette-4-base u-table-header u-table-header-1\">
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Course Name</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Price</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Category</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Level</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Instructor</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\"></th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\"></th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\"></th>
            
            
            </tr>";

                    while($row = mysqli_fetch_array($result)) {

                        $IID_cur = $row['IID'];
                        $current_instructor_name_sql = "select name from Instructor where IID = '$IID_cur'";
                        $result2 = mysqli_query($con, $current_instructor_name_sql);
                        $row2 = mysqli_fetch_array($result2);
                        $cur_int_name = $row2['name'];
                        $discount_rate = $row['rate'];
                        $cost = $row['cost'];
                        $new_price = round(((100 - $discount_rate) / 100) * $cost, 2);

                        if($cost == 0.0){
                            $cost = "Free";
                            $new_price = "Free";
                        }

                        echo "<tr>";
                        echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-7\">" .$row['course_name']. "</td>";
                        if($cost == "Free"){
                            echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-13\">" .$cost."</td>" ;
                        }
                        else if($discount_rate == 0.0){
                            echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-13\">" .$cost."₺</td>" ;
                        }
                        else{
                            echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-13\"> <del>" .$cost. "₺<br></del> ".$new_price. "₺</td>" ;
                        }

                        echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$row['category']. "</td>";
                        echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$row['level']. "</td>";
                        echo "<td class=\"u-border-1 u-border-grey-30 u-first-column u-grey-5 u-table-cell u-table-cell-19\">" .$cur_int_name. "</td>";
                        echo "<td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"view_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$row['CID'] .">View</button>
                                     </form>
                            </td>";
                        echo "<td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"buy_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$row['CID'] .">Buy</button>
                                     </form>
                            </td>";
                        echo "<td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"remove_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$row['CID'] .">Remove</button>
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
                <button type="submit" name = "left_page" id = "btn" class="u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4-13">Left</button>
                <button type="submit" name = "right_page" id = "btn" class="u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4-14">Right</button>
            </div>
        </form>
        <p class="u-text u-text-1"><?php echo $_SESSION['PAGENUM'] + 1; ?></p>
</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>

</body>
</html>
