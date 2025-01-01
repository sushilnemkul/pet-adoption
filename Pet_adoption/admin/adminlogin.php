<?php
session_start(); // Start session at the top of the script

include 'config.php';

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check admin table for the email using prepared statement
    $stmt = $conn->prepare("SELECT * FROM shelteradmin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch admin data
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = "true"; // Set admin session
            echo "<script>alert('welcome admin!!');</script>";
            header("Location: admin_page.php");
            exit();
        } else {
            echo "<script>alert('Invalid password for admin account.');</script>";
            header("Location: adminlogin.php?error=invalidpassword");
            exit();
        }
    } else {
        echo "<script>alert('No admin account found with that email.');</script>";
        header("Location: adminlogin.php?error=nouser");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            background-color: #28a745;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="adminlogin.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <span id="error_email"></span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <span id="error_password"></span>

            <input type="submit" value="Login" name="login">
        </form>

        <div class="signup-link">
            Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
    </div>
</body>
</html>
