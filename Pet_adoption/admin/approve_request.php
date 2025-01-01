<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update request status to 'Approved'
    $stmt = $conn->prepare("UPDATE agreement_form SET status = 'Approved' WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Send confirmation email to user
    $query = $conn->prepare("SELECT email FROM agreement_form WHERE user_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $email = $result->fetch_assoc()['email'];

    $subject = "Adoption Request Approved";
    $message = "Dear " . $email . ", your adoption request has been approved. Please contact us for further instructions.";
    $headers = "From: susilnamecool@gmail.com";

    mail($email, $subject, $message, $headers);

    header("Location: admin_page.php");
    exit();
}