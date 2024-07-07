<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
       
        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">
                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <p>Quizzes</p>
                                <h1><?= $adminController->getAllQuestionCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <p>Exams</p>
                                <h1><?= $adminController->examCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <p>Quiz Contestants</p>
                                <h1><?= $adminController->contestantsCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <p>Examinees</p>
                                <h1><?= $adminController->examineesCount() ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
<?php require __DIR__ . '/./partials/footer.php' ?>