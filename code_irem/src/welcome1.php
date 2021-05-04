<?php

include("connect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $given_cid = $_POST['given_cid'];
    $student_id = $_SESSION['login_pass'];

    // cancel the application
    $delete = "delete from apply where sid ='$student_id' and cid='$given_cid'";
    $result = mysqli_query($con,$delete);

    // increase quota
    $update_quota = "update company set quota = (quota + 1) where cid='$given_cid'";
    $result2 = mysqli_query($con,$update_quota);

    if (!$result && !$result2) {
        echo "<script type='text/javascript'>alert('Cancellation FAILED!');</script>";
        exit();
    }else{
        echo "<script type='text/javascript'>alert('Successful cancellation!');</script>";
    }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>

   <h3><?php echo htmlspecialchars($_SESSION['login_user']); ?></h3>

   <p><a class="nav-link" href="logout.php">Logout</a></p>

    <div class="applied">
        <h2>Applied Internships</h2>

        <?php
        $sql = "select cid, cname, quota from student natural join apply natural join company where sid = " .$_SESSION['login_pass'];
        $result = mysqli_query($con, $sql);

        if ($result)
        {
            echo "<table class=\"table\">
            <tr>
            <th>Company ID</th>
            <th>Company Name</th>
            <th>Quota</th>
            <th>Cancel</th>
            </tr>";

            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" .$row['cid']. "</td>";
                echo "<td>" .$row['cname']. "</td>";
                echo "<td>" .$row['quota']. "</td>";
                echo "<td> <form action=\"#\" METHOD=\"POST\">
                    <button type=\"submit\" name = \"given_cid\" id = \"btn\" value =".$row['cid'] .">X</button>
                    </form>
                     
                  </td>";
                echo "</tr>";
        }

            echo "</table>";
        }
        else
        {
            header("Location:welcome1.php");
        }
        ?>

    <p><a href="apply1.php">Apply</a></p>
    </div>

</body>
</html>

<style type="text/css">


    .applied {
        text-align: center;
    }

    .table{
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    #btn{
        background: darkred;
    }

</style>
