<?php
require __DIR__ . '/./partials/header.php';

if (isset($_GET['id'])) {
    $row = $adminController->getExamById();
}

$message = null;
if (isset($_POST['section'])) {
    $adminController->editExam();
}

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
                        <a href="exam.php" class="btn btn-secondary"><i class="bx bx-arrow-back"></i></a>
                        <h5 class="mb-0 ms-2">Edit Exam</h5>

                    </div>

                    <div class="card-body">

                        <?php
                        if ($message !== null) :
                        ?>
                            <div class="alert alert-success py-2">
                                <?= $message ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST">
                            <p class="my-0 d-none alert py-2 mb-2" id="alert"></p>

                            <input type="hidden" id="id" name="id" value="<?= $row['id'] ?>">

                            <label for="">Section</label>
                            <select name="section" class="form-select my-3" required>
                                <?php
                                foreach ($databaseController->getSections() as $key => $value) {
                                    if ($key == $row['section']) {
                                ?>
                                        <option selected value="<?= $key ?>"><?= $value ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="">Year Level</label>
                            <select name="year_level" class="form-select my-3" required>
                                <?php
                                foreach ($databaseController->yearLevel() as $key => $value) {
                                    if ($key == $row['year_level']) {
                                ?>
                                        <option selected value="<?= $key ?>"><?= $value ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="">Semester</label>
                            <div class="row my-2">
                                <div class="col-lg-4 col-6">
                                    <input type="radio" name="semester" id="semester" class="form-check-input" value="1" <?= $row['semester'] == 1 ? 'checked' : '' ?>>
                                    1st Semester
                                </div>
                                <div class="col-lg-4 col-6">
                                    <input type="radio" name="semester" id="semester" class="form-check-input" value="2" <?= $row['semester'] == 2 ? 'checked' : '' ?>>
                                    2nd Semester
                                </div>
                                <div class="col-lg-4 col-6">
                                    <input type="radio" name="semester" id="semester" class="form-check-input" value="3" <?= $row['semester'] == 3 ? 'checked' : '' ?>>
                                    Summer
                                </div>
                            </div>

                            <!-- <label for="">Question</label>
                    <textarea name="question" class="form-control my-3" cols="30" rows="5" style="resize: none;" placeholder="Write question..." required></textarea>
                    <label for="">Choices</label> -->

                            <label for="">Type</label>
                            <div class="row my-2">
                                <div class="col-lg-4 col-6">
                                    <input type="radio" name="type" class="form-check-input" value="1" checked>
                                    Preliminary
                                </div>
                                <div class="col-lg-4 col-6">
                                    <input type="radio" name="type" class="form-check-input" value="2">
                                    Midterm
                                </div>
                                <div class="col-lg-4 col-6">
                                    <input type="radio" name="type" class="form-check-input" value="3">
                                    Final
                                </div>
                            </div>

                            <label for="">Question Category</label>
                            <select name="category" class="form-select my-3" required>
                                <?php
                                foreach ($databaseController->questionDifficulty() as $key => $value) {
                                    if ($key == $row['category']) {
                                ?>
                                        <option selected value="<?= $key ?>"><?= $value ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="">Time Limit</label>
                            <input type="number" name="time_limit" class="form-control my-2" value="<?= $row['time_limit'] ?>" min="0" required>

                            <button type="submit" class="btn btn-danger float-end px-lg-5 mt-3">Submit</button>


                        </form>

                    </div>
                </div>

            </div>


        </div>

    </div>
</div>

<?php require __DIR__ . '/./partials/footer.php' ?>
