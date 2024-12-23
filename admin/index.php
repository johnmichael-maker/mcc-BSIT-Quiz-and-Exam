

<?php require __DIR__ . '/partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <?php require __DIR__ . '/partials/sidebar.php'; ?>
        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/partials/navbar.php'; ?>
            <div class="w-100 p-3">
                <div class="row g-2">
                    <!-- Cards -->
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

                    <!-- Score Chart -->
                    <div class="col-lg-3">
                        <div class="card shadow"> 
                            <div class="card-body">
                                <h5>Scores for <?= date('F Y') ?></h5>
                                <canvas id="scoreChart"></canvas>
                            </div>
                        </div>
                    </div>
                   
    <div class="col-lg-3">
        <div class="card shadow" style="width: 950px; margin: 100px; margin-left: 50px; margin-top:10px;"> 
            <div class="card-body">
                <h6>Exam Completion Times (<?= date('F Y') ?>)</h6>
                <canvas id="completionChart" style="margin: auto;"></canvas>
            </div>
        </div>
    </div>


                    <!-- General Chart -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    // General Chart
    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Quizzes', 'Exams', 'Student Contestants', 'Examinees', 'Instructor', 'MS 365 Users'],
            datasets: [{
                label: '# of Items',
                data: [
                    <?= $adminController->getAllQuestionCount() ?>,
                    <?= $adminController->examCount() ?>,
                    <?= $adminController->contestantsCount() ?>,
                    <?= $adminController->examineesCount() ?>,
                    <?= $userType2_count ?>,
                    <?= $user_count ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(57, 255, 20, 0.8)',
                    'rgba(35, 47, 97, 0.8)',
                    'rgba(18, 91, 226, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(57, 255, 20, 1)',
                    'rgba(35, 47, 97, 1)',
                    'rgba(18, 91, 226, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
</script>

<?php require __DIR__ . '/partials/footer.php'; ?>
