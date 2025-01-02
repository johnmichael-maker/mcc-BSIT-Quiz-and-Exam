<?php
// Database connection details
$servername = "localhost";  // or your host
$username = "u510162695_mcclrc";
$password = "1Mcclrc_pass";
$dbname = "u510162695_mcclrc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all data from a specific table
$sql = "SELECT * FROM user";  // replace 'your_table_name' with your actual table name
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Start table
    echo "<table border='1'><tr>";

    // Fetch the column names and create table headers
    $field_info = $result->fetch_fields();
    foreach ($field_info as $val) {
        echo "<th>" . $val->name . "</th>";
    }

    echo "</tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td>" . $data . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the connection
$conn->close();
?>
