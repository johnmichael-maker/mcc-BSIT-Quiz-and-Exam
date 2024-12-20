<?php
$host = 'localhost';   // Your database host
$username = 'u510162695_bsit_quiz';    // Your database username
$password = '1Bsit_quiz';        // Your database password
$database = 'u510162695_bsit_quiz'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to add the 'start_time' column to the 'exams' table
$sql = "ALTER TABLE `exams`
        ADD COLUMN `start_time` timestamp NULL DEFAULT NULL;";

// Execute the query to add the column
if ($conn->query($sql) === TRUE) {
    echo "Column 'start_time' added successfully to the 'exams' table.";
} else {
    echo "Error adding column: " . $conn->error;
}

// Close the connection
$conn->close();
?>
