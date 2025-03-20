<?php
$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS `examinees` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `id_number` VARCHAR(255) NOT NULL,
        `section` INT(11) NOT NULL,
        `year_level` INT(11) NOT NULL,
        `fname` TEXT NOT NULL,
        `lname` TEXT NOT NULL,
        `mname` TEXT DEFAULT NULL,
        `exam_id` INT(11) DEFAULT NULL,
        `score` INT(11) DEFAULT NULL,
        `status` INT(11) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $conn->exec($sql);
    echo "Table `examinees` created successfully!";
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

$conn = null;
?>
