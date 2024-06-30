<?php 
    $url = implode(explode('/quiz_bowl/admin', strtolower($_SERVER['REQUEST_URI'])));
    $active = "text-dark bg-light";
    $inactive = "text-light";
?>

<div class="col-lg-2 bg-danger px-0" style="height: 100vh;">
            <h5 class="mt-3 text-light mx-3">
                <a href="index.php" class="text-decoration-none text-light">
                   <div class="row g-1">
                   <div class="col-4">
                        <img src="../assets/img/logo.png" alt="" style="width: 100%;">
                    </div>
                    <div class="col-8">
                    MCC
                        <span class="d-block" style="font-size: 15px;">Quiz and Exam</span>
                    </div>
                   </div>
                </a>
            </h5>

            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= $url == '/index.php' ? $active : $inactive ?>"> <i class="bx bx-home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="quiz.php" class="nav-link <?= $url == '/quiz.php' ? $active : $inactive ?>"> <i class="bx bx-question-mark"></i> Quiz</a>
                </li>
                <li class="nav-item">
                    <a href="exam.php" class="nav-link <?= $url == '/exam.php' ? $active : $inactive ?>"> <i class="bx bx-file"></i> Exam</a>
                </li>
                <li class="nav-item">
                    <a href="examinees.php" class="nav-link <?= $url == '/examinees.php' ? $active : $inactive ?>"> <i class="bx bx-user"></i> Examinees</a>
                </li>
                <li class="nav-item">
                    <a href="contestants.php" class="nav-link <?= $url == '/contestants.php' ? $active : $inactive ?>"> <i class="bx bx-user"></i> Contestants</a>
                </li>
                <li class="nav-item">
                    <a href="?logout" class="nav-link text-light"> <i class="bx bx-log-out"></i> Logout</a>
                </li>
            </ul>

        </div>