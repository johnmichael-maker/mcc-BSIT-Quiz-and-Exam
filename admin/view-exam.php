<?php
require __DIR__ . '/./partials/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $adminController->getExamById();
}

$message = null;
$message_error = null;
if (isset($_GET['message'])) {
    $message = $_GET['message'];
} else if (isset($_GET['message_error'])) {
    $message_error = $_GET['message_error'];
}
?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0" style="max-height: 100vh; overflow-y: auto;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <div class="w-100 p-3">

                <div class="row">

                    <div class="col-12">
                        <h5 class="me-2">Exam Questions | <?= $databaseController->sections($row['section']) . ' - ' . $databaseController->semester()[$row['semester']] . ' / ' . $databaseController->examType()[$row['type']] ?></h5>
                    </div>

                    <div class="col-12">
                        <?php if ($message !== null) : ?>
                            <div class="alert alert-success py-2">
                                <?= $message ?>
                            </div>
                        <?php elseif ($message_error !== null) : ?>
                            <div class="alert alert-danger py-2">
                                <?= $message_error ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 my-3">
                            <button type="button" class="btn btn-danger p-1 py-0" data-bs-toggle="modal" data-bs-target="#add-multiple-choice"><i class="bx bx-plus"></i></button>
                            <h6 class="mb-0">I. Multiple Choice</h6>
                        </div>

                        <div class="row g-3">
                            <?php
                            $count1 = 1;
                            $multiples = $databaseController->getMultipleChoice($id);
                            $correct_multiple = "border rounded-circle p-2 py-1 border-dark";
                            if ($multiples->rowCount() > 0) {
                                foreach ($multiples as $multiple) {
                            ?>
                                    <div class="col-12">
                                        <span><?= $count1++ ?> .</span>
                                        <span><?= $multiple['question'] ?></span>
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <span class="<?= $multiple['answer'] == 'A' ? $correct_multiple : '' ?>">A.</span>
                                                <span><?= $multiple['A'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span class="<?= $multiple['answer'] == 'B' ? $correct_multiple : '' ?>">B.</span>
                                                <span><?= $multiple['B'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span class="<?= $multiple['answer'] == 'C' ? $correct_multiple : '' ?>">C.</span>
                                                <span><?= $multiple['C'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span class="<?= $multiple['answer'] == 'D' ? $correct_multiple : '' ?>">D.</span>
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
                            <h6 class="mb-0">II. Matching Type</h6>
                        </div>

                        <div class="row">
                            <?php
                            $count2 = 1;
                            $identifications = $databaseController->getIdentification($id);

                            ?>
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <button type="button" class="btn btn-danger p-1 py-0" data-bs-toggle="modal" data-bs-target="#add-identification-question"><i class="bx bx-plus"></i></button>
                                    <p class="mb-0">Questions</p>
                                </div>

                                <?php
                                $identification_data = [];
                                if ($identifications->rowCount() > 0) {
                                    foreach ($identifications as $identification) :

                                ?>
                                        <p><?= $count2++ ?>. <?= $identification['question'] ?></p>

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
                                    <button type="button" class="btn btn-danger p-1 py-0" data-bs-toggle="modal" data-bs-target="#add-identification-choice"><i class="bx bx-plus"></i></button>
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

                        </div>

                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 my-3">
                            <button type="button" class="btn btn-danger p-1 py-0" data-bs-toggle="modal" data-bs-target="#add-enumeration"><i class="bx bx-plus"></i></button>
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
                                        <p><?= $count4++ ?>. <?= $enumeration['question'] ?></p>
                                        <ul>
                                        <?php 
                                            foreach ($databaseController->getEnumerationCorrect($id, $enumeration['id']) as $key => $value) {
                                                ?>
                                               
                                                    <li><?= $value['answer'] ?></li>
                                               
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
                            <button type="button" class="btn btn-danger p-1 py-0" data-bs-toggle="modal" data-bs-target="#add-essay"><i class="bx bx-plus"></i></button>
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


        </div>

    </div>
</div>

<div class="modal fade" id="add-multiple-choice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Multiple Choice Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="?id=<?= $id ?>&add-multiple-choice" method="post">
                    <input type="hidden" name="exam_id" value="<?= $id ?>">
                    <label>Question</label>
                    <textarea name="question" id="" rows="3" class="form-control my-2" style="resize: none;" placeholder="Write question here"></textarea>

                    <hr>
                    <h6>Choices:</h6>
                    <label>A</label>
                    <textarea name="A" rows="2" class="form-control my-2" style="resize: none;" placeholder="Write choice A here"></textarea>
                    <label>B</label>
                    <textarea name="B" rows="2" class="form-control my-2" placeholder="Write choice B here" style="resize: none;"></textarea>
                    <label>C</label>
                    <textarea name="C" rows="2" class="form-control my-2" placeholder="Write choice C here" style="resize: none;"></textarea>
                    <label>D</label>
                    <textarea name="D" rows="2" class="form-control my-2" placeholder="Write choice D here" style="resize: none;"></textarea>
                    <hr>
                    <label for="">Correct Answer</label>
                    <select name="answer" class="form-select my-2">
                        <option selected disabled value="">Select correct answer</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>

                    <button type="submit" class="btn btn-danger w-100 mt-3">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-identification-question">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Identification Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="?id=<?= $id ?>&add-identification-question" method="post">
                    <input type="hidden" name="exam_id" value="<?= $id ?>">
                    <label>Question</label>
                    <textarea name="question" rows="3" class="form-control my-2" style="resize: none;" placeholder="Write question here"></textarea>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-identification-choice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Identification Choices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="?id=<?= $id ?>&add-identification-choice" method="post">
                    <input type="hidden" name="exam_id" value="<?= $id ?>">

                    <label for="">Question</label>
                    <select name="identification_id" class="form-select my-2">
                        <option selected disabled value="">Select Question</option>
                        <?php foreach ($databaseController->getIdentificationIsNull($id) as $identification) : ?>
                            <option value="<?= $identification['id'] ?>"><?= $identification['question'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Choice</label>
                    <textarea name="answer" rows="3" class="form-control my-2" style="resize: none;" placeholder="Write answer here"></textarea>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-enumeration">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Enumeration Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="?id=<?= $id ?>&add-enumeration" method="post">
                    <input type="hidden" name="exam_id" value="<?= $id ?>">
                    <label>Question</label>
                    <textarea name="question" id="" rows="3" class="form-control my-2" style="resize: none;" placeholder="Write question here"></textarea>

                    <h6>Answers:</h6>
                    <div id="answer-div">
                        <input name="answer[]" id="" rows="2" class="form-control my-3" style="resize: none;" placeholder="Write answer here"></input>
                    </div>
                    <button type="button" id="add-answer-input" class="btn btn-danger"><i class="bx bx-plus"></i> Add Answer</button>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-essay">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add Multiple Choice Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="?id=<?= $id ?>&add-essay" method="post">
                    <input type="hidden" name="exam_id" value="<?= $id ?>">
                    <label>Question</label>
                    <textarea name="question" id="" rows="3" class="form-control my-2" style="resize: none;" placeholder="Write question here"></textarea>

                    <label>Answer</label>
                    <textarea name="answer" id="" rows="3" class="form-control my-2" style="resize: none;" placeholder="Write answer here"></textarea>

                    <button type="submit" class="btn btn-danger w-100 mt-3">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let addInputBtn = document.getElementById("add-answer-input");
    let answerDiv = document.getElementById("answer-div");

    addInputBtn.onclick = () => {
        let inputCreate = document.createElement('input')
        inputCreate.setAttribute('name', 'answer[]')
        inputCreate.setAttribute('placeholder', 'Write answer here')
        // inputCreate.setAttribute('rows', '3')
        inputCreate.classList.add('form-control', 'my-3')
        answerDiv.appendChild(inputCreate)
    }
</script>

<?php require __DIR__ . '/./partials/footer.php' ?>
