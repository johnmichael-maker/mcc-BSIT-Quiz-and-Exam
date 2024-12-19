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

// Step 1: Create the 'identifications' table if it doesn't exist
$table_creation_query = "
CREATE TABLE IF NOT EXISTS identifications (
  id INT(11) NOT NULL AUTO_INCREMENT,
  exam_id INT(11) NOT NULL,
  question TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// Execute the query to create the table
if ($conn->query($table_creation_query) === TRUE) {
    echo "Table 'identifications' created or already exists!<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Step 2: Show columns of the 'identifications' table
$query = "SHOW COLUMNS FROM identifications";
$result = $conn->query($query);

// Check if the query was successful
if ($result->num_rows > 0) {
    echo "Columns in the 'identifications' table:<br>";
    // Output column names and their types
    while ($row = $result->fetch_assoc()) {
        echo "Column: " . $row['Field'] . " - Type: " . $row['Type'] . "<br>";
    }
} else {
    echo "No columns found in the 'identifications' table.<br>";
}

// Close the connection
$conn->close();
?>
