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

// Check if the 'admin' table exists before trying to drop it
$sql_check = "SHOW TABLES LIKE 'admin'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows == 0) {
    die("Table 'admin' does not exist.");
}

// SQL to delete the 'admin' table
$table_to_delete = "admin";
$sql = "DROP TABLE `$table_to_delete`";

if ($conn->query($sql) === TRUE) {
    echo "Table '$table_to_delete' deleted successfully.";
} else {
    echo "Error deleting table: " . $conn->error;
}

$conn->close();
?>
