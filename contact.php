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

// Step 2: Data to be updated (change values as needed)
$user_id_to_edit = 375; // The user_id of the record to edit
$new_name = 'john Michaelle'; // New name
$new_lastname = 'Robles'; // New last name
$new_gender = 'Male'; // New gender
$new_course = 'BSIT'; // New course
$new_address = 'Malbago, Bantayan, Cebu'; // New address
$new_phone = '09345267354'; // New phone number
$new_dob = '2000-09-25'; // New date of birth
$new_email = 'johnmichaelle.robles@mcclawis.edu.ph'; // New email
$new_year = '4th year'; // New year level
$new_student_no = '2021-1732'; // New student number
$new_status = 'approved'; // New status
$new_image = '2021-0851.png'; // New image filename (if applicable)
$new_additional_image = 'received_1275058173275025.jpeg'; // New additional image filename
$new_guardian_name = 'Edna Robles'; // New guardian name
$new_guardian_phone = '09238746536'; // New guardian phone
$new_password = 'iloveyou'; // New password (plain text)

$hashed_password = password_hash($new_password, PASSWORD_ARGON2ID); // Securely hash the new password using Argon2ID

// Step 3: SQL query to update the record
$sql = "UPDATE users SET 
            name = ?, 
            lastname = ?, 
            gender = ?, 
            course = ?, 
            address = ?, 
            phone = ?, 
            dob = ?, 
            email = ?, 
            year = ?, 
            student_no = ?, 
            status = ?, 
            image = ?, 
            additional_image = ?, 
            guardian_name = ?, 
            guardian_phone = ?, 
            password = ?  // Updating the password
        WHERE user_id = ?"; // Replace 'users' with your actual table name

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters to the query
$stmt->bind_param(
    "sssssssssssssssi", // Data types for each parameter (string, string, etc.)
    $new_name, $new_lastname, $new_gender, $new_course, $new_address,
    $new_phone, $new_dob, $new_email, $new_year, $new_student_no,
    $new_status, $new_image, $new_additional_image, $new_guardian_name,
    $new_guardian_phone, $hashed_password, $user_id_to_edit // Bind the user_id for the condition
);

// Execute the query
if ($stmt->execute()) {
    echo "Record with user_id $user_id_to_edit has been updated successfully.";
} else {
    echo "Error updating record: " . $conn->error;
}

// Step 4: Close the database connection
$stmt->close();
$conn->close();
?>
