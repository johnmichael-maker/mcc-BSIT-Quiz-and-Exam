<?php
// Database connection details
$host = 'localhost';
$dbname = 'u510162695_bsit_quiz';
$username = 'u510162695_bsit_quiz';
$password = '1Bsit_quiz';

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ID of the admin you want to update
    $admin_id = 11; // Replace with the actual admin_id
    $new_password = 'password'; // Replace with the new password

    // Hash the new password using Argon2
    $hashed_password = password_hash($new_password, PASSWORD_ARGON2ID);

    // Update query
    $sql = "UPDATE admin SET password = :password WHERE admin_id = :admin_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

    // Execute the query
    if ($stmt->execute()) {
        echo "Password updated successfully for admin_id $admin_id.";
    } else {
        echo "Failed to update password.";
    }
} catch (PDOException $e) {
    // Handle connection error
    echo "Error: " . $e->getMessage();
}
?>
