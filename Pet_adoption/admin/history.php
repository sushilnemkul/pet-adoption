<?php include 'admin_header.php'; ?>
<?php
include 'config.php';

// Fetch all requests including those marked as deleted
$history = $conn->query("SELECT * FROM agreement_form ORDER BY application_date DESC");
?>
<h1>Request History</h1>
<table border="1">
    <tr>
        <th>Agreement ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Pet ID</th>
        <th>Documents</th>
        <th>Status</th>
        <th>Message</th>
        <th>Deleted</th>
    </tr>
    <?php while ($row = $history->fetch_assoc()) { ?>
    <tr>
        <td><?= htmlspecialchars($row['agreement_id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['pet_id']) ?></td>
        <td>
            <a href="img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">View Documents</a>
        </td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td><?= htmlspecialchars($row['message']) ?></td>
        <td><?= $row['is_deleted'] ? 'Yes' : 'No' ?></td>
    </tr>
    <?php } ?>
</table>

<style>
    /* General Page Styles */
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f5f5dc; /* Beige background */
    color: #333;
}

h1 {
    color: #007bff;
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 95%;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
}

table th,
table td {
    text-align: center;
    padding: 12px;
    border: 1px solid #ddd;
}

table th {
    background-color:rgb(90, 185, 61);
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
    color:rgb(107, 185, 238); /* Dark green links */
    text-decoration: none;
    font-weight: bold;
    margin: 0 5px;
}

/* Mark Deleted Requests */
table td:last-child {
    font-weight: bold;
}




</style>