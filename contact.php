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

class DatabaseHelper {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Show all tables in the current database
    public function showAllTables() {
        // Query to show all tables in the database
        $query = "SHOW TABLES";
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            echo "<h3>Tables in Database:</h3>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                // Get the table name from the first column
                echo "<li>" . $row["Tables_in_" . $this->db->query("SELECT DATABASE()")->fetch_row()[0]] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No tables found in the database.";
        }
    }
}

// Instantiate the Database connection
$db = new Database();

// Instantiate the DatabaseHelper class with the database connection
$dbHelper = new DatabaseHelper($db->getConnection());

// Show all tables
$dbHelper->showAllTables();

// Close the connection
$db->closeConnection();
?>
