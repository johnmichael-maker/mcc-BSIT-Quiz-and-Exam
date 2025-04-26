<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the exams table
    $sql = "CREATE TABLE IF NOT EXISTS `exams` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `section` int(11) NOT NULL,
        `year_level` int(11) NOT NULL,
        `semester` int(11) NOT NULL,
        `type` int(11) NOT NULL,
        `admin_id` int(11) NOT NULL,
        `category` int(11) NOT NULL,
        `time_limit` float NOT NULL,
        `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=disabled',
        `start_time` timestamp NULL DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `fk_admin_id` (`admin_id`),
        CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'exams' created successfully!<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
