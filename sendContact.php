<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentName = $_POST['studentName'] ?? '';
    $yourName = $_POST['yourName'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Recipient email
    $to = "mountwally21@gmail.com"; // <-- Replace with your email

    // Email subject
    $emailSubject = "New Contact Form Submission: $subject";

    // Email body
    $body = "Student Name: $studentName\n";
    $body .= "Your Name: $yourName\n";
    $body .= "Email: $email\n";
    $body .= "Subject: $subject\n";
    $body .= "Message: $message\n";

    // Headers
    $headers = "From: info@yourdomain.com"; // <-- Must be a valid email on your domain

    if(mail($to, $emailSubject, $body, $headers)) {
        echo "Thank you! Your message has been sent.";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
