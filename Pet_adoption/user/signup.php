
    <?php include 'header.php'; ?>
    <?php
 
    if(isset($_SESSION['user' === "true"] )){
      header("Location: Login.php");//redirects to login.php if not logged in
      exit();
    }
    
    
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
            background-color: #FFF4D9;
            opacity: 0.8;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
            

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

        <?Php
    if(isset($_POST['submit'])){
    //inserting data into database table
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['repeat_password'];
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);


    $errors = array();

     // Basic validation
     if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $errors[] = "<script>alert('All fields are required.');window.location.href = 'signup.php';</script>";
        exit();

    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "<script>alert('Invalid email format.');window.location.href = 'signup.php';</script>";
        exit();
    }
    if (strlen($password) < 6) {
        $errors[] = "<script>alert('Password must be at least 6 characters long.');window.location.href = 'signup.php';</script>";
        exit();
    }
    if ($password !== $passwordRepeat) {
        $errors[] = "<script>alert('Passwords do not match.');window.location.href = 'signup.php';</script>";
        exit();
    }

    

    // Check if username or email already exists
    if (strtolower($name) === 'admin') {
        echo "<script>
        alert('The username \"admin\" is reserved and cannot be used.');
        window.location.href = 'signup.php';
        </script>";
        exit();
    }

    require_once "database.php"; // Make sure this file contains $conn
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount > 0) {
        array_push($errors, "Email already exists.");
    }

    // Display errors if any
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "$error";
        }
    } else {
        // Hash the password for security
      

        // Database connection
       

        // SQL query to insert data
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $passwordHash);

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Your account has been created successfully!!";
                echo "<script>window.location.href = 'login.php';</script>"; 
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Database error. Could not prepare statement.";
        }

        // Close the database connection
        mysqli_close($conn);
    }
}

   
?>


        <form action="signup.php" method="post" id="adoptionForm">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            <span id="error_full_name"></span>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <span id="error_email"></span>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required >
            <span id="error_password"></span>

            <label for="Repeat_password">Repeat-Password</label>
            <input type="password" id="repeat_password" name="repeat_password" >
            <span id="error_repeat_password"></span>

           

            <input type="submit" class="btn-submit" value="Create Account" id = "submit" name="submit">
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
    <!-- <script src="script.js"></script> -->
</body>
</html>



