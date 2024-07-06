<?php 
    require __DIR__ . '/../../vendor/autoload.php';
    require __DIR__ . '../../../function/Process.php';
    use App\Admin;
    use App\DatabaseControl;
    $databaseController = new DatabaseControl;
    $adminController = new Admin($_POST);
    // $adminController->startSession();
    if ($adminController->checkAdmin()) {
        header('location: login.php');
    }
    if ($adminController->isAdminDashboard()) {
        if (!$adminController->isActive()) {
            header('location: login.php');
        }
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        header('location: login.php');
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
</head>
<body class="__admin">