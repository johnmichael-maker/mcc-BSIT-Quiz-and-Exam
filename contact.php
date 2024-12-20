<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// The admin ID and the new password to update
$admin_id = 51; // Set the admin ID of the record you want to update
$new_password = 'new_secure_password'; // The new password to be hashed and set

// Hash the new password using Argon2
$hashed_password = password_hash($new_password, PASSWORD_ARGON2I);

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to update the password for the specified admin_id
$sql = "UPDATE `admin` SET `password` = ? WHERE `admin_id` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("si", $hashed_password, $admin_id); // 's' for string (hashed password), 'i' for integer (admin_id)

// Execute the query
if ($stmt->execute()) {
    echo "Password updated successfully for admin_id $admin_id.";
} else {
    echo "Error updating password: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
