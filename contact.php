<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the contestants table
    $sql = "CREATE TABLE IF NOT EXISTS `contestants` (
        `contestant_id` int(11) NOT NULL AUTO_INCREMENT,
        `id_number` varchar(255) NOT NULL,
        `fname` varchar(100) DEFAULT NULL,
        `lname` varchar(100) DEFAULT NULL,
        `mname` varchar(100) DEFAULT NULL,
        `year` int(11) DEFAULT NULL,
        `section` int(11) NOT NULL,
        `status` tinyint(1) NOT NULL DEFAULT 1,
        `created_at` timestamp NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`contestant_id`),
        UNIQUE KEY `unique_id_number` (`id_number`),
        KEY `section_index` (`section`),
        KEY `status_index` (`status`)
    ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'contestants' created successfully!<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
