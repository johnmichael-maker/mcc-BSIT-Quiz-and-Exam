<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_chatbot_db';    // Your database username
$password = '1Chatbot_db';        // Your database password
$database = 'u510162695_chatbot_db'; // Replace with your database name

// The ID of the question you want to delete
$id_to_delete = 5; // Change this to the ID of the row you want to delete

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to delete a row from the 'questions' table by ID
$sql = "DELETE FROM `questions` WHERE `id` = ?";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_to_delete); // 'i' stands for integer type

// Execute the query
if ($stmt->execute()) {
    echo "Row with ID $id_to_delete deleted successfully from the 'questions' table.";
} else {
    echo "Error deleting row: " . $conn->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
