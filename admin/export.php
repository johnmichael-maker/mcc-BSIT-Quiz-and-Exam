<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users_data.csv"');

$conn = new mysqli("localhost", "u510162695_bsit_quiz", "1Bsit_quiz", "u510162695_bsit_quiz");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Firstname', 'Lastname', 'Email']); // Header

$sql = "SELECT id, first_name, last_name, Username FROM ms_365_users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
exit();
?>
