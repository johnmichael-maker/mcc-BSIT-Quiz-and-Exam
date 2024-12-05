<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // If using Composer or the PHPMailer library

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'johnmichaellerobles345@gmail.com'; 
    $mail->Password   = 'ybhr uilh htvb xygk'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
                           // TCP port to connect to (587 for Gmail)

    //Recipients
    $mail->setFrom('no-reply@yourdomain.com', 'Your Name or Company');  // Replace with your email
    $mail->addAddress($email);                                      // Add the recipient's email address

    //Content
    $mail->isHTML(false);                                          // Set email format to plain text
    $mail->Subject = 'Your Verification Code';
    $mail->Body    = 'Your verification code is: ' . $verificationCode;

    // Send email
    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Verification code sent to your email.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => "Failed to send email. Mailer Error: {$mail->ErrorInfo}"]);
}
?>
