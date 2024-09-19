<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer library files
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                             // Set mailer to use SMTP
        $mail->Host       = 'smtp.example.com';                      // Specify SMTP server (replace with your SMTP server)
        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
        $mail->Username   = 'your-email@example.com';                // SMTP username (replace with your email)
        $mail->Password   = 'your-email-password';                   // SMTP password (replace with your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS can also be used
        $mail->Port       = 587;                                     // TCP port to connect to (TLS usually works on 587)

        // Recipients
        $mail->setFrom($email, $name);                               // Sender's email and name
        $mail->addAddress('ntsanwisi12@gmail.com');                  // Recipient's email (owner's email)

        // Email content
        $mail->isHTML(false);                                        // Set email format to plain text
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Send the email
        $mail->send();
        // Redirect to thank you page after successful send
        header("Location: thank_you.html");
        exit;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
