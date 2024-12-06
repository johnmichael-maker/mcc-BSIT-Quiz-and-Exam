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

    require __DIR__ . '/../../vendor/autoload.php';
    require __DIR__ . '../../../function/Process.php';
    use App\Admin;
    use App\DatabaseControl;
    $databaseController = new DatabaseControl;
    $adminController = new Admin($_POST);
    // $adminController->startSession();
    if ($adminController->checkAdmin()) {
        header('location:  access-session');
    }
    if ($adminController->isAdminDashboard()) {
        if (!$adminController->isActive()) {
            header('location: login');
        }
    }
    $examinees = $adminController->getExaminees();
    $contestants = $adminController->getContestants();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC Competition : QUIZ BOWL</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../assets/css/dataTable.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <style>
        @media print{
            .dont-print{
                display: none !important;
            }

            .card{
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="__admin">
