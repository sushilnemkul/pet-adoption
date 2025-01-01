
<?php
include 'config.php';

$request_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($request_id) {
    $stmt = $conn->prepare("UPDATE agreement_form SET status = 'rejected', message = 'Submit proper documents.' WHERE agreement_id = ?");
    $stmt->bind_param("i", $request_id);

   
    $stmt->close();
}

header("Location: request.php");
exit();
?>

<a href="admin_page.php">Back to Admin Page</a>