<?php
$url = implode(explode('/mcc-bsit-quiz-and-exam/admin', strtolower($_SERVER['REQUEST_URI'])));
$active = "text-dark bg-light";
$inactive = "text-light";
?>

<div class="col-lg-2 col-10 d-lg-block d-none bg-danger px-0 dont-print" id="menu" style="height: 100vh; z-index: 100 !important;">
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

    <a href="#" class="position-absolute top-0 fs-1 end-0 m-3 text-light d-lg-none d-block" id="close-sidebar"><i class="bx bx-x"></i></a>

    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a href="index.php" class="nav-link <?= $url == '/index.php' ? $active : $inactive ?>"> <i class="bx bx-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="quiz.php" class="nav-link <?= $url == '/quiz.php' || $url == '/print-quiz.php' ? $active : $inactive ?>"> <i class="bx bx-question-mark"></i> Quiz</a>
        </li>
        <li class="nav-item">
            <a href="exam.php" class="nav-link <?= 
                $url == '/exam.php' 
                || str_contains($url, 'exam.php') 
                || str_contains($url, 'edit-exam') 
                || str_contains($url, 'view-exam') 
                ? $active : $inactive ?>"> <i class="bx bx-file"></i> Exam</a>
        </li>
        <li class="nav-item">
            <a href="examinees.php" class="nav-link <?= $url == '/examinees.php' ? $active : $inactive ?>"> <i class="bx bx-user"></i> Examinees</a>
        </li>
        <!-- <li class="nav-item">
            <a href="contestants.php" class="nav-link <?= $url == '/contestants.php' ? $active : $inactive ?>"> <i class="bx bx-user"></i> Contestants</a>
        </li> -->
        <li class="nav-item">
            <a href="#"  onclick="return showLogout()" class="nav-link text-light"> <i class="bx bx-log-out"></i> Logout</a>
        </li>
    </ul>

</div>

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
