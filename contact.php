<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// The ID of the admin you want to delete
$admin_id = 51; // Set the ID of the record you want to delete

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete the admin record
$sql = "DELETE FROM `admin` WHERE `admin_id` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the admin_id parameter
$stmt->bind_param("i", $admin_id); // 'i' is for integer type

// Execute the query
if ($stmt->execute()) {
    echo "Record with admin_id $admin_id deleted successfully.";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
