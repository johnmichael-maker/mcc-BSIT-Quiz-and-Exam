<?php
require __DIR__ . '/./partials/header.php';
// echo $_SESSION['EXAM_ID'];

$row = $examineeController->getExamByStudent();
$examineeController->checkExamineeSession();
$id = $row['id'];

if (isset($_GET['submit-exam'])) {
    $examineeController->submitAnswer();
}

if (!$examineeController->checkExaminee()) {
    header('location: finished.php');
}
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

            <form method="POST" action="?submit-exam" class="row">
                <input type="hidden" name="exam_id" value="<?= $id ?>">
                <div class="col-lg-12 text-center position-relative">
                    <img src="./assets/img/logo.png" alt="" style="width: 150px;" class="position-absolute start-0 top-0 mt-3">
                    <h3>Madridejos Community College</h3>
                    <p class="mb-0">Examination of BSIT - <?= $row['year_level'] . ' ' .  $databaseController->sections($row['section']) ?></p>
                    <p>Date: <?= date('y-m-d') ?></p>
                    <div id="timer" class="position-absolute top-0 end-0 border border-2 px-2">
                        <p class="mb-0">Exam ends in:</p>
                        <h1>00:00</h1>
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="col-12">
                        <h5 class="me-2">Exam Questions | <?= $databaseController->sections($row['section']) . ' - ' . $databaseController->semester()[$row['semester']] . ' / ' . $databaseController->examType()[$row['type']] ?></h5>

                        <p class="mb-0 mt-3">Please read the questions carefully and choose the answer wisely.</p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2 my-3">
                            <h6 class="mb-0">I. Multiple Choice</h6>
                        </div>

                        <div class="row g-3">
                            <?php
                            $count1 = 1;
                            $multiples = $databaseController->getMultipleChoice($id);
                            // $correct_multiple = "border rounded-circle p-2 py-1 border-dark";
                            if ($multiples->rowCount() > 0) {
                                foreach ($multiples as $multiple) {
                            ?>
                                    <div class="col-12">
                                        <span><?= $count1++ ?> .</span>
                                        <span><?= $multiple['question'] ?></span>
                                        <div class="row g-2">
                                            <div class="col-lg-6">
                                                <span><input type="radio" name="choices<?= $multiple['id'] ?>" value="A" checked> A.</span>
                                                <span><?= $multiple['A'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span><input type="radio" name="choices<?= $multiple['id'] ?>" value="B"> B.</span>
                                                <span><?= $multiple['B'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span><input type="radio" name="choices<?= $multiple['id'] ?>" value="C"> C.</span>
                                                <span><?= $multiple['C'] ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <span><input type="radio" name="choices<?= $multiple['id'] ?>" value="D"> D.</span>
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
                        <div class=" my-3">
                            <h6 class="mb-0">II. Identification</h6>

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
                                    <p class="mb-0">Choices (Enter number of the question on the input)</p>
                                </div>

                                <?php
                                $count3 = 'A';
                                $identification_choices = $databaseController->getIdentificationChoicesAdmin($id);
                                $identification_choice = $identification_choices->fetchAll(PDO::FETCH_ASSOC);
                                if ($identification_choices->rowCount() > 0) {
                                    for ($i = 0; $i < $identification_choices->rowCount(); $i++) :
                                ?>
                                        <p><input type="number" min="1" max="<?= $identification_choices->rowCount() ?>" name="identification<?= $identification_choice[$i]['identification_id'] ?>" style="width: 20px; height: 20px;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');"> <?= $count3++ ?>. <?= $identification_choice[$i]['answer'] ?></p>
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
                            <h6 class="mb-0">III. Enumeration</h6>
                        </div>

                        <div class="row">
                            <?php
                            $count4 = 1;
                            $input_count1 = 1;
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

                                                <li>
                                                    <input type="text" name="enumeration<?= $enumeration['id'] ?>[]" class="my-2" placeholder="Enter Answer">
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
                                        <textarea name="essay<?= $essay['id'] ?>" rows="3" style="resize: none;" placeholder="Enter Answer here" class="form-control"></textarea>
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

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-danger mt-3">Submit</button>
                        <p class="mt-1 mb-0">Please double check your answer before submitting.</p>
                    </div>

                </div>

            </form>


        </div>
    </div>
</div>
<div id="reminderModal" style="display:none; position:fixed; bottom:10%; left:50%; transform:translateX(-50%); background-color:#fff; padding:20px; border-radius:5px; width:80%; max-width:300px; text-align:center; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); z-index:1000;">
    <h2>Reminder</h2>
    <p>1 minute left! Please finish up.</p>
</div>

<audio id="reminderSound">
    <source src="time.mp3" type="audio/mpeg">
    <source src="time.ogg" type="audio/ogg">
</audio>


<script>
      window.addEventListener("keydown", function(event) {
       
        if (event.key === "F5") {
            event.preventDefault();
        }
       
        if (event.ctrlKey && event.key === "r") {
            event.preventDefault();
        }
    });

    
    window.addEventListener("beforeunload", function(event) {
        
        event.returnValue = "Are you sure you want to leave the exam? This may cause you to lose your progress.";
    });

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        var interval = setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
  
            display.textContent = minutes + ":" + seconds;

           
            if (timer === 60) {
                var reminderModal = document.getElementById('reminderModal');
                var reminderSound = document.getElementById('reminderSound');
                
                reminderModal.style.display = 'block';
                reminderSound.play();

              
                setTimeout(function() {
                    reminderModal.style.display = 'none';
                }, 5000); 
            }

            if (--timer < 0) {
                clearInterval(interval);
                location.href = 'finished.php?time_end';
            }
        }, 1000);
    }

    window.onload = function() {
        var fiveMinutes = 60 * <?= $row['time_limit'] ?>,
        display = document.querySelector('#timer h1');
        startTimer(fiveMinutes, display);
    };
</script>

<?php require __DIR__ . '/./partials/footer.php' ?>
