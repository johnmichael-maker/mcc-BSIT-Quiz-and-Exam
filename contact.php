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

// Step 2: Query to get all tables from the database
$sql = "SHOW TABLES"; // This will return all tables in the database
$result = $conn->query($sql);

// Step 3: Display table names
if ($result->num_rows > 0) {
    echo "<h2>Tables in Database '$dbname'</h2>";
    echo "<ul>"; // Start an unordered list
    // Loop through each row and display the table name
    while ($row = $result->fetch_assoc()) {
        // The table name will be in the first column (index 0)
        echo "<li>" . htmlspecialchars($row['Tables_in_' . $dbname]) . "</li>";
    }
    echo "</ul>"; // End the unordered list
} else {
    echo "No tables found in the database."; // If no tables are found
}

// Step 4: Close the database connection
$conn->close();
?>
