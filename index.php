<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "CREATE TABLE `activity_logs` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `admin_id` int(11) NOT NULL,
      `action` varchar(255) NOT NULL,
      `action_details` text NOT NULL,
      `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `admin_id` (`admin_id`),
      CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table `activity_logs` created successfully!";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
