<?php

namespace App;

use PDO;
use PDOException;
use Exception;


// private string $user = "u510162695_bsit_quiz";
// private string $pass = "1Bsit_quiz";
// private string $db = "u510162695_bsit_quiz";

// private string $user = "root";
// private string $pass = "";
// private string $db = "mcc_bsit_quiz_and_exam";

class Database
{
    private string $host = "localhost";
    private string $user = "u510162695_bsit_quiz";
    private string $pass = "1Bsit_quiz";
    private string $db = "u510162695_bsit_quiz";
    private ?PDO $conn = null;

    // Returns a PDO connection
    public function getConnection(): PDO
    {
        if ($this->conn == null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";

                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $this->conn = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException  $e) {
                throw new Exception('Connection Error: ' . $e->getMessage());
            }
        }
        return $this->conn;
    }

    // Prevent dropping of tables
    public function preventDropTable(string $sql): void
    {
        // Check if the SQL query contains 'DROP TABLE' command
        if (stripos($sql, 'DROP TABLE') !== false) {
            throw new Exception('Dropping tables is not allowed!');
        }
    }

    // Execute SQL statement and check for DROP TABLE
    public function executeQuery(string $sql): bool
    {
        // First, prevent DROP TABLE command
        $this->preventDropTable($sql);

        // Execute the SQL query if it's safe
        try {
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception('Query execution failed: ' . $e->getMessage());
        }
    }

    // Close the database connection
    public function closeConnection(): void
    {
        $this->conn = null;
    }
}
