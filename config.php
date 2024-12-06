<?php
ob_start();
date_default_timezone_set('Asia/Manila');

// Apply HTTP Security Headers
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer");
header("Permissions-Policy: geolocation=(self), microphone=(), camera=()");
header("X-Permitted-Cross-Domain-Policies: none");
header("Cross-Origin-Opener-Policy: same-origin");
header("Cross-Origin-Embedder-Policy: require-corp");
header('Content-Type: text/html; charset=utf-8');

// Session Security
session_start();
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
session_regenerate_id(true);

// Database Connection
$host = 'localhost';
$username = 'u510162695_bsit_quiz';
$password = '1Bsit_quiz';
$dbname = 'u510162695_bsit_quiz';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Helper Functions
function getCurrentPage() {
    $url = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    return $url;
}

define('BASE_URL', 'https://mccbsitquizandexam.com/');
define('TEMPLATES_PATH', __DIR__ . '/templates/');
define('UPLOADS_PATH', __DIR__ . '/uploads/');

function redirectTo($url) {
    header("Location: $url");
    exit();
}
?>
