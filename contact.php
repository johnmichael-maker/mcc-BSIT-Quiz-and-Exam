<?php
$host = 'localhost';   // Your database host
$username = 'u510162695_bsit_quiz';    // Your database username
$password = '1Bsit_quiz';        // Your database password
$database = 'u510162695_bsit_quiz'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the table
$sql = "
DROP TABLE IF EXISTS `examinees`;

CREATE TABLE `examinees` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_number` VARCHAR(255) NOT NULL,
  `section` INT(11) NOT NULL,
  `year_level` INT(11) NOT NULL,
  `fname` TEXT NOT NULL,
  `lname` TEXT NOT NULL,
  `mname` TEXT DEFAULT NULL,
  `exam_id` INT(11) DEFAULT NULL,
  `score` INT(11) DEFAULT NULL,
  `status` INT(11) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

// Execute the query to create the table
if ($conn->query($sql) === TRUE) {
    echo "Table 'examinees' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
