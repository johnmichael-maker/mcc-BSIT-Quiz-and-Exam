<?php
// Database connection parameters
$host = 'localhost'; // Database host
$db   = 'u510162695_mcclrc'; // Database name
$user = 'u510162695_mcclrc'; // Database username
$pass = '1Mcclrc_pass'; // Database password

try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionally, you can set the character set to utf8mb4 for better compatibility
    $pdo->exec("SET NAMES 'utf8mb4'");

    // Fetch all table names in the database
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    // Iterate through each table
    foreach ($tables as $table) {
        echo "<h2>Table: $table</h2>";

        // Fetch all columns for the current table
        $columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);

        // Display column names and types
        echo "<table border='1'><tr><th>Column Name</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        foreach ($columns as $column) {
            echo "<tr>
                    <td>" . htmlspecialchars($column['Field']) . "</td>
                    <td>" . htmlspecialchars($column['Type']) . "</td>
                    <td>" . htmlspecialchars($column['Null']) . "</td>
                    <td>" . htmlspecialchars($column['Key']) . "</td>
                    <td>" . htmlspecialchars($column['Default']) . "</td>
                    <td>" . htmlspecialchars($column['Extra']) . "</td>
                  </tr>";
        }
        echo "</table>";

        // Fetch all data for the current table
        $data = $pdo->query("SELECT * FROM $table")->fetchAll(PDO::FETCH_ASSOC);

        // Display the data in a table format
        echo "<h3>Data:</h3>";
        if (count($data) > 0) {
            echo "<table border='1'><tr>";
            // Display table headers (column names)
            foreach ($columns as $column) {
                echo "<th>" . htmlspecialchars($column['Field']) . "</th>";
            }
            echo "</tr>";

            // Display table rows (data)
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . htmlspecialchars($row[$column['Field']]) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data available for this table.</p>";
        }
    }

} catch (PDOException $e) {
    // If the connection fails or there's an error executing the query, display an error message
    echo "Error: " . $e->getMessage();
    exit;
}
?>
