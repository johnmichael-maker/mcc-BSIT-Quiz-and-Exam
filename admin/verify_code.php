<?php
// Database connection
$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

// Check connection
if ($conn->connect_error) {
    // Log connection error and exit
    error_log("Connection failed: " . $conn->connect_error);
    echo json_encode(['success' => false, 'message' => 'Server error, please try again later.']);
    exit;
}

// Check if email and code are provided
if (isset($_POST['email']) && isset($_POST['code'])) {
    $email = $_POST['email'];
    $code = $_POST['code'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        exit;
    }

    // Validate code (Ensure it's a 4-digit code)
    if (!preg_match('/^\d{4}$/', $code)) {
        echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        exit;
    }

    // Prepare query to check if email exists
    $query = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        // Log and return error if the query preparation failed
        error_log("Error preparing query: " . $conn->error);
        echo json_encode(['success' => false, 'message' => 'Server error, please try again later.']);
        exit;
    }

    $stmt->bind_param("s", $email); // Bind email parameter
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Compare the entered code with the stored verification code
        if ($user['verification'] == $code) {
            // Clear the verification code after successful verification
            $updateQuery = "UPDATE admin SET verification = NULL WHERE email = ?";
            $updateStmt = $conn->prepare($updateQuery);
            
            if (!$updateStmt) {
                // Log and return error if the update query preparation failed
                error_log("Error preparing update query: " . $conn->error);
                echo json_encode(['success' => false, 'message' => 'Server error, please try again later.']);
                exit;
            }

            $updateStmt->bind_param("s", $email); // Bind email parameter for update
            $updateStmt->execute();

            // Return success response and redirect
            echo json_encode(['success' => true, 'message' => 'Verification successful. Redirecting...', 'redirect' => 'login.php']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email not found.']);
    }

    // Close the prepared statement
    $stmt->close();
    $updateStmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Both email and code are required.']);
}

// Close the database connection
$conn->close();
?>
