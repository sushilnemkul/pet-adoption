<?php include 'header.php'; ?>
<?php
// Start session
// session_start();

// Check if the user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: Login.php"); // Redirect to login.php if not logged in
//     exit();
// }

// Include necessary files

include 'database.php';

// Search functionality
$searchTerm = '';
if (isset($_POST['search']) && !empty($_POST['pet_search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['pet_search']);
    $sql = "SELECT * FROM pets WHERE pet_name LIKE '%$searchTerm%'
        OR pet_breed like '%$searchTerm%'
        OR pet_status like '%$searchTerm%'
        OR pet_age like '%$searchTerm%'
        OR pet_gender like '%$searchTerm%'
        OR pet_desc like '%$searchTerm%'";
} else {
    $sql = "SELECT * FROM pets where pet_status IN ('available', 'pending') ORDER BY pet_id DESC";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Pets for Adoption</title>
   
</head>
<body>
    <h1>Available Pets for Adoption</h1>
<br>
    <form action="" method="POST">
        <input type="text" id="pet_search" name="pet_search" placeholder="Search by pet name" value="<?= htmlspecialchars($searchTerm) ?>">
        <input type="submit" value="Search" id="search" name="search">

        <h5><a href="">Clear search</a></h5>
    </form>

    <div class="card-container">
        <?php
        // Check if there are rows returned
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row and display it as a card
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<img src="../admin/uploaded_img/' . $row['image'] . '" alt="' . $row['pet_name'] . '">';
                echo '<h3>' . $row['pet_name'] . '</h3>';
                echo '<p>Breed: ' . $row['pet_breed'] . '</p>';
                echo '<p>Status: ' . $row['pet_status'] . '</p>';
                echo '<a href="pet_details.php?id=' . $row['pet_id'] . '">View Details</a>';
                echo '</div>';
            }
        } else {
            echo '<p>No pets found in the database.</p>';
        }
        ?>
    </div>
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
            margin-top: 120px;
        }

        h5 {
            text-align: center;
            margin-top: 20px;
        }

        #pet_search {
            margin-left: 600px;
            padding: 10px;
            font-size: 16px;
            width: 300px;
        }

        #search {
            padding: 10px;
            font-size: 16px;
            background-color: #28a749;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #search:hover {
            background-color: #218838;
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
            color: white;
            background-color: #28a749;
            border-radius: 5px;
            font-size: 14px;
        }

        .card a:hover {
            opacity: 0.9;
        }
    </style>
    <?php include 'footer.php'; ?>
</body>
</html>
