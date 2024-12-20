<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all rows from the 'admin' table
$sql = "SELECT * FROM `admin`";

// Execute the query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Get the column names dynamically
    $columns = $result->fetch_fields();
    
    // Start the table
    echo "<h2>Admin Table Data:</h2>";
    echo "<table border='1' cellpadding='10'>";
    
    // Display table headers (column names)
    echo "<tr>";
    foreach ($columns as $column) {
        echo "<th>" . htmlspecialchars($column->name) . "</th>";
    }
    echo "</tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($columns as $column) {
            echo "<td>" . htmlspecialchars($row[$column->name]) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found in the 'admin' table.";
}

// Close the connection
$conn->close();
?>
