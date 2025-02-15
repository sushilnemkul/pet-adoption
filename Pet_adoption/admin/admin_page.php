<?php include 'admin_header.php'; ?>
<?php
//session_start();

if(!isset($_SESSION['admin'])){
    header("Location: adminlogin.php");//redirects to login.php if not logged in
    exit();
  }

?>
<?php

include 'config.php';

if(isset($_POST['add_pet'])) {
    $pet_name = $_POST['pet_name'];
    $pet_age = $_POST['pet_age'];
    $pet_breed = $_POST['pet_breed'];
    $pet_gender = $_POST['pet_gender'];
    $pet_description = $_POST['pet_description'];
    $pet_image = $_FILES['pet_image']['name'];
    $pet_status = $_POST['pet_status'];

    $pet_image_tmp_name = $_FILES['pet_image']['tmp_name'];
    $pet_image_folder = 'uploaded_img/'.$pet_image;

    if(empty($pet_name) || empty($pet_age) || empty($pet_breed) || empty($pet_gender) || empty($pet_description) || empty($pet_image) || empty($pet_status)) {
      $message[] = 'please fill out all';  
    }else {
        // $add_pet = $conn->prepare("INSERT INTO pets(name, age, breed, gender, description, image) VALUES(?,?,?,?,?,?)");
        // $add_pet->bind_param("ssssss", $pet_name, $pet_age, $pet_breed, $pet_gender, $pet_description, $pet_image);
        // $add_pet->execute();
        // move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
        // $message[] = 'pet added successfully';
      
        $insert = "INSERT INTO pets(pet_name, pet_age, pet_breed, pet_gender, pet_desc, image, pet_status) 
        VALUES('$pet_name', '$pet_age', '$pet_breed', '$pet_gender', '$pet_description', '$pet_image', '$pet_status')";
        $upload = mysqli_query($conn, $insert);
        if($upload){
            move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
            $message[] = '<script>alert("Pet added successfully")</script>'; 
        }else{
            $message[] = '<script>alert("Failed to add pet")</script>'; 
        }
    }
};

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Show the confirmation message with Yes and No buttons
    echo "
    <script>
        var confirmDelete = confirm('Are you sure you want to delete this pet?');
        if (confirmDelete) {
            window.location.href = 'admin_page.php?confirm_delete=$id';
        }
    </script>
    ";
    exit(); // Stop further script execution to show the confirmation page
}
if (isset($_GET['confirm_delete'])) {
    $id = $_GET['confirm_delete'];
    $delete = "DELETE FROM pets WHERE pet_id = '$id'";
    $result = mysqli_query($conn, $delete);
    if ($result) {
        $message[] = '<script>alert("Pet deleted successfully")</script>';
    } else {
        $message[] = '<script>alert("Failed to delete pet")</script>';
    }
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<span class="message">'.$message.'</span>';
    }
}

?>
<br><br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="admin_form_container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h3>Add new pets</h3>
                <input type="text" name="pet_name" placeholder="Name of pet" class="box">
                <input type="double" name="pet_age" placeholder="Age of pet" class="box">
                <input type="text" name="pet_breed" placeholder="Breed of pet" class="box">
                <input type="text" name="pet_gender" placeholder="Gender of pet" class="box">
                <input type="text" name="pet_description" placeholder="Description of pet" class="box">
                <select name="pet_status" class="box">
            <option value="available">Available</option>
            <option value=" ed">Adopted</option>
            <option value="pending" >Pending</option>
        </select>
                <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" name="pet_image" class="box" >
                <input type="submit" value="add pet" name="add_pet" class="btn">
            </form>
        </div>
        <?php
        $select = mysqli_query($conn, "SELECT * FROM pets where pet_status = 'available' ORDER BY pet_id DESC");

       
        
        
        ?>

            <div class="pet_display">
                <h1>Available Pets</h1>
                <table class="pet_table">
                    <thead>
                        <tr>
                        <th>Pet ID</th>
                         <th>Name</th>
                         <th>Age</th>
                         <th>Breed</th>
                         <th>Gender</th>
                         <th>Description</th>
                         <th>Image</th>
                         <th>Status</th>
                         <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    while($row = mysqli_fetch_assoc($select)){
                    ?>
                     <tr>
                           <td><?php echo $row['pet_id']; ?></td>
                           <td><?php echo $row['pet_name']; ?></td>
                           <td><?php echo $row['pet_age']; ?></td>
                           <td><?php echo $row['pet_breed']; ?></td>
                           <td><?php echo $row['pet_gender']; ?></td>

                           <td><?php echo $row['pet_desc']; ?></td>
                           
                           <td><img src="uploaded_img/<?php echo $row['image']; ?>" alt="" width="100" height="100"></td>
                           <td><?php echo $row['pet_status']; ?></td>
                           <td>
    <!-- Edit button -->
    <a href="admin_update.php?edit=<?php echo $row['pet_id']; ?>" class="btn">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
    </a>
    <!-- Delete button -->
    <a href="admin_page.php?delete=<?php echo $row['pet_id']; ?>" class="btn">
        <i class="fa fa-trash-o" aria-hidden="true"></i>Delete
    </a>
</td>

                        </tr>

                    <?php }; ?>
                </table>
               
                <h1>Adopted Pets</h1>
                <?php
        $select = mysqli_query($conn, "SELECT * FROM pets where pet_status = 'adopted' ORDER BY pet_id DESC");
        ?>
                <table class="pet_table">
                    <thead>
                        <tr>
                        <th>Pet ID</th>
                         <th>Name</th>
                         <th>Age</th>
                         <th>Breed</th>
                         <th>Gender</th>
                         <th>Description</th>
                         <th>Image</th>
                         <th>Status</th>
                         <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    while($row = mysqli_fetch_assoc($select)){
                    ?>
                     <tr>
                           <td><?php echo $row['pet_id']; ?></td>
                           <td><?php echo $row['pet_name']; ?></td>
                           <td><?php echo $row['pet_age']; ?></td>
                           <td><?php echo $row['pet_breed']; ?></td>
                           <td><?php echo $row['pet_gender']; ?></td>

                           <td><?php echo $row['pet_desc']; ?></td>
                           
                           <td><img src="uploaded_img/<?php echo $row['image']; ?>" alt="" width="100" height="100"></td>
                           <td><?php echo $row['pet_status']; ?></td>
                           <td>
    <!-- Edit button -->
    <a href="admin_update.php?edit=<?php echo $row['pet_id']; ?>" class="btn">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
    </a>
    <!-- Delete button -->
    <a href="admin_page.php?delete=<?php echo $row['pet_id']; ?>" class="btn">
        <i class="fa fa-trash-o" aria-hidden="true"></i>Delete
    </a>
</td>

                        </tr>

                    <?php }; ?>
                </table>    

                <h1>Pending Pets</h1>
                <?php
        $select = mysqli_query($conn, "SELECT * FROM pets where pet_status = 'pending' ORDER BY pet_id DESC");
        ?>
                <table class="pet_table">
                    <thead>
                        <tr>
                        <th>Pet ID</th>
                         <th>Name</th>
                         <th>Age</th>
                         <th>Breed</th>
                         <th>Gender</th>
                         <th>Description</th>
                         <th>Image</th>
                         <th>Status</th>
                         <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    while($row = mysqli_fetch_assoc($select)){
                    ?>
                     <tr>
                           <td><?php echo $row['pet_id']; ?></td>
                           <td><?php echo $row['pet_name']; ?></td>
                           <td><?php echo $row['pet_age']; ?></td>
                           <td><?php echo $row['pet_breed']; ?></td>
                           <td><?php echo $row['pet_gender']; ?></td>

                           <td><?php echo $row['pet_desc']; ?></td>
                           
                           <td><img src="uploaded_img/<?php echo $row['image']; ?>" alt="" width="100" height="100"></td>
                           <td><?php echo $row['pet_status']; ?></td>
                           <td>
    <!-- Edit button -->
    <a href="admin_update.php?edit=<?php echo $row['pet_id']; ?>" class="btn">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
    </a>
    <!-- Delete button -->
    <a href="admin_page.php?delete=<?php echo $row['pet_id']; ?>" class="btn">
        <i class="fa fa-trash-o" aria-hidden="true"></i>Delete
    </a>
</td>

                        </tr>

                    <?php }; ?>
                </table>
            </div>
    </div>
   
</body>
</html>