<?php

class DatabaseExporter {
    private $user = "u510162695_bsit_quiz";
    private $pass = "1Bsit_quiz";
    private $db = "u510162695_bsit_quiz";
    private $host = "localhost"; // Use 'localhost' or the relevant host IP address

    public function exportDatabase() {
        // Define the backup file path on your local machine
        // Ensure the directory exists and is writable
        $backupFile = 'C:\\path\\to\\your\\backup\\directory\\' . $this->db . '_' . date('Y-m-d_H-i-s') . '.sql';

        // Construct the mysqldump command
        $command = "mysqldump --user={$this->user} --password={$this->pass} --host={$this->host} {$this->db} > {$backupFile}";

        // Execute the command
        $output = null;
        $resultCode = null;

        exec($command, $output, $resultCode);

        // Check if the export was successful
        if ($resultCode === 0) {
            echo "Database exported successfully to {$backupFile}";
        } else {
            echo "Error occurred during the database export.";
        }
    }
}

// Instantiate the class and call the export method
$exporter = new DatabaseExporter();
$exporter->exportDatabase();

?>
