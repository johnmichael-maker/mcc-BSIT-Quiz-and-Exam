<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS `admin` (
        `admin_id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) DEFAULT NULL,
        `img` text DEFAULT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) DEFAULT NULL,
        `verification` varchar(255) DEFAULT NULL,
        `userType` int(1) NOT NULL DEFAULT 1,
        `created_at` timestamp NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        `firstName` varchar(100) NOT NULL,
        `middleName` varchar(100) NOT NULL,
        `lastName` varchar(100) NOT NULL,
        `phone` int(11) NOT NULL,
        `address` varchar(100) NOT NULL,
        `expires_at` datetime DEFAULT NULL,
        PRIMARY KEY (`admin_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'admin' created successfully!";
} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>

