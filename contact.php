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

    // SQL query to fetch all data from the admin table
    $sql = "SELECT * FROM admin";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch the results
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if data exists
    if ($admins) {
        // Start the HTML table
        echo "<table border='1'>";
        echo "<tr>";

        // Output table headers based on column names
        foreach (array_keys($admins[0]) as $column) {
            echo "<th>" . htmlspecialchars($column) . "</th>";
        }

        echo "</tr>";

        // Loop through the result and display each row
        foreach ($admins as $admin) {
            echo "<tr>";
            foreach ($admin as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
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
