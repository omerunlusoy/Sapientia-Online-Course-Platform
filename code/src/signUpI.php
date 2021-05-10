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
?>