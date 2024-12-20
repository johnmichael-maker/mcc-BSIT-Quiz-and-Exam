<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_chatbost_db';    // Your database username
$password = '1Chatbot_db';        // Your database password
$database = 'u510162695_chatbot_db'; // Replace with your database name

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
        // Get the table name
        $table_name = $row['Tables_in_' . $database];
        
        echo "<li><strong>Table: $table_name</strong>";

        // Query to fetch data from each table
        $data_sql = "SELECT * FROM `$table_name`";
        $data_result = $conn->query($data_sql);

        if ($data_result->num_rows > 0) {
            echo "<table border='1'><thead><tr>";

            // Fetch column names for the table
            $columns = $data_result->fetch_fields();
            foreach ($columns as $column) {
                echo "<th>" . $column->name . "</th>";
            }

            echo "</tr></thead><tbody>";

            // Fetch and display data
            while ($data_row = $data_result->fetch_assoc()) {
                echo "<tr>";
                foreach ($data_row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "No data found in this table.";
        }

        echo "</li><br>";
    }
    
    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the connection
$conn->close();
?>
