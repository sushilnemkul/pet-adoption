<?php include 'admin_header.php'; ?>

<?php

//session_start();

if(!isset($_SESSION['admin'])){
    header("Location: adminlogin.php");//redirects to login.php if not logged in
    exit();
  }


// Include database connection
include 'config.php';

// Handle the action to mark a user as non-active
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Sanitize the ID to ensure it's an integer

    // Prepare an UPDATE query to set the user as non-active (instead of deleting)
    $stmt = $conn->prepare("UPDATE users SET status = 'non-active' WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect back to the same page after updating the status
        header('Location: users.php');
        exit();
    } else {
        echo "Error updating user status: " . $stmt->error;
    }

    $stmt->close();
}

// Query to fetch all users (both active and non-active)
$sql = "SELECT * FROM users"; // Fetch all users regardless of status
$result = mysqli_query($conn, $sql);
?>

<center><h1>User Management</h1></center>

<div class="card-container">
    <?php
    // Check if there are rows returned
    if ($result && mysqli_num_rows($result) > 0) {
        // Loop through each row and display it as a card
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</p>';
            echo '<p><strong>Phone:</strong> ' . htmlspecialchars($row['Phone']) . '</p>';
            echo '<p><strong>Address:</strong> ' . htmlspecialchars($row['address']) . '</p>';
            echo '<a class="view" href="userdetails.php?id=' . $row['ID'] . '">View Details</a>';
            
            // Display Edit button only if the user is active
            if ($row['status'] == 'active') {
                echo '<a class="edit" href="user_update.php?edit=' . $row['ID'] . '">Edit</a>';
            }
            
            // Display the Delete button only if the user is active
            if ($row['status'] == 'active') {
                echo '<a class="delete" href="users.php?delete=' . $row['ID'] . '" 
                       onclick="return confirm(\'Are you sure you want to mark this user as non-active?\')">Delete</a>';
            } else {
                // For non-active users, display a message
                echo '<span class="status" style="color: gray;">This user is non-active</span>';
            }

            echo '</div>';
        }
    } else {
        echo '<p>No users found in the database.</p>';
    }
    ?>
</div>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7e7ce;
            margin: 0;
            padding: 0;
        }
        h1 {
            margin: 20px 20px;
            margin-top: 70px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .card {
            background-color:#FCE195;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card h3 {
            margin-top: 0;
        }
        .card p {
            margin: 10px 0;
        }
        .card a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            border-radius: 5px;
        }
        .card a.view {
            background-color: #28a745;
        }
        .card a.edit {
            background-color: #007bff;
        }
        .card a.delete {
            background-color: #dc3545;
        }
        .card a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<?php
// Check if a delete request has been made
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    
    // Update the user's status to 'non-active'
    $query = "UPDATE users SET status='non-active' WHERE ID = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>User has been marked as non-active.</p>";
        } else {
            echo "<p>Error updating user status.</p>";
        }
        mysqli_stmt_close($stmt);
    }
}

// Fetch only active users (status = 'active')
$query = "SELECT * FROM users WHERE status = 'active'"; // Only fetch active users
$result = mysqli_query($conn, $query);

?>



</body>
</html>
