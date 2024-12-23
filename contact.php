<?php
// Database connection class
class Database {
    private string $host = "localhost";
    private string $user = "u510162695_bsit_quiz";
    private string $pass = "1Bsit_quiz";
    private string $db = "u510162695_bsit_quiz";

    // Create a connection method
    public function connect() {
        // Create connection using PDO (more secure and flexible)
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Create the admin table
    public function createAdminTable() {
        $conn = $this->connect();

        // SQL query to drop the table if it exists and create the new table
        $sql = "
        DROP TABLE IF EXISTS `admin`;
        /*!40101 SET @saved_cs_client     = @@character_set_client */;
        /*!40101 SET character_set_client = utf8 */;
        CREATE TABLE `admin` (
          `admin_id` int(11) NOT NULL AUTO_INCREMENT,
          `username` varchar(50) DEFAULT NULL,
          `img` text DEFAULT NULL,
          `email` varchar(255) NOT NULL,
          `password` varchar(255) DEFAULT NULL,
          `verification` varchar(255) DEFAULT NULL,
          `userType` int(1) NOT NULL DEFAULT 1,
          `created_at` timestamp NULL DEFAULT current_timestamp(),
          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `firstName` varchar(100) NOT NULL,
          `middleName` varchar(100) NOT NULL,
          `lastName` varchar(100) NOT NULL,
          `phone` int(11) NOT NULL,
          `address` varchar(100) NOT NULL,
          `expires_at` datetime DEFAULT NULL,
          PRIMARY KEY (`admin_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        /*!40101 SET character_set_client = @saved_cs_client */;
        ";

        // Execute the query to create the table
        try {
            $conn->exec($sql);
            echo "Table 'admin' created successfully!";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // Inserting data into the admin table
        $insertSql = "
        INSERT INTO `admin` (`admin_id`, `username`, `img`, `email`, `password`, `verification`, `userType`, `created_at`, `updated_at`, `firstName`, `middleName`, `lastName`, `phone`, `address`, `expires_at`) 
        VALUES 
        (1, 'johnmichael@gmail.com', '../assets/img/logo.png', 'johnmichaelrobles813@gmail.com', '$argon2id\$v=19\$m=65536,t=4,p=1\$NVFJcUVTV1lNbFgwZ2FUYg\$svqAC0IMHw/0d1BqOakLHSZYsTm5rcNwzM2sJA++ArM', '869965', 1, '2024-03-15 15:25:36', '2024-12-12 07:36:02', 'john michaelle', 'piedad', 'robles', 2147483647, 'malbago', '2024-12-11 14:52:52'),
        (10, 'johnmichaelle.robles@mcclawis.edu.ph', '../assets/img/logo.png', 'admin@gmail.com', '$2y$10$vWQ9Aq2LK/r3Au3cw4hhxuvQCHFrotYB2IOTJmlVyF4iqqOOU099q', '6b10f4b9bab1ae99f81c', 2, '2024-12-12 04:33:50', '2024-12-12 04:33:50', 'john Michaelle', 'Piedad', 'Robles', 2147483647, 'malbago', NULL);
        ";

        // Execute the query to insert data
        try {
            $conn->exec($insertSql);
            echo "Data inserted into 'admin' table successfully!";
        } catch (PDOException $e) {
            echo "Error inserting data: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->createAdminTable();
?>
