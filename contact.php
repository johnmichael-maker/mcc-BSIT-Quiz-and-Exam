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

    // Create the identification_answers table
    public function createIdentificationAnswersTable() {
        $conn = $this->connect();

        // SQL query to create the identification_answers table
        $sql = "
        CREATE TABLE `identification_answers` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `exam_id` int(11) NOT NULL,
          `identification_id` int(11) NOT NULL,
          `answer` text NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ";

        // Execute the query to create the table
        try {
            $conn->exec($sql);
            echo "Table 'identification_answers' created successfully!";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->createIdentificationAnswersTable();
?>
