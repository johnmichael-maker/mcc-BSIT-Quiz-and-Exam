<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_chatbot_db';    // Your database username
$password = '1Chatbot_db';        // Your database password
$database = 'u510162695_chatbot_db'; // Replace with your database name
// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to drop the 'questions' table
$sql = "DROP TABLE IF EXISTS `questions`";

// Execute the query to delete the table
if ($conn->query($sql) === TRUE) {
    echo "Table 'questions' deleted successfully.";
} else {
    echo "Error deleting table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
