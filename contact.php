<?php
// Database connection settings
$host = 'localhost';
$username = 'u510162695_chatbot_db';
$password = '1Chatbot_db';
$database = 'u510162695_chatbot_db';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $user_id = $_POST['id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Fetch the current password hash from the database
    $sql = "SELECT `password` FROM `users` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "User not found.";
        exit;
    }

    $row = $result->fetch_assoc();
    $hashed_password = $row['password']; // The stored hash of the current password

    // Verify the current password entered by the user
    if (!password_verify($current_password, $hashed_password)) {
        echo "Current password is incorrect.";
        exit;
    }

    // Check if the new password and the confirmation match
    if ($new_password !== $confirm_new_password) {
        echo "New password and confirmation do not match.";
        exit;
    }

    // Hash the new password
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $update_sql = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_hashed_password, $user_id);

    if ($update_stmt->execute()) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
