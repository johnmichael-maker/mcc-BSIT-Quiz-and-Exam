<?php
require __DIR__ . '/./partials/header.php';

$row = $examineeController->getExamByStudent();
$examineeController->checkExamineeSession();
$id = $row['id'];

if (isset($_GET['submit-exam'])) {
    $examineeController->submitAnswer();
}

// Ensure both current time and exam start time are in the same time zone
$current_time = new DateTime('now', new DateTimeZone('Asia/Manila')); // Set to your server's time zone
$start_time = new DateTime($row['start_time'], new DateTimeZone('Asia/Manila')); // Same time zone as current time


if ($current_time < $start_time) {
    $time_difference = $start_time->diff($current_time);
    $remaining_time = $time_difference->format('%h hours %i minutes %s seconds');
    
    // Format the start time as a string in ISO 8601 format for JavaScript compatibility
    $start_time_str = $start_time->format('Y-m-d\TH:i:s');  // Format to a string for JS
    
    echo "
    <div style='
        position: fixed; 
        top: 50%; 
        left: 50%; 
        transform: translate(-50%, -50%); 
        background-color: #fff; 
        padding: 30px; 
        border-radius: 10px; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        text-align: center; 
        max-width: 400px; 
        width: 90%; 
        font-family: Arial, sans-serif;
        border: 2px solid rgb(53, 236, 223);
        z-index: 1000;
        animation: fadeIn 0.5s ease-out;
    '>
        <h2 style='color:rgb(34, 150, 200); font-size: 1.5em; margin-bottom: 15px;'>Exam Start Time</h2>
        <p id='countdown' style='font-size: 1.2em; color: #333;'>The exam will start in <strong>$remaining_time</strong>. Please wait until the scheduled time.</p>
    </div>
    <div style='
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    '></div>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    <script>
        // Use the formatted string to create the startTime Date object in JS
        var startTime = new Date('$start_time_str'); // Format string for JS Date constructor
        var currentTime = new Date(); // Get current time

        // Function to update the countdown every second
        function updateCountdown() {
            var now = new Date();
            var timeDiff = startTime - now;

            if (timeDiff <= 0) {
                // Exam time has arrived, reload the page
                setTimeout(function() {
                    window.location.reload();  // Reload the page after 3 seconds
                }, 3000); // 3-second delay before auto reload
                document.getElementById('countdown').innerHTML = 'The exam is starting now!';
            } else {
                var hours = Math.floor(timeDiff / (1000 * 60 * 60));
                var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                document.getElementById('countdown').innerHTML = 'The exam will start in <strong>' + hours + ' hours ' + minutes + ' minutes ' + seconds + ' seconds</strong>. Please wait until the scheduled time.';
            }
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);
    </script>
    ";
    exit; // Prevent further code execution if the exam hasn't started yet.
}



$canStartExam = $examineeController->checkExaminee(); 

if (!$canStartExam) {
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
                                                <span><input type="radio" name="choices<?= $multiple['id'] ?>" value="A"> A.</span>
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
    <div class="d-flex align-items-center gap-2 my-3">
        <h6 class="mb-0">II. Identification</h6>
    </div>

    <div class="row">
        <?php
        $count2 = 1;
        // Fetch identification questions for the given exam
        $identifications = $databaseController->getIdentificationQuestions($id);
        
        if ($identifications->rowCount() > 0) {
            foreach ($identifications as $identification) {
        ?>
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <!-- Question on the left, Input field on the right -->
                        <p class="mb-0" style="flex: 1;"><?= $count2++ ?>. <?= $identification['question'] ?></p>

                        
                        <input type="text" name="identification<?= $identification['id'] ?>" class="form-control w-auto ml-3" placeholder="Enter Answer" style="max-width: 300px;">
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
                            <h6 class="mb-0">II. Matching Type</h6>

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
    let warningCount = 0;

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            warningCount++;
            alert(`Warning: You have switched tabs ${warningCount} time(s). Stay on the exam page.`);
            
            if (warningCount >= 3) {
                location.href = 'finished.php?cheating_detected';
            }
        }
    });

    document.addEventListener('contextmenu', function(event) {
        event.preventDefault();
        alert("Right-click is disabled on this page.");
    });

    document.addEventListener('copy', function(event) {
        event.preventDefault();
        alert("Copying text is disabled on this page.");
    });

    document.addEventListener('cut', function(event) {
        event.preventDefault();
        alert("Cutting text is disabled on this page.");
    });

    document.addEventListener('keydown', function(event) {
        if ((event.ctrlKey || event.metaKey) && ['c', 'v', 'x'].includes(event.key.toLowerCase())) {
            event.preventDefault();
            alert("Copying, pasting, and cutting are disabled on this page.");
        }

        if (event.altKey && event.key === 'Tab') {
            event.preventDefault();
            alert("Switching tabs is restricted during the exam.");
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        }
    });

    document.addEventListener('fullscreenchange', function() {
        if (!document.fullscreenElement) {
            alert("Please stay in fullscreen mode for the exam.");
        }
    });
</script>

<script>
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
