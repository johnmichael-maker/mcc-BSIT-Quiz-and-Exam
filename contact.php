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

// SQL query to show the columns of the 'exams' table
$query = "SHOW COLUMNS FROM exams";
$result = $conn->query($query);

// Check if the query was successful
if ($result->num_rows > 0) {
    echo "Columns in the 'exams' table:<br>";
    // Output column names and their types
    while ($row = $result->fetch_assoc()) {
        echo "Column: " . $row['Field'] . " - Type: " . $row['Type'] . "<br>";
    }
} else {
    echo "No columns found in the 'exams' table.<br>";
}

// Close the connection
$conn->close();
?>
