<?php 
session_start();
include 'database.php';

// Validate session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user ID and request ID
$user_id = $_SESSION['user_id'];
$request_id = filter_input(INPUT_GET, 'ID', FILTER_VALIDATE_INT);

if (!$request_id) {
    echo "Invalid request ID.";
    exit();
}

try {
    // Check if the request belongs to the user and is pending
    $query = $conn->prepare("
        SELECT id FROM agreement_form 
        WHERE id = ? AND user_id = ? AND status = 'pending'
    ");
    $query->bind_param("ii", $request_id, $user_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Delete the request
        $delete = $conn->prepare("DELETE FROM agreement_form WHERE user_id = ?");
        $delete->bind_param("i", $request_id);

        if ($delete->execute()) {
            $delete->close();
            $query->close();
            header("Location: profile.php?message=Request cancelled successfully.");
            exit();
        } else {
            throw new Exception("Error cancelling request: " . $conn->error);
        }
    } else {
        echo "Invalid request or permission denied.";
    }

    $query->close();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
