<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/phpmailer/phpmailer/src/Exception.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/SMTP.php";
require '../vendor/autoload.php';

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if (isset($_POST['email']) && isset($_POST['recaptcha_response'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $recaptchaResponse = $_POST['recaptcha_response'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        exit();
    }

    // Verify reCAPTCHA response
    $recaptchaSecret = '6Ld9CpMqAAAAAD1Hq_krZF-HXnFLxuuY5HcqVSCF';
    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $recaptchaUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'secret' => $recaptchaSecret,
        'response' => $recaptchaResponse
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification failed.']);
        exit();
    }

    // Check if email exists in the admin table
    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a 6-digit verification code securely using random_int()
        $verificationCode = random_int(100000, 999999);

        // Update the verification code in the database
        $updateQuery = "UPDATE admin SET verification = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("is", $verificationCode, $email);

        // Check if the update query was successful
        if (!$updateStmt->execute()) {
            echo json_encode(['success' => false, 'message' => 'Failed to update verification code in database.']);
            exit();
        }

        // Send the verification code via email using PHPMailer and Gmail SMTP
        $mail = new PHPMailer(true);  // Create a new PHPMailer instance

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'johnmichaellerobles345@gmail.com'; 
            $mail->Password   = 'ybhr uilh htvb xygk'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;


            //Recipients
            $mail->setFrom('no-reply@yourdomain.com', 'Verification');
            $mail->addAddress($email);  // Add recipient's email

            // Content
            $mail->isHTML(false);  // Set email format to plain text
            $mail->Subject = 'Your Verification Code';
            $mail->Body    = 'Your verification code is: ' . $verificationCode;

            // Send the email
            $mail->send();
            echo json_encode(['success' => true, 'message' => 'Verification code sent to your email.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Email and reCAPTCHA response are required.']);
}

$conn->close();
?>
