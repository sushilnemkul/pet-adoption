<?php include 'admin_header.php'; ?>
<?php
// Ensure session is active

if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
@include 'config.php';

// Get pet ID from query parameter
$id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

// Fetch pet details
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM pets WHERE pet_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pet = $result->fetch_assoc();
    $stmt->close();

    if (!$pet) {
        echo "<script>alert('Pet not found.'); window.location.href = 'admin_page.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid pet ID.'); window.location.href = 'admin_page.php';</script>";
    exit();
}

// Check if the update form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_pet'])) {
    $pet_name = trim($_POST['pet_name']);
    $pet_age = intval($_POST['pet_age']);
    $pet_breed = trim($_POST['pet_breed']);
    $pet_gender = trim($_POST['pet_gender']);
    $pet_description = trim($_POST['pet_description']);
    $pet_status = trim($_POST['pet_status']);
    $pet_image = $_FILES['pet_image']['name'];
    $pet_image_tmp_name = $_FILES['pet_image']['tmp_name'];
    $pet_image_folder = 'uploaded_img/' . $pet_image;

    // Validate inputs
    if (empty($pet_name) || empty($pet_age) || empty($pet_breed) || empty($pet_gender) || empty($pet_description) || empty($pet_status)) {
        $message[] = 'Please fill out all fields.';
    } else {
        $update_query = "UPDATE pets SET pet_name = ?, pet_age = ?, pet_breed = ?, pet_gender = ?, pet_desc = ?, pet_status = ?";

        // Check if a new image is uploaded
        if (!empty($pet_image)) {
            $update_query .= ", image = ?";
        }
        $update_query .= " WHERE pet_id = ?";

        $stmt = $conn->prepare($update_query);

        if (!empty($pet_image)) {
            $stmt->bind_param("sisssssi", $pet_name, $pet_age, $pet_breed, $pet_gender, $pet_description, $pet_status, $pet_image, $id);
        } else {
            $stmt->bind_param("sissssi", $pet_name, $pet_age, $pet_breed, $pet_gender, $pet_description, $pet_status, $id);
        }

        if ($stmt->execute()) {
            if (!empty($pet_image)) {
                move_uploaded_file($pet_image_tmp_name, $pet_image_folder);
            }
            echo '<script>alert("Pet updated successfully.");</script>';
            echo '<script>window.location.href = "admin_page.php";</script>';
            exit();
        } else {
            $message[] = 'Failed to update pet: ' . $stmt->error;
        }
        $stmt->close();
    }
}
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
        foreach ($message as $msg) {
            echo '<span class="message">' . htmlspecialchars($msg) . '</span>';
        }
    }
    ?>

    <div class="container">
        <div class="admin_form_container centered">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?edit=$id"); ?>" method="post" enctype="multipart/form-data">
                <h3>Update Pet Info</h3>
                <input type="text" name="pet_name" placeholder="Name of pet" value="<?php echo htmlspecialchars($pet['pet_name']); ?>" class="box">
                <input type="number" name="pet_age" placeholder="Age of pet" value="<?php echo $pet['pet_age']; ?>" class="box">
                <input type="text" name="pet_breed" placeholder="Breed of pet" value="<?php echo htmlspecialchars($pet['pet_breed']); ?>" class="box">
                <input type="text" name="pet_gender" placeholder="Gender of pet" value="<?php echo htmlspecialchars($pet['pet_gender']); ?>" class="box">
                <input type="text" name="pet_description" placeholder="Description of pet" value="<?php echo htmlspecialchars($pet['pet_desc']); ?>" class="box">
                <select name="pet_status" class="box">
                    <option value="available" <?php echo ($pet['pet_status'] === 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="adopted" <?php echo ($pet['pet_status'] === 'adopted') ? 'selected' : ''; ?>>Adopted</option>
                    <option value="pending" <?php echo ($pet['pet_status'] === 'pending') ? 'selected' : ''; ?>>Pending</option>
                </select>
                <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" name="pet_image" class="box">
                <input type="submit" value="Update Pet" name="update_pet" id="update_pet" class="btn">
                <a href="admin_page.php" class="btn">Go Back</a>
            </form>
        </div>
    </div>
</body>
</html>
