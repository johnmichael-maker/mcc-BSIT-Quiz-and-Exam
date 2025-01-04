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

// Query to fetch data from your table (replace 'your_table' with the actual table name)
$sql = "SELECT * FROM admin"; 
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Output data for each row
    echo "<table border='1'><tr><th>Column1</th><th>Column2</th><th>Column3</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results found";
}

// Close connection
$conn->close();
?>
