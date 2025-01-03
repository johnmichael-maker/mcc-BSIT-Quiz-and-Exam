<?php
// Database connection details
$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all table names
$sql = "SHOW TABLES";
$result = $conn->query($sql);

// Check if any tables were found
if ($result->num_rows > 0) {
    echo "<h2>Tables in the database:</h2><ul>";
    // Output each table name
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Tables_in_' . $dbname] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
