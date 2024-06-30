<?php

namespace App;

use PDO;
use PDOException;
use Exception;

class Database
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $db = "mcc_bsit_quiz_and_exam";
    private ?PDO $conn = null;

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

                $this->conn = new PDO($dsn, $this->user,$this->pass);
                
            } catch (PDOException  $e) {
                throw new Exception('Connection Error: ' . $e->getMessage());
            }
        }
        return $this->conn;
    }

    public function closeConnection(): void {
        $this->conn = null;
    }
}