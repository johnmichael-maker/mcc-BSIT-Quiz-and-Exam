<?php
// Database configuration
$servername = "localhost";
$username = "u510162695_bsit_quiz"; // your username
$password = "1Bsit_quiz"; // your password
$dbname = "u510162695_bsit_quiz"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete all data in `activity_logs` table
$sql = "DELETE FROM activity_logs";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "All data from `activity_logs` table has been deleted!";
} else {
    echo "Error deleting data: " . $conn->error;
}

// Close the connection
$conn->close();
?>
