<!DOCTYPE html>
<html lang="en">
<title>SAPIENTIA</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
</style>

<body>
<?php

//config inclusion session starts
include "config.php";
session_start();

//defining necessary variables
$username = "";
$password = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $username = mysqli_real_escape_string($db, $_POST['e-mail']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //sql query for checking inputs and finding corresponding student
    $sql = "SELECT e-mail, password FROM Student WHERE SID = ? and name = ?";
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $entered_username, $entered_password);

        //set parameters
        $entered_username = $username;
        $entered_password = $password;

        //executing the statement
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            //checking if sid and sname is true
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $username, $turned_pw);

                if(mysqli_stmt_fetch($stmt)){
                    if($turned_pw == $password){
                        //inputs are correct session is starting
                        session_start();
                        $_SESSION['sname'] = $username;
                        $_SESSION['sid'] = $password;
                        header("location: student_main_page.php");
                    }
                }
            }else{
                //wrong input
                echo "<script type='text/javascript'>alert('Invalid E-mail or Password.');</script>";
            }

        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>



<!-- Header -->
<header class="w3-container w3-cyan w3-center" style="padding:12px 16px">
    <h1 class="w3-margin w3-jumbo">Sapientia<br> Online Course Platform</h1>
</header>

<div class="w3-row-padding w3-padding-64 w3-container">
    <div class="w3-content">
        <div class="w3-twothird">
            <h1>Login</h1>
            <h2 class="w3-padding-32">


                <form id="loginForm" action="" method="post">
                    <div class="form-group">
                        <label for="e-mail">E-mail</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <input type="text" name="e-mail" class="form-control" id="e-mail" placeholder="Your e-mail..">

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password">Password</label> &nbsp; &nbsp;
                        <input type="password" name="password" class="form-control" id="password" placeholder="Your password..">

                    </div>
                    <br>
                    <div
                    <a onclick="tryLogin()" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Login</a>
        </div>
                    <div
                    <a onclick="signup()" class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Sign up</a>
        </div>
        </form>
        </h2>

        <p class="w3-text-grey"></p>
    </div>

    <div class="w3-third w3-center">

    </div>
</div>
</div>


<script type="text/javascript">
    function tryLogin() {
        var email_value = document.getElementById("e-mail").value;
        var password_value = document.getElementById("password").value;
        if (email_value === "" || password_value === "") {
            alert("Fill e-mail and password fields.");
        }
        else {
            var form = document.getElementById("loginForm").submit();
        }
    }

    function signup() {
        window.location.href='create_account.php';
    }
</script>
</body>
</html>