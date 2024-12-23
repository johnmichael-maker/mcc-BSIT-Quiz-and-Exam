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

    // Create the examinees table
    public function createExamineesTable() {
        $conn = $this->connect();

        // SQL query to drop the table if it exists and create the new table
        $sql = "
        DROP TABLE IF EXISTS `examinees`;
        /*!40101 SET @saved_cs_client     = @@character_set_client */;
        /*!40101 SET character_set_client = utf8 */;
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
        /*!40101 SET character_set_client = @saved_cs_client */;
        ";

        // Execute the query
        try {
            $conn->exec($sql);
            echo "Table 'examinees' created successfully!";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->createExamineesTable();
?>
