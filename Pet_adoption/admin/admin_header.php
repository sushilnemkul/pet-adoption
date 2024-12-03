<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    
<div class="navbar">
             <div class="logo"><img src="img/logo.png" alt="adopt" width="125px"></div><style></style></h2>  
               <ul class="menu">
                <li><a href="indexx.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
             
               

                <li><a href="Dogs.php">DOGS</a></li>
            


                <li><a href="cats.php">CATS</a></li>

      

                <li><a href="#">How To Help</a></li>    
              <li><a href="#">Contact Us</a></li>
          <!-- Change button based on session status -->
          <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === "true") { ?>
   <div class="logout"><li><a id="logout" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li></div>

<?php } else { ?>
   <div class="login"> <li><a id="login" href="../user/Login.php"> <i class="fa fa-sign-in"></i>Login</a></li></div>
<?php } ?>

              
          </div>
</body>
</html>