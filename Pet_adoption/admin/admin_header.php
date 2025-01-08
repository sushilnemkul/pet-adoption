<?php
// Start session
session_start();

// Check if the admin is logged in
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php'); // Redirect to login page if not logged in
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Styles */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f7e7ce; /* Beige background */
}

/* Header Section */
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #4CAF50; /* Green background */
    color: white;
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.header h1 {
    font-size: 24px;
    margin: 0;
}

/* Navigation Links */
.nav {
    display: flex;
    gap: 20px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    transition: color 0.2s ease;
}

.nav a:hover {
    color: #c8f0c8; /* Lighter green on hover */
}

/* Sidebar Styles */
.sidebar {
    width: 200px;
    background-color: #fae6d1; /* Light beige */
    position: fixed;
    top: 50px;
    bottom: 0;
    left: 0;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 15px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333; /* Dark text */
    font-size: 16px;
    transition: color 0.2s ease;
}

.sidebar ul li a:hover {
    color: #4CAF50; /* Green on hover */
}

/* Content Section */
.content {
    margin-left: 220px;
    padding: 20px;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav {
        flex-wrap: wrap;
        gap: 10px;
    }

    .sidebar {
        width: 100%;
        position: static;
        box-shadow: none;
    }

    .content {
        margin-left: 0;
    }
}

    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>Admin Dashboard</h1>
        <div class="nav">
        <li><a href="admin_page.php">Dashboard</a></li>
            <li><a href="users.php">Users</a></li>
            <li><a href="request.php">Request</a></li>
            <li><a href="history.php">History</a></li>
            <a href="logout.php">Logout</a>
        </div>
    </div>


</body>
</html>
