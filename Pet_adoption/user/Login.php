<?php include 'header.php'; ?>
<style>
    /* Login page CSS */
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image:url(img/logi.jpg.png);
        background-size: cover;
    }

    .login-container {
        background-color: #ffe4c4;
        opacity: 0.8;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        text-align: center;
        margin-left: 100px;
      
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

    input[type="submit"] {
        background-color: #28a745 !important;
        color: #ffffff !important;
        padding: 10px 20px !important;
        font-size: 16px !important;
        border: none !important;
        border-radius: 5px !important;
        cursor: pointer !important;
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

    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-bottom: 10px;
        background-color: #fff;
        color: #333;
        font-size: 16px;
        cursor: pointer;
     

    }
   
    
</style>



    <?php
// Start the session


include 'database.php';

if (isset($_POST["login"])) {
  
    $email = $_POST["email"];
    $password = $_POST["password"];
    $usertype = $_POST['usertype'];

    // Determine the table based on user type
    if ($usertype === 'admin') {
        $sql = "SELECT * FROM shelteradmin WHERE email = '$email'";
    } elseif ($usertype === 'user') {
        $sql = "SELECT * FROM users WHERE email = '$email'";
    } else {
        die("<script>alert('Invalid user type.');window.location.href = 'Login.php';</script>");
    }

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check for query errors
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            if ($usertype === 'admin') {
                $_SESSION['admin'] = "true";
               
                echo "<script>alert('Welcome to the admin panel!');window.location.href = '../admin/admin_page.php';</script>";
            } elseif ($usertype === 'user') {
                $_SESSION['user'] = "true";
               
             header("Location: indexx.php");
            }
            exit();
          
        } else {
            echo "<script>alert('Invalid password for $usertype.');window.location.href = 'Login.php';</script>"; // echo "Invalid password for $usertype.";
        }
    } else {
        echo "<script>alert('No $usertype found with that email.');window.location.href = 'Login.php';</script>"; // echo "No $usertype found with that email.";
    }
}
?>

<div class="login-container">
<!-- <div class="welcome-message">
            <h1>Welcome to Pet Adoption</h1>
            <p>Find your perfect pet companion today. Log in or sign up to get started!</p>
        </div> -->
<h1>Login</h1>
    <form action="Login.php" method="post">
        <label for="username">Username:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email:">
        <span id="error_email"></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <span id="error_password"></span>  
        
        <label for="usertype">User Type</label>
            <select id="usertype" name="usertype">
            <option value="">Select User Type</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
      

        <input type="submit" value="login" name="login" id = "login">
    </form>

    <div class="signup-link">
        Don't have an account? <a href="signup.php">Sign Up</a>
    </div>
</div>



