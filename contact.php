<?php
try {
    // Database connection
    $host = "localhost";
    $user = "u510162695_bsit_quiz";
    $pass = "1Bsit_quiz";
    $db = "u510162695_bsit_quiz";

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Query to fetch all table names
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<h2>Tables in Database: $db</h2>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}
?>
