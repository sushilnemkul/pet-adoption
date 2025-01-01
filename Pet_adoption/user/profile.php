<?php include 'header.php';?>
<?php
//Start session and check user login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'database.php';

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_query = $conn->prepare("SELECT * FROM users WHERE ID = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user_data = $user_result->fetch_assoc();

if (!$user_data) {
    echo "User not found.";
    exit();
}

// Handle updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_query = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE ID = ?");
    $update_query->bind_param("ssisi", $username, $email, $phone, $address, $user_id);

    if ($update_query->execute()) {
        echo "<script>alert('Profile updated successfully.');</script>";
        // Refresh user data
        $user_query->execute();
        $user_result = $user_query->get_result();
        $user_data = $user_result->fetch_assoc();
    } else {
        echo "Error updating profile.";
    }
}

// Fetch user requests
$requests_query = $conn->prepare("SELECT * FROM requests WHERE user_id = ?");
$requests_query->bind_param("i", $user_id);
$requests_query->execute();
$requests_result = $requests_query->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 10px 5px 20px 400px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
            margin-top: 110px;
        }

        h1, h2 {
            color: #333333;
            text-align: center;
        }

        form {
            margin-bottom: 30px;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
         
        }

        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #cccccc;
        }

        table th {
            background-color: #f4f4f4;

        }

        

        .no-requests {
            text-align: center;
            color: #666666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($user_data['name']); ?></h1>
        
        <h2>Your Details</h2>
        <form method="POST" action="profile.php">
            <label for="username">Username:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user_data['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user_data['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user_data['Phone']); ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($user_data['address']); ?>" required>

            <button type="submit" name="update" class="btn">Update Profile</button>
        </form>

       

        
    </div>
    <?php


include 'database.php';

// Validate session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch adoption requests made by the user
$query = $conn->prepare("
    SELECT af.user_id, af.application_date, af.documents, p.pet_name AS pet_name, p.pet_breed, p.pet_age, p.image, af.status 
    FROM agreement_form af 
    INNER JOIN pets p ON af.pet_id = p.pet_id 
    WHERE af.user_id = ?
");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>

    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }

    .profile-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        color: #4CAF50;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #4CAF50;
        color: white;
        text-transform: uppercase;
        font-weight: bold;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f1f1f1;
    }

    a {
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
    }

    a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .btn-cancel {
        color: #d9534f;
        font-weight: bold;
    }

    .btn-cancel:hover {
        color: #b52b27;
    }

    p {
        text-align: center;
        color: #666;
        font-size: 16px;
    }



</style>
<body>
    <div class="profile-container">
        <h2>My Adoption Requests</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Pet Name</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Request Date</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['pet_name']) ?></td>
                            <td><?= htmlspecialchars($row['pet_breed']) ?></td>
                            <td><?= htmlspecialchars($row['pet_age']) ?> years</td>
                            <td><?= htmlspecialchars($row['application_date']) ?></td>
                            <td>
                                <a href="../admin/img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">
                                    View Document
                                </a>
                            </td>
                            <td>
                                <?= htmlspecialchars(ucfirst($row['status'])) ?>
                            </td>
                            <td>
                                <?php if ($row['status'] === 'pending'): ?>
                                    <a href="cancel_request.php?id=<?= $row['user_id'] ?>" class="btn-cancel">Cancel</a>
                                <?php else: ?>
                                    ---
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have not submitted any adoption requests yet.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
