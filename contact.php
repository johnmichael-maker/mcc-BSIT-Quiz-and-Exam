<?php
// Database connection details
$host = 'localhost';  // You can leave this as 'localhost' if your MySQL server is on the same server
$username = 'u510162695_bsit_quiz';  // Your database username
$password = '1Bsit_quiz';  // Your database password
$dbname = 'u510162695_bsit_quiz';  // Your database name

// Set the filename for the SQL export
$filename = $dbname . '_backup_' . date('Y-m-d_H-i-s') . '.sql';

// Create a new connection to MySQL
$connection = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Function to get the list of tables in the database
function getTables($connection, $dbname) {
    $result = $connection->query("SHOW TABLES FROM $dbname");
    $tables = [];
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
    return $tables;
}

// Function to get the structure and data of each table
function getTableSQL($connection, $table) {
    // Get table structure
    $createTable = $connection->query("SHOW CREATE TABLE $table")->fetch_row()[1];
    
    // Get table data
    $insertData = "";
    $result = $connection->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $values = array_map(function($value) {
            return "'" . addslashes($value) . "'";
        }, $row);
        $insertData .= "INSERT INTO $table (" . implode(", ", array_keys($row)) . ") VALUES (" . implode(", ", $values) . ");\n";
    }

    return $createTable . ";\n\n" . $insertData . "\n";
}

// Get all tables from the database
$tables = getTables($connection, $dbname);

// Start building the SQL dump file
$sqlDump = "";

// Loop through each table and add its structure and data to the dump
foreach ($tables as $table) {
    $sqlDump .= getTableSQL($connection, $table);
}

// Set the headers for file download
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');

// Output the SQL dump file content
echo $sqlDump;

// Close the database connection
$connection->close();
?>
