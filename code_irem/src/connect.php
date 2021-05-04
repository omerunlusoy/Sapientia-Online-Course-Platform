<?php
//connection
define('server','dijkstra.ug.bcc.bilkent.edu.tr');
define('user','irem.tekin');
define('pass','WF9cpRT5');
define('db','irem_tekin');

$con = new mysqli(server,user,pass,db);
if($con -> connect_errno)
{
echo "ERROR: Could not connect!";
}
