<?php include 'admin_header.php';?>

<?php
// Include database connection
include 'config.php';

// Fetch user details based on the ID from the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID

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
    <title>View User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color :#f7e7ce ;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #FCE195;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 40px;
        }
        .detail {
            margin-bottom: 15px;
        }
        .detail strong {
            display: inline-block;
            width: 120px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            opacity: 0.9;
        }

        h1{
            text-align: center;
            font-weight: bold;
            font-size: 40px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <h1> User Details</h1>
<div class="container">
    <h1><?php echo htmlspecialchars($user['name']); ?></h1>
    <div class="detail">
        <strong>ID:</strong> <?php echo $user['ID']; ?>
    </div>
   
    <div class="detail">
        <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?>
    </div>
    <div class="detail">
        <strong>Phone:</strong> <?php echo htmlspecialchars($user['Phone']); ?>
    </div>
    <div class="detail">
        <strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?>
    </div>
    <a class="btn" href="users.php">Back to User Management</a>
</div>
</body>
</html>
