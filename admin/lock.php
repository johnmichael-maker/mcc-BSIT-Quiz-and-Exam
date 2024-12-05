<?php
// Database connection
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

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
    $recaptchaSecret = '6LcgCYQqAAAAAF2I3spmD66uqtH8tm7ionOFqxUf';  // Replace with your reCAPTCHA secret key
    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($recaptchaUrl . "?secret=" . $recaptchaSecret . "&response=" . $recaptchaResponse);
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
        // Generate a 6-digit verification code
        $verificationCode = rand(100000, 999999);

        // Update the verification code in the database
        $updateQuery = "UPDATE admin SET verification = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("is", $verificationCode, $email);
        $updateStmt->execute();

        if ($updateStmt->affected_rows > 0) {
            // Send the verification code via email
            $subject = "Your Verification Code";
            $message = "Your verification code is: " . $verificationCode;
            $headers = "From: no-reply@yourdomain.com\r\n" .
                       "Reply-To: no-reply@yourdomain.com\r\n" .
                       "Content-Type: text/plain; charset=UTF-8";

            // Use PHP's mail function to send the email
            if (mail($email, $subject, $message, $headers)) {
                echo json_encode(['success' => true, 'message' => 'Verification code sent to your email.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again later.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update the verification code in the database.']);
        }

        $updateStmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Email and reCAPTCHA response are required.']);
}

$conn->close();
?>
