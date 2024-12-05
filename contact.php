<?php
// Database connection settings
$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all data from a table
$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

// Check if we have results
if ($result->num_rows > 0) {
    // Display column headers (table column names)
    $field_info = $result->fetch_fields();
    echo "<table border='1'><tr>";
    foreach ($field_info as $val) {
        echo "<th>" . $val->name . "</th>";
    }
    echo "</tr>";

    // Display rows of data
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
