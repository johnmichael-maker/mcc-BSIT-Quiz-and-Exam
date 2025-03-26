<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=u510162695_bsit_quiz", "u510162695_bsit_quiz", "1Bsit_quiz");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("DELETE FROM contestant WHERE id = :id");
    $stmt->bindParam(':id', $id);

    $id = 1; // Change this to the ID you want to delete
    $stmt->execute();

    echo "✅ Contestant deleted successfully!";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
