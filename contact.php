<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_chatbot_db';    // Your database username
$password = '1Chatbot_db';        // Your database password
$database = 'u510162695_chatbot_db'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all users
$sql = "SELECT * FROM `users`";

// Execute the query
$result = $conn->query($sql);

// Check if there are records
if ($result->num_rows > 0) {
    // Get column names dynamically
    $fields = $result->fetch_fields();
    
    // Start the table
    echo "<table border='1'>";
    
    // Output column names as table headers
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>" . $field->name . "</th>";
    }
    echo "</tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<td>" . $row[$field->name] . "</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No users found in the table.";
}

// Close the connection
$conn->close();
?>
