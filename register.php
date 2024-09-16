<?php
namespace App;

$successMessage = '';
$errorMessage = '';

// Function to generate a random verification string
function generateVerificationCode($length = 20) {
    return bin2hex(random_bytes($length / 2)); // Generates a random string of specified length
}

// Check if a token is provided
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($token) {
    // Verify the token
    $tokenHash = hash('sha256', $token);
    $stmt = $conn->prepare("SELECT id, reset_token_hash_expires_at FROM signupinstructors WHERE reset_token_hash = ? AND reset_token_hash_expires_at > NOW()");
    $stmt->bind_param('s', $tokenHash);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Token is valid
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect and validate form data
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

            // Generate a random verification code
            $verification = generateVerificationCode();

            // Basic server-side validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage = "Invalid email address.";
            } else {
                // Start transaction to ensure both inserts happen
                $conn->begin_transaction();
                try {
                    // Insert into instructors table
                    $stmt = $conn->prepare("INSERT INTO instructors (first_name, middle_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('ssssss', $firstName, $middleName, $lastName, $email, $phone, $address);
                    $stmt->execute();
                    $stmt->close(); // Close the statement after execution

                    // Insert into admin table with userType of 2 (Instructor)
                    $img = '../assets/img/logo.png'; // Default image
                    $userType = 2; // Set userType for instructor
                    $stmt = $conn->prepare("INSERT INTO admin (username, img, email, password, verification, userType, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
                    $stmt->bind_param('sssssi', $username, $img, $email, $password, $verification, $userType);
                    $stmt->execute();
                    $stmt->close(); // Close the statement after execution

                    // Remove token from signupinstructors table
                    $stmt = $conn->prepare("DELETE FROM signupinstructors WHERE reset_token_hash = ?");
                    $stmt->bind_param('s', $tokenHash);
                    $stmt->execute();
                    $stmt->close(); // Close the statement after execution

                    // Commit transaction
                    $conn->commit();
                    
                    $successMessage = "Registration successful!";
                } catch (Exception $e) {
                    // Rollback transaction on error
                    $conn->rollback();
                    $errorMessage = "Error: " . $e->getMessage(); // Use detailed exception message
                }
            }
        }
    } else {
        // Token is invalid or expired
        $errorMessage = "Invalid or expired token.";
    }
} else {
    $errorMessage = "No token provided.";
}
?>

