<?php
// Database configuration
$servername = "localhost";
$username = "u510162695_bsit_quiz"; // your username
$password = "1Bsit_quiz"; // your password
$dbname = "u510162695_bsit_quiz"; // your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Query to get all tables in the database
$query = "SHOW TABLES";
$result = $conn->query($query);

// Step 2: Check if there are any tables and display them
if ($result->num_rows > 0) {
    echo "Tables in the database '$dbname':<br>";
    while ($row = $result->fetch_assoc()) {
        echo $row['Tables_in_' . $dbname] . "<br>";  // Display table name
    }
} else {
    echo "No tables found in the database.<br>";
}

// Close the connection
$conn->close();
?>
