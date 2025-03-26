<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the examinees table
    $sql = "CREATE TABLE IF NOT EXISTS `examinees` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `id_number` varchar(255) NOT NULL,
        `section` int(11) NOT NULL,
        `year_level` int(11) NOT NULL,
        `fname` text NOT NULL,
        `lname` text NOT NULL,
        `mname` text DEFAULT NULL,
        `exam_id` int(11) DEFAULT NULL,
        `score` int(11) DEFAULT NULL,
        `status` int(11) NOT NULL DEFAULT 1,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `exam_index` (`exam_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'examinees' created successfully!<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
