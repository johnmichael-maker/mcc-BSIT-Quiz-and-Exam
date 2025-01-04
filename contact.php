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

// The email of the user to be deleted (this is the unique identifier for the user)
$userEmail = "ritchel.delarama@mcclawis.edu.ph"; // Replace with the actual email

// SQL query to delete the user record from the 'user' table
$sql = "DELETE FROM user WHERE email = '$userEmail'";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully for email: " . $userEmail;
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close connection
$conn->close();
?>
