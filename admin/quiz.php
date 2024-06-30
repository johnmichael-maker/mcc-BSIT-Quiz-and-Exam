<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">
       
        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>


            <?php 
                $adminController->confirmSession()
            ?>


        </div>

    </div>
</div>
<?php require __DIR__ . '/./partials/footer.php' ?>