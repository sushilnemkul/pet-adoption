<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "project"; //here project is the database name

$conn = mysqli_connect($host, $user, $password, $db_name);
if (!$conn) {
    die("Something went wrong; " );
}


?>