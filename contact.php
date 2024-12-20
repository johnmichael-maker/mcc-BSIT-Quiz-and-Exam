<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_chatbot_db';    // Your database username
$password = '1Chatbot_db';        // Your database password
$database = 'u510162695_chatbot_db'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all tables in the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

// Check if there are tables in the database
if ($result->num_rows > 0) {
    echo "<h2>Tables in the database:</h2>";
    echo "<ul>";
    
    // Loop through all tables
    while ($row = $result->fetch_assoc()) {
        $table_name = $row['Tables_in_' . $database];
        echo "<li><strong>$table_name</strong><br>";

        // For each table, get the columns
        $column_sql = "SHOW COLUMNS FROM `$table_name`";
        $column_result = $conn->query($column_sql);

        if ($column_result->num_rows > 0) {
            echo "<ul>";
            // Loop through all columns of the current table
            while ($column = $column_result->fetch_assoc()) {
                echo "<li>" . $column['Field'] . " (" . $column['Type'] . ")</li>";
            }
            echo "</ul>";
        } else {
            echo "No columns found.";
        }

        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
