<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS `activity_logs` (
        `log_id` INT(11) NOT NULL AUTO_INCREMENT,
        `admin_id` INT(11) NOT NULL,
        `action` VARCHAR(255) NOT NULL,
        `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`log_id`),
        FOREIGN KEY (`admin_id`) REFERENCES `admin`(`admin_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'activity_logs' created successfully.";

} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
