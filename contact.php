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

// SQL query to select column names from the user table
$sql = "SELECT * FROM `user` LIMIT 1";  // Replace `user` with your actual table name if necessary

// Execute the query and store the result
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output the column names (headers)
    $field_info = $result->fetch_fields();
    echo "<table border='1'>";
    echo "<tr>";
    foreach ($field_info as $val) {
        echo "<th>" . $val->name . "</th>";
    }
    echo "</tr>";
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
