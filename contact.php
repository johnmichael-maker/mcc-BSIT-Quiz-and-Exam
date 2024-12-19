<?php
// Database configuration
$servername = "localhost";
$username = "u510162695_bsit_quiz"; // your username
$password = "1Bsit_quiz"; // your password
$dbname = "u510162695_bsit_quiz"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Query to get the column names of the 'admin' table
$sql_columns = "SHOW COLUMNS FROM admin";
$columns_result = $conn->query($sql_columns);

// Step 2: Query to get the data from the 'admin' table
$sql_data = "SELECT * FROM admin";
$data_result = $conn->query($sql_data);

// Step 3: Check if there are any columns and data
if ($columns_result->num_rows > 0 && $data_result->num_rows > 0) {
    // Display columns
    echo "<h2>Admin Table - Columns and Data</h2>";
    echo "<table border='1'>";
    
    // Table Header: Display column names
    echo "<tr>";
    while ($column = $columns_result->fetch_assoc()) {
        echo "<th>" . $column['Field'] . "</th>"; // 'Field' holds the column name
    }
    echo "</tr>";

    // Table Rows: Display data from the 'admin' table
    while ($row = $data_result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>"; // Display data for each column
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No columns or data found in the 'admin' table.";
}

// Close the connection
$conn->close();
?>
