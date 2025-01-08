<?php
include 'config.php';

$agreement_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($agreement_id) {
    // Soft delete: mark as deleted instead of removing
    $stmt = $conn->prepare("UPDATE agreement_form SET is_deleted = TRUE WHERE agreement_id = ?");
    $stmt->bind_param("i", $agreement_id);

    if ($stmt->execute()) {
        echo "<script>alert('Request successfully deleted.');</script>";
    } else {
        echo "Error deleting request: " . $conn->error;
    }

    $stmt->close();
    header("Location: request.php");
    exit();
}
?>
