<?php
// Database credentials
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

// Create a connection to the database
$conn = new mysqli("localhost", $user, $pass, $db);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL script to drop and create the login_history table
$sql = "
-- Drop and create login_history table
DROP TABLE IF EXISTS `login_history`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` enum('success','failure') NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `attempt_time` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
";

// Execute the SQL query
if ($conn->multi_query($sql)) {
    echo "Table 'login_history' created successfully (or replaced if it already existed).";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
