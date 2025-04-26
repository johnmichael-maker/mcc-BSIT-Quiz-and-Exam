<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "CREATE TABLE IF NOT EXISTS login_history (
        id INT(11) NOT NULL AUTO_INCREMENT,
        ip_address VARCHAR(45) NOT NULL,
        username VARCHAR(255) NOT NULL,
        status ENUM('success','failure') NOT NULL,
        reason VARCHAR(255) DEFAULT NULL,
        attempt_time DATETIME DEFAULT current_timestamp(),
        PRIMARY KEY (id)
    ) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table `login_history` created successfully!";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
