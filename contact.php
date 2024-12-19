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

// Step 1: Create the 'identification_answers' table if it doesn't exist
$table_creation_query = "
CREATE TABLE IF NOT EXISTS identification_answers (
  id INT(11) NOT NULL AUTO_INCREMENT,
  exam_id INT(11) NOT NULL,
  identification_id INT(11) NOT NULL,
  answer TEXT NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

// Execute the query to create the table
if ($conn->query($table_creation_query) === TRUE) {
    echo "Table 'identification_answers' created or already exists!<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Step 2: Show columns of the 'identification_answers' table
$query = "SHOW COLUMNS FROM identification_answers";
$result = $conn->query($query);

// Check if the query was successful
if ($result->num_rows > 0) {
    echo "Columns in the 'identification_answers' table:<br>";
    // Output column names and their types
    while ($row = $result->fetch_assoc()) {
        echo "Column: " . $row['Field'] . " - Type: " . $row['Type'] . "<br>";
    }
} else {
    echo "No columns found in the 'identification_answers' table.<br>";
}

// Close the connection
$conn->close();
?>
