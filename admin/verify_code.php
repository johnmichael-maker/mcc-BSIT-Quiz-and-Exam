<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mcc_bsit_quiz_and_exam";


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if code and email are provided
if (isset($_POST['code']) && isset($_POST['email'])) {
    $code = $_POST['code'];
    $email = $_POST['email'];

    // Check if email exists and if the code matches
    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Compare the entered code with the stored verification code
        if ($user['verification'] == $code) {
            // Clear the verification code after successful login
            $updateQuery = "UPDATE admin SET verification = NULL WHERE email = ?";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute([$email]);

            // Return success response
            echo json_encode(['success' => true, 'message' => 'Verification successful. Redirecting...', 'redirect' => 'login.php']); // Redirect to the login page
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Both email and code are required.']);
}
?>
