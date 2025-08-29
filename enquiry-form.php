<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

header('Content-Type: application/json');

$name = $_POST['name'] ?? '';
$mobile = $_POST['mobile'] ?? '';
$email = $_POST['email'] ?? '';
$className = $_POST['className'] ?? '';
$message = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'indhujaakddeveloper@gmail.com'; // Your Gmail
    $mail->Password   = 'bqip rsgx bxqa fxik';           // Gmail App Password (no spaces)
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('indhujaakddeveloper@gmail.com', 'School Admin');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'School Enquiry Form';
    $mail->Body    = "
        <h3>New Enquiry Received</h3>
        <p><b>Name:</b> $name</p>
        <p><b>Mobile:</b> $mobile</p>
        <p><b>Email:</b> $email</p>
        <p><b>Class:</b> $className</p>
        <p><b>Message:</b> $message</p>
    ";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Message Sent!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
?>
