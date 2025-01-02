<?php
// Database connection details
$server = "localhost"; // Change to your server if necessary
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
$sql = "SELECT * FROM user"; // Assuming your table is named 'users'
$result = $conn->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Start the table
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    
    // Display the column headers dynamically
    $fields = $result->fetch_fields();
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>" . $field->name . "</th>"; // Display column names as table headers
    }
    echo "</tr>";

    // Loop through each row and display the data
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($fields as $field) {
            echo "<td>" . $row[$field->name] . "</td>"; // Display data for each column dynamically
        }
        echo "</tr>";
    }

    // Close the table
    echo "</table>";
} else {
    echo "No data found in the 'users' table.";
}

// Close the connection
$conn->close();
?>
