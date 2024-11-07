
    <?php include 'header.php'; ?>
 
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
        }

        .signup-container {
            background-color: #fff;
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

 
    </style>


    <div class="signup-container">
        <h2>Sign Up</h2>

        <?Php
//creating database connection in php
$host = "localhost"; //host name
$user = "root"; //mysql username or db user 
$password = ""; // according to your database 
//if u are using xampp mysql then put password blank 
$db_name = "project"; //database name

//creating connection in procedure oriented
$con = mysqli_connect($host, $user, $password, $db_name);

if($con){
    echo "connection successful";
    if(isset($_POST['submit'])){
    //inserting data into database table
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['Repeat_password'];
    $usertype = $_POST['user_type'];

    $errors = array();

     // Basic validation
     if (empty($name) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $errors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }
    if ($password !== $passwordRepeat) {
        $errors[] = "Passwords do not match.";
    }

    // Display errors if any
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // Hash the password for security
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        require_once "database.php"; // Make sure this file contains $conn

        // SQL query to insert data
        $sql = "INSERT INTO users (name, email, password, usertype) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $passwordHash, $usertype);

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>Your account has been created successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Something went wrong. Please try again.</div>";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<div class='alert alert-danger'>Database error. Could not prepare statement.</div>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
}
   
?>


        <form action="signup.php" method="post">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your name">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" >

            <label for="Repeat_password">Repeat-Password</label>
            <input type="password" id="Repeat_password" name="Repeat_password" >

            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                </select>

            <input type="submit" class="btn-submit" value="Create Account" name="submit">
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

</body>
</html>



