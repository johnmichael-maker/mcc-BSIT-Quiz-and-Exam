<?php
// db_connection.php
$host = 'localhost'; // Database host
$db   = 'u510162695_bsit_quiz'; // Database name
$user = 'u510162695_bsit_quiz'; // Database username
$pass = '1Bsit_quiz'; // Database password

try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionally, you can set the character set to utf8mb4 for better compatibility
    $pdo->exec("SET NAMES 'utf8mb4'");

    // SQL query to select all data from the admin table
    $sql = "SELECT * FROM `admin`";
    
    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch all results as an associative array
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($admins) > 0) {
        echo "<table border='1'>
                <thead>
                    <tr>";
        // Display column headers
        foreach ($admins[0] as $column => $value) {
            echo "<th>" . htmlspecialchars($column) . "</th>";
        }
        echo "</tr>
                </thead>
                <tbody>";
        
        // Display each row of the result
        foreach ($admins as $admin) {
            echo "<tr>";
            foreach ($admin as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        
        echo "</tbody></table>";
    } else {
        echo "No data found in the admin table.";
    }
    
} catch (PDOException $e) {
    // If the connection fails or there's an error executing the query, display an error message
    echo "Error: " . $e->getMessage();
    exit;
}
?>
