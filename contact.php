<?php
$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS `admin` (
        `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(50) DEFAULT NULL,
        `img` TEXT DEFAULT NULL,
        `email` VARCHAR(255) NOT NULL,
        `password` VARCHAR(255) DEFAULT NULL,
        `verification` VARCHAR(255) DEFAULT NULL,
        `userType` INT(1) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`admin_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $conn->exec($sql);
    echo "Table `admin` created successfully!";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

$conn = null;
?>
