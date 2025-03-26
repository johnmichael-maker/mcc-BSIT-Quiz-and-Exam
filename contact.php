<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all table names
    $stmt = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = '$db'");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if ($tables) {
        // Disable foreign key checks
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

        // Drop each table
        foreach ($tables as $table) {
            $pdo->exec("DROP TABLE IF EXISTS `$table`");
            echo "Dropped table: $table <br>";
        }

        // Re-enable foreign key checks
        $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

        echo "<br>✅ All tables in database '$db' have been deleted successfully.";
    } else {
        echo "⚠️ No tables found in the database.";
    }
} catch (PDOException $e) {
    die("❌ Error: " . $e->getMessage());
}
?>
