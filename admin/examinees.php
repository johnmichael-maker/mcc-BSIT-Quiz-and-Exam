<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">
                <div class="row g-3">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">
                                <h5><i class="bx bx-user"></i> Examinees</h5>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="table">
                                        <thead>
                                            <th>ID Number</th>
                                            <th>Name</th>
                                            <th>Section</th>
                                            <th>Year Level</th>
                                            <th>Score</th>
                                            <th>Date</th>
                                        </thead>

                                        <tbody>
                                            <?php while($row = $examinees->fetch()): ?>
                                                <tr>
                                                    <td><?= $row['id_number'] ?></td>
                                                    <td><?= $row['fullname'] ?></td>
                                                    <td><?= $databaseController->sections($row['section']) ?></td>
                                                    <td><?= $databaseController->yearLevel()[$row['year_level']] ?></td>
                                                    <td><?= $row['score'] ?? 0 ?> / <?= $databaseController->getMultipleChoice($row['exam_id'])->rowCount() + $databaseController->getIdentification($row['exam_id'])->rowCount() + $databaseController->getEnumeration($row['exam_id'])->rowCount() ?></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>

                                    </table>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>


        </div>

    </div>
</div>


<?php require __DIR__ . '/./partials/footer.php' ?>
<script>
    $(document).ready(function(){
        $("#table").DataTable()
    })
</script>