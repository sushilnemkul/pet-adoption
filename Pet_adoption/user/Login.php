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
        background-image: url(img/logi.jpg.png);
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
</style>

<?php
include 'database.php';


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check both admin and user tables for the email
  
    $userQuery = "SELECT * FROM users WHERE email = '$email'";


  
    $userResult = mysqli_query($conn, $userQuery);
    

   if (mysqli_num_rows($userResult) > 0) {
        $row = mysqli_fetch_array($userResult);
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // After successful login
$_SESSION['user'] = "true";
$_SESSION['user_id'] = $user_id; // Assuming $user_id is the ID of the logged-in user
            $_SESSION['user_id'] = $row['ID']; 
          
            
          
            header("Location: indexx.php");
            exit();
        } else {
            echo "<script>alert('Invalid password for user account.');window.location.href = 'Login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.');window.location.href = 'Login.php';</script>";
    }
}
?>

<div class="login-container">
    <h1>Login</h1>
    <form action="Login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email">
        <span id="error_email"></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <span id="error_password"></span>

        <input type="submit" value="Login" name="login" id="login">
    </form>

    <div class="signup-link">
        Don't have an account? <a href="signup.php">Sign Up</a>
    </div>
</div>
