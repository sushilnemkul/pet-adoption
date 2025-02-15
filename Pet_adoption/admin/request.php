<?php include 'admin_header.php'; ?>
<?php

//session_start();

if(!isset($_SESSION['admin'])){
    header("Location: adminlogin.php");//redirects to login.php if not logged in
    exit();
  }


include 'config.php';

// Handle admin actions (approve/reject) before any output
if (isset($_GET['action'], $_GET['id']) && in_array($_GET['action'], ['approve', 'reject'])) {
    $action = $_GET['action'];
    $agreement_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($agreement_id) {
        if ($action === 'approve') {
            $status = 'Approved';
            $message = 'Please visit the shelter within 4 days for further proceedings.';
        } else {
            $status = 'Rejected';
            $message = 'Submit proper documents.';
        }

        // Update the agreement_form table
        $stmt = $conn->prepare("UPDATE agreement_form SET status = ?, message = ? WHERE agreement_id = ?");
        $stmt->bind_param("ssi", $status, $message, $agreement_id);

        if ($stmt->execute()) {
            echo "<script>alert('Request successfully updated.');</script>";
        } else {
            echo "<script>alert('Error updating request: " . $conn->error . "');</script>";
        }

        $stmt->close();

        // Redirect back to avoid re-submitting the action
        header("Location: request.php");
        exit();
    }
}

// Fetch all adoption requests
$requests = $conn->query("SELECT * FROM agreement_form WHERE status = 'Pending'");
?>
<br><br>
<h1>Adoption Requests</h1>
<table border="1">
    <tr>
        <th>Agreement ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Pet ID</th>
        <th>application_date</th>
        <th>occupation</th>
        <th>previous_pets</th>
        <th>Documents</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $requests->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['agreement_id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['pet_id']) ?></td>
        <td><?= htmlspecialchars($row['application_date']) ?></td>
        <td><?= htmlspecialchars($row['occupation']) ?></td>
        <td><?= htmlspecialchars($row['previous_pets']) ?></td>
        <td>
            <a href="img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">View Documents</a>
        </td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td>
            <a href="request.php?action=approve&id=<?= $row['agreement_id'] ?>">Approve</a> |
            <a href="request.php?action=reject&id=<?= $row['agreement_id'] ?>">Reject</a> |
            <a href="delete_request.php?id=<?= $row['agreement_id'] ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<h1>Approved Requests</h1>
<table border="1">
    <tr>
        <th>Agreement ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Pet ID</th>
        <th>application_date</th>
        <th>occupation</th>
        <th>previous_pets</th>
        <th>Documents</th>
        <th>Status</th>
    </tr>
    <?php
    $approvedRequests = $conn->query("SELECT * FROM agreement_form WHERE status = 'Approved'");
    while ($row = $approvedRequests->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['agreement_id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['pet_id']) ?></td>
        <td><?= htmlspecialchars($row['application_date']) ?></td>
        <td><?= htmlspecialchars($row['occupation']) ?></td>
        <td><?= htmlspecialchars($row['previous_pets']) ?></td>
        <td>
            <a href="img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">View Documents</a>
        </td>
        <td><?= htmlspecialchars($row['status']) ?></td>
    </tr>
    <?php } ?>
</table>

<h1>Rejected Requests</h1>
<table border="1">
    <tr>
        <th>Agreement ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Pet ID</th>
        <th>application_date</th>
        <th>occupation</th>
        <th>previous_pets</th>
        <th>Documents</th>
        <th>Status</th>
    </tr>
    <?php
    $rejectedRequests = $conn->query("SELECT * FROM agreement_form WHERE status = 'Rejected'");
    while ($row = $rejectedRequests->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['agreement_id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['pet_id']) ?></td>
        <td><?= htmlspecialchars($row['application_date']) ?></td>
        <td><?= htmlspecialchars($row['occupation']) ?></td>
        <td><?= htmlspecialchars($row['previous_pets']) ?></td>
        <td>
            <a href="img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">View Documents</a>
        </td>
        <td><?= htmlspecialchars($row['status']) ?></td>
    </tr>
    <?php } ?>
</table>
<style>
   /* General Page Styles */
body {
    font-family: Arial, sans-serif;
    margin: 10px;
    background-color: #f5f5dc; /* Beige background */
    color: #333;
}

h1 {
    color:rgb(0, 0, 0);
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    border-radius: 8px;
    overflow-y: 200px;
  
}

table th,
table td {
    text-align: center;
    padding: 12px;
    border: 1px solid #ddd;
}

table th {
    background-color:rgb(97, 202, 87);
    color: #ffffff;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #e7f5e7; /* Light green for even rows */
}

table tr:nth-child(odd) {
    background-color: #f5f5dc; /* Beige for odd rows */
}

table td a {
    color: #006400; /* Dark green links */
    text-decoration: none;
    font-weight: bold;
    margin: 0 5px;
}




 
</style>