<?php
// Database connection details
$host = 'localhost';
$dbname = 'u510162695_mcclrc';
$username = 'u510162695_mcclrc';
$password = '1Mcclrc_pass';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get column names from the admin table
    $sql = "SHOW COLUMNS FROM admin";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch the results
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the column names
    if ($columns) {
        echo "Columns in 'admin' table:<br>";
        foreach ($columns as $column) {
            echo "- " . $column['Field'] . "<br>";
        }
    } else {
        echo "No columns found in the admin table.";
    }
} catch (PDOException $e) {
    // Handle connection error
    echo "Error: " . $e->getMessage();
}
?>
