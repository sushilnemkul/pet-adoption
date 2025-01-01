<?php include 'admin_header.php';?>

<?php
// Include database connection
include 'config.php';

// Check if the form is submitted to update user details
if (isset($_POST['update'])) {
    $id = intval($_POST['id']); // Sanitize the ID
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);

    // Prepare an UPDATE query using prepared statements
    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, Phone = ?, address = ? WHERE ID = ?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);

    if ($stmt->execute()) {
        // Redirect back to the users page after updating
        header('Location: users.php');
        exit();
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch user details to populate the form
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']); // Sanitize the ID

    $stmt = $conn->prepare("SELECT * FROM users WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }

    $stmt->close();
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #FCE195;
        }
        .container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding-right: 2px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update User Details</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $user['ID']; ?>">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['Phone']); ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($user['address']); ?></textarea>
        </div>

        <button type="submit" name="update" class="btn">Update</button>
        <a href="users.php" class="btn btn-danger">Cancel</a>
    </form>
</div>
</body>
</html>
