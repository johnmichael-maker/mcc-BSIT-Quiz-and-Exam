<?php
$servername = "localhost";  
$username = "u510162695_bsit_quiz";       
$password = "1Bsit_quiz";            
$dbname = "u510162695_bsit_quiz";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(id) AS user_count FROM ms_365_users";
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
// Get the current month and year
$month = date('m');
$year = date('Y');

// Fetch the highest scorer
$sql_highest_score = "SELECT fname, lname, score 
                      FROM examinees 
                      WHERE score = (SELECT MAX(score) 
                                     FROM examinees 
                                     WHERE MONTH(created_at) = ? AND YEAR(created_at) = ?) 
                        AND MONTH(created_at) = ? AND YEAR(created_at) = ? 
                      LIMIT 1";
$stmt_highest_score = $conn->prepare($sql_highest_score);
$stmt_highest_score->bind_param('iiii', $month, $year, $month, $year);
$stmt_highest_score->execute();
$result_highest_score = $stmt_highest_score->get_result();

// Fetch lowest and highest scores for the chart
$sql_scores = "SELECT MIN(score) AS lowest_score, MAX(score) AS highest_score 
               FROM examinees 
               WHERE MONTH(created_at) = ? AND YEAR(created_at) = ?";
$stmt_scores = $conn->prepare($sql_scores);
$stmt_scores->bind_param('ii', $month, $year);
$stmt_scores->execute();
$result_scores = $stmt_scores->get_result();
$scores = $result_scores->fetch_assoc();
$lowest_score = $scores['lowest_score'] ?? 0;
$highest_score = $scores['highest_score'] ?? 0;

// Fetch time intervals for exam completion
$sql_completion_time = "SELECT TIMESTAMPDIFF(MINUTE, created_at, updated_at) AS completion_time 
                        FROM examinees 
                        WHERE score IS NOT NULL 
                        AND MONTH(created_at) = ? 
                        AND YEAR(created_at) = ?";
$stmt_completion_time = $conn->prepare($sql_completion_time);
$stmt_completion_time->bind_param('ii', $month, $year);
$stmt_completion_time->execute();
$result_completion_time = $stmt_completion_time->get_result();

// Organize data into intervals
$time_intervals = [];
while ($row = $result_completion_time->fetch_assoc()) {
    $interval = floor($row['completion_time'] / 10) * 10; // Group into 10-minute intervals
    if (!isset($time_intervals[$interval])) {
        $time_intervals[$interval] = 0;
    }
    $time_intervals[$interval]++;
}

// Prepare data for the chart
ksort($time_intervals); // Sort intervals
$interval_labels = json_encode(array_keys($time_intervals));
$interval_values = json_encode(array_values($time_intervals));

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
                                <h5><i class="fas fa-question-circle"></i> Quizzes</h5> 
                                <h1><?= $adminController->getAllQuestionCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(54, 162, 235, 0.8);">
                            <div class="card-body">
                              <h5><i class="fas fa-file-alt"></i> Exams</h5>
                                <h1><?= $adminController->examCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(255, 206, 86, 0.8);">
                            <div class="card-body">
                                <h5><i class="fas fa-users"></i> Student Contestants</h5>
                                <h1><?= $adminController->contestantsCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(57, 255, 20, 0.8);">
                            <div class="card-body">
                                <h5><i class="fas fa-user-check"></i> Examinees</h5>
                                <h1><?= $adminController->examineesCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(35, 47, 97, 0.8);">
                            <div class="card-body">
                                <h5><i class="fas fa-chalkboard-teacher"></i> Instructor</h5> 
                                <h1><?= $userType2_count ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow" style="border-left: 6px solid rgba(18, 91, 226, 0.8);">
                            <div class="card-body">
                              <h5><i class="fas fa-users-cog"></i> MS 365 Users</h5>
                                <h1><?= $user_count ?></h1> 
                            </div>
                        </div>
                    </div>
                   <!-- Score Chart -->
                    <div class="col-lg-3">
                        <div class="card shadow">
                            <div class="card-body">
                                <h6><i class="fas fa-chart-line"></i> Scores for <?= date('F Y') ?></h6>
                                <canvas id="scoreChart"></canvas>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-6">
                         <div class="card shadow" style="max-width: 1000px; margin: auto; margin-left:50px;"> 
            <div class="card-body">
                <h6><i class="fas fa-clock"></i> Exam Completion Times (<?= date('F Y') ?>)</h6> 
                <canvas id="completionChart"></canvas>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script>
    // Wave Chart for Exam Completion Times
const completionCtx = document.getElementById('completionChart').getContext('2d');
new Chart(completionCtx, {
    type: 'line',
    data: {
        labels: <?= $interval_labels ?>, // Time intervals
        datasets: [{
            label: 'Number of Students',
            data: <?= $interval_values ?>, // Counts
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2,
            tension: 0.4 // Create a smooth wave effect
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Completion Time (Minutes)'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Number of Students'
                },
                beginAtZero: true
            }
        }
    }
});

</script>
<script>
    // Score Chart
    const scoreCtx = document.getElementById('scoreChart').getContext('2d');
    new Chart(scoreCtx, {
        type: 'pie',
        data: {
            labels: ['Lowest Score', 'Highest Score'],
            datasets: [{
                data: [<?= $lowest_score ?>, <?= $highest_score ?>],
                backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
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
                    <?= $user_count / 200?>  // MS 365 Users count
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
                    beginAtZero: true,  
                    max: Math.max(<?= $adminController->getAllQuestionCount() ?>, <?= $adminController->examCount() ?>, <?= $adminController->contestantsCount() ?>, <?= $adminController->examineesCount() ?>, <?= $userType2_count ?>, <?= $user_count / 200 ?>) * 1.2  // Set the max Y value to 120% of the highest value
                }
            }
        }
    });
</script>

<?php require __DIR__ . '/./partials/footer.php' ?>
