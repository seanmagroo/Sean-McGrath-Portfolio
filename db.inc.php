<?php
$hostname="localhost"; // name of host or ip address
$username="SeanMcGrath";
$password="SeanMcGrath02!";
$dbname="MyDBC00287963";
//MySQL username - Users need to change this to their own //MySQL Password - Users need to change this to their own
//database Name - Users need to change this to their own
$con = mysqli_connect ($hostname, $username, $password, $dbname);
if (!$con) {
    die ("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
