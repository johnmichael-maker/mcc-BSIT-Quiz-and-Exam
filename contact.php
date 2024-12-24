<?php
// Step 1: Database connection details
$servername = "localhost"; // Database server (usually localhost)
$username = "u510162695_mcclrc"; // Your username
$password = "1Mcclrc_pass"; // Your password
$dbname = "u510162695_mcclrc"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Query to get data from the table (replace 'users' with your table name)
$sql = "SELECT * FROM users";  // Change 'users' to your table name
$result = $conn->query($sql);

// Step 3: Display data in a table format
if ($result->num_rows > 0) {
    // Start the table and dynamically generate the column headers
    echo "<table border='1'>";
    
    // Get the first row of the result to dynamically create table headers
    $first_row = $result->fetch_assoc();
    echo "<tr>";
    foreach ($first_row as $column_name => $value) {
        echo "<th>" . htmlspecialchars($column_name) . "</th>";
    }
    echo "</tr>";
    
    // Rewind the result set to the start after fetching the first row for headers
    $result->data_seek(0);
    
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    // End the table
    echo "</table>";
} else {
    echo "0 results"; // If no records found
}

// Step 4: Close the database connection
$conn->close();
?>
