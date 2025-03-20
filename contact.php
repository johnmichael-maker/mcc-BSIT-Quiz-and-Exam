<?php
// Database connection details
$servername = "localhost"; // Change this to your database server if needed
$username = "u510162695_bsit_quiz";  // Your database username
$password = "1Bsit_quiz";            // Your database password
$dbname = "u510162695_bsit_quiz";    // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all table names
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each table
    while($row = $result->fetch_assoc()) {
        $table_name = $row["Tables_in_" . $dbname];
        echo "Table: " . $table_name . "<br>";

        // Get columns for each table
        $columns_sql = "DESCRIBE $table_name";
        $columns_result = $conn->query($columns_sql);

        if ($columns_result->num_rows > 0) {
            // Loop through each column in the table
            while($column = $columns_result->fetch_assoc()) {
                echo "&nbsp;&nbsp;&nbsp;Column: " . $column["Field"] . " (" . $column["Type"] . ")<br>";
            }
        } else {
            echo "&nbsp;&nbsp;&nbsp;No columns found.<br>";
        }
    }
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
