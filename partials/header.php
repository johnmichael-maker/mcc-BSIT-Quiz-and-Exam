<?php 
    require __DIR__ . '/../vendor/autoload.php';
    use App\Contestants;
    $contestantController = new Contestants($_POST);
    $contestantController->startSession();
    $contestantController->checkSession();

    $contestantController->checkAccountStatus();
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
</head>
