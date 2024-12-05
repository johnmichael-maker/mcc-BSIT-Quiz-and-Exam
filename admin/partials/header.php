<?php
// Include necessary files
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '../../../function/Process.php';

use App\Admin;
use App\DatabaseControl;

// Instantiate the controllers
$databaseController = new DatabaseControl;
$adminController = new Admin($_POST);

// Generate a nonce for CSP (Content-Security-Policy)
$nonce = bin2hex(random_bytes(16)); // Generates a random nonce

// Send security-related HTTP headers before any output
header("Content-Security-Policy: default-src 'none'; script-src 'self' 'nonce-{$nonce}'; style-src 'self' 'nonce-{$nonce}'; img-src 'self'; connect-src 'self'; font-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'none'; report-uri /csp-violation-report-endpoint;");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: no-referrer-when-downgrade");
header("Permissions-Policy: accelerometer=(), camera=(), geolocation=(), microphone=(), payment=()");

// Check if the admin is authenticated and has an active session
if ($adminController->checkAdmin()) {
    header('Location: access-session');
    exit;
}

// If the admin dashboard is being accessed, ensure the admin is active
if ($adminController->isAdminDashboard()) {
    if (!$adminController->isActive()) {
        header('Location: login.php');
        exit;
    }
}

// Fetch examinees and contestants from the admin controller
$examinees = $adminController->getExaminees();
$contestants = $adminController->getContestants();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC Competition: QUIZ BOWL</title>
    
    <!-- External stylesheets -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/dataTable.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    
    <!-- SweetAlert for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- Chart.js for any charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* Prevent printing certain elements */
        @media print {
            .dont-print {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body class="__admin">
    <!-- Your content goes here -->
</body>
</html>
