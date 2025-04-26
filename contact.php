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
    $sql = "CREATE TABLE IF NOT EXISTS `identification_answers` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `exam_id` int(11) NOT NULL,
        `identification_id` int(11) NOT NULL,
        `answer` text NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`exam_id`) REFERENCES `exams`(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`identification_id`) REFERENCES `identification`(`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    // Execute the query
    $pdo->exec($sql);

    echo "Table `identification_answers` created successfully!";

} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
