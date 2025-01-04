<?php
// Database connection details
$host = 'localhost';  // or your database host
$user = 'u510162695_bsit_quiz';
$pass = '1Bsit_quiz';
$db = 'u510162695_bsit_quiz';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the backup file name
$backupFile = 'backup_' . $db . '_' . date('Y-m-d_H-i-s') . '.sql';

// Start the output buffer to save the file
ob_start();

// Export the database structure and data
exportDatabase($conn, $db);

// Get the output buffer content
$sqlContent = ob_get_clean();

// Set headers to download the file
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
header('Content-Length: ' . strlen($sqlContent));

// Output the file content for download
echo $sqlContent;

$conn->close();

// Function to export the database structure and data
function exportDatabase($conn, $db) {
    // Get all the tables in the database
    $tables = [];
    $result = $conn->query('SHOW TABLES');
    
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }

    // Loop through the tables
    foreach ($tables as $table) {
        // Add table structure
        exportTableStructure($conn, $table);
        // Add table data
        exportTableData($conn, $table);
    }
}

// Function to export the table structure (CREATE TABLE statement)
function exportTableStructure($conn, $table) {
    echo "DROP TABLE IF EXISTS `$table`;\n";
    
    // Get the CREATE TABLE statement for the table
    $result = $conn->query("SHOW CREATE TABLE `$table`");
    $row = $result->fetch_row();
    echo $row[1] . ";\n\n";
}

// Function to export the table data (INSERT INTO statements)
function exportTableData($conn, $table) {
    // Get the data from the table
    $result = $conn->query("SELECT * FROM `$table`");
    $numFields = $result->field_count;

    // Generate INSERT INTO statements
    while ($row = $result->fetch_row()) {
        echo "INSERT INTO `$table` VALUES(";
        $values = [];

        // Escape each value to prevent SQL injection
        foreach ($row as $value) {
            if (isset($value)) {
                $values[] = "'" . $conn->real_escape_string($value) . "'";
            } else {
                $values[] = "NULL";
            }
        }

        echo implode(", ", $values) . ");\n";
    }

    echo "\n";
}
?>
