<?php
session_start();
session_unset();//unset all session variables
session_destroy();//destroy all session data
header("Location: ../user/Login.php");//redirect to login page
exit();
?>