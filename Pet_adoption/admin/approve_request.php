<?php
include 'config.php';

$agreement_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($agreement_id) {
    // Update the status to 'Approved'
    $stmt = $conn->prepare("UPDATE agreement_form SET status = 'Approved' WHERE agreement_id = ?");
    $stmt->bind_param("i", $agreement_id);

    if ($stmt->execute()) {
        // Insert a message into the message table
        $message = "Please visit the shelter within 4 days for further proceedings.";
        $msg_stmt = $conn->prepare("INSERT INTO agreement_form (agreement_id, message) VALUES (?, ?)");
        $msg_stmt->bind_param("is", $agreement_id, $message);
        $msg_stmt->execute();

        echo "<script>alert('Request approved successfully.');</script>";
    } else {
        echo "Error approving request: " . $conn->error;
    }

    $stmt->close();
    $msg_stmt->close();
}

header("Location: request.php");
exit();
?>
