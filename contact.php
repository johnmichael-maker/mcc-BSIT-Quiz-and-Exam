<?php
try {
    // Database Connection
    $host = "localhost";
    $user = "u510162695_bsit_quiz";
    $pass = "1Bsit_quiz";
    $db = "u510162695_bsit_quiz";

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Get all table names
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Disable foreign key checks
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0");

    // Drop all tables
    foreach ($tables as $table) {
        $conn->exec("DROP TABLE IF EXISTS `$table`");
        echo "✅ Deleted table: $table <br>";
    }

    // Enable foreign key checks
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

    echo "<br>🚀 All tables have been deleted successfully.";

} catch (PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}
?>
