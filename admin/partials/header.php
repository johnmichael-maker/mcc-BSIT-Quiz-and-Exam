<?php
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '../../../function/Process.php';
use App\Admin;
use App\DatabaseControl;

$databaseController = new DatabaseControl;
$adminController = new Admin($_POST);

// Check if admin is logged in
if ($adminController->checkAdmin()) {
    // Redirect to login without .php
    header('location: login');  // Redirects to /login, which maps to admin/login.php
    exit();  // Always call exit after header redirection
}

// Access-control redirect if needed
if ($adminController->checkAccessControl()) {
    // Redirect to access-control without .php
    header('location: access-control');  // Redirects to /access-control, which maps to admin/access-control.php
    exit();  // Always call exit after header redirection
}

// Fetch data for the dashboard
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
    <!-- Your HTML content here -->
</body>
</html>
