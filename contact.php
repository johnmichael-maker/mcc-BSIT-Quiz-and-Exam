<?php
// Database connection details
$host = 'localhost';  // or your database host
$user = 'u510162695_bsit_quiz';
$pass = '1Bsit_quiz';
$db = 'u510162695_bsit_quiz';

// Backup file name with timestamp
$backupFile = 'backup_' . $db . '_' . date('Y-m-d_H-i-s') . '.sql';

// Command for mysqldump
$command = "mysqldump --opt --host=$host --user=$user --password=$pass $db > $backupFile";

// Execute the command
exec($command, $output, $result);

// Check if the backup was successful
if ($result === 0) {
    echo "Backup completed successfully! The backup file is: $backupFile";
} else {
    echo "Error during backup: " . implode("\n", $output);
}
?>
