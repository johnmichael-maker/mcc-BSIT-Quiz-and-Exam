<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=u510162695_bsit_quiz", "u510162695_bsit_quiz", "1Bsit_quiz");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SHOW TABLES");
    echo "<h2>Tables in Database:</h2><ul>";
    
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "<li>" . $row[0] . "</li>";
    }
    
    echo "</ul>";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
