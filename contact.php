<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS `answer_identifications` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `exam_id` INT(11) NOT NULL,
        `examinee_id` INT(11) NOT NULL,
        `question_id` INT(11) NOT NULL,
        `answer` TEXT NOT NULL,
        `is_correct` TINYINT(1) NOT NULL DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`exam_id`) REFERENCES `exams`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`examinee_id`) REFERENCES `examinees`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'answer_identifications' created successfully.";

} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
