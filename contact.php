<?php
// Database configuration
$servername = "localhost"; // Your MySQL server host
$username = "u510162695_bsit_quiz"; // Your MySQL username
$password = "1Bsit_quiz"; // Your MySQL password
$dbname = "u510162695_bsit_quiz"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to show all tables in the database
$sql = "SHOW TABLES";

// Execute the query and get the result
$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Loop through and display each table name
    echo "<h3>Tables in the '$dbname' database:</h3>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['Tables_in_' . $dbname] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
