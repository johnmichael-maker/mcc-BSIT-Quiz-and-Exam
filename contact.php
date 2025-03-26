<?php
try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=u510162695_bsit_quiz", "u510162695_bsit_quiz", "1Bsit_quiz");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM `questions` WHERE `question_id` IN (7, 8)");

    // Execute the query
    $stmt->execute();

    echo "Data deleted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
