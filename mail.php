<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

header('Content-Type: application/json');

$studentName = $_POST['studentName'] ?? '';
$yourName    = $_POST['yourName'] ?? '';
$email       = $_POST['email'] ?? '';
$subject     = $_POST['subject'] ?? '';
$message     = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'indhujaakddeveloper@gmail.com';
    $mail->Password   = 'bqip rsgx bxqa fxik'; // App password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom($email, $yourName);
    $mail->addAddress('indhujaakddeveloper@gmail.com', 'School Admin');

    $mail->isHTML(true);
    $mail->Subject = "School Enquiry: $subject";
    $mail->Body    = "
        <h3>New Enquiry Received</h3>
        <p><b>Student Name:</b> $studentName</p>
        <p><b>Your Name:</b> $yourName</p>
        <p><b>Email:</b> $email</p>
        <p><b>Subject:</b> $subject</p>
        <p><b>Message:</b> $message</p>
    ";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Message Sent!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
?>
