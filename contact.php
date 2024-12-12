<?php
// Database connection
$servername = "localhost";  // Change to your server's name if not localhost
$username = "u510162695_bsit_quiz";         // Your MySQL username
$password = "1Bsit_quiz";             // Your MySQL password
$dbname = "u510162695_bsit_quiz";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to delete all contestant data
$sql = "DELETE FROM questions";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "All contestant records have been deleted successfully.";
} else {
    echo "Error deleting records: " . $conn->error;
}

// Close connection
$conn->close();
?>
