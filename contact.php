<?php
// Database connection details
$servername = "localhost";  // Change to your server's name if not localhost
$username = "u510162695_bsit_quiz";         // Your MySQL username
$password = "1Bsit_quiz";             // Your MySQL password
$dbname = "u510162695_bsit_quiz";  // Replace with your database name

// Define the output file path for the backup
$backupFile = "backup_" . date("Y-m-d_H-i-s") . ".sql";  // Filename with timestamp

// Create the command for mysqldump
$command = "mysqldump --host=$servername --user=$username --password=$password $dbname > $backupFile";

// Execute the command
exec($command, $output, $return_var);

// Check if the backup was successful
if ($return_var === 0) {
    echo "Database backup successfully created: $backupFile";
} else {
    echo "Error creating backup: " . implode("\n", $output);
}
?>
