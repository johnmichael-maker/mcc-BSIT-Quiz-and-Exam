<?php 
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

