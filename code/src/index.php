<?php

include("connect.php");

$top_courses_sql = "select * 
                        from Discount right join Course on Course.CID = Discount.CID  natural join Instructor
                        order by rate DESC 
                        limit 0, 5";

$result = mysqli_query($con, $top_courses_sql);




?>

<!DOCTYPE html>
<html style="font-size: 16px;">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Learn Everyday, Join online courses today, Train Your Brain Today!, Learn to enjoyevery minute of your life., Online Learning, Innovations in Online Learning, Education and Learning, 01, 02, 03, 04, Contact Us">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Home</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Home.css" media="screen">
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
            "logo": "images/SapientiaLogo.PNG"
        }</script>
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#478ac9">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
</head>
<body data-home-page="Home.html" data-home-page-title="Home" class="u-body"><header class="u-clearfix u-header u-header" id="sec-85c8"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1" data-image-width="521" data-image-height="202">
            <img src="images/SapientiaLogo.PNG" class="u-logo-image u-logo-image-1" data-image-width="196.129">
        </a>
    </div></header>
<section class="u-clearfix u-image u-valign-top u-section-1" id="sec-832e">
    <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
        <div class="u-gutter-0 u-layout">
            <div class="u-layout-row">
                <div class="u-align-left u-container-style u-layout-cell u-size-29 u-layout-cell-1">
                    <div class="u-container-layout u-container-layout-1">
                        <h5 class="u-custom-font u-font-pt-sans u-text u-text-1">online learning</h5>
                        <h1 class="u-text u-text-2">Sapientia</h1>
                        <p class="u-text u-text-3">Sapientia is what you need in life.<br>
                            <br>
                            <br>
                        </p>
                        <form method="POST" action="signUp.php">
                            <a   id="signUpButton" class="u-active-palette-1-dark-2 u-btn u-btn-rectangle u-button-style u-custom-font u-font-pt-sans u-hover-palette-1-dark-2 u-palette-1-dark-3 u-radius-0 u-btn-1">Sign up for Wısdom</a>
                            <script type="text/javascript">
                                document.getElementById("signUpButton").onclick = function () {
                                    location.href = "signUp.php";
                                };
                            </script>
                        </form>
                        <form method="POST" action="login.php">
                            <a id="loginButton"  class="u-active-palette-1-dark-2 u-btn u-btn-rectangle u-button-style u-custom-font u-font-pt-sans u-hover-palette-1-dark-2 u-palette-1-dark-3 u-radius-0 u-btn-2">logın for Wısdom</a>
                            <script type="text/javascript">
                                document.getElementById("loginButton").onclick = function () {
                                    location.href = "login.php";
                                };
                            </script>
                        </form>
                    </div>
                </div>
                <div class="u-align-right u-container-style u-image u-layout-cell u-size-31 u-image-1">
                    <div class="u-container-layout u-valign-bottom u-container-layout-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="u-align-center u-clearfix u-section-2" id="sec-4fce">

    <div class="u-table u-table-responsive u-table-1">
        <h2 class="u-text u-text-3">Popular Courses</h2>
        <table class="u-table-entity u-table-entity-1">

            <?php

            if ($result) {

                echo "<table class=\"u-table-body\">
            <tr class=\"u-palette-4-base u-table-header u-table-header-1\">
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Course Name</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Price</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Category</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Level</th>
            <th class=\"u-border-1 u-border-palette-4-base u-table-cell\">Instructor</th>

            
            
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

                }
            }

            ?>

            <colgroup>
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
                <col width="20%">
            </colgroup>

            <tbody class="u-table-body">

            </tbody>
        </table>
    </div>

</section>


<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-266b"><div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Wisdom is life...</p>
    </div></footer>

</body>
</html>