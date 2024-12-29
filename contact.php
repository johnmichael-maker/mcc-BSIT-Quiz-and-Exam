<?php
// Database credentials
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

// Create a connection to the database
$conn = new mysqli("localhost", $user, $pass, $db);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve all tables in the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

// Check if there are tables in the database
if ($result->num_rows > 0) {
    echo "Tables in the database '$db':<br>";
    while ($row = $result->fetch_row()) {
        echo $row[0] . "<br>";
    }
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
