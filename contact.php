<?php
// Database connection settings
$servername = "localhost";
$username = "u510162695_mcclrc";
$password = "1Mcclrc_pass";
$dbname = "u510162695_mcclrc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User ID to be deleted
$user_id = 375;

// SQL query to delete the user
$sql = "DELETE FROM user WHERE user_id = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);  // 'i' is for integer

// Execute the query
if ($stmt->execute()) {
    echo "User record with user_id = $user_id has been deleted successfully!";
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
