<?php
// Database connection details
$host     = 'localhost';
$dbname   = 'u510162695_mcclrc';
$username = 'u510162695_mcclrc';
$password = '1Mcclrc_pass';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define the new password for admin ID 58
    $newPassword = 'password123';

    // Hash the new password securely
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare the UPDATE SQL query
    $sql = "UPDATE admin SET password = :password WHERE admin_id = :admin_id";
    $stmt = $pdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindValue(':admin_id', 58, PDO::PARAM_INT);

    // Execute the update statement
    $stmt->execute();

    echo "Password updated for admin with ID 58.";
} catch (PDOException $e) {
    // Handle any errors during the update process
    echo "Error: " . $e->getMessage();
}
?>
