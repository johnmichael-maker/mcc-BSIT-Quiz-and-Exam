<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $tables = [
        "activity_logs",
        "admin",
        "examinees",
        "instructors",
        "login_history",
        "ms_365_instructor",
        "ms_365_users",
        "multiple_choice",
        "points",
        "questions"
    ];

    foreach ($tables as $table) {
        $pdo->exec("DROP TABLE IF EXISTS `$table`");
    }

    echo "All specified tables dropped successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
