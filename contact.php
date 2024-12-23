<?php
class Database {
    private $servername = "localhost";
    private $user = "u510162695_bsit_quiz";
    private $pass = "1Bsit_quiz";
    private $db = "u510162695_bsit_quiz";
    private $conn;

    public function __construct() {
        // Create a connection
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

class AdminData {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function displayData() {
        // Get column names
        $columnsQuery = "DESCRIBE admin";
        $resultColumns = $this->db->query($columnsQuery);

        // Display column names
        if ($resultColumns->num_rows > 0) {
            echo "<h3>Column Names:</h3>";
            echo "<ul>";
            while ($row = $resultColumns->fetch_assoc()) {
                echo "<li>" . $row['Field'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No columns found.";
        }

        // Get and display the data
        $dataQuery = "SELECT * FROM admin";
        $resultData = $this->db->query($dataQuery);

        if ($resultData->num_rows > 0) {
            echo "<h3>Data:</h3>";
            echo "<table border='1'><tr>";

            // Fetch and display column names as table headers
            while ($column = $resultColumns->fetch_assoc()) {
                echo "<th>" . $column['Field'] . "</th>";
            }

            echo "</tr>";

            // Reset the column result pointer for the next loop
            $resultColumns->data_seek(0);

            // Fetch and display each row of data
            while ($row = $resultData->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No data found.";
        }
    }
}

// Instantiate the Database connection
$db = new Database();

// Instantiate the AdminData class with the database connection
$adminData = new AdminData($db->getConnection());

// Display the data
$adminData->displayData();

// Close the connection
$db->closeConnection();
?>
