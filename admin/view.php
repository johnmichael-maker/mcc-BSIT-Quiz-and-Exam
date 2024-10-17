<?php 
    require __DIR__ . '/../vendor/autoload.php';
    use App\Admin;
    $adminController = new Admin($_POST);
    $adminController->startSession();
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
</head>
<body >
<div class="bg-danger container-fluid position-relative __view" id="__view">
    <div class="position-absolute top-0 end-0 text-light p-3 d-flex align-items-center">
        <h3>MCC - QUIZ BOWL 2024</h3>
        <img src="../assets/img/logo.png" alt="logo" class="logo">
    </div>

    <div class="h-100-vh d-flex align-items-center justify-content-center">
        <div class="card p-2">
            <div class="row w-100 g-3">
                <div class="col-lg-7 pe-3">
                    <div class="card border-0 border-end">
                        <div class="card-body">
                            <p class="text-muted">Current Question</p>
                            <p class="text-center py-5 fs-3" id="view-question"></p>
                            <div class="row g-3">
                                <div class="col-6">
                                    <button type="button" class="w-100 btn btn-light border border-2" id="view-A"></button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="w-100 btn btn-light border border-2" id="view-B"></button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="w-100 btn btn-light border border-2" id="view-C"></button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="w-100 btn btn-light border border-2" id="view-D"></button>
                                </div>
                            </div>

                            <p class="text-center mt-3">Time: <span id="timer"></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h5 class="mb-3">Candidates</h5>

                    <div class="row g-3" id="candidates">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/./partials/footer.php' ?>