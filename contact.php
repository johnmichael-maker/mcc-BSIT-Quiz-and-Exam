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

    // Create the enumeration_correct table
    public function createEnumerationCorrectTable() {
        $conn = $this->connect();

        // SQL query to drop the table if it exists and create the new table
        $sql = "
        DROP TABLE IF EXISTS `enumeration_correct`;
        /*!40101 SET @saved_cs_client     = @@character_set_client */;
        /*!40101 SET character_set_client = utf8 */;
        CREATE TABLE `enumeration_correct` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `exam_id` int(11) NOT NULL,
          `enumeration_id` int(11) NOT NULL,
          `answer` text NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        /*!40101 SET character_set_client = @saved_cs_client */;
        ";

        // Execute the query to create the table
        try {
            $conn->exec($sql);
            echo "Table 'enumeration_correct' created successfully!";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->createEnumerationCorrectTable();
?>
