<?php
// Database connection variables
private $servername = "localhost"; // Assuming localhost, change if needed
private $user = "u510162695_bsit_quiz"; // Replace with your username
private $pass = "1Bsit_quiz"; // Replace with your password
private $db = "u510162695_bsit_quiz"; // Replace with your database name

// Create a connection to the database using MySQLi
$conn = new mysqli($servername, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the column names
$columnsQuery = "DESCRIBE admin";
$resultColumns = $conn->query($columnsQuery);

// Display column names
if ($resultColumns->num_rows > 0) {
    echo "<h3>Column Names:</h3>";
    echo "<ul>";
    while ($row = $resultColumns->fetch_assoc()) {
        echo "<li>" . $row['Field'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No columns found.";
}

// Query to get all the data from the admin table
$dataQuery = "SELECT * FROM admin";
$resultData = $conn->query($dataQuery);

// Display data
if ($resultData->num_rows > 0) {
    echo "<h3>Data:</h3>";
    echo "<table border='1'><tr>";

    // Fetch and display column names as table headers
    while ($column = $resultColumns->fetch_assoc()) {
        echo "<th>" . $column['Field'] . "</th>";
    }

    echo "</tr>";

    // Reset the column result pointer for the next loop
    $resultColumns->data_seek(0);

    // Fetch and display each row of data
    while ($row = $resultData->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>
