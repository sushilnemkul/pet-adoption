<?php


session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] === "true") {
  $user_id = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopt a Buddy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="trial.css">
</head>
<body>
     
     
    
<div class="navbar">
    <div class="logo"><img src="img/logo.png" alt="adopt" width="110px"></div>
    <ul class="menu">
        <li><a href="indexx.php">HOME</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="pets.php">AVAILABLE PETS</a></li>
        <li><a href="profile.php">PROFILE</a></li>

        <?php if (isset($_SESSION['user']) && $_SESSION['user'] === "true") { ?>
            <li><div class="logout"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div></li>

        <?php } else { ?>
            <li><div class="login"><a id="login" href="Login.php"><i class="fa fa-sign-in"></i> Login</a></div></li>
        <?php } ?>
    </ul>
</div>

</body>
</html>