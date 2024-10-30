<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">
                <div class="card h-100">
                    <div class="card-header dont-print">
                        <a href="quiz.php" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Back</a>
                    </div>
                    <div class="card-body table-responsive">

                    <div class="mb-4 d-flex justify-content-between align-items-center">
    <img src="../assets/img/bsit-logo.png" alt="Left Logo" style="max-width: 150px; height: auto; margin-right: -20px;">
    <div class="text-center flex-grow-1">
        <h3 class="mb-0">MCC Quiz Bowl <?= date('Y') ?></h3> 
        <h5 class="mb-1">Quiz Result</h5> 
        <p class="mb-0">Date: <?= date('Y-m-d') ?></p>
    </div>
    <img src="../assets/img/logo.png" alt="Right Logo" style="max-width: 150px; height: auto;">
</div>


                        <table class="table table-bordered">
                            <thead>
                                <th>Rank #</th>
                                <th>Name</th>
                                <th>Section</th>
                                <th>Year</th>
                                <th>Average</th>
                                <th>Time</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 1;
                                    foreach($adminController->getAllContestants() as $contestant):
                                ?>

                                    <tr>
                                        <td><?= $i++ ?></td>
                                       <td><?= ucfirst($contestant->fname .' '. $contestant->mname . ' ' . $contestant->lname) ?></td>
                                        <td><?= $databaseController->sections($contestant->section) ?></td>
                                        <td><?= $databaseController->yearLevel()[$contestant->year] ?></td>
                                        <td><?= $contestant->check_code == null ? 0 : $contestant->check_code ?> <?= ' / ' . $adminController->getAllQuestionCount() ?> </td>
                                        <td><?= $contestant->time ?? 0 ?>ms</td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="card-footer text-end dont-print">
                        <button type="button" class="btn btn-danger" onclick="print()"><i class="bx bx-printer"></i> Print</button>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
<!-- <script src="../assets/js/script.js"></script> -->
<?php require __DIR__ . '/./partials/footer.php' ?>
