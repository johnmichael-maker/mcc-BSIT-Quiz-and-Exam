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

    // Admin ID of the user whose password needs to be updated
    $admin_id = 58; // Change this to the correct ID

    // New password
    $newPassword = 'pakyo123'; // Change this to the new password

    // Hash the password using Argon2id
    $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

    // Update the password in the database
    $sql = "UPDATE admin SET password = :password WHERE admin_id = :admin_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['password' => $hashedPassword, 'admin_id' => $admin_id]);

    echo "Password updated successfully using Argon2!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
