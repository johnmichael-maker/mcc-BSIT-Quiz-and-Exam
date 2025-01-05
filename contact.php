<?php
// Database connection parameters
$host = "localhost"; // or your database host
$user = "u510162695_mcclrc";
$pass = "1Mcclrc_pass";
$db = "u510162695_mcclrc";

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all data from the 'admin' table
$sql = "SELECT * FROM admin"; // 'admin' is the table name
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Start the table and print the headers
    echo "<table border='1'>
            <tr>";

    // Fetch the column names for the table headers
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . $field->name . "</th>";
    }

    echo "</tr>";

    // Loop through the result and output each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found in the admin table.";
}

// Close the database connection
$conn->close();
?>
