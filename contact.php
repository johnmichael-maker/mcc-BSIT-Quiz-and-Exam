<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the admin table
    $sql = "CREATE TABLE IF NOT EXISTS `admin` (
        `admin_id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) DEFAULT NULL,
        `img` text DEFAULT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) DEFAULT NULL,
        `verification` varchar(255) DEFAULT NULL,
        `userType` int(1) NOT NULL DEFAULT 1,
        `created_at` timestamp NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        `firstName` varchar(100) NOT NULL,
        `middleName` varchar(100) NOT NULL,
        `lastName` varchar(100) NOT NULL,
        `phone` varchar(20) NOT NULL,
        `address` varchar(100) NOT NULL,
        `expires_at` datetime DEFAULT NULL,
        PRIMARY KEY (`admin_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'admin' created successfully!<br>";

    // Insert sample data (using prepared statements to avoid errors)
    $sqlInsert = "INSERT INTO `admin` (`admin_id`, `username`, `img`, `email`, `password`, `verification`, `userType`, `created_at`, `updated_at`, `firstName`, `middleName`, `lastName`, `phone`, `address`, `expires_at`) 
        VALUES 
        (1, 'johnmichael@gmail.com', '../assets/img/logo.png', 'johnmichaelrobles813@gmail.com', :password1, '809079', 1, '2024-03-15 15:25:36', '2025-01-23 06:31:20', 'john michaelle', 'piedad', 'robles', '2147483647', 'malbago', '2024-12-11 14:52:52'),
        (11, 'johnmichaelle.robles@mcclawis.edu.ph', '../assets/img/logo.png', 'admin@gmail.com', :password2, '880593', 2, '2024-12-23 11:01:09', '2025-01-23 05:29:39', 'john Michael', 'Piedad', 'Robles', '2147483647', 'malbago', NULL)
        ON DUPLICATE KEY UPDATE `username` = VALUES(`username`), `email` = VALUES(`email`), `password` = VALUES(`password`), `updated_at` = VALUES(`updated_at`);";

    $stmt = $pdo->prepare($sqlInsert);
    $stmt->execute([
        ':password1' => '$argon2i$v=19$m=65536,t=4,p=1$RWlHOXhSUk9Ia2JYTk1xZA$GARp6NJdGGPO04HxzfXnE/YNUuIQ38NPezMlJfVDPmw',
        ':password2' => '$argon2id$v=19$m=65536,t=4,p=1$dkpQbEptaDF5RXFJZWFJSw$osZI4kxhJT4NNEqwZAIO3PqE+BIzNskvqdrmH6m8/i8'
    ]);

    echo "Sample admin data inserted successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
