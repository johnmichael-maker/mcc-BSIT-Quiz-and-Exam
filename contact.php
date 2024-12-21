




<?php
// Database credentials
$host = 'localhost';      // Your MySQL host, usually localhost
$username = 'u510162695_bsit_quiz';       // Your MySQL username
$password = '1Bsit_quiz';           // Your MySQL password
$database = 'u510162695_bsit_quiz'; // Your MySQL database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all tables
$sql = "SHOW TABLES";

// Execute the query
$result = $conn->query($sql);

// Check if there are any tables
if ($result->num_rows > 0) {
    echo "<h3>Tables in database '$database':</h3>";
    echo "<ul>";
    // Fetch and display each table name
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Tables_in_' . $database] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in database.";
}

// Close the connection
$conn->close();
?>
