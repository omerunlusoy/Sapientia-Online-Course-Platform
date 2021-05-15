<?php

include("connect.php");


    $e_mail = $_POST['email_s'];
    $password = $_POST['password_s'];
    $name = $_POST['name_s'];


    if($e_mail=="" | $password=="" | $name =="")
    {
        echo "<script type='text/javascript'>alert('Fill all the fields!');</script>";
    }
    else {

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
                    echo "<script type='text/javascript'>alert('You already have an account');</script>";
                    header("Location:signUp.php");
                }

            } else {
                header("Location:signUp.php");
            }
    }
?>