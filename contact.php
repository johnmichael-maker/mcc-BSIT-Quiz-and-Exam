<?php
// Database credentials
$user = "u510162695_mcclrc";
$pass = "1Mcclrc_pass";
$db = "u510162695_mcclrc";

// Create connection
$servername = "localhost"; // assuming the server is localhost
$conn = new mysqli($servername, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all data from the 'user' table
$sql = "SELECT * FROM user";  // Retrieves all columns from the 'user' table
$result = $conn->query($sql);

// Check if there are any rows in the result
if ($result->num_rows > 0) {
    // Output data in a table
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    
    // Dynamically fetch column headers (field names)
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . $field->name . "</th>"; // Display each column name as table header
    }
    echo "</tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>" . $value . "</td>"; // Display each row value in table cells
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found in the user table.";
}

// Close connection
$conn->close();
?>
