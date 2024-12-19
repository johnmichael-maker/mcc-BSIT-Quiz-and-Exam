<?php
$servername = "localhost";  
$username = "u510162695_bsit_quiz";       
$password = "1Bsit_quiz";            
$dbname = "u510162695_bsit_quiz";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(id) AS user_count FROM ms_365_instructor";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $user_count = $row['user_count'];
} else {
    $user_count = 0; 
}

$sql_userType2 = "SELECT COUNT(admin_id) AS userType2_count FROM admin WHERE userType = 2";
$result_userType2 = $conn->query($sql_userType2);
if ($result_userType2) {
    $row_userType2 = $result_userType2->fetch_assoc();
    $userType2_count = $row_userType2['userType2_count'];
} else {
    $userType2_count = 0;
}

?>

<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
        <?php require __DIR__ . '/./partials/sidebar.php'; ?>
        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>
            <div class="w-100 p-3">
                <div class="row g-2">
                    <!-- Display Cards for Each Category -->
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(255, 99, 132, 0.8);">
                            <div class="card-body">
                                <h5>Quizzes</h5>
                                <h1><?= $adminController->getAllQuestionCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(54, 162, 235, 0.8);">
                            <div class="card-body">
                                <h5>Exams</h5>
                                <h1><?= $adminController->examCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(255, 206, 86, 0.8);">
                            <div class="card-body">
                                <h5>Student Contestants</h5>
                                <h1><?= $adminController->contestantsCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(57, 255, 20, 0.8);">
                            <div class="card-body">
                                <h5>Examinees</h5>
                                <h1><?= $adminController->examineesCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(35, 47, 97, 0.8);">
                            <div class="card-body">
                                <h5>Instructor</h5>
                                <h1><?= $userType2_count ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(18, 91, 226, 0.8);">
                            <div class="card-body">
                                <h5>MS 365 Users</h5>
                                <h1><?= $user_count ?></h1> 
                            </div>
                        </div>
                    </div>
                    <!-- Chart -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="myChart" width="400" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get context of the chart
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Quizzes', 'Exams', 'Student Contestant', 'Examinees', 'Instructor', 'MS 365 Users'],
            datasets: [{
                label: '# of Items',
                data: [
                    <?= $adminController->getAllQuestionCount() ?>,  // Quizzes count
                    <?= $adminController->examCount() ?>,  // Exams count
                    <?= $adminController->contestantsCount() ?>,  // Contestants count
                    <?= $adminController->examineesCount() ?>,  // Examinees count
                    <?= $userType2_count ?>,  // Instructor count
                    <?= $user_count ?>  // MS 365 Users count
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',  // Red for Quizzes
                    'rgba(54, 162, 235, 0.8)',  // Blue for Exams
                    'rgba(255, 206, 86, 0.8)',  // Yellow for Student Contestants
                    'rgba(57, 255, 20, 0.8)',   // Green for Examinees
                    'rgba(35, 47, 97, 0.8)',    // Navy for Instructor
                    'rgba(18, 91, 226, 0.8)'    // Blue for MS 365 Users
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',    // Red border for Quizzes
                    'rgba(54, 162, 235, 1)',    // Blue border for Exams
                    'rgba(255, 206, 86, 1)',    // Yellow border for Student Contestants
                    'rgba(57, 255, 20, 1)',     // Green border for Examinees
                    'rgba(35, 47, 97, 1)',      // Navy border for Instructor
                    'rgba(18, 91, 226, 1)'      // Blue border for MS 365 Users
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true  // Ensure y-axis starts from 0
                }
            }
        }
    });
</script>

<?php require __DIR__ . '/./partials/footer.php' ?>
