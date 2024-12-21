<?php
// Database connection settings
$servername = "localhost";
$username = "u510162695_mcclrc"; // your database username
$password = "1Mcclrc_pass";     // your database password
$dbname = "u510162695_mcclrc"; // your database name
09814473408
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all columns from the users table
$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

// Check if there are any users
if ($result->num_rows > 0) {
    // Output data in an HTML table
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    
    // Fetching the column names dynamically
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";
    
    // Fetch and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No users found.";
}

// Close connection
$conn->close();
?>
