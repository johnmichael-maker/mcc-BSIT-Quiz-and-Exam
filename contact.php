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

// SQL query to add the 'start_time' column of type 'timestamp' to the 'exams' table
$sql = "ALTER TABLE exams ADD COLUMN start_time TIMESTAMP";

// Execute the query to add the column
if ($conn->query($sql) === TRUE) {
    echo "Column 'start_time' added successfully to the 'exams' table!<br>";
} else {
    echo "Error adding column: " . $conn->error . "<br>";
}

// SQL query to show the columns of the 'exams' table
$query = "DESCRIBE exams";
$result = $conn->query($query);

// Check if the query was successful
if ($result->num_rows > 0) {
    echo "Columns in the 'exams' table:<br>";
    // Output column names and their types
    while($row = $result->fetch_assoc()) {
        echo "Column: " . $row['Field'] . " - Type: " . $row['Type'] . "<br>";
    }
} else {
    echo "No columns found in the 'exams' table.<br>";
}

// Close the connection
$conn->close();
?>
