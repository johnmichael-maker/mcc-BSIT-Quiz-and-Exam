<?php
$servername = "localhost"; // your MySQL server
$username = "u510162695_mcclrc"; // your MySQL username
$password = "1Mcclrc_pass"; // your MySQL password
$dbname = "u510162695_mcclrc"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all tables in the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through all tables
    while($row = $result->fetch_assoc()) {
        $table = $row['Tables_in_' . $dbname];
        echo "<h2>Table: $table</h2>";

        // Get all columns for the current table
        $sql_columns = "DESCRIBE $table";
        $columns_result = $conn->query($sql_columns);

        if ($columns_result->num_rows > 0) {
            echo "<table border='1'><tr>";
            // Display column names
            while($column = $columns_result->fetch_assoc()) {
                echo "<th>" . $column['Field'] . "</th>";
            }
            echo "</tr>";

            // Fetch data from the table
            $sql_data = "SELECT * FROM $table";
            $data_result = $conn->query($sql_data);

            if ($data_result->num_rows > 0) {
                // Display data rows
                while($data_row = $data_result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($data_row as $key => $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='" . $columns_result->num_rows . "'>No data available</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No columns found in $table.</p>";
        }
    }
} else {
    echo "No tables found in database.";
}

$conn->close();
?>
