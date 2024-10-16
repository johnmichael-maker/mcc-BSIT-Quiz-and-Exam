<?php 
    require __DIR__ . '/../vendor/autoload.php';
    use App\Contestants;
    use App\DatabaseControl;
    use App\Examinee;



   // Security Headers
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self';");
header("Referrer-Policy: no-referrer-when-downgrade");

session_start();








// Prevent clickjacking attacks by disallowing your site from being embedded in iframes
    header('X-Frame-Options: SAMEORIGIN');

    // Protect against XSS attacks by setting the Content Security Policy
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'; object-src 'none'; frame-ancestors 'none';");
    
    // Enforce secure browsing by only allowing HTTPS connections
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    
    // Disable MIME-type sniffing to prevent certain types of attacks
    header('X-Content-Type-Options: nosniff');
    
    // Set XSS Protection in browsers
    header('X-XSS-Protection: 1; mode=block');
    
    // Referrer Policy to control how much information is sent along with referrer URLs
    header('Referrer-Policy: no-referrer');
    
    // Disable caching for sensitive information (optional)
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Start the session securely
    session_start();
    
    // Ensure the session uses secure cookies and is only accessible via HTTP
    ini_set('session.cookie_secure', 1);
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    
    // Set Content-Type and charset for HTML pages
    header('Content-Type: text/html; charset=utf-8');





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

