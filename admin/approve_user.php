<?php
$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    }

    $stmt = $conn->prepare("UPDATE instructors SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $userId);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
