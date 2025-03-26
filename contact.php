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

    // SQL to create the login_attempts table
    $sql = "CREATE TABLE IF NOT EXISTS `login_attempts` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `user_id` INT(11) NOT NULL,
        `ip_address` VARCHAR(45) NOT NULL,
        `attempt_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `status` ENUM('success', 'failed') NOT NULL,
        PRIMARY KEY (`id`),
        INDEX (`user_id`),
        INDEX (`ip_address`)
    )";

    // Execute the query
    $conn->exec($sql);
    echo "✅ Table `login_attempts` created successfully!";
} catch (PDOException $e) {
    die("❌ Error creating table: " . $e->getMessage());
}
?>
