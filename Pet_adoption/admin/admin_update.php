<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../user/Login.php");//redirects to login.php if not logged in
    exit();
  }
@include 'config.php';



$id = $_GET['edit'];



if (isset($_POST['update_pet'])) {
    $pet_name = $_POST['pet_name'];
    $pet_age = $_POST['pet_age'];
    $pet_breed = $_POST['pet_breed'];
    $pet_gender = $_POST['pet_gender'];
    $pet_description = $_POST['pet_description'];
    $pet_image = $_FILES['pet_image']['name'];
    $pet_status = $_POST['pet_status'];

    $pet_image_tmp_name = $_FILES['pet_image']['tmp_name'];
    $pet_image_folder = 'uploaded_img/' . $pet_image;

    if (empty($pet_name) || empty($pet_age) || empty($pet_breed) || empty($pet_gender) || empty($pet_description) || empty($pet_image) || empty($pet_status)) {
        $message[] = 'please fill out all';
    } else {
        // $add_pet = $conn->prepare("INSERT INTO pets(name, age, breed, gender, description, image) VALUES(?,?,?,?,?,?)");
        // $add_pet->bind_param("ssssss", $pet_name, $pet_age, $pet_breed, $pet_gender, $pet_description, $pet_image);
        // $add_pet->execute();
        // move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
        // $message[] = 'pet added successfully';

        $update = "UPDATE pets SET pet_name='$pet_name', pet_age='$pet_age', pet_breed='$pet_breed', pet_gender='$pet_gender', pet_desc='$pet_description', pet_status='$pet_status', image='$pet_image' WHERE ID = '$id'";
        $upload = mysqli_query($conn, $update);
        if ($upload) {
            move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
            $message[] = '<script>alert("Pet updated successfully")</script>';
            header('location:admin_page.php');
        } else {
            $message[] = '<script>alert("Failed to add pet")</script>';
        }
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
            $select = mysqli_query($conn, "SELECT * FROM pets WHERE ID = '$id'");
            while ($row = mysqli_fetch_assoc($select)) {

            ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?edit=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <h3>Update pet info pets</h3>
                    <input type="text" name="pet_name" placeholder="Name of pet" value="<?php echo $row['pet_name']; ?>" class="box">
                    <input type="double" name="pet_age" placeholder="Age of pet" value="<?php echo $row['pet_age']; ?>" class="box">
                    <input type="text" name="pet_breed" placeholder="Breed of pet" value="<?php echo $row['pet_breed']; ?>" class="box">
                    <input type="text" name="pet_gender" placeholder="Gender of pet" value="<?php echo $row['pet_gender']; ?>" class="box">
                    <input type="text" name="pet_description" placeholder="Description of pet" value="<?php echo $row['pet_desc']; ?>" class="box">
                    <select name="pet_status" class="box">
                        <option value="available" <?php echo ($row['pet_status'] == 'available') ? 'selected' : ''; ?>>Available</option>
                        <option value="adopted" <?php echo ($row['pet_status'] == 'adopted') ? 'selected' : ''; ?>>Adopted</option>
                        <option value="pending" <?php echo ($row['pet_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    </select>
                    <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" name="pet_image" class="box">
                    <input type="submit" value="update pet" name="update_pet" class="btn">
                    <a href="admin_page.php" class="btn">Go Back</a>
                </form>
            <?php }; ?>
        </div>
    </div>

</body>

</html>