<?php
// Database connection settings
$host = 'localhost';  // Your database host
$username = 'u510162695_mcclrc';  // Your database username
$password = '1Mcclrc_pass';  // Your database password
$database = 'u510162695_mcclrc'; // Your database name

// User ID to delete
$user_id = 311;  // The user_id of the record to delete

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete the record from the user table
$sql = "DELETE FROM `user` WHERE `user_id` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the user_id parameter
$stmt->bind_param("i", $user_id); // 'i' means the parameter is an integer

// Execute the query
if ($stmt->execute()) {
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
