
    <?php include 'header.php'; ?>
    <?php
 
    // if(isset($_SESSION['user' === "true"] )){
    //   header("Location: Login.php");//redirects to login.php if not logged in
    //   exit();
    // }
    
    
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(img/sig.jpg);
            background-size:cover;
        }

        .signup-container {
            margin-top: 70px;
            background-color: #FFF4D9;
            opacity: 0.8;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            margin-top: 480px;
            margin-bottom: 60px;

        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="address"],
        input[type="password"],
        input[type="Repeat-password"]
         {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .signup-container form select{
            width: 100%;
            padding:10px 15px;
            font-size: 17px;
            margin:8px 0;
            background:#eee;
            border-radius: 5px;
        }
I
        .form-container form select option{
            background: #fff;
            }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .login-link { 
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        span{
    color: #ff0000;
    font-size: 1.5rem/2;
    font-weight: 300;
}
 
    </style>


<div class="signup-container">
    <h2>Sign Up</h2>

    <?php
    if (isset($_POST['submit'])) {
        require_once "database.php"; // Ensure database connection file is included

        // Retrieve and sanitize input data
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $password = $_POST['password'];
        $passwordRepeat = $_POST['repeat_password'];

        $errors = [];

        // Input validation
        if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat) || empty($phone) || empty($address)) {
            $errors[] = "All fields are required.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
        if (!preg_match('/^[0-9]{10}$/', $phone)) {
            $errors[] = "Phone number must be exactly 10 digits.";
        }
        if (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters long.";
        }
        if ($password !== $passwordRepeat) {
            $errors[] = "Passwords do not match.";
        }
        if (strtolower($name) === 'admin') {
            $errors[] = "The username 'admin' is reserved and cannot be used.";
        }

        // Check if email already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Email already exists.";
        }
        $stmt->close();

        // Check if phone number already exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Phone number is already registered.";
        }
        $stmt->close();

        // If there are errors, display them
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<script>alert('$error');</script>";
            }
        } else {
            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Insert user into the database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $name, $email, $passwordHash, $phone, $address);

            if ($stmt->execute()) {
                echo "<script>alert('Your account has been created successfully!'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }

            $stmt->close();
        }

        // Close the database connection
        $conn->close();
    }
    ?>


    <form action="signup.php" method="post" id="adoptionForm">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Email" required>

        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="Phone" required>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" placeholder="Address" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="repeat_password">Repeat Password</label>
        <input type="password" id="repeat_password" name="repeat_password" required>

        <input type="submit" class="btn-submit" value="Create Account" id="submit" name="submit">
    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Login</a>
    </div>
</div>
</div>
<?php include 'footer.php'; ?> 

