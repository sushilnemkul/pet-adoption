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
    /* span{
    color: #ff0000;
    font-size: 1.5rem/2;
    font-weight: 300;
} */
</style>

<div class="login-container">
    <h1>Login</h1>

    <?php
// Start session at the very beginning
session_start();

include 'database.php';

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    // $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    // $stmt->bind_param("s", $email);
    // $stmt->execute();
    // $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        // $user = $result->fetch_assoc();
        $row = mysqli_fetch_array($result);
        $status = password_verify($password, $row['password']) ? "TRUE" : "FALSE";
         // Verify password
         if ($status === "TRUE") {
            // Set session variables
            $_SESSION['user'] = "yes";
            // $_SESSION['name'] = $user['name'];
            header("Location: indexx.php"); // Redirect to home page
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email.";
    }

}


//     if ($row) {

//         if(password_verify($password, $row["password"])) {
//             $_SESSION["user_id"] = $row["id"];
//             $_SESSION["name"] = $row["name"];
//             $_SESSION["email"] = $row["email"];
//             header("Location: indexx.php");
//             exit();
//         }else{
//             echo "<div class='alert alert-danger'>Password does not match</div>";
//         }
//     } else {
//         echo "<div class='alert alert-danger'>Email does not match</div>";
//     }
// }
?>

    <form action="Login.php" method="post">
        <label for="username">Username:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email:">
        <span id="error_email"></span>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <span id="error_password"></span>

        <input type="submit" value="login" name="login" id = "login">
    </form>

    <div class="signup-link">
        Don't have an account? <a href="signup.php">Sign Up</a>
    </div>
</div>



<!-- <script>
const email = document.getElementById("email");
const password = document.getElementById("password");

const submit = document.getElementById("login");

login.addEventListener("click", (event) => {
    event.preventDefault();
    clearErrors();//clears previous error messages

    let isValid = true;//variable to check if form is valid

    //validating email
    if (email.value === "") {
        console.log("Please enter email");
         alert("Please enter email");
        // document.getElementById("error_email").innerHTML = "Please enter email";
        isValid = false;
    }

    //validating password
    if (password.value === "") {
        console.log("Please enter password");
        // alert("Please enter password");
        document.getElementById("error_password").innerHTML = "Please enter password";
        isValid = false;
    }
    if(isValid){
    alert("Form submitted successfully");
    // console.log("Form submitted successfully");
    window.location.href = "indexx.php";
}
     
    });

</script> -->