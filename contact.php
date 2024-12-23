<?php
// Database connection class
class Database {
    private string $host = "localhost";
    private string $user = "u510162695_bsit_quiz"; // Your database username
    private string $pass = "1Bsit_quiz"; // Your database password
    private string $db = "u510162695_bsit_quiz"; // Your database name

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

    // Method to drop the 'points' table
    public function dropPointsTable() {
        $conn = $this->connect();

        // SQL query to drop the 'points' table
        $sql = "DROP TABLE IF EXISTS `points`";

        try {
            // Execute the query to drop the table
            $conn->exec($sql);
            echo "Table 'points' has been dropped successfully!";
        } catch (PDOException $e) {
            echo "Error dropping table: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class and drop the 'points' table
$db = new Database();
$db->dropPointsTable();
?>
