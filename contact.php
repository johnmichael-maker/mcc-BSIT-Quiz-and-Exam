<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to delete table
$sql = "DROP TABLE quiz_questions";

if ($conn->query($sql) === TRUE) {
    echo "Table 'quiz_questions' deleted successfully.";
} else {
    echo "Error deleting table: " . $conn->error;
}

$conn->close();
?>
