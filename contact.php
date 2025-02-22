<?php
$host = 'localhost';
$dbname = 'u510162695_bsit_qui';
$username = 'u510162695_bsit_quiz';
$password = '1Bsit_quiz';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $pdo->query("SHOW TABLES");
    
    echo "<h3>Tables in database '$dbname':</h3>";
    echo "<ul>";
    while ($row = $query->fetch(PDO::FETCH_NUM)) {
        echo "<li>{$row[0]}</li>";
    }
    echo "</ul>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
