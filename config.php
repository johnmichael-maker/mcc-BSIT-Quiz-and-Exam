<?php

// Start output buffering to prevent issues with premature output (especially headers)
ob_start();

// Set the default timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

// Apply HTTP Security Headers
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload"); // HSTS (HTTP Strict Transport Security)
header("X-Frame-Options: SAMEORIGIN"); // Prevent clickjacking
header("X-Content-Type-Options: nosniff"); // Prevent MIME sniffing
header("Referrer-Policy: no-referrer"); // Prevent referrer leakage
header("Permissions-Policy: geolocation=(self), microphone=(), camera=()"); // Restrict API permissions (like geolocation, microphone, etc.)
header("X-Permitted-Cross-Domain-Policies: none"); // Prevent Flash and similar plugins from being used across domains
header('Content-Type: text/html; charset=utf-8'); // Set content type to UTF-8

// Database credentials (Replace with your actual values)
$host = 'localhost';        // Database server
$username = 'u510162695_bsit_quiz';  // Database username
$password = '1Bsit_quiz';      // Database password
$dbname = 'u510162695_bsit_quiz'; // Database name

// Start a session and set session security settings
session_start();
ini_set('session.cookie_secure', 1); // Use secure cookies (only over HTTPS)
ini_set('session.cookie_httponly', 1); // Make session cookies inaccessible to JavaScript
ini_set('session.use_strict_mode', 1); // Use strict mode for session management (disallow uninitialized session IDs)

// Database connection using PDO (PHP Data Objects)
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting for PDO
} catch (PDOException $e) {
    // Handle database connection errors
    die("Connection failed: " . $e->getMessage());
}

// Function to get the current page URL without the .php extension (for cleaner URLs)
function getCurrentPage() {
    // Get the current URL, removing trailing slashes or query strings
    $url = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    return $url;
}

// Example: Define a base URL for easy reference throughout the app
define('BASE_URL', 'https://yourdomain.com/');

// Optionally: Define constants for commonly used paths
define('TEMPLATES_PATH', __DIR__ . '/templates/');
define('UPLOADS_PATH', __DIR__ . '/uploads/');

// Additional helpers, like a function to handle redirects (useful for login or 404 redirects)
function redirectTo($url) {
    header("Location: $url");
    exit();
}

// End of config.php
?>
