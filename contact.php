<?php
// Database connection details
class Database {
    private $servername = "localhost";
    private $user = "u510162695_bsit_quiz";
    private $pass = "1Bsit_quiz";
    private $db = "u510162695_bsit_quiz";
    private $conn;

    public function __construct() {
        // Create a connection to the database
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->db);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class TableCreator {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Method to create the 'questions' table
    public function createQuestionsTable() {
        // SQL query to create the 'questions' table
        $sql = "CREATE TABLE `questions` (
            `question_id` int(11) NOT NULL AUTO_INCREMENT,
            `question` text DEFAULT NULL,
            `A` text DEFAULT NULL,
            `B` text DEFAULT NULL,
            `C` text DEFAULT NULL,
            `D` text DEFAULT NULL,
            `answer` int(11) DEFAULT NULL,
            `category` int(11) NOT NULL,
            `status` int(11) NOT NULL DEFAULT 1,
            `activation` int(11) DEFAULT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (`question_id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        // Execute the query to create the table
        if ($this->db->query($sql) === TRUE) {
            echo "Table 'questions' created successfully.";
        } else {
            echo "Error creating table: " . $this->db->error;
        }
    }
}

// Instantiate the Database connection
$db = new Database();

// Instantiate the TableCreator class with the database connection
$tableCreator = new TableCreator($db->getConnection());

// Create the 'questions' table
$tableCreator->createQuestionsTable();

// Close the connection
$db->closeConnection();
?>
