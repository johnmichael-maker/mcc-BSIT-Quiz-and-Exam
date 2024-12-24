<?php
class Database {
    // Define the database credentials
    private $servername = "localhost";
    private $user = "u510162695_sillon";
    private $pass = "1Sillon_pass";
    private $db = "u510162695_sillon";
    private $conn;

    // Create a method to connect to the database
    public function connect() {
        // Create a new connection using the provided credentials
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->db);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Create a method to retrieve all tables from the database
    public function getTables() {
        // SQL query to get all table names
        $sql = "SHOW TABLES";
        $result = $this->conn->query($sql);

        // Check if there are any tables
        if ($result->num_rows > 0) {
            // Output the table names
            echo "<ul>";
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row['Tables_in_' . $this->db] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No tables found in the database.";
        }
    }

    // Close the database connection
    public function close() {
        $this->conn->close();
    }
}

// Create a new Database object
$database = new Database();

// Connect to the database
$database->connect();

// Display all tables
$database->getTables();

// Close the connection
$database->close();
?>
