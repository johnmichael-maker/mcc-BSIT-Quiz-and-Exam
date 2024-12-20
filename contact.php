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
    // Output data of each row
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Other Columns</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        // Add other columns if necessary
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found in the table.";
}

// Close the connection
$conn->close();
?>
