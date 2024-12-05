<?php
// Database credentials
$servername = "localhost";  // Database host, usually localhost
$username = "u510162695_bsit_quiz";         // MySQL username
$password = "1Bsit_quiz";             // MySQL password (empty for local development)
$dbname = "u510162695_bsit_quiz";  // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// Create a table with columns
$table_sql = "
CREATE TABLE login_attempts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,  -- Primary key for identifying records
    ip_address VARCHAR(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,  -- IP address for each attempt (can store IPv6 as well)
    attempts INT(11) DEFAULT 0,  -- Number of attempts made (default is 0)
    last_attempt DATETIME,  -- Timestamp of the last login attempt
    blocked_until DATETIME  -- Timestamp indicating when the user will be unblocked
)";

// Execute the query and check if the table was created
if ($conn->query($table_sql) === TRUE) {
    echo "Table 'login_attempts' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Close the connection
$conn->close();
?>
