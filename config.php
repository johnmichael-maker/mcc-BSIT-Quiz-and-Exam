<?php

// Start output buffering
ob_start();

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Enable HTTPS for secure connections
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}

// Set HTTP security headers
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // Enforce HTTPS
header("X-Frame-Options: SAMEORIGIN"); // Prevent clickjacking by only allowing frames from the same origin
header("X-Content-Type-Options: nosniff"); // Prevent MIME-type sniffing
header("Referrer-Policy: no-referrer-when-downgrade"); // Control the amount of information sent with referrers
header("Permissions-Policy: geolocation=(self), microphone=(), camera=()"); // Control feature permissions (adjust as needed)

// Database credentials
$host = 'localhost'; // Database server
$username = 'u510162695_bsit_quiz';  // Database username
$password = '1Bsit_quiz';      // Database password
$dbname = 'u510162695_bsit_quiz'; // Database name

try {
    // Create PDO connection
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    
    // Set PDO attributes
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Your database interaction code goes here

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>
