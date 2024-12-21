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

// SQL query to fetch all rows from the 'admin' table
$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

// Check if there are any rows in the 'admin' table
if ($result->num_rows > 0) {
    // Output data in an HTML table
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    
    // Fetch column names dynamically for the table header
    $field_info = $result->fetch_fields();
    echo "<tr>";
    foreach ($field_info as $val) {
        echo "<th>" . htmlspecialchars($val->name) . "</th>";
    }
    echo "</tr>";

    // Fetch and display each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $columnValue) {
            echo "<td>" . htmlspecialchars($columnValue) . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found in the 'admin' table.";   
}

// Close connection
$conn->close();
?>
