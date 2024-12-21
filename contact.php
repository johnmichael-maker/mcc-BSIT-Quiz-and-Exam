<?php
// Database connection settings
$servername = "localhost";
$username = "u510162695_mcclrc"; // your database username
$password = "1Mcclrc_pass";     // your database password
$dbname = "u510162695_mcclrc"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all table names from the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

// Check if there are any tables
if ($result->num_rows > 0) {
    // Output data in an HTML table
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Table Name</th></tr>";  // Table header
    
    // Fetch and display each table name
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $tableName) {
            echo "<tr><td>" . htmlspecialchars($tableName) . "</td></tr>";
        }
    }
    
    echo "</table>";
} else {
    echo "No tables found.";   
}

// Close connection
$conn->close();
?>
