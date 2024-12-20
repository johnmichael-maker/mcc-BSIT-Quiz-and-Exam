<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// The ID of the admin you want to update
$admin_id = 51; // Set the ID of the record you want to edit

// New values to be updated (For example, received from a form)
$firstname = 'Developer';
$middlename = 'Calatero';
$lastname = 'Diovin';
$email = 'diovin.calatero@mcclawis.edu.ph';
$address = 'Patao, Bantayan, Cebu';
$phone_number = '09858024662';
$password = '$argon2i$v=19$m=65536,t=4,p=1$dTVaUDg0b3NPLjBQVWZrcg$XyzGb8qFxoM8IvX4vIg45T6C0nzWpVGftLTEoDZW6Nc'; // Example Argon2i hashed password
$confirm_password = '$argon2i$v=19$m=65536,t=4,p=1$dTVaUDg0b3NPLjBQVWZrcg$XyzGb8qFxoM8IvX4vIg45T6C0nzWpVGftLTEoDZW6Nc'; // Example Argon2i hashed confirm password
$admin_image = '1732497782.jpg';
$admin_type = 'Admin';
$admin_added = '2024-10-10 15:28:44';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to update the admin record
$sql = "UPDATE `admin` 
        SET `firstname` = ?, 
            `middlename` = ?, 
            `lastname` = ?, 
            `email` = ?, 
            `address` = ?, 
            `phone_number` = ?, 
            `password` = ?, 
            `confirm_password` = ?, 
            `admin_image` = ?, 
            `admin_type` = ?, 
            `admin_added` = ? 
        WHERE `admin_id` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssssssssssi", 
    $firstname, 
    $middlename, 
    $lastname, 
    $email, 
    $address, 
    $phone_number, 
    $password, 
    $confirm_password, 
    $admin_image, 
    $admin_type, 
    $admin_added, 
    $admin_id
);

// Execute the query
if ($stmt->execute()) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
