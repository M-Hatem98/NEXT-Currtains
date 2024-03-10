<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST["user_email"];
    $subject = "New Message from $user_email";
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'moh.hat226@gmail.com';  // Replace with your Gmail address
        $mail->Password = 'M_01022070283';   // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom($user_email);
        $mail->addAddress('moh.hat226@gmail.com');  // Replace with the destination email address
        $mail->addReplyTo($user_email);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        $mail->send();

        // Redirect back to the form page after sending the email
        header("Location: index.html?success=true");
        exit();
    } catch (Exception $e) {
        echo "Email not sent. Error: {$mail->ErrorInfo}";
    }
}
?>