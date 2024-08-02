<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
       
        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


           
            <div class="w-100 p-3">
                <div class="row g-2">
                    <div class="col-lg-4">
                    <div class="card shadow " style="border-left: 6px solid rgba(255, 99, 132, 0.8);">
                            <div class="card-body">
                                 <h5>Quizzes</h5>
                                <h1><?= $adminController->getAllQuestionCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow " style="border-left: 6px solid rgba(54, 162, 235, 0.8);">
                            <div class="card-body">
                             <h5>Exams</h5>
                                <h1><?= $adminController->examCount() ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                          <div class="card shadow " style="border-left: 6px solid rgba(255, 206, 86, 0.8);">
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
   const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Quizzes', 'Exams', 'Student Contestant', 'Examinees'],
        datasets: [{
            label: '# of Items',
            data: [
                <?= $adminController->getAllQuestionCount() ?>, 
                <?= $adminController->examCount() ?>, 
                <?= $adminController->contestantsCount() ?>, 
                <?= $adminController->examineesCount() ?>
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',  // Darker red
                'rgba(54, 162, 235, 0.8)',  // Darker blue
                'rgba(255, 206, 86, 0.8)',  // Darker yellow
                'rgba(57, 255, 20, 0.8)'   // Darker green
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</script>
<?php require __DIR__ . '/./partials/footer.php' ?>
