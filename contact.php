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
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Check if the user wants to update the password
    if (!empty($new_password)) {
        // Hash the new password before storing it with Bcrypt
        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

        // Update query with new password
        $sql = "UPDATE `users` SET `username` = ?, `email` = ?, `password` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $new_username, $new_email, $new_password_hash, $user_id);
    } else {
        // If no password is provided, update only the username and email
        $sql = "UPDATE `users` SET `username` = ?, `email` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_username, $new_email, $user_id);
    }

    // Execute the update
    if ($stmt->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>
