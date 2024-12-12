<?php
// Database connection
$servername = "localhost";  // Change to your server's name if not localhost
$username = "u510162695_bsit_quiz";         // Your MySQL username
$password = "1Bsit_quiz";             // Your MySQL password
$dbname = "u510162695_bsit_quiz";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all tables in the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table names
    echo "Tables in '$dbname' database:<br>";
    while($row = $result->fetch_assoc()) {
        $table = $row["Tables_in_" . $dbname];
        echo "Table: $table<br>";

        // Query to get columns for each table
        $columns_sql = "DESCRIBE $table";
        $columns_result = $conn->query($columns_sql);
        
        if ($columns_result->num_rows > 0) {
            echo "Columns in '$table':<br>";
            while ($column = $columns_result->fetch_assoc()) {
                echo "Column: " . $column['Field'] . " - Type: " . $column['Type'] . "<br>";
            }
        } else {
            echo "No columns found for $table<br>";
        }

        echo "<br>";
    }
} else {
    echo "No tables found in database.";
}

// Close connection
$conn->close();
?>
