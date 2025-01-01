<?php
$conn = mysqli_connect("localhost", "root", "1234", "project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>