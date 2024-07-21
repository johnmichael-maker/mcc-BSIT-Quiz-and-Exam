<?php 
    require __DIR__ . '/./partials/header.php';

    $message = null;
    if (isset($_POST['section'])) {
       $adminController->addExam();
    }

    if (isset($_GET['message'])) {
        $message = $_GET['message'];
    }
    
?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">

                <div class="card">

                    <div class="card-header d-flex align-items-center">
                        <a href="exam.php" class="btn btn-secondary" ><i class="bx bx-arrow-back"></i></a>
                        <h5 class="mb-0 ms-2">Add Exam</h5>
                        
                    </div>

                    <div class="card-body">

                    <?php 
                        if($message !== null):
                    ?>
                        <div class="alert alert-success py-2">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                    <p class="my-0 d-none alert py-2 mb-2" id="alert"></p>

                    <label for="">Section</label>
                    <select name="section" class="form-select my-3" required>
                        <option value="1">North</option>
                        <option value="2">East</option>
                        <option value="3">West</option>
                        <option value="4">South</option>
                        <option value="5">South East</option>
                    </select>

                    <label for="">Year Level</label>
                    <select name="year_level" class="form-select my-3" required>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>

                    <label for="">Semester</label>
                    <div class="row my-2">
                        <div class="col-lg-4 col-6">
                            <input type="radio" name="semester" name="semester" class="form-check-input" value="1" checked>
                            1st Semester
                        </div>
                        <div class="col-lg-4 col-6">
                            <input type="radio" name="semester" name="semester" class="form-check-input" value="2">
                            2nd Semester
                        </div>
                        <div class="col-lg-4 col-6">
                            <input type="radio" name="semester" name="semester" class="form-check-input" value="3">
                            Summer
                        </div>
                    </div>

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


                    <!-- <label for="">Question</label>
                    <textarea name="question" class="form-control my-3" cols="30" rows="5" style="resize: none;" placeholder="Write question..." required></textarea>
                    <label for="">Choices</label> -->

                    <!-- <label for="">Exam Type</label>
                    <select name="type" class="form-select my-3" required>
                        <option value="1">Essay</option>
                        <option value="2">Enumeration</option>
                        <option value="3">Multiple Choice</option>
                        <option value="4">Identification</option>
                    </select> -->

                    <label for="">Question Category</label>
                    <select name="category" class="form-select my-3" required>
                        <option value="0">Easy</option>
                        <option value="1">Medium</option>
                        <option value="2">Hard</option>
                    </select>

                    <label for="">Time Limit</label>
                    <input type="number" name="time_limit" class="form-control my-2" value="0" min="0" required>

                    <button type="submit" class="btn btn-danger float-end px-lg-5 mt-3">Submit</button>


                </form>

                    </div>
                </div>

            </div>


        </div>

    </div>
</div>

<?php require __DIR__ . '/./partials/footer.php' ?>
