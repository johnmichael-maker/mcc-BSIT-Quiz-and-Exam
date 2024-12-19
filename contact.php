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

// SQL query to drop the `exams` table if it exists
$sql = "DROP TABLE IF EXISTS exams";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "The `exams` table has been deleted successfully!";
} else {
    echo "Error deleting table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
