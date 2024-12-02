<?php
require __DIR__ . '/./partials/header.php';

if (isset($_GET['delete'])) {
    $adminController->deleteExam();
}
$message = null;
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">

                <div class="card">

                    <div class="card-header d-flex align-items-center">
                        <h5 class="mb-0 me-2">Exams</h5>
                        <a href="add-exam" class="btn btn-danger" ><i class="bx bx-plus"></i></a>
                    </div>

                    <div class="card-body">

                    <?php 
                        if($message !== null):
                    ?>
                        <div class="alert alert-success py-2">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                        <div class="table-responsive">
                            <table id="dataTable">
                                <thead>
                                    <th>Section</th>
                                    <th>Year Level</th>
                                    <th>Semester</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Time Limit</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($databaseController->getExams() as $row) :
                                    ?>

                                        <tr>
                                            <td><?= $databaseController->sections($row['section']) ?></td>
                                            <td><?= $databaseController->yearLevel()[$row['year_level']] ?></td>
                                            <td><?= $databaseController->semester()[$row['semester']] ?></td>
                                            <td><?= $databaseController->examType()[$row['type']] ?></td>
                                            
                                            <td><?= $databaseController->questionDifficulty()[$row['category']] ?></td>
                                            <td><?= $row['time_limit'] ?>mins.</td>
                                            
                                            <td class="dropdown">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown">Options</button>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li >
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-<?= $row['id'] ?>" class="dropdown-item"> <i class="bx bx-trash text-danger"></i> Delete</a>
                                                    </li>
                                                    <li>
                                                    <a href="edit-exam?id=<?= $row['id'] ?>" class="dropdown-item"><i class="bx bx-edit"></i> Edit</a>
                                                    </li>
                                                    <li>
                                                    <a href="view-exam?id=<?= $row['id'] ?>" class="dropdown-item"><i class="bx bx-file"></i> View</a>
                                                    </li>
                                                    <li>
                                                    <a href="print-exam?id=<?= $row['id'] ?>" class="dropdown-item"><i class="bx bx-printer"></i> Print Result</a>
                                                    </li>
                                                </ul>

                                               
                                            </td>
                                        </tr>

                                        <div class="modal fade modal-sm" id="delete-<?= $row['id'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content ">
                                                    <div class="modal-body text-center">
                                                        <form action="exam.php?delete" method="post">
                                                            <h5>Are you sure you want to delete this exam?</h5>
                                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                            <div class="d-flex gap-2 mt-3">
                                                                <button type="submit" class="btn btn-danger w-100">Yes</button>
                                                                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary w-100">No</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>


        </div>

    </div>
</div>




<?php require __DIR__ . '/./partials/footer.php' ?>
