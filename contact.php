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

    // Query to get column names
    $columnsQuery = $pdo->prepare("SHOW COLUMNS FROM admin");
    $columnsQuery->execute();
    $columns = $columnsQuery->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all data from the admin table
    $dataQuery = $pdo->prepare("SELECT * FROM admin");
    $dataQuery->execute();
    $adminData = $dataQuery->fetchAll(PDO::FETCH_ASSOC);

    // Display data in a table
    if ($adminData) {
        echo "<table border='1' cellpadding='10'>";
        
        // Table Header (Column Names)
        echo "<tr>";
        foreach ($columns as $column) {
            echo "<th>{$column['Field']}</th>";
        }
        echo "</tr>";

        // Table Data (Rows)
        foreach ($adminData as $row) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No data found in the admin table.";
    }
} catch (PDOException $e) {
    // Handle connection error
    echo "Error: " . $e->getMessage();
}
?>
