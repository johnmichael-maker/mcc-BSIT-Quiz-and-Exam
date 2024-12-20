<?php
// Database connection settings
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

// Query to fetch all tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output all table names
    echo "<h2>Tables in Database: $database</h2><ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Tables_in_' . $database] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
