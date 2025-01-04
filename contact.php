<?php
// Database connection details
$servername = "localhost";  // or the database server IP/hostname
$username = "u510162695_mcclrc";
$password = "1Mcclrc_pass";
$dbname = "u510162695_mcclrc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all data from the admin table
$sql = "SELECT * FROM admin"; 
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    echo "<table border='1'><tr>";
    
    // Fetch and display the column names as table headers
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . $field->name . "</th>";
    }
    
    echo "</tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $columnValue) {
            echo "<td>" . $columnValue . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found";
}

// Close connection
$conn->close();
?>
