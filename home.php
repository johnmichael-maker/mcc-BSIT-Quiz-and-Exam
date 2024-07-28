<?php
require __DIR__ . '/./partials/header.php';

if (isset($_SESSION['EXAM_ID'])) {
    header('location: exam.php');
}

?>

<body id="__index">

    <div class="container __index">

        <div class="position-absolute top-0 start-0 p-2">
            <h5 class="text-light">Name: <?= $_SESSION['LNAME'].', '.$_SESSION['FNAME'].' '.$_SESSION['MNAME'] ?></h5>
           <p class="mb-1 text-light">Year & Section: <?= $databaseController->yearLevel()[$_SESSION['LEVEL']] ?> <?= $databaseController->sections($_SESSION['SECTION']) ?></p>
        </div>

        <div class="question-container" id="question-container">
            <img src="assets/img/logo.png" alt="">
            <div class="card position-relative pb-5">
                <div class="question-number bg-danger text-light">
                    <h5>Quiz #: <span id="question-number"></span></h5>
                </div>
                <div class="card-body py-5">
                    <div class="question text-center" id="question">

                    </div>

                    <div class="row g-3 pt-5 px-4" id="choices">
                    </div>
                </div>

                <div class="d-none position-absolute bottom-0 start-0 d-flex align-items-center p-3 w-100" id="time-div">
                    <div class="text-center w-100 d-flex justify-content-center">
                        <span class="me-3">Time : </span>
                        <h3 id="timer"></h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="alert-modal d-none" id="alert-modal">
        <div class="card position-relative bg-transparent pt-4 border-0 success-card d-none">
            <div class="position-absolute top-0 text-center w-100 success-icon">
                <img src="assets/img/check-circle-svgrepo-com.png" alt="Icon-png">
            </div>
            <div class="card-body bg-light text-center pt-4 text-success">
                <h1>Correct</h1>
                <p>Your answer is correct you will be proceeding to the next round.</p>
            </div>
        </div>

        <div class="card position-relative bg-transparent pt-4 border-0 error-card d-none">
            <div class="position-absolute top-0 text-center w-100 success-icon mb-5">
                <img src="assets/img/wrong-delete-remove-trash-minus-cancel-close-svgrepo-com (1).png" alt="Icon-png">
            </div>
            <div class="card-body bg-light text-center pt-4 text-success">
                <h1>Incorrect</h1>
                <p>Your answer is incorrect. Sorry but you are eliminated from the competition.</p>
            </div>
        </div>

        <div class="card position-relative bg-transparent pt-4 border-0 disable-card d-none">
            <div class="position-absolute top-0 text-center w-100 success-icon mb-5">
                <img src="assets/img/wrong-delete-remove-trash-minus-cancel-close-svgrepo-com (1).png" alt="Icon-png">
            </div>
            <div class="card-body bg-light text-center pt-4 text-danger">
                <h3 class="mt-4">Account Disabled</h3>
                <p>Sorry but you are eliminated from the competition.</p>
            </div>
        </div>
    </div>

    <?php $contestantController->checkAccount() ?>

    <?php require __DIR__ . '/./partials/footer.php' ?>
