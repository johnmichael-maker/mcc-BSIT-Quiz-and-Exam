<?php
// db_connection.php
$host = 'localhost'; // Database host
$db   = 'u510162695_bsit_quiz'; // Database name
$user = 'u510162695_bsit_quiz'; // Database username
$pass = '1Bsit_quiz'; // Database password

try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionally, you can set the character set to utf8mb4 for better compatibility
    $pdo->exec("SET NAMES 'utf8mb4'");

    // SQL query to drop the table and create the new 'login_attempts' table
    $sql = "
    DROP TABLE IF EXISTS `login_attempts`;
    CREATE TABLE `login_attempts` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
        `attempts` int(11) DEFAULT 0,
        `last_attempt` datetime DEFAULT NULL,
        `blocked_until` datetime DEFAULT NULL,
        `device_info` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "The 'login_attempts' table has been created successfully.";

} catch (PDOException $e) {
    // If the connection fails or there's an error executing the query, display an error message
    echo "Error: " . $e->getMessage();
    exit;
}
?>
