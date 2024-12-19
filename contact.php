<?php
// Database configuration
$servername = "localhost";
$username = "u510162695_bsit_quiz"; // or your username
$password = "1Bsit_quiz"; // or your password
$dbname = "u510162695_bsit_quiz"; // specify your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to add the 'start_time' column of type 'timestamp' to the 'exams' table
$sql = "ALTER TABLE exams ADD COLUMN start_time TIMESTAMP";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Column 'start_time' added successfully to the 'exams' table!";
} else {
    echo "Error adding column: " . $conn->error;
}

// Close the connection
$conn->close();
?>
