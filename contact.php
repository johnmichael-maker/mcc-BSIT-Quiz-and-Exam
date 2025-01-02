<?php
// Database connection settings
$host = 'localhost';  // Your database host
$username = 'u510162695_mcclrc';  // Your database username
$password = '1Mcclrc_pass';  // Your database password
$database = 'u510162695_mcclrc'; // Your database name

// New Data to update for user with ID 148
$user_id = 148;  // The user_id of the record to update
$status = 'approved';  // Set the status to 'approved'

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to update only the status column in the user table
$sql = "UPDATE `user` SET `status` = ? WHERE `user_id` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("si", $status, $user_id); // 's' for string (status), 'i' for integer (user_id)

// Execute the query
if ($stmt->execute()) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
