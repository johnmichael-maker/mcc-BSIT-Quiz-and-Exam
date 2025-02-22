<?php
$host = 'localhost';
$dbname = 'u510162695_bsit_quiz';
$username = 'u510162695_bsit_quiz';
$password = '1Bsit_quiz';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS login_history (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(45) NOT NULL,
        username VARCHAR(255) NOT NULL,
        status ENUM('success', 'failure') NOT NULL,
        reason VARCHAR(255) DEFAULT NULL,
        attempt_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);
    echo "Table login_history created successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
