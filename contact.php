<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Query to get all tables
    $stmt = $pdo->query("SHOW TABLES");

    // Fetch tables
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Display tables
    if ($tables) {
        echo "<h2>Tables in Database `$db`:</h2><ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
    } else {
        echo "No tables found in the database.";
    }
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
