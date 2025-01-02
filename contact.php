<?php
// Database connection settings
$host = 'localhost';  // Your database host
$username = 'u510162695_mcclrc';  // Your database username
$password = '1Mcclrc_pass';  // Your database password
$database = 'u510162695_mcclrc'; // Your database name

// New Data to update for user with ID 311
$user_id = 398;  // The user_id of the record to update
$lastname = 'De La Rama';
$firstname = 'Ritchel';
$middlename = 'Maru'; // Assuming no middlename is provided
$gender = 'Female';
$course = 'BSBA';
$address = 'Kaongkod, Madridejos, Cebu';
$cell_no = '09947163692';
$birthdate = '2004-01-21';
$email = 'ritchel.delarama@mcclawis.edu.ph';
$year_level = '3rd year';
$student_id_no = '2022-2010';

// New password (the password you want to set)
$password_plain = 'ritchel200421'; // New password
$hashed_password = password_hash($password_plain, PASSWORD_ARGON2I); // Hash the password using Argon2

$role_as = 'student';
$status = 'approved';
$user_added = '2024-10-22 08:43:27';
$profile_image = '';
$qr_code = 'b60412e514f3d2709092740f2ca0cfdb';
$verify_token = '';
$token_used = 1; // Assuming token is used
$contact_person = 'Rosa liza Dela Rama';
$person_cell_no = '09851703352';
$logs = ''; // Assuming no logs provided

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to update data in the user table
$sql = "UPDATE `user` 
        SET `lastname` = ?, `firstname` = ?, `middlename` = ?, `gender` = ?, `course` = ?, 
            `address` = ?, `cell_no` = ?, `birthdate` = ?, `email` = ?, `year_level` = ?, 
            `student_id_no` = ?, `password` = ?, `role_as` = ?, `status` = ?, `user_added` = ?, 
            `profile_image` = ?, `qr_code` = ?, `verify_token` = ?, `token_used` = ?, 
            `contact_person` = ?, `person_cell_no` = ?, `logs` = ? 
        WHERE `user_id` = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param(
    "ssssssssssssssssssiisss", 
    $lastname, 
    $firstname, 
    $middlename, 
    $gender, 
    $course, 
    $address, 
    $cell_no, 
    $birthdate, 
    $email, 
    $year_level, 
    $student_id_no, 
    $hashed_password,  // Use the hashed password for the new password
    $role_as, 
    $status, 
    $user_added, 
    $profile_image, 
    $qr_code, 
    $verify_token, 
    $token_used, 
    $contact_person, 
    $person_cell_no, 
    $logs, 
    $user_id  // The user_id to identify which record to update
);

// Execute the query
if ($stmt->execute()) {
    echo "Record updated successfully.";
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
