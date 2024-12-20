<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Real user data to insert (replace these with your own data)
$user_name = 'Alice Johnson';  // Real user name
$user_email = 'alice.johnson@example.com';  // Real user email

// SQL query to insert data into the user table
$sql = "INSERT INTO `user` (`name`, `email`) VALUES (?, ?)";

// Prepare and bind the statement to avoid SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_name, $user_email); // "ss" means both parameters are strings

// Execute the query
if ($stmt->execute()) {
    // Output the ID of the newly inserted user
    echo "New user added successfully with ID: " . $stmt->insert_id;
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
