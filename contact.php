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

// Step 2: Query to get data from the 'users' table
$sql = "SELECT * FROM user";  // Change 'users' to your table name if necessary
$result = $conn->query($sql);

// Step 3: Display column names and data in a table format
if ($result->num_rows > 0) {
    // Start the table
    echo "<table border='1'>";
    
    // Display column names (headers)
    echo "<tr>";
    // Get the column names dynamically from the result set
    $fields = $result->fetch_fields();  // Get the fields (columns) of the result
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";
    
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
