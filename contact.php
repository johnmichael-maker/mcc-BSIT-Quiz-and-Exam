<?php
// Database connection class
class Database {
    private string $host = "localhost";
    private string $user = "u510162695_bsit_quiz"; // Your database username
    private string $pass = "1Bsit_quiz"; // Your database password
    private string $db = "u510162695_bsit_quiz"; // Your database name

    // Create a connection method
    public function connect() {
        // Create connection using PDO
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Fetch all table names from the database
    public function showTables() {
        $conn = $this->connect();

        // SQL query to get all table names
        $sql = "SHOW TABLES";

        // Execute the query and fetch the result
        try {
            $stmt = $conn->query($sql);
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($tables) {
                echo "<h3>Tables in '$this->db' database:</h3>";
                echo "<ul>";
                // Loop through the results and display each table
                foreach ($tables as $table) {
                    // Fetch the table name dynamically from the result
                    $tableName = reset($table); // Reset fetches the first value (table name)
                    echo "<li>" . $tableName . "</li>";
                }
                echo "</ul>";
            } else {
                echo "No tables found in the database.";
            }
        } catch (PDOException $e) {
            echo "Error fetching tables: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();

// Call the showTables method to display all tables
$db->showTables();
?>
