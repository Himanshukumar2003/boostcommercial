<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Form data
    $full_name = $_POST['full_name'] ?? '';
    $email     = $_POST['email'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $service   = $_POST['service'] ?? '';
    $message   = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tech.eventcrew@gmail.com';
        $mail->Password   = 'ubiobtuhjoddhzjs'; // ✅ App password (no spaces)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // EMAIL SETTINGS
        $mail->setFrom('tech.eventcrew@gmail.com', 'Booking Form');
        $mail->addAddress('aman.brandingwaale@gmail.com'); // Admin email
        $mail->addReplyTo($email, $full_name);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'New Booking Request';

        $mail->Body = "
            <h2>New Booking Details</h2>
            <p><strong>Full Name:</strong> {$full_name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Service:</strong> {$service}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->AltBody = "
            Name: $full_name
            Email: $email
            Phone: $phone
            Service: $service
            Message: $message
        ";

        $mail->send();

        echo "<script>
            alert('✅ Booking request sent successfully!');
            window.location.href = 'index.html';
        </script>";
    } catch (Exception $e) {
        echo '❌ Mail Error: ' . $mail->ErrorInfo;
    }
}
