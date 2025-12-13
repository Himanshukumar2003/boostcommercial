<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address');history.back();</script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tech.eventcrew@gmail.com';
        $mail->Password   = 'ubiobtuhjoddhzjs'; // APP PASSWORD
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // EMAIL SETTINGS
        $mail->setFrom('tech.eventcrew@gmail.com', 'Newsletter');
        $mail->addAddress('devliyalhimanshu@gmail.com'); // Admin email
        $mail->addReplyTo($email);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'New Newsletter Subscription';

        $mail->Body = "
            <h3>New Newsletter Subscriber</h3>
            <p><strong>Email:</strong> {$email}</p>
        ";

        $mail->AltBody = "New Newsletter Subscriber: {$email}";

        $mail->send();

        echo "<script>
            alert('✅ Thank you for subscribing!');
            window.location.href = 'index.html';
        </script>";
    } catch (Exception $e) {
        echo '❌ Mail Error: ' . $mail->ErrorInfo;
    }
}
