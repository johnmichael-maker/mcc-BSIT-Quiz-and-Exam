<?php
// Database credentials
$user = "u510162695_mcclrc";
$pass = "1Mcclrc_pass";
$db = "u510162695_mcclrc";

// Create connection
$servername = "localhost"; // assuming the server is localhost
$conn = new mysqli($servername, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// New password
$newPassword = "new_secure_password"; // Replace with the new password you want to set
$hashedPassword = password_hash($newPassword, PASSWORD_ARGON2I); // Hash the new password using Argon2i

// User email or ID to identify the user whose password you want to update
$userEmail = "diovin.calatero@mcclawis.edu.ph"; // The user's email address or identifier

// SQL query to update the password for the specific user
$sql = "UPDATE admin SET password='$hashedPassword' WHERE email='$userEmail'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Password updated successfully for user: " . $userEmail;
} else {
    echo "Error updating password: " . $conn->error;
}

// Close connection
$conn->close();
?>
