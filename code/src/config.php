<?php
define('SERVER', 'dijkstra.ug.bcc.bilkent.edu.tr');
define('USERNAME', 'omer.unlusoy');
define('PASSWORD', '8cWZ7QRc');
define('DATABASE', 'omer_unlusoy');
$db = mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);

if (!$db) {
    die("connection failed. " . mysqli_connect_error());
}
?>