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

// SQL to get all tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Tables in database '$db':<br>";
    while($row = $result->fetch_assoc()) {
        echo $row["Tables_in_$db"] . "<br>";
    }
} else {
    echo "No tables found in the database.";
}

$conn->close();
?>
