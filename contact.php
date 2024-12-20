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

// SQL query to add the new columns
$sql = "
    ALTER TABLE `user`
    ADD COLUMN `user_id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    ADD COLUMN `lastname` VARCHAR(255) NOT NULL,
    ADD COLUMN `firstname` VARCHAR(255) NOT NULL,
    ADD COLUMN `middlename` VARCHAR(255) NULL,
    ADD COLUMN `gender` VARCHAR(10) NULL,
    ADD COLUMN `course` VARCHAR(255) NULL,
    ADD COLUMN `address` TEXT NULL,
    ADD COLUMN `cell_no` VARCHAR(20) NULL,
    ADD COLUMN `birthdate` DATE NULL,
    ADD COLUMN `email` VARCHAR(255) UNIQUE NOT NULL,
    ADD COLUMN `year_level` VARCHAR(10) NULL,
    ADD COLUMN `student_id_no` VARCHAR(50) NULL,
    ADD COLUMN `password` TEXT NOT NULL,
    ADD COLUMN `cpassword` TEXT NOT NULL,
    ADD COLUMN `role_as` VARCHAR(50) DEFAULT 'Student',
    ADD COLUMN `status` VARCHAR(50) DEFAULT 'Active',
    ADD COLUMN `user_added` DATETIME DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN `qr_code` TEXT NULL,
    ADD COLUMN `verify_token` VARCHAR(255) NULL,
    ADD COLUMN `token_used` TINYINT(1) DEFAULT 0,
    ADD COLUMN `profile_image` VARCHAR(255) NULL,
    ADD COLUMN `contact_person` VARCHAR(255) NULL,
    ADD COLUMN `person_cell_no` VARCHAR(20) NULL,
    ADD COLUMN `logs` TEXT NULL;
";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Columns added successfully to the 'user' table.";
} else {
    echo "Error adding columns: " . $conn->error;
}

// Close the connection
$conn->close();
?>
