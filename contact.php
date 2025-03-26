<?php
try {
    // Database connection details
    $host = "localhost";
    $user = "u510162695_bsit_quiz";
    $pass = "1Bsit_quiz";
    $db = "u510162695_bsit_quiz";

    // Create PDO connection
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $conn = new PDO($dsn, $user, $pass, $options);

    // SQL to create the table
    $sql = "CREATE TABLE IF NOT EXISTS `admin` (
        `admin_id` INT(11) NOT NULL AUTO_INCREMENT,
        `username` VARCHAR(50) DEFAULT NULL,
        `img` TEXT DEFAULT NULL,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) DEFAULT NULL,
        `verification` VARCHAR(255) DEFAULT NULL,
        `userType` INT(1) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`admin_id`)
    )";

    // Execute the query
    $conn->exec($sql);
    echo "✅ Table `admin` created successfully!";
} catch (PDOException $e) {
    die("❌ Error creating table: " . $e->getMessage());
}
?>
