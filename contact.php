<?php

class Database {
    private $servername = "localhost";
    private $username = "u510162695_bsit_quiz";
    private $password = "1Bsit_quiz";
    private $dbname = "u510162695_bsit_quiz";
    private $conn;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->connect();
    }

    // Method to establish database connection
    private function connect() {
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Method to fetch all table names from the database
    public function getTables() {
        $sql = "SHOW TABLES";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $tables = [];
            while ($row = $result->fetch_assoc()) {
                $tables[] = $row;
            }
            return $tables;
        } else {
            return "No tables found.";
        }
    }

    // Method to fetch data from a specific table
    public function getTableData($tableName) {
        $sql = "SELECT * FROM `$tableName`";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "No data found in the table: $tableName";
        }
    }

    // Destructor to close the connection
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Create a Database object
$db = new Database();

// Get all tables in the database
$tables = $db->getTables();
if (is_array($tables)) {
    foreach ($tables as $table) {
        echo "Table: " . $table['Tables_in_' . $db->dbname] . "<br>";
        $tableData = $db->getTableData($table['Tables_in_' . $db->dbname]);
        echo "<pre>";
        print_r($tableData);
        echo "</pre><br>";
    }
} else {
    echo $tables; // If no tables were found or an error occurred
}
?>
