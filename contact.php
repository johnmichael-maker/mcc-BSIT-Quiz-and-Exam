
<?php
// Database connection details
$host = 'localhost';
$dbname = 'u510162695_mcclrc';
$username = 'u510162695_mcclrc';
$password = '1Mcclrc_pass';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all data from the admin table
    $query = "SELECT * FROM admin";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

