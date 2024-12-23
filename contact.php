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

    // Create the exams table
    public function createExamsTable() {
        $conn = $this->connect();

        // SQL query to drop the table if it exists and create the new table with start_time column
        $sql = "
        DROP TABLE IF EXISTS `exams`;
        /*!40101 SET @saved_cs_client     = @@character_set_client */;
        /*!40101 SET character_set_client = utf8 */;
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
          `start_time` timestamp NULL DEFAULT NULL,  -- Added start_time column
          `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
          PRIMARY KEY (`id`),
          KEY `fk_admin_id` (`admin_id`),
          CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        /*!40101 SET character_set_client = @saved_cs_client */;
        ";

        // Execute the query to create the table
        try {
            $conn->exec($sql);
            echo "Table 'exams' created successfully with the new 'start_time' column!";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->createExamsTable();
?>
