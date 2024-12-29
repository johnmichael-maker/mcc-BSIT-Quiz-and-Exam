<?php
// Database connection
$host = 'localhost'; 
$db = 'u510162695_mcclrc'; 
$user = 'u510162695_mcclrc'; 
$pass = '1Mcclrc_pass'; 

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// User ID and new password
$admin_id = 54; // The ID of the admin you want to update
$new_password = 'new_password'; // Replace this with the new password you want

// Hash the new password using Argon2i
$hashed_password = password_hash($new_password, PASSWORD_ARGON2I);

// Update the password in the database
$sql = "UPDATE admin SET password = :password WHERE admin_id = :admin_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':admin_id', $admin_id);

if ($stmt->execute()) {
    echo "Password updated successfully!";
} else {
    echo "Failed to update the password.";
}
?>
