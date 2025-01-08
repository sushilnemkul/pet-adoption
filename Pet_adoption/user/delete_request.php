<?php
include 'database.php';
session_start();

// Validate user session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$request_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($request_id) {
    // Soft delete: mark as deleted only for the user's view
    $stmt = $conn->prepare("UPDATE agreement_form SET is_deleted = TRUE WHERE agreement_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $request_id, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Request successfully removed from your history.'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Error deleting request: " . $conn->error . "'); window.location.href = 'profile.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: profile.php");
    exit();
}
?>
