<?php

include("connect.php");

session_start();


if(isset($_SESSION['PAGENUM'])){
    $page_num = $_SESSION['PAGENUM'];}
else{$_SESSION['PAGENUM'] = 0;}

if(isset($_SESSION['level'])){
    $level = $_SESSION['level'];}
else{$level = "All";}



if(isset($_GET['search'])){
    $_SESSION['search'] = $_GET['search'];
}

if(isset($_POST['right_page'])){
    $_SESSION['PAGENUM'] = $_SESSION['PAGENUM'] + 1;

}

if(isset($_POST['left_page'])){
    if($_SESSION['PAGENUM'] != 0){
        $_SESSION['PAGENUM'] = $_SESSION['PAGENUM'] - 1;
    }
}


if(isset($_POST['filter_button'])){

    if($_POST['level'] != ""){
        $_SESSION['level'] = $_POST['level'];
    }
    if($_POST['category'] != ""){
        $_SESSION['category'] = $_POST['category'];
    }
    if($_POST['price'] != ""){
        $_SESSION['price'] = $_POST['price'];
    }
    if($_POST['discount'] != ""){
        $_SESSION['discount'] = $_POST['discount'];
    }

    header("location: admin_main.php");
}


if(isset($_POST['offer_discount_button'])){
    $_SESSION['CID'] = $_POST['offer_discount_button'];
    header("location: admin_offer_discount.php");
}

if(isset($_POST['view_statistics_button'])){
    $_SESSION['CID'] = $_POST['view_statistics_button'];
    header("location: admin_course_statistics.php");
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
    <title>admin main</title>
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
    <div class="u-clearfix u-sheet u-sheet-1">
        <form action="#" method="get" class="u-border-1 u-border-grey-30 u-search u-search-left u-white u-search-1">
            <button class="u-search-button" type="submit">
            <span class="u-search-icon u-spacing-10">
              <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 56.966 56.966"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-edc1"></use></svg>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-edc1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" class="u-svg-content"><path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path></svg>
            </span>
            </button>
            <input class="u-search-input" type="search" name="search" value="" placeholder="Search in Courses or Instructors...">
        </form>
        <div class="u-form u-form-1">
            <form action="#" method="POST">
                <div class="u-form-group u-form-select u-form-group-1">
                    <label for="select-f368" class="u-label">Level</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-f368" name="level" class="u-border-4 u-border-palette-4-base u-input u-input-rectangle">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="All">All</option>

                            <option selected value='<?php if(isset($_SESSION['level'])){
                                $level = $_SESSION['level'];}
                            else{$level = "All";}; ?>'><?php if(isset($_SESSION['level'])){
                                    $level = $_SESSION['level'];
                                    echo $level;}
                                else{echo "All";} ?></option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-select u-form-group-2">
                    <label for="select-90be" class="u-label">Category</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-90be" name="category" class="u-border-4 u-border-palette-4-base u-input u-input-rectangle">
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
                            <option value="All">All</option>
                            <option selected value='<?php if(isset($_SESSION['category'])){
                                $category = $_SESSION['category'];}
                            else{$level = "All";}; ?>'><?php if(isset($_SESSION['category'])){
                                    $category = $_SESSION['category'];
                                    echo $category;}
                                else{echo "All";} ?></option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-select u-form-group-3">
                    <label for="select-4350" class="u-label">Price</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-4350" name="price" class="u-border-4 u-border-palette-4-base u-input u-input-rectangle">
                            <option value="$50+">$50+</option>
                            <option value="$35-$50">$35-$50</option>
                            <option value="$15-$35">$15-$35</option>
                            <option value="$5-$15">$5-$15</option>
                            <option value="$0-$5">$0-$5</option>
                            <option value="Free">Free</option>
                            <option value="All">All</option>
                            <option selected value='<?php if(isset($_SESSION['price'])){
                                $price = $_SESSION['price'];}
                            else{$price = "All";}; ?>'><?php if(isset($_SESSION['price'])){
                                    $price = $_SESSION['price'];
                                    echo $price;}
                                else{echo "All";} ?></option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-select u-form-group-4">
                    <label for="select-cdbe" class="u-label">Discount</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-cdbe" name="discount" class="u-border-4 u-border-palette-4-base u-input u-input-rectangle">
                            <option value="%75-%100">%75-%100</option>
                            <option value="%50-%75">%50-%75</option>
                            <option value="%25-%50">%25-%50</option>
                            <option value="%0-%25">%0-%25</option>
                            <option value="All">All</option>
                            <option selected value='<?php if(isset($_SESSION['discount'])){
                                $discount = $_SESSION['discount'];}
                            else{$discount = "All";}; ?>'><?php if(isset($_SESSION['discount'])){
                                    $discount = $_SESSION['discount'];
                                    echo $discount;}
                                else{echo "All";} ?></option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"  class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                    </div>
                </div>
                <div class="u-form-group u-form-submit">
                    <a href="#" class="u-btn u-btn-submit u-button-style u-palette-4-base u-btn-1">Filter</a>
                    <input type="submit"  value="filter_button" name="filter_button" class="u-form-control-hidden">
                </div>

            </form>
        </div>
        <div class="u-table u-table-responsive u-table-1">
            <h2>Courses</h2>
            <table class="u-table-entity u-table-entity-1">
                <?php

                if(isset($_SESSION['level'])){
                    $level = $_SESSION['level'];}
                else{$level = "All";}

                if(isset($_SESSION['category'])){
                    $category = $_SESSION['category'];}
                else{$category = "All";}

                if(isset($_SESSION['price'])){
                    $price = $_SESSION['price'];}
                else{$price = "All";}

                if(isset($_SESSION['discount'])){
                    $discount = $_SESSION['discount'];}
                else{$discount = "All";}


                $price_max = 100000;
                $price_min = 0;
                if($price == "$50+"){
                    $price_max = 100000;
                    $price_min = 50;
                }
                else if($price == "$35-$50"){
                    $price_max = 50;
                    $price_min = 35;
                }
                else if($price == "$15-$35"){
                    $price_max = 35;
                    $price_min = 15;
                }
                else if($price == "$5-$15"){
                    $price_max = 15;
                    $price_min = 5;
                }
                else if($price == "$0-$5"){
                    $price_max = 5;
                    $price_min = 0;
                }
                else if($price == "Free"){
                    $price_max = 0;
                    $price_min = 0;
                }
                else{
                    $price_max = 100000;
                    $price_min = 0;
                }

                $discount_max = 100;
                $discount_min = 0;

                if($discount == "%75-%100"){
                    $discount_max = 100;
                    $discount_min = 75;
                }
                else if($discount == "%50-%75"){
                    $discount_max = 75;
                    $discount_min = 50;
                }
                else if($discount == "%25-%50"){
                    $discount_max = 50;
                    $discount_min = 25;
                }
                else if($discount == "%0-%25"){
                    $discount_max = 25;
                    $discount_min = 0;
                }
                else{
                    $discount_max = 100;
                    $discount_min = 0;
                }

                if(isset($_SESSION['search'])){
                    $search_word = $_SESSION['search'];}
                else{$search_word = "";}

                $all_courses_sql = "";
                $page_entry_num = 10;

                $page_num = $_SESSION['PAGENUM'] * $page_entry_num;
                if($level == "All" && $category == "All"){
                    $all_courses_sql = "select * 
                                        from Discount right join Course on Course.CID = Discount.CID  and
                                        rate between '$discount_min' and '$discount_max' natural join Instructor
                                        where
                                        cost between '$price_min' and '$price_max' and 
                                        (course_name like '%$search_word%' or Instructor.name like '%$search_word%')
                                        limit $page_num, $page_entry_num";
                }
                else if($level == "All" && $category != "All"){
                    $all_courses_sql = "select * 
                                    from Discount right join Course on Course.CID = Discount.CID and 
                                        rate between '$discount_min' and '$discount_max' natural join Instructor
                                    where
                                        cost between '$price_min' and '$price_max' and 
                                        category = '$category' and 
                                        (course_name like '%$search_word%' or Instructor.name like '%$search_word%')
                                        limit $page_num, $page_entry_num";
                }
                else if($level != "All" && $category == "All"){
                    $all_courses_sql = "select * 
                                    from Discount right join Course on Course.CID = Discount.CID and 
                                        rate between '$discount_min' and '$discount_max' natural join Instructor
                                    where
                                        cost between '$price_min' and '$price_max' and 
                                        level = '$level' and 
                                        (course_name like '%$search_word%' or Instructor.name like '%$search_word%')
                                        limit $page_num, $page_entry_num";
                }
                else{
                    $all_courses_sql = "select * 
                                    from Discount right join Course on Course.CID = Discount.CID and 
                                        rate between '$discount_min' and '$discount_max' natural join Instructor
                                    where
                                        cost between '$price_min' and '$price_max' and 
                                        category = '$category' and level = '$level' and 
                                        (course_name like '%$search_word%' or Instructor.name like '%$search_word%')
                                        limit $page_num, $page_entry_num";
                }




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
            
            
            </tr>";

                    while($row = mysqli_fetch_array($result)) {
                        $IID_cur = $row['IID'];
                        $discount_allowed = $row['discount_allowed'];
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
                                    <button type=\"submit\" name = \"view_statistics_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$row['CID'] .">View Statistics</button>
                                     </form>
                            </td>";
                        if($discount_allowed)
                        {
                            echo "<td> <form action=\"#\" METHOD=\"POST\">
                                    <button type=\"submit\" name = \"offer_discount_button\" id = \"btn\" class=\"u-border-2 u-border-palette-2-light-2 u-btn u-button-style u-hover-palette-2-light-2 u-none u-text-black u-text-hover-white u-btn-4\" value =".$row['CID'] .">Offer Discount</button>
                                     </form>
                            </td>";
                        }
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
