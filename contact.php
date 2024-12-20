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
    echo "<h2>Admin Table Data:</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Date Added</th></tr>"; // Adjust columns based on your table's structure

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";  // Assuming 'role' is a column
        echo "<td>" . $row['date_added'] . "</td>";  // Assuming 'date_added' is a column
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found in the 'admin' table.";
}

// Close the connection
$conn->close();
?>
