<?php require __DIR__ . '/./partials/header.php' ?>
<div class="h-100-vh d-flex align-items-center justify-content-center bg-danger">

<div class="container">
    <form name="login" class="m-auto" id="signup-card">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Sign In As Admin</h5>

                <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to questions page....</p>
                <p class="alert alert-danger py-2 d-none" id="alert-error">Error, Incorrect username or password</p>

                <label for="">Username</label>
                <input type="text" class="form-control my-2" placeholder="Username" name="uname">
                <p class="errors d-none alert alert-danger py-1"></p>

                <label for="">Password</label>
                <input type="password" class="form-control my-2" placeholder="Password" name="password">
                <p class="errors d-none alert alert-danger py-1"></p>

                <button type="submit" name="button" class="w-100 btn btn-danger mt-3">Submit</button>
                <div class="text-center d-none" id="loading-signup">
                    <div class="spinner-border mt-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

</div>
<?php require __DIR__ . '/./partials/footer.php' ?>