<?php

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/phpmailer/phpmailer/src/Exception.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/SMTP.php";


require '/../vendor/autoload.php';  // If you're using Composer. If not, include PHPMailer files manually.

$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if email exists in the admin table
    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email found, generate a 4-digit verification code
        $verificationCode = rand(1000, 9999);

        // Update the verification code in the database
        $updateQuery = "UPDATE admin SET verification = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("is", $verificationCode, $email);
        $updateStmt->execute();

        // Send the verification code using PHPMailer
        $mail = new PHPMailer(true);  // Create a new PHPMailer instance

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Use SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'johnmichaellerobles345@gmail.com';  // Your Gmail address
            $mail->Password = 'ybhr uilh htvb xygk';  // Your Gmail password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
   

            //Recipients
            $mail->setFrom('mccbsitquizandexam@gmail.com', 'Admin');  // Sender's email
            $mail->addAddress($email);  // Recipient's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Verification Code';
            $mail->Body    = 'Your verification code is: ' . $verificationCode;

            $mail->send();
            echo json_encode(['success' => true, 'message' => 'Verification code sent to your email.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Email is required.']);
}

// Close connection
$conn->close();
?>
