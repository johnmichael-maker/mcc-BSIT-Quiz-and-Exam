<?php

// Start output buffering
ob_start();

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Apply Security Headers
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // HSTS
header("X-Frame-Options: SAMEORIGIN"); // Prevent clickjacking
header("X-Content-Type-Options: nosniff"); // Prevent MIME sniffing
header("Referrer-Policy: no-referrer"); // Control referrer information
header("Permissions-Policy: geolocation=(self), microphone=(), camera=()"); // Control API permissions
header("X-Permitted-Cross-Domain-Policies: none"); // Restrict cross-domain policies
header('Content-Type: text/html; charset=utf-8'); // Set content type to UTF-8

// Database credentials
$host = 'localhost'; // Database server
$username = 'u510162695_bsit_quiz';  // Database username
$password = '1Bsit_quiz';      // Database password
$dbname = 'u510162695_bsit_quiz'; // Database name

// Start session and set session security
session_start();
ini_set('session.cookie_secure', 1); // Use secure cookies
ini_set('session.cookie_httponly', 1); // HTTP only cookies
ini_set('session.use_strict_mode', 1); // Use strict mode for session management

// Database connection using PDO
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


?>
