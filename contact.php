<?php
// Database connection details
$server = "localhost"; // Change if you're using a different host
$user = "u510162695_mcclrc"; // Database username
$pass = "1Mcclrc_pass"; // Database password
$db = "u510162695_mcclrc"; // Database name

// Create connection
$conn = new mysqli($server, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all data from the 'users' table
$sql = "SELECT * FROM user; // Assuming your table is named 'users'
$result = $conn->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Other Columns</th></tr>"; // Adjust column names as needed

    // Loop through each row and display the data
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>"; // Replace with your actual column names
        echo "<td>" . $row["username"] . "</td>"; // Replace with your actual column names
        echo "<td>" . $row["email"] . "</td>"; // Replace with your actual column names
        // Add more columns as needed
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "0 results found";
}

// Close the connection
$conn->close();
?>
