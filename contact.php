<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// Data to be inserted into the user table
$user_id = null; // Assuming user_id is auto-incremented
$lastname = 'i';
$firstname = 'love';
$middlename = 'you';
$gender = 'Female';
$course = 'bsit';
$address = 'Maalat, Madridejos, Cebu';
$cell_no = '09070384342';
$birthdate = '1998-08-15';
$email = 'ilove.you@mcclawis.edu.ph';
$year_level = '3rd Year';
$student_id_no = '2020-1111';

// Password: We will hash the password "iloveyoutoo" using Argon2
$password = 'iloveyoutoo'; // The password you want to store
$hashed_password = password_hash($password, PASSWORD_ARGON2I); // Hash the password using Argon2

// Set confirm password to be the same as the hashed password
$cpassword = $hashed_password;

// Other data
$role_as = 'Student';
$status = 'Active';
$user_added = '2024-12-16 02:07:37';
$qr_code = ''; // Example empty string for QR code
$verify_token = ''; // Example empty string for verification token
$token_used = 0; // Default value
$profile_image = 'default_image.jpg'; // Example profile image
$contact_person = 'John Doe'; // Example emergency contact
$person_cell_no = '09123456789'; // Example emergency contact number
$logs = ''; // Example empty string for logs

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to insert data into the user table
$sql = "INSERT INTO `user` 
        (`lastname`, `firstname`, `middlename`, `gender`, `course`, `address`, `cell_no`, `birthdate`, `email`, `year_level`, `student_id_no`, `password`, `cpassword`, `role_as`, `status`, `user_added`, `qr_code`, `verify_token`, `token_used`, `profile_image`, `contact_person`, `person_cell_no`, `logs`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("ssssssssssssssssssiiss", 
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
    $hashed_password,  // Use the hashed password
    $cpassword,        // Use the same hashed password for confirm_password
    $role_as, 
    $status, 
    $user_added, 
    $qr_code, 
    $verify_token, 
    $token_used, 
    $profile_image, 
    $contact_person, 
    $person_cell_no, 
    $logs
);

// Execute the query
if ($stmt->execute()) {
    echo "Data inserted successfully into the 'user' table.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
