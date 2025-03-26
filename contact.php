<?php
try {
    // Database connection
    $conn = new PDO("mysql:host=localhost;dbname=u510162695_bsit_quiz", "u510162695_bsit_quiz", "1Bsit_quiz");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all tables
    $stmt = $conn->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Loop through each table
    foreach ($tables as $table) {
        echo "<h2>Table: $table</h2>";

        // Get columns of the table
        $columnStmt = $conn->query("DESCRIBE $table");
        $columns = $columnStmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Display column names
        echo "<strong>Columns:</strong><ul>";
        foreach ($columns as $column) {
            echo "<li>" . $column['Field'] . "</li>";
        }
        echo "</ul>";

        // Fetch and display data from the table
        $dataStmt = $conn->query("SELECT * FROM $table");
        $data = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($data) > 0) {
            echo "<table border='1'><tr>";
            // Display table headers (column names)
            foreach ($columns as $column) {
                echo "<th>" . $column['Field'] . "</th>";
            }
            echo "</tr>";

            // Display table rows (data)
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No data in this table.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

