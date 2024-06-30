<?php require __DIR__ . '/./partials/header.php'; ?>

<div class="container py-5">
    <div class="card rounded-0">

        <div class="card-body p-4">

            <div class="row">

                <div class="col-lg-12 text-center">
                    <img src="./assets/img/logo.png" alt="" style="width: 150px;" class="position-absolute start-0 top-0 mt-3">
                    <h3>Madridejos Community College</h3>
                    <p class="mb-0">Examination of BSIT - 2 section North</p>
                    <p>Date: 10/10/2023</p>
                </div>

                <?php 
                    $stmt = $examineeController->getExamById();
                    foreach ($stmt as $row): 
                ?>

                <div class="col-lg-12">
                        
                </div>

                <?php endforeach; ?>

            </div>


        </div>
    </div>
</div>

<?php require __DIR__ . '/./partials/footer.php' ?>