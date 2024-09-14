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

    $stmt = $pdo->prepare("SELECT * FROM ms_365_users WHERE Username = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $registration_link = "https://mccbsitquizandexam.com/signup.php?token=" . md5(uniqid($email, true));

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

            $mail->isHTML(true);
            $mail->Subject = 'MS 365 Account Verification';
            $mail->Body    = "Click on the following link to complete your registration: <a href='$registration_link'>$registration_link</a>";

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
    $email = $_POST['Username'];
    $status = sendRegistrationLink($email);

    // Return a JSON response for AJAX handling
    echo json_encode(['status' => $status]);
    exit;
}
?>
