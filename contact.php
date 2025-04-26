<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "CREATE TABLE IF NOT EXISTS questions (
        question_id INT(11) NOT NULL AUTO_INCREMENT,
        question TEXT DEFAULT NULL,
        A TEXT DEFAULT NULL,
        B TEXT DEFAULT NULL,
        C TEXT DEFAULT NULL,
        D TEXT DEFAULT NULL,
        answer INT(11) DEFAULT NULL,
        category INT(11) NOT NULL,
        status INT(11) NOT NULL DEFAULT 1,
        activation INT(11) DEFAULT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
        updated_at TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (question_id)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);

    echo "Table `questions` created successfully!";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
