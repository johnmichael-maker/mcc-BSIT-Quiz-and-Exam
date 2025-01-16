<?php
// Database connection details
$host = 'localhost'; // Change if using a remote server
$dbname = 'u510162695_mcc_ems';
$username = 'u510162695_mcc_ems';
$password = '1Mcc_ems';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to fetch all data from the admin table
    $sql = "SELECT * FROM admin";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch the results
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if the admin table has data
    if ($admins) {
        echo "<h2>Admin Table Data</h2>";

        // Start the HTML table
        echo "<table border='1' style='width:100%; text-align:left; border-collapse:collapse;'>";
        echo "<tr style='background-color:#f2f2f2;'>";

        // Output table headers
        foreach (array_keys($admins[0]) as $column) {
            echo "<th style='padding:8px;'>" . htmlspecialchars($column) . "</th>";
        }
        echo "</tr>";

        // Loop through each row and display the data
        foreach ($admins as $admin) {
            echo "<tr>";
            foreach ($admin as $value) {
                echo "<td style='padding:8px;'>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No data found in the admin table.";
    }
} catch (PDOException $e) {
    // Display error if connection fails
    echo "Error: " . $e->getMessage();
}
?>
