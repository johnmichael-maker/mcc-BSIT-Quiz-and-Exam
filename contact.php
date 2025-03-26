<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    // Create connection
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL to create table
    $sql = "CREATE TABLE IF NOT EXISTS `activity_logs` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `admin_id` int(11) NOT NULL,
        `action` varchar(255) NOT NULL,
        `action_details` text NOT NULL,
        `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `admin_id` (`admin_id`),
        CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    // Execute query
    $pdo->exec($sql);
    echo "Table 'activity_logs' created successfully.";

} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
