<?php


session_start();





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
             <div class="logo"><img src="img/logo.png" alt="adopt" width="110px"></div><style></style></h2>  
               <ul class="menu">
                <li><a href="indexx.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="pets.php">AVAILABLE PETS</a></li>
               

                <!-- <li><a href="Dogs.php">DOGS</a>
               <ul class="dropdown">
            <li><a href="#">Dog Adoption </a></li>
            <li><a href="#">Dog Breeds</a></li>
            <li><a href="#">Dog Size</a></li>
            <li><a href="#">Vaccinations</a></li>
            <li><a href="#">Dog Behaviour</a></li>
               </ul>
              </li> -->


                <!-- <li><a href="cats.php">CATS</a>
                <ul class="dropdown">
              <li><a href="#">Cat Adoption</a></li>
              <li><a href="#">Cat Breeds</a></li>
              <li><a href="#">Cat Behaviour</a></Li>
              <li><a href="#">Vaccinations</a></li>
         
                </ul>
                </li> -->

      

                 
              <li><a href="#">Contact Us</a></li>
              <?php if (isset($_SESSION['user']) && $_SESSION['user'] === "true") { ?>
    <l1><div class="logout"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></div><li>
 
<?php } else { ?>
   <li> <div class="login"><a id="login" href="login.php"> <i class="fa fa-sign-in"></i> Login</a></div></li>
<?php } ?>

              
              </ul> 
          </div>
</body>
</html>