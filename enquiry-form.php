<?php
header('Content-Type: application/json');

// Get form values
$name = $_POST['name'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$className = $_POST['className'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $mobile && $email && $className && $message) {
    $to = "indhujaakddeveloper@gmail.com"; // Your email
    $subject = "New School Enquiry from $name";

    $body = "
    New enquiry received:\n\n
    Name: $name\n
    Mobile: $mobile\n
    Email: $email\n
    Class: $className\n
    Message: $message\n
    ";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Message Sent!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error sending email.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
}
?>
