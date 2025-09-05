<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $className = $_POST['className'] ?? '';
    $message = $_POST['message'] ?? '';

    // Recipient email
    $to = "mountwally21@gmail.com";  // <-- Replace with your email
    $subject = "New Enquiry Form Submission";

    // Email body
    $body = "Name: $name\n";
    $body .= "Mobile: $mobile\n";
    $body .= "Email: $email\n";
    $body .= "Class: $className\n";
    $body .= "Message: $message\n";

    // Headers
    $headers = "From: webmaster@yourdomain.com"; // <-- Replace with your domain email

    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your enquiry has been sent.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
