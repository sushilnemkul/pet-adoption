<?php include 'admin_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Users</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
            background-color: #f7e7ce;
        }

        h1 {
            text-align: center;
            margin-top: -10px;
        }

        #searchInput {
            display: block;
            margin: 20px auto;
            padding: 10px;
            width: 80%;
            max-width: 400px;
            font-size: 16px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
            width: 300px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.4);
        }

        .card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 10px 0;
            font-size: 20px;
        }

        .card p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }

        .card a {
            display: inline-block;
            margin: 5px;
            padding: 10px 15px;
            text-decoration: none;
            color:  #f7e7ce;
            background-color: #28a749;
            border-radius: 5px;
            font-size: 14px;
        }

        .card a.view {
            background-color:#fa8072;
            color: black;
        }

        .card a.adopt {
            background-color: #28a749;
            color: black;
        }

        .card a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br><br>

<h1>User Details</h1>

<div class="card-container">
<?php

// Include database connection
include 'config.php';

// Query to fetch data from the pets table
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Check if there are rows returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and display it as a card
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card">';
        // echo '<img src="uploaded_img/' . $row['image'] . '" alt="' . $row['name'] . '">';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<p>Email: ' . $row['email'] . '</p>';
        // echo '<p>Password: ' . $row['password'] . '</p>';
        // echo '<p>Address: ' . $row['address'] . '</p>';
        echo '<a class="view" href="userdetails.php?id=' . $row['ID'] . '">View Details</a>';
        echo '<a class="adopt" href="user_update.php?edit=' . $row['ID'] . '">Edit</a>';
        echo '<a class="adopt" href="users.php?delete=' . $row['ID'] . '">Delete</a>';
        echo '</div>';
    }
} else {
    echo '<p>No pets found in the database.</p>';
};
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE ID = '$id'");
    // header('location: users.php');
    };
?>
</div>


</body>
</html>
