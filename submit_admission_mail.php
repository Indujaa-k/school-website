<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yourgmail@gmail.com';      // 🔹 your Gmail
        $mail->Password = 'your_app_password';        // 🔹 Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender & Receiver
        $mail->setFrom('yourgmail@gmail.com', 'Mount Valley Public School');
        $mail->addAddress('schooladmin@gmail.com', 'School Admin');
        $mail->addReplyTo($_POST['email'], $_POST['student_name']);

        // Attach photo if uploaded
        if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] == 0) {
            $mail->addAttachment($_FILES['student_photo']['tmp_name'], $_FILES['student_photo']['name']);
        }

        // Email content
        $mail->isHTML(true);
        $mail->Subject = " New Admission Application - " . $_POST['student_name'];

        $body  = "<h2>New Admission Application</h2>";
        $body .= "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
        foreach ($_POST as $key => $value) {
            $keyFormatted = ucwords(str_replace("_", " ", $key));
            $body .= "<tr>
                        <td style='background:#f4f4f4; width:30%;'><strong>$keyFormatted</strong></td>
                        <td>$value</td>
                      </tr>";
        }
        $body .= "</table>";
        $mail->Body = $body;

        // Send email
        $mail->send();

        // ✅ Show alert and redirect back to form
        echo "<script>
                alert('Form sent successfully!');
                window.location.href='admission.html';
              </script>";

    } catch (Exception $e) {
        echo "<script>
                alert('Error sending form: {$mail->ErrorInfo}');
                window.location.href='admission.html';
              </script>";
    }
}
?>
