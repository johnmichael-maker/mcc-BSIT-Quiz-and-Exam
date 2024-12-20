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

// SQL query to create only the 'exams' table
$sql = "
-- Drop the 'exams' table if it exists
DROP TABLE IF EXISTS `exams`;

-- Create the 'exams' table
CREATE TABLE `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `time_limit` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_admin_id` (`admin_id`),
  CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";

// Execute the query to create the exams table
if ($conn->multi_query($sql)) {
    echo "Table 'exams' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
