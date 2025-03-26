<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $stmt = $pdo->query("SHOW TABLES;");
    echo "Tables in database '$db':<br>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row["Tables_in_$db"] . "<br>";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
