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

    // SQL query to drop the table and create the new 'contestants' table
    $sql = "
    DROP TABLE IF EXISTS `contestants`;
    CREATE TABLE `contestants` (
        `contestant_id` int(11) NOT NULL AUTO_INCREMENT,
        `id_number` varchar(255) NOT NULL,
        `fname` text DEFAULT NULL,
        `lname` text DEFAULT NULL,
        `mname` text DEFAULT NULL,
        `year` int(11) DEFAULT NULL,
        `section` int(11) NOT NULL,
        `status` int(11) NOT NULL DEFAULT 1,
        `created_at` timestamp NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`contestant_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "The 'contestants' table has been created successfully.";

} catch (PDOException $e) {
    // If the connection fails or there's an error executing the query, display an error message
    echo "Error: " . $e->getMessage();
    exit;
}
?>
