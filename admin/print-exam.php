<?php
require __DIR__ . '/./partials/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $adminController->getExamById();
}
?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0" style="max-height: 100vh; overflow-y: auto;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class=" w-100 p-3">

                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12 text-center">
                                <img src="../assets/img/logo.png" alt="" style="width: 150px;" class="position-absolute start-0 top-0 mt-3">
                                <h3>Madridejos Community College</h3>
                                <p class="mb-0">Examination of BSIT - <?= $row['year_level'] . ' ' .  $databaseController->sections($row['section']) . ' - ' . $databaseController->examType()[$row['type']] ?></p>
                                <p>Date: 10/10/2023</p>
                            </div>

                            <div class="col-12 table-responsive">

                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <th>Name</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $examinees = $adminController->getExamineesByExam($id);
                                        if ($examinees->rowCount() > 0) {
                                            foreach($examinees as $examinee): ?>
                                                <tr>
                                                    <td><?= $examinee['fullname'] ?></td>
                                                    <td><?= $examinee['score'] ?? 0 ?></td>
                                                    <td><?= date('m-d-Y', strtotime($examinee['created_at'])) ?></td>
                                                </tr>  
                                        <?php 
                                                endforeach;
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="3" class="text-center">No record found</td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>

                                       
                                    </tbody>
                                </table>

                            </div>
                          

                        </div>

                    </div>

                    <div class="card-footer text-end dont-print">
                        <a href="print-quiz.php" class="btn btn-danger" onclick="print()"><i class="bx bx-printer"></i> Print</a>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>


<?php require __DIR__ . '/./partials/footer.php' ?>