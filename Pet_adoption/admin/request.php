<?php include 'admin_header.php'; ?>
<?php
include 'config.php';

// Fetch all adoption requests
$requests = $conn->query("SELECT * FROM agreement_form");
?>
<h1>Adoption Requests</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Pet ID</th>
        <th>Documents</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $requests->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['user_id'] ?></td> <!-- Correctly use the request ID -->
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['pet_id']) ?></td>
        <td>
            <a href="img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">View Documents</a>
        </td>
        <td>
            <a href="approve_request.php?id=<?= $row['user_id'] ?>">Approve</a> |
            <a href="reject_request.php?id=<?= $row['user_id'] ?>">Reject</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
// Fetch all approved requests
$approved_requests = $conn->query("SELECT * FROM agreement_form WHERE status = 'Approved'");
?>

<h1>Approved Requests</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Pet ID</th>
        <th>Documents</th>
    </tr>
    <?php while ($row = $approved_requests->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['user_id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['pet_id']) ?></td>
        <td>
            <a href="img1/<?= htmlspecialchars($row['documents']) ?>" target="_blank">View Documents</a>
        </td>
    </tr>
    <?php } ?>
</table>
