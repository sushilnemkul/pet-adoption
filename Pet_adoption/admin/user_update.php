<?php include 'admin_header.php'; ?>
<?php
// session_start();

// if(!isset($_SESSION['admin'])){
//     header("Location: ../user/Login.php");//redirects to login.php if not logged in
//     exit();
//   }
@include 'config.php';



$id = $_GET['edit'];



if (isset($_POST['update_user'])) {
 $name = $_POST ['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $phone = $_POST['Phone'];
    
   

    // $pet_image_tmp_name = $_FILES['pet_image']['tmp_name'];
    // $pet_image_folder = 'uploaded_img/' . $pet_image;

    if (empty($name) || empty($email) || empty($address) || empty($phone)) {
        $message[] = 'please fill out all';
    } else {


        $update = "UPDATE users SET name='$name', email='$email', address='$address', Phone='$phone' WHERE ID = '$id'";
        $upload = mysqli_query($conn, $update);
        // if ($upload) {
        //     move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
        //     $message[] = '<script>alert("Pet updated successfully")</script>';
        //     header('location:admin_page.php');
        // } else {
        //     $message[] = '<script>alert("Failed to add pet")</script>';
        // }
    }
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<br><br><br><br><br><br><br><br>
    <?php

    if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    }

    ?>

    <div class="container">
        <div class="admin_form_container centered">

            <?php
            $select = mysqli_query($conn, "SELECT * FROM users WHERE ID = '$id'");
            while ($row = mysqli_fetch_assoc($select)) {

            ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?edit=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <h3>Update user info </h3>
                    <input type="text" name="name" placeholder="User name" value="<?php echo $row['name']; ?>" class="box">
                    <input type="text" name="email" placeholder="User email" value="<?php echo $row['email']; ?>" class="box">
                    <input type="text" name="address" placeholder="User address" value="<?php echo $row['address']; ?>" class="box">
                    <input type="text" name="Phone" placeholder="User phone" value="<?php echo $row['Phone']; ?>" class="box">
                    <input type="submit" value="update user" name="update_user" class="btn">
                    <a href="users.php" class="btn">Go Back</a>
                </form>
            <?php }; ?>
        </div>
    </div>

</body>

</html>