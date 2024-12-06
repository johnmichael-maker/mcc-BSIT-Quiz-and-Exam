<?php

// Start output buffering
ob_start();

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');
// Security Headers
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // Enforce HTTPS
header("X-Content-Type-Options: nosniff"); // Prevent MIME-type sniffing
header("X-Frame-Options: DENY"); // Prevent clickjacking by denying frames entirely
header("X-XSS-Protection: 1; mode=block"); // Enable Cross-Site Scripting filter
header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline'; img-src 'self' data:;"); // Define CSP for secure content loading
header("Referrer-Policy: no-referrer"); // Do not send referrer info
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); // Disable caching
header('Pragma: no-cache'); // Disable caching for older HTTP/1.0 proxies
header('Expires: 0'); // Prevent caching of the page
header("Permissions-Policy: geolocation=(self), microphone=()"); // Control feature permissions
header("X-Permitted-Cross-Domain-Policies: none"); // Restrict cross-domain policies
header('Content-Type: text/html; charset=utf-8'); // Set content type to UTF-8
// Enable HTTPS for secure connections
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https://";
} else {
    $protocol = "http://";
}


session_start();

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
