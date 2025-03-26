<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "CREATE TABLE IF NOT EXISTS points (
        point_id INT(11) NOT NULL AUTO_INCREMENT,
        contestant_id TEXT DEFAULT NULL,
        time TEXT DEFAULT NULL,
        check_answer TEXT DEFAULT NULL,
        check_code INT(11) DEFAULT NULL,
        PRIMARY KEY (point_id)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);

    echo "Table `points` created successfully!";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
