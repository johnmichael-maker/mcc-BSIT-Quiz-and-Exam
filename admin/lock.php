<?php
// Database connection
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if email is provided
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA (optional, for additional security)
    $recaptchaSecretKey = '6LcgCYQqAAAAAF2I3spmD66uqtH8tm7ionOFqxUf'; // replace with your secret key
    $recaptchaVerifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaData = [
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse,
    ];

    $recaptchaVerifyResponse = file_get_contents($recaptchaVerifyUrl . '?' . http_build_query($recaptchaData));
    $recaptchaResult = json_decode($recaptchaVerifyResponse);

    if ($recaptchaResult->success) {
        // Check if email exists in the admin table
        $query = "SELECT * FROM admin WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Generate a 4-digit verification code
            $verificationCode = rand(1000, 9999);

            // Store the verification code in the database
            $updateQuery = "UPDATE admin SET verification = ? WHERE email = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute([$verificationCode, $email]);

            // Send the verification code to the email (using PHPMailer or mail() function)
            // Example using mail() function:
            $subject = "Your Verification Code";
            $message = "Your verification code is: " . $verificationCode;
            $headers = "From: no-reply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                echo json_encode(['success' => true, 'message' => 'Verification code sent to your email.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again later.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Email not found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'reCAPTCHA verification failed.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Email is required.']);
}
?>
