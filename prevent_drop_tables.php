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

    // Prevent dropping critical tables
    public function checkCriticalTablesExist() {
        // List of tables that cannot be dropped
        $criticalTables = [
            'activity_logs', 'admin', 'answer_identifications', 'answers', 'answers_enumeration', 
            'answers_essay', 'answers_identification', 'answers_multiple_choice', 'contestants', 
            'enumeration', 'enumeration_correct', 'essay', 'examinees', 'exams', 'feedbacks', 
            'identification', 'identification_answers', 'identification_choices', 'identifications', 
            'login_attempts', 'login_history', 'ms_365_instructor', 'ms_365_users', 
            'multiple_choice', 'points'
        ];

        $conn = $this->connect();

        // SQL query to get all table names
        $sql = "SHOW TABLES";

        try {
            $stmt = $conn->query($sql);
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tablesFound = [];

            // Loop through the tables in the database and store their names
            foreach ($tables as $table) {
                $tablesFound[] = reset($table);
            }

            // Check if any of the critical tables are missing
            foreach ($criticalTables as $criticalTable) {
                if (!in_array($criticalTable, $tablesFound)) {
                    echo "<p style='color: red;'>Warning: The required table '$criticalTable' is missing from the database. Dropping tables is not allowed.</p>";
                    return false; // Prevent dropping tables if any critical table is missing
                }
            }

            return true; // All critical tables exist, safe to proceed
        } catch (PDOException $e) {
            echo "Error checking tables: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }

    // Function to prevent dropping tables
    public function preventDropping() {
        if ($this->checkCriticalTablesExist()) {
            echo "<p style='color: green;'>All critical tables are present. Dropping tables is now disabled.</p>";
        } else {
            echo "<p style='color: red;'>Dropping tables is prevented due to missing critical tables.</p>";
        }
    }
}

// Create an instance of the Database class
$db = new Database();

// Prevent dropping tables if critical tables are missing
$db->preventDropping();

// Show all tables in the database (optional)
$db->showTables();
?>
