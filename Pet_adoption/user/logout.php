<?php
session_start();
session_destroy();//destroy all session data
header("Location: Login.php");//redirect to login page
exit();
?>