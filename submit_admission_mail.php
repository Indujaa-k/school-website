<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect all form fields
    $admission_no = $_POST['admission_no'] ?? '';
    $grade = $_POST['grade'] ?? '';
    $emis_no = $_POST['emis_no'] ?? '';
    $student_name = $_POST['student_name'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $aadhar_no = $_POST['aadhar_no'] ?? '';
    $community = $_POST['community'] ?? '';
    $father_name = $_POST['father_name'] ?? '';
    $father_occupation = $_POST['father_occupation'] ?? '';
    $father_income = $_POST['father_income'] ?? '';
    $father_education = $_POST['father_education'] ?? '';
    $address = $_POST['address'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $email = $_POST['email'] ?? '';
    $previous_school = $_POST['previous_school'] ?? '';
    $blood_group = $_POST['blood_group'] ?? '';
    $siblings = $_POST['siblings'] ?? '';
    $transport = $_POST['transport'] ?? '';
    $medical_history = $_POST['medical_history'] ?? '';

    // Recipient email
    $to = "mountwally21@gmail.com"; // <-- Replace with your email
    $subject = "New Admission Form Submission";

    // Prepare email body
    $body = "Admission No: $admission_no\n";
    $body .= "Grade: $grade\n";
    $body .= "EMIS No: $emis_no\n";
    $body .= "Student Name: $student_name\n";
    $body .= "DOB: $dob\n";
    $body .= "Age: $age\n";
    $body .= "Gender: $gender\n";
    $body .= "Nationality: $nationality\n";
    $body .= "Religion: $religion\n";
    $body .= "Aadhar No: $aadhar_no\n";
    $body .= "Community: $community\n";
    $body .= "Father Name: $father_name\n";
    $body .= "Father Occupation: $father_occupation\n";
    $body .= "Father Income: $father_income\n";
    $body .= "Father Education: $father_education\n";
    $body .= "Address: $address\n";
    $body .= "Contact: $contact\n";
    $body .= "Email: $email\n";
    $body .= "Previous School: $previous_school\n";
    $body .= "Blood Group: $blood_group\n";
    $body .= "Siblings: $siblings\n";
    $body .= "Transport: $transport\n";
    $body .= "Medical History: $medical_history\n";

    // Prepare headers
    $headers = "From: info@yourdomain.com"; // <-- Must be valid email on your domain

    // Check if file is uploaded
    if(isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] == 0){
        $file_tmp = $_FILES['student_photo']['tmp_name'];
        $file_name = $_FILES['student_photo']['name'];
        $file_type = $_FILES['student_photo']['type'];
        $file_content = chunk_split(base64_encode(file_get_contents($file_tmp)));

        $boundary = md5(time());
        $headers .= "\r\nMIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";

        // Message
        $message = "--".$boundary."\r\n";
        $message .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= $body . "\r\n";

        // Attachment
        $message .= "--".$boundary."\r\n";
        $message .= "Content-Type: $file_type; name=\"".$file_name."\"\r\n";
        $message .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message .= $file_content . "\r\n";
        $message .= "--".$boundary."--";

        $sent = mail($to, $subject, $message, $headers);

    } else {
        // No file uploaded
        $sent = mail($to, $subject, $body, $headers);
    }

    echo $sent ? "Admission form submitted successfully!" : "Failed to send. Please try again.";
}
?>
