<?php
include("connect.php");
session_start();

//number of application of the student
$sql = "select count(sid) as id_count from apply where sid =" .$_SESSION['login_pass'];
$result = mysqli_query($con, $sql);

if ($result) {
    $row = mysqli_fetch_array($result);
    if ($row['id_count'] == 3) {
        echo "<script type='text/javascript'>alert('You can apply max 3 internships!');
        window.location.href = 'welcome1.php'; 
         </script>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $given_cid = $_POST['cid'];
        $student_id = $_SESSION['login_pass'];

        $sql1 = "SELECT cid FROM company WHERE cid='$given_cid'";

        if ($sql1 = $con->query($sql1)) {
            if ($sql1->num_rows == 1) {
                $sql2 = "select * from apply where cid='$given_cid'and sid='$student_id'";
                if ($sql2 = $con->query($sql2)) {
                    if ($sql2->num_rows != 0) {
                        echo "<script type='text/javascript'>alert('You already applied to this company!');</script>";
                    } else {
                        //quota check
                        $quota_check = "SELECT quota FROM company WHERE cid='$given_cid'";
                        $result = mysqli_query($con, $quota_check);

                        if ($result) {
                            $row = mysqli_fetch_array($result);
                            $quota = $row['quota'];

                            if ($quota == 0) {
                                echo "<script type='text/javascript'>alert('No available quota for this company!');</script>";
                            } else {
                                //apply
                                $insert_application= "INSERT INTO apply VALUES ('$student_id','$given_cid')";
                                $result = mysqli_query($con,$insert_application);

                                $update_quota = "UPDATE company SET quota = quota -1 WHERE cid = '$given_cid'";
                                $result2 = mysqli_query($con,$update_quota);

                                if($result && $result2)
                                {
                                    echo "<script type='text/javascript'>alert('You applied successfully!');
                                    window.location.href = 'welcome1.php'; 
                                    </script>";
                                }
                                else
                                {
                                    echo "Error";
                                    exit();
                                }

                            }
                        }

                    }
                }

            } else {
                echo "<script>
                window.alert('Company does not exist!);
                window.location.href = 'apply1.php'; 
                </script>";
            }

        }

    }
}


else {
    echo "<script type='text/javascript'>alert('Error');</script>";
    exit();
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Apply</title>
</head>
<body>

        <h3><?php echo htmlspecialchars($_SESSION['login_user']); ?></h3>

    <p><a class="nav-link" href="welcome1.php">Go Back</a></p>
    <p><a class="nav-link" href="logout.php">Logout</a></p>

    <div class="apply">
        <h2>Apply</h2>

        <?php
        echo "<table class=\"table\">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quota</th>
        </tr>";

        $sql ="select * from company as c where c.quota > 0 and  not exists(SELECT * FROM apply WHERE c.cid = cid AND sid =".$_SESSION['login_pass'].")";


        if ($sql) {
            $result = mysqli_query($con, $sql);

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['cid'] . "</td>";
                echo "<td>" . $row['cname'] . "</td>";
                echo "<td>" . $row['quota'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else{
            echo "Error";
            exit();
        }

        ?>
    </div>

    <form action="#" METHOD="POST">
        <div class = "submit_part">
            <input type="text" name="cid" placeholder="Company ID">
            <button type="submit" id="btn" >Submit</button>
        </div>
    </form>

</body>

<style type="text/css">

    .apply {
        text-align: center;
    }

    .table{
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    .submit_part
    {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }

    #btn{
        background: darkslategray;
        color: white;
    }


</style>