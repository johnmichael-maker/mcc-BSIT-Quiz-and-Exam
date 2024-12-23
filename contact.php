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

    // Create the answer_identifications table
    public function createAnswerIdentificationsTable() {
        $conn = $this->connect();

        // SQL query to create the answer_identifications table
        $sql = "
        CREATE TABLE `answer_identifications` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `exam_id` int(11) NOT NULL,
          `identification_id` int(11) NOT NULL,
          `id_number` int(11) NOT NULL,
          `answer` text NOT NULL,
          `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        ";

        // Execute the query to create the table
        try {
            $conn->exec($sql);
            echo "Table 'answer_identifications' created successfully!";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->createAnswerIdentificationsTable();
?>
