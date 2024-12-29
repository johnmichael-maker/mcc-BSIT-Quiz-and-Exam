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

    // SQL query to drop the admin table if it exists
    $sql = "DROP TABLE IF EXISTS `admin`";
    
    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);
    
    // Execute the query to drop the table
    $stmt->execute();

    echo "Admin table dropped successfully.";
} catch (PDOException $e) {
    // If the connection fails or there's an error executing the query, display an error message
    echo "Error: " . $e->getMessage();
    exit;
}
?>
