<?php
// Database connection
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
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

        // Send the verification code to the email
        $subject = "Your Verification Code";
        $message = "Your verification code is: " . $verificationCode;
        $headers = "From: mccbistquizandexam@gmail.com\r\n";
        $headers .= "Reply-To: mccbistquizandexam@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Using mail function to send the email
        if (mail($email, $subject, $message, $headers)) {
            echo json_encode(['success' => true, 'message' => 'Verification code sent to your email.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again later.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
}

// Close connection
$conn->close();
?>
