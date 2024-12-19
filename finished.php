<?php

require __DIR__ . '/./partials/header.php';
// echo $_SESSION['EXAM_ID'];
$row = $examineeController->getExamByStudent();
$examineeController->checkExamineeSession();
$id = $row['id'];
// $scores = [];

if (isset($_GET['time_end'])) {
    $_SESSION['DISABLED'] = 1;
}

if (!isset($_SESSION['DISABLED'])) {
    header('location: exam.php');
}

if (isset($_GET['logout'])) {
    
?>

    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Logged out successfully",
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
                window.location.href = "index.php"
            });
    </script>
<?php
session_destroy();
}

if (isset($_GET['add-feedback'])) {
    $examineeController->addFeedback();
}

// echo $_SESSION['ID'];
?>

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<div class="container py-5">
    <div class="card rounded-0">

        <div class="card-body p-4">

            <div class="row">
                <input type="hidden" name="exam_id" value="<?= $id ?>">

                <div class="col-lg-12 text-center">
                    <img src="./assets/img/logo.png" alt="" style="width: 150px;" class="position-absolute start-0 top-0 mt-3">
                    <h3>Madridejos Community College</h3>
                    <p class="mb-0">Examination of BSIT - <?= $row['year_level'] . ' ' .  $databaseController->sections($row['section']) ?></p>
                    <p>Date: <?= date('Y-m-d')?></p>
                </div>

                <div class="col-12 dont-print">
                    <?php
                    if (isset($_GET['message'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= isset($_GET['message']) ? $_GET['message'] : '' ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </div>


                <div class="row mt-3">

                    <div class="col-12">
                        <h5 class="me-2">Exam Questions | <?= $databaseController->sections($row['section']) . ' - ' . $databaseController->semester()[$row['semester']] . ' / ' . $databaseController->examType()[$row['type']] ?></h5>

                        <p class="mb-0 mt-3">Please read the questions carefully and choose the answer wisely.</p>
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 my-3">

                                    <h6 class="mb-0">I. Multiple Choice</h6>
                                </div>

                                <div class="row g-3">
                                    <?php
                                    $score = 0;
                                    $count1 = 1;
                                    $multiples = $databaseController->getMultipleChoice($id);
                                    $correct_multiple = "border rounded-circle p-2 py-1 border-dark";
                                    if ($multiples->rowCount() > 0) {
                                        foreach ($multiples as $multiple) {
                                    ?>
                                             <div class="col-12">
        <span>
            <?php
            if ($examineeController->checkMultiple($multiple['id'])) {
                $score++;
                echo '<i class="bx bx-check text-success fw-bold"></i>';
            } else {
                echo '<i class="bx bx-x text-danger fw-bold"></i>';
            }
            ?>
            <?= $count1++ ?> .
        </span>
        <span><?= $multiple['question'] ?></span>
        <div class="row g-2">
            <div class="col-lg-6">
                <span>A.</span>
                <span><?= $multiple['A'] ?></span>
            </div>
            <div class="col-lg-6">
                <span>B.</span>
                <span><?= $multiple['B'] ?></span>
            </div>
            <div class="col-lg-6">
                <span>C.</span>
                <span><?= $multiple['C'] ?></span>
            </div>
            <div class="col-lg-6">
                <span>D.</span>
                <span><?= $multiple['D'] ?></span>
            </div>
        </div>
    </div>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12">
                                            No record found
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>




  <div class="col-12">
    <div class="d-flex align-items-center gap-2 my-3">
        <h6 class="mb-0">II. Identification</h6>
    </div>
    <div class="row">
        <?php
        $count4 = 1;
        $identifications = $databaseController->getIdentificationQuestions($id);  // Assuming this method gets all questions for the quiz
        if ($identifications->rowCount() > 0) {
            foreach ($identifications as $identification) {
        ?>
               <div class="col-12">
    <p>
        <?= $count4++ ?>. <?= htmlspecialchars($identification['question']) ?>
    </p>
    <ul>
        <?php
        // Retrieve correct answers for this question
        $correctAnswers = $databaseController->getIdentificationCorrect($id, $identification['id']);
        foreach ($correctAnswers as $answer) {
        ?>
            <li>
                <?php
                // Checking if the provided answer matches the correct one
                if ($examineeController->checkIdentifications($answer['answer'], $identification['id'])) {
                    $score++;  // Increment score if the answer matches
                    echo '<i class="bx bx-check text-success fw-bold"></i>';
                } else {
                    echo '<i class="bx bx-x text-danger fw-bold"></i>';
                }
                ?>
                <!-- Hide the correct answer text -->
                <!--<?= htmlspecialchars($answer['answer']) ?>-->
            </li>
        <?php
        }
        ?>
    </ul>
</div>
            <?php
            }
        } else {
            ?>
            <div class="col-12">
                No record found
            </div>
        <?php
        }
        ?>
    </div>
</div>



                            
 <div class="col-12">
                                <div class="d-flex align-items-center gap-2 my-3">
                                    <h6 class="mb-0">III. Matching Type</h6>
                                </div>

                                <div class="row">
                                    <?php
                                    $count2 = 1;
                                    $identifications = $databaseController->getIdentification($id);

                                    ?>
                                  <div class="col-lg-6">
    <div class="d-flex align-items-center gap-2 mb-3">
        <p class="mb-0">Questions</p>
    </div>

    <?php
    $identifications = $databaseController->getIdentification($id);
    if ($identifications->rowCount() > 0) {
        foreach ($identifications as $identification) :
    ?>
        <p>
            <?php
            // Show whether the answer is correct or not
            if ($examineeController->checkIdentification($identification['id'])) {
                $score++; // Increment score if correct
                echo '<i class="bx bx-check text-success fw-bold"></i>';
            } else {
                echo '<i class="bx bx-x text-danger fw-bold"></i>';
            }
            ?>
            <?= $count2++ ?>. <?= $identification['question'] ?>
        </p>
    <?php
        endforeach;
    } else {
    ?>
        <div class="col-12">
            No record found
        </div>
    <?php
    }
    ?>
</div>

<div class="col-lg-6">
    <div class="d-flex align-items-center gap-2 mb-3">
        <p class="mb-0">Choices</p>
    </div>

    <?php
    $count3 = 'A';
    $identification_choices = $databaseController->getIdentificationChoicesAdmin($id);
    $identification_choice = $identification_choices->fetchAll(PDO::FETCH_ASSOC);
    if ($identification_choices->rowCount() > 0) {
        for ($i = 0; $i < $identification_choices->rowCount(); $i++) :
    ?>
        <p><span class="p-1 py-0 bg-danger text-light rounded-circle"><?= $identification_choice[$i]['count'] ?></span> <?= $count3++ ?>. <?= $identification_choice[$i]['answer'] ?></p>
    <?php
        endfor;
    } else {
    ?>
        <div class="col-12">
            No record found
        </div>
    <?php
    }
    ?>
</div>
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 my-3">

                                    <h6 class="mb-0">III. Enumeration</h6>
                                </div>

                                <div class="row">
                                    <?php
                                    $count4 = 1;
                                    $enumerations = $databaseController->getEnumeration($id);
                                    if ($enumerations->rowCount() > 0) {
                                        foreach ($enumerations as $enumeration) {
                                    ?>
                                            <div class="col-12">
                                                <p>
                                                    <?= $count4++ ?>. <?= $enumeration['question'] ?></p>
                                                <ul>
                                                    <?php
                                                    foreach ($databaseController->getEnumerationCorrect($id, $enumeration['id']) as $key => $value) {
                                                    ?>

                                                        <li>
                                                            <?php
                                                            if ($examineeController->checkEnumeration($value['answer'], $enumeration['id'])) {
                                                                $score++;
                                                            ?>
                                                                <i class="bx bx-check text-success fw-bold"></i>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <i class="bx bx-x text-danger fw-bold"></i>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?= $value['answer'] ?>
                                                        </li>

                                                    <?php
                                                    }
                                                    ?>
                                                </ul>

                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12">
                                            No record found
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="d-flex align-items-center gap-2 my-3">

                                    <h6 class="mb-0">IV. Essay</h6>
                                </div>

                                <div class="row">
                                    <?php
                                    $count5 = 1;
                                    $essays = $databaseController->getEssay($id);
                                    if ($essays->rowCount() > 0) {
                                        foreach ($essays as $essay) {
                                    ?>
                                            <div class="col-12">
                                                <p><?= $count5++ ?>. <?= $essay['question'] ?></p>
                                                <p>Answer: <?= $essay['answer'] ?></p>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-12">
                                            No record found
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>

                        </div>
                    </div> 

                    <div class="col-12">
                        <h3>Total Score: <?= $score ?> / <?= $databaseController->getMultipleChoice($id)->rowCount() + $databaseController->getIdentification($id)->rowCount() + $databaseController->getEnumeration($id)->rowCount() ?> </h3>
                        <p class="mb-1">Name: <?= ucfirst($_SESSION['LNAME']) . ', ' . ucfirst($_SESSION['FNAME']) . ' ' . ucfirst($_SESSION['MNAME'])  ?></p>
                        <p class="mb-1">Year & Section: <?= $databaseController->yearLevel()[$_SESSION['LEVEL']] ?> <?= $databaseController->sections($_SESSION['SECTION']) ?></p>

                    </div>

                    <div class="col-12 d-flex align-items-center mt-3 justify-content-end dont-print">
                        <!--<button type="submit" class="btn btn-danger" onclick="print()"><i class="bx bx-printer"></i> Print</button>-->
                       <span class="mx-3 h-100 border-end border-secondary"></span>
                        <a href="#" onclick="return showLogout()" class="btn btn-secondary"> Logout</a>
                    </div>

                    <?php
                    if (!$examineeController->checkFeedback()) {
                    ?>
                        <div class="col-12 dont-print">

                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5>Give Feedback</h5>


                                    <form action="?add-feedback" method="post">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control my-2" name="name" value="<?= ucfirst($_SESSION['LNAME']) . ', ' . ucfirst($_SESSION['FNAME']) . ' ' . ucfirst($_SESSION['MNAME']) ?>" readonly>
                                        <label for="">Feedback</label>
                                        <textarea name="feedback" rows="5" class="form-control my-2" placeholder="Write something"></textarea>
                                        <button type="submit" class="btn btn-danger float-end mt-2"> Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>

            </div>


        </div>
    </div>
</div>

<?php $examineeController->updateScore($score) ?>


<script>
    function showLogout() {
        Swal.fire({
            title: "<strong>Are you sure you want to logout?</strong>",
            icon: "info",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `Yes`,
            confirmButtonColor: "#d93645",
            cancelButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "?logout"
            }
        });
    }
</script>

<?php require __DIR__ . '/./partials/footer.php' ?>
