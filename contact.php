<?php
$host = 'localhost';
$dbname = 'u510162695_bsit_quiz';
$username = 'u510162695_bsit_quiz';
$password = '1Bsit_quiz';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE TABLE login_attempts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(45) NOT NULL,
        attempts INT DEFAULT 0,
        last_attempt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        blocked_until DATETIME DEFAULT NULL,
        device_info VARCHAR(255) DEFAULT NULL
    )";

    $conn->exec($sql);
    echo "Table login_attempts created successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
