<?php 

header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'; object-src 'none';");
header("Referrer-Policy: no-referrer");
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');

    require __DIR__ . '/../vendor/autoload.php';
    use App\Contestants;
    use App\DatabaseControl;
    use App\Examinee;

session_start();
ini_set('session.cookie_secure', 1); // Use secure cookies
ini_set('session.cookie_httponly', 1); // HTTP only cookies
ini_set('session.use_strict_mode', 1); // Use strict mode for session management


    $contestantController = new Contestants($_POST);
    $examineeController = new Examinee($_POST);
    $contestantController->startSession();
    $contestantController->checkSession();
    $databaseController = new DatabaseControl;
    $contestantController->checkAccountStatus();
    
    if ($examineeController->isStudentDashboard()) {
        if (!isset($_SESSION['EXAM_ID'])) {
            header('location: signup.php');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC Competition : QUIZ BOWL</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<body>
