<?php include 'header.php'; ?>
<?php
include 'database.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color:#f7e7ce;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

section {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.box {
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn {
    width: 100%;
    padding: 10px 15px;
    background-color:rgb(110, 241, 141);
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
}


      

        </style>
</head>
<body>
    <section>
        <div class="form-container">
            <form action="forgot_password.php" method="post">
                <h3>Forgot Password</h3>
                <input type="email" name="email" placeholder="Enter your email" class="box" required>
                <input type="submit" name="submit" value="Submit" class="btn">
            </form>
        </div>
    </section>
</body>
</html>
<?php

include 'database.php'; // Replace with your database connection file

if (isset($_POST['submit_email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if email exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP to email
        $subject = "Password Reset OTP";
        $message = "Your OTP for password reset is: $otp";
        $headers = "From: namecoolsusil@gmail.com.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "OTP sent to your email.";
        } else {
            echo "Failed to send OTP. Please try again.";
        }
    } else {
        echo "Email does not exist.";
    }
}

if (isset($_POST['verify_otp'])) {
    $user_otp = $_POST['otp'];

    if ($user_otp == $_SESSION['otp']) {
        $_SESSION['otp_verified'] = true;
        echo "OTP verified. You can now reset your password.";
    } else {
        echo "Invalid OTP. Please try again.";
    }
}

if (isset($_POST['reset_password'])) {
    if ($_SESSION['otp_verified'] === true) {
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $email = $_SESSION['email'];

        // Update password in the database
        $update_query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";

        if (mysqli_query($conn, $update_query)) {
            echo "Password reset successfully.";
            session_destroy();
        } else {
            echo "Failed to reset password. Please try again.";
        }
    } else {
        echo "OTP verification failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <section>
        <?php if (!isset($_SESSION['otp']) && !isset($_SESSION['otp_verified'])): ?>
            <form action="" method="post">
                <h3>Forgot Password</h3>
                <input type="email" name="email" placeholder="Enter your email" class="box" required>
                <input type="submit" name="submit_email" value="Submit" class="btn">
            </form>
        <?php elseif (!isset($_SESSION['otp_verified'])): ?>
            <form action="" method="post">
                <h3>Enter OTP</h3>
                <input type="text" name="otp" placeholder="Enter OTP" class="box" required>
                <input type="submit" name="verify_otp" value="Verify" class="btn">
            </form>
        <?php else: ?>
            <form action="" method="post">
                <h3>Reset Password</h3>
                <input type="password" name="new_password" placeholder="Enter new password" class="box" required>
                <input type="submit" name="reset_password" value="Reset Password" class="btn">
            </form>
        <?php endif; ?>
    </section>
</body>
</html>
