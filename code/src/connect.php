<?php
//connection
define('server','dijkstra.ug.bcc.bilkent.edu.tr');
define('user','omer.unlusoy');
define('pass','8cWZ7QRc');
define('db','omer_unlusoy');

$con = new mysqli(server,user,pass,db);
if($con -> connect_errno)
{
echo "ERROR: Could not connect!";
}
