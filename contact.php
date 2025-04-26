<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the answers_identification table
    $sql = "CREATE TABLE IF NOT EXISTS `answers_identification` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `exam_id` int(11) NOT NULL,
        `id_number` varchar(50) NOT NULL,
        `identification_id` int(11) NOT NULL,
        `choice_id` int(11) NOT NULL,
        `answer` int(11) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `exam_id` (`exam_id`),
        KEY `identification_id` (`identification_id`),
        KEY `choice_id` (`choice_id`),
        KEY `id_number` (`id_number`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'answers_identification' created successfully!<br>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
