<?php
$host = "localhost";
$user = "u510162695_bsit_quiz";
$pass = "1Bsit_quiz";
$db = "u510162695_bsit_quiz";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the activity_logs table
    $sql = "CREATE TABLE IF NOT EXISTS `activity_logs` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `admin_id` int(11) NOT NULL,
        `action` varchar(255) NOT NULL,
        `action_details` text NOT NULL,
        `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        KEY `admin_id` (`admin_id`),
        CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $pdo->exec($sql);
    echo "Table 'activity_logs' created successfully!<br>";

    // Insert sample data
    $sqlInsert = "INSERT INTO `activity_logs` (`id`, `admin_id`, `action`, `action_details`, `timestamp`) VALUES
        (14, 11, 'Deleted Exam', 'Exam ID: 20, Section: 1, Year Level: 1, Semester: 1, Type: 1, Category: 1', '2025-01-03 08:04:00'),
        (15, 11, 'Added Exam', 'Section: 1, Year Level: 1, Semester: 1, Type: 1, Category: 1', '2025-01-03 08:04:35')
        ON DUPLICATE KEY UPDATE `action` = VALUES(`action`), `action_details` = VALUES(`action_details`), `timestamp` = VALUES(`timestamp`);";

    $pdo->exec($sqlInsert);
    echo "Sample data inserted successfully!";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
