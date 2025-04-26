<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the answers table
    $sql = "CREATE TABLE IF NOT EXISTS `answers` (
        `answer_id` int(11) NOT NULL AUTO_INCREMENT,
        `contestant_id` varchar(50) DEFAULT NULL,
        `question_id` int(11) DEFAULT NULL,
        `answer` text DEFAULT NULL,
        `time` varchar(20) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `check_answer` text DEFAULT NULL,
        `check_code` int(11) DEFAULT NULL,
        PRIMARY KEY (`answer_id`),
        KEY `question_id` (`question_id`),
        KEY `contestant_id` (`contestant_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'answers' created successfully!<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
