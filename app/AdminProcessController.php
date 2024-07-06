<?php 
    // require __DIR__ . '../../app/AdminProcessController.php';

    // use App\Admin;

    if (isset($_POST['add-exam'])) {
        $adminController->addExam();
    }
