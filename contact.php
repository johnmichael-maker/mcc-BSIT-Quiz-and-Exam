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

// Step 2: ID of the record you want to delete
$id_to_delete = 637; // Change this to the ID you want to delete

// Step 3: SQL query to delete the record
$sql = "DELETE FROM user WHERE id = ?"; // Replace 'users' with your actual table name

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameter to the query
$stmt->bind_param("i", $id_to_delete); // "i" means the ID is an integer

// Execute the query
if ($stmt->execute()) {
    echo "Record with ID $id_to_delete has been deleted successfully.";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Step 4: Close the database connection
$stmt->close();
$conn->close();
?>
