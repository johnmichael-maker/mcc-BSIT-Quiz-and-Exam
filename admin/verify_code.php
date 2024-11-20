<?php
// Start session to manage user data
session_start();

// Database connection
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['code']) && isset($_POST['email'])) {
    $code = $_POST['code'];
    $email = $_POST['email'];

    // Sanitize email to prevent SQL injection
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check if email exists and if the code matches
    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email); // Bind the email parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Compare the entered code with the stored verification code
        if ($user['verification'] == $code) {
            // Clear the verification code after successful verification
            $updateQuery = "UPDATE admin SET verification = NULL, email_verified = 1 WHERE email = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("s", $email); // Bind the email parameter
            if ($updateStmt->execute()) {
                // Set session to reflect email is verified
                $_SESSION['email_verified'] = true;

                // Return success response and perform server-side redirect
                echo json_encode([
                    'success' => true,
                    'message' => 'Verification successful. Redirecting...',
                    'redirect' => 'login.php'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating verification status.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Both email and code are required.']);
}

// Close the connection
$conn->close();
?>
