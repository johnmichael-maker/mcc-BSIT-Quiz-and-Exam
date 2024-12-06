<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/phpmailer/phpmailer/src/Exception.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/SMTP.php";
require '../vendor/autoload.php';

function sendRegistrationLink(string $email): string {
    $database = new Database();
    $pdo = $database->getConnection();

    $stmt = $pdo->prepare("SELECT * FROM ms_365_instructor WHERE username = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        
        $token = bin2hex(random_bytes(16));
        
       
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

        
        $insertStmt = $pdo->prepare("UPDATE ms_365_instructor SET token = :token, token_expire = :expiration WHERE username = :email");
        $insertStmt->bindParam(':token', $token);
        $insertStmt->bindParam(':expiration', $expiration);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->execute();

        
        $registration_link = "https://mccbsitquizandexam.com/step-123?token=" . $token;


        $mail = new PHPMailer(true);
        try {
            
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'johnmichaellerobles345@gmail.com'; 
            $mail->Password   = 'ybhr uilh htvb xygk'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            
            $mail->setFrom('johnmichaellerobles345@gmail.com', 'mccpopquizandexam');
            $mail->addAddress($email);

            
             // Button-style email body with link
            $mail->Body    = '
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
                    .container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
                    h1 { color: #007bff; }
                    .btn { 
                        display: inline-block; background-color: #007bff; color: white; 
                        text-decoration: none; padding: 10px 20px; border-radius: 5px; 
                        margin-top: 20px; font-size: 16px; text-align: center; 
                    }
                    .footer { font-size: 12px; color: #888; text-align: center; padding-top: 10px; }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Complete Your MS 365 Account Registration</h1>
                    <p>Dear user,</p>
                    <p>Thank you for registering with us! To complete your registration, please click the button below:</p>
                    <p><a href="' . $registration_link . '" class="btn">Complete Registration</a></p>
                    <p>If you didn’t request this email, please ignore it.</p>
                    <p class="footer">mccpopquizandexam &copy; ' . date('Y') . '</p>
                </div>
            </body>
            </html>';

            
            $mail->send();
            return 'success';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        return "This MS 365 email is not found in our records.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['username'] ?? '';
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status = sendRegistrationLink($email);
    } else {
        $status = "Invalid email format.";
    }

    echo json_encode(['status' => $status]);
    exit;
}
?>
