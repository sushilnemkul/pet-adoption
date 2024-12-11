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
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f7e7ce;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .nav {
            display: flex;
            gap: 20px;
        }

        .nav a {
            text-decoration: none;
            color: white;
            font-size: 16px;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        .sidebar {
            width: 200px;
            background-color: #fae6d1;
            position: fixed;
            top: 50px;
            bottom: 0;
            left: 0;
            padding: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            font-size: 16px;
        }

        .sidebar ul li a:hover {
            color: #4CAF50;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
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
