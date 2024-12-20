
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `mname` text DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
