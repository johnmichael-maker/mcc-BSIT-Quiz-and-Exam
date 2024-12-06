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

require __DIR__ . '/../vendor/autoload.php';
use App\Contestants;
use App\DatabaseControl;
use App\Examinee;

$contestantController = new Contestants($_POST);
$examineeController = new Examinee($_POST);
$contestantController->startSession();
$contestantController->checkSession();
$databaseController = new DatabaseControl;
$contestantController->checkAccountStatus();

if ($examineeController->isStudentDashboard()) {
    if (!isset($_SESSION['EXAM_ID'])) {
        header('location: student-signup.php');
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
<!-- your body content here -->
</body>
</html>
