<?php
class Database {
    // Database connection settings
    private $servername = "localhost";
    private $user = "u510162695_mcclrc";
    private $pass = "1Mcclrc_pass";
    private $db = "u510162695_mcclrc";

    // Property to store the connection
    private $conn;

    // Constructor to create the connection
    public function __construct() {
        $this->connect();
    }

    // Method to establish database connection
    private function connect() {
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->db);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to fetch and display all data and columns from the table
    public function displayData($tableName) {
        // SQL query to select all data from the specified table
        $sql = "SELECT * FROM $tableName";
        $result = $this->conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output column names as table headers
            echo "<table border='1'><tr>";
            
            // Fetch and display column names
            $fields = $result->fetch_fields();
            foreach ($fields as $field) {
                echo "<th>" . $field->name . "</th>";
            }
            echo "</tr>";

            // Fetch and display each row of data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No records found.";
        }
    }

    // Method to close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}

// Example usage
$db = new Database();
$tableName = "your_table";  // Replace 'your_table' with your actual table name
$db->displayData($tableName);
$db->closeConnection();
?>
