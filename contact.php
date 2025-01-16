<?php
$host = 'localhost';
$dbname = 'u510162695_mcc_ems';
$username = 'u510162695_mcc_ems';
$password = '1Mcc_ems';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
