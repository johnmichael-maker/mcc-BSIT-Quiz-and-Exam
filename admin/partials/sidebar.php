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
                   <img src="../assets/img/file.png" alt="" style="width: 100%;">
                </div>
                <div class="col-8">
                    BSIT DEPARTMENT
                    <span class="d-block" style="font-size: 15px;">Quiz and Exam</span>
                </div>
            </div>
        </a>
    </h5>

    <a href="#" class="position-absolute top-0 fs-1 end-0 m-3 text-light d-lg-none d-block" id="close-sidebar"><i class="bx bx-x"></i></a>

    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a href="index.php" class="nav-link <?= str_contains($url, '/index.php') ? $active : $inactive ?>"> <i class="bx bx-home"></i> Dashboard</a>
        </li>

        <!-- Conditionally render Exam menu based on AUTH_UTYPE -->
        <?php if (isset($_SESSION['AUTH_UTYPE']) && $_SESSION['AUTH_UTYPE'] != 1): ?>

        <li class="nav-item">
            <a href="quiz" class="nav-link <?= str_contains($url, '/quiz') || str_contains($url, '/print-quiz.php') ? $active : $inactive ?>"> <i class="bx bx-question-mark"></i> Quiz</a>
        </li>
        
        <li class="nav-item">
            <a href="exam" class="nav-link <?= 
                $url == '/exam' 
                || str_contains($url, 'exam.php') 
                || str_contains($url, 'edit-exam') 
                || str_contains($url, 'view-exam') 
                ? $active : $inactive ?>"> <i class="bx bx-file"></i> Exam</a>
        </li>
        <li class="nav-item dropend">
    <a href="#" class="nav-link dropdown-toggle <?= 
        str_contains($url, '/midterm.php') || str_contains($url, '/final.php') 
        ? $active : $inactive ?>" 
        id="classRecordsDropdown" 
        role="button" 
        data-bs-toggle="dropdown" 
        aria-expanded="false">
        <i class="bx bx-book"></i> Class Records
    </a>
    <ul class="dropdown-menu custom-dropdown bg-danger" aria-labelledby="classRecordsDropdown">
        <li><a class="dropdown-item text-black" href="midterm.php">Midterm</a></li>
        <li><a class="dropdown-item text-black" href="final.php">Final</a></li>
    </ul>
</li>
        <?php endif; ?>
        
       <?php if (isset($_SESSION['AUTH_UTYPE']) && $_SESSION['AUTH_UTYPE'] != 2): ?>
        <li class="nav-item">
            <a href="quiz" class="nav-link <?= str_contains($url, '/quiz') ? $active : $inactive ?>"> <i class="bx bx-user"></i> Quiz</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a href="examinees" class="nav-link <?= str_contains($url, '/examinees') ? $active : $inactive ?>"> <i class="bx bx-user"></i> Examinees</a>
        </li>

        <?php if (isset($_SESSION['AUTH_UTYPE']) && $_SESSION['AUTH_UTYPE'] != 2): ?>
        <li class="nav-item">
            <a href="instructors" class="nav-link <?= str_contains($url, '/instructors') ? $active : $inactive ?>"> <i class="bx bx-user"></i> Instructors</a>
        </li>
        <?php endif; ?>

        <?php if (isset($_SESSION['AUTH_UTYPE']) && $_SESSION['AUTH_UTYPE'] != 2): ?>
        <li class="nav-item">
            <a href="activity_log" class="nav-link <?= str_contains($url, '/activity_log') ? $active : $inactive ?>"> <i class="bx bx-clipboard"></i> Activity Log</a>
        </li>
        <?php endif; ?>

        <!-- Conditionally render Ms365 Account menu based on AUTH_UTYPE -->
        <?php if (isset($_SESSION['AUTH_UTYPE']) && $_SESSION['AUTH_UTYPE'] != 2): ?>
        <li class="nav-item">
            <a href="ms_account" class="nav-link <?= str_contains($url, '/ms_account') ? $active : $inactive ?>"> 
                <i class="bx bx-user"></i> Ms365 Account
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <a href="#" onclick="return showLogout()" class="nav-link text-light"> <i class="bx bx-log-out"></i> Logout</a>
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
