<!-- <!DOCTYPE html>
<html>
<head>
    <title>Pet Adoption Login</title>
    <link rel="stylesheet" href="trial.css">
</head>
<body>
    <div class="navbar">
        <div class="logo"><img src="logo.png" alt="adopt" width="125px"></div><style></style></h2>  
          <ul class="menu">
           <li><a href="#">HOME</a></li>
           <li><a href="#">ABOUT</a></li>
        
          

           <li><a href="#">DOGS</a>
          <ul class="dropdown">
       <li><a href="#">Dog Adoption </a></li>
       <li><a href="#">Dog Breeds</a></li>
       <li><a href="#">Dog Size</a></li>
       <li><a href="#">Vaccinations</a></li>
       <li><a href="#">Dog Behaviour</a></li>
          </ul>
         </li>


           <li><a href="#">CATS</a>
           <ul class="dropdown">
         <li><a href="#">Cat Adoption</a></li>
         <li><a href="#">Cat Breeds</a></li>
         <li><a href="#">Cat Behaviour</a></Li>
         <li><a href="#">Vaccinations</a></li>
    
           </ul>
           </li>

 

           <li><a href="#">How To Help</a>
             <ul class="dropdown"> 
           <li><a href="#">Donate Now</a></li>
           <li><a href="#">Day Visit Package</a></li>
           <li><a href="#">Sponsor</a></li>
           <li><a href="#">Adopt</a></li>
           <li><a href="#">Work with us</a></li>
           </ul>
         </li>    
         <li><a href="#">Contact Us</a></li>
         <button class="btn"><a href="#"></a>SIGN IN</button>
         </ul>
         </ul> 
         

     </div>
 
   </div>
   </div> -->
   <?php include 'header.php'; ?>
<style> 
    /* Login page CSS */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h1 {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 10px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background-color: #45a049;
}
a {
    text-decoration: none;
    color: #333;
}
.signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

</style>

    <div class="login-container">
        <h1>Login</h1>
        <form>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit"><a href="#">Login</a></button>
        </form>
        
        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>

<?php 
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $servername = "localhost";  
    $username1 = "root";
    $password1 = "";
    $dbname = "project";
    $conn = new mysqli($servername, $username1, $password1, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "Invalid username or password";
    }
    $conn->close();
}


?>