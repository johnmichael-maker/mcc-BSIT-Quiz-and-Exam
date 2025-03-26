<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    // Establish database connection
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Enable error reporting
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
        PDO::ATTR_EMULATE_PREPARES => false // Prevent SQL injection
    ]);

    // SQL query to create the table
    $sql = "CREATE TABLE IF NOT EXISTS `login_attempts` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
        `attempts` int(11) DEFAULT 0,
        `last_attempt` datetime DEFAULT NULL,
        `blocked_until` datetime DEFAULT NULL,
        `device_info` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    // Execute the query
    $pdo->exec($sql);

    echo "Table `login_attempts` created successfully!";

} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
