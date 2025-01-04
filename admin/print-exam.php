<?php
require __DIR__ . '/./partials/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $adminController->getExamById();
    
    $multiples = $databaseController->getMultipleChoice($id);
    $identifications = $databaseController->getIdentification($id);
    $enumerations = $databaseController->getEnumeration($id);
    foreach($multiples as $multiple){
        // echo $multiple['question'];
    }
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
                                <img src="../assets/img/logo.png" alt="" style="width: 150px;" class="position-absolute start-0 top-0 mt-3 d-lg-block d-none">
                                <h3>Madridejos Community College</h3>
                                <p class="mb-0">Examination of BSIT - <?= $row['year_level'] . ' ' .  $databaseController->sections($row['section']) . ' - ' . $databaseController->examType()[$row['type']] ?></p>
                                <p>Date: <?= date('Y-m-d')?></p>
                            </div>

                            <div class="col-12 table-responsive">

                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <th>ID_Number</th>
                                        <th>Name</th>
                                        <th>Section</th>
                                        <th>Year</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        $examinees = $adminController->getExamineesByExam($id);
                                        if ($examinees->rowCount() > 0) {
                                            foreach($examinees as $examinee): 
                                                $average = $databaseController->getMultipleChoice($examinee['exam_id'])->rowCount() + $databaseController->getIdentification($examinee['exam_id'])->rowCount() + $databaseController->getEnumeration($examinee['exam_id'])->rowCount();
                                                ?>
                                                
                                                <tr>
                                                    <td><?= $examinee['id_number'] ?></td>
                                                    <td><?= ucfirst($examinee['lname']) . ', ' . ucfirst($examinee['fname']) . ' ' . ucfirst($examinee['mname']) ?></td>
                                                    <td><?=$databaseController->sections($examinee['section'])?></td>
                                                    <td><?= $databaseController->yearLevel()[$examinee['year_level']] ?></td>
                                                    <td><?= $examinee['score'] ?? 0 ?> / <?= $average ?></td>
                                                    <td><?= date('m-d-Y', strtotime($examinee['created_at'])) ?></td>
                                                </tr>  
                                        <?php 
                                                endforeach;
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="12" class="text-center">No record found</td>
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
                        <button type="button" class="btn btn-danger" onclick="window.print()"><i class="bx bx-printer"></i> Print</button>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>
<style>

    .container-fluid {
        margin-top: 20px;
    }

    .card {
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f9fa;
        font-size: 20px;
        font-weight: bold;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color:rgb(79, 88, 97);
        color: white;
    }

    .table td {
        background-color: #f8f9fa;
    }

    .table tr:nth-child(even) td {
        background-color: #e9ecef;
    }

    .table tr:hover {
        background-color: #f1f1f1;
    }

    .dont-print {
        display: block;
    }

    .dont-print button {
        background-color: #dc3545;
        color: white;
        font-weight: bold;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }

    .dont-print button:hover {
        background-color: #c82333;
    }

    .header-logo {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 100px;
    }

    .header-title {
        font-size: 24px;
        font-weight: bold;
    }

    .header-date {
        font-size: 16px;
    }

    @media print {
        .dont-print {
            display: none;
        }

        body {
            font-size: 14px;
        }

        .table th, .table td {
            padding: 10px;
        }
    }
</style>

<?php require __DIR__ . '/./partials/footer.php' ?>
