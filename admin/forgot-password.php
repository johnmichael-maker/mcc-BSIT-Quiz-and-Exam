<?php 
    require __DIR__ . '/./partials/header.php'
?>
<div class="h-100-vh d-flex align-items-center justify-content-center bg-danger">

    <div class="container">
        <form name="forgot-pass" class="m-auto" id="signup-card">
            <div class="card">
                <div class="card-body">
                    <a href="login.php" class="btn btn-secondary mb-3"><i class="bx bx-arrow-back"></i></a>
                    <h5 class="mb-3 text-center">Forgot Password</h5>

                    <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to reset page....</p>
                    <p class="alert alert-danger py-2 d-none" id="alert-error">Error, Incorrect username or password</p>

                    <label for="">Email</label>
                    <input type="email" class="form-control my-2" placeholder="Enter email" name="email">
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <button type="submit" name="button" class="w-100 btn btn-danger mt-3 mb-2">Submit</button>

                   

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

<script>
    const login = async (data) => {
        try {
            const response = await fetch("../function/Process.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                throw new Error("Could not fetch resource");
            }
            const dataResponse = await response.text();
            console.log(dataResponse);

            let alert = document.getElementById("alert-success");
            let alertError = document.getElementById("alert-error");

            if (dataResponse === "success") {
                setTimeout(() => {
                    alert.classList.remove("d-none");
                }, 3000);
                setTimeout(() => {
                    window.location.href = "reset-password.php";
                }, 6000);
            } else if (dataResponse === 'error') {
                setTimeout(() => {
                    alertError.classList.remove("d-none");
                }, 3000);
                setTimeout(() => {
                    window.location.href = "forgot-password.php";
                }, 7000);
            }
        } catch (error) {
            console.error(error);
        }
    };

    const forgotPassForm = document.forms["forgot-pass"];

        forgotPassForm.onsubmit = (e) => {
            e.preventDefault();
            let errors = document.querySelectorAll(".errors");
            let loadingSignup = document.getElementById("loading-signup");

            const datas = {
                email: forgotPassForm["email"].value,
                forgot_password: true
            };

            if (datas.email == '') {
                errors[0].classList.remove("d-none");
                errors[0].innerHTML = "Please fill email";
            } else {
                errors[0].classList.add("d-none");
            }

            if (datas.email !== "") {
                login(datas);
                forgotPassForm["button"].classList.add("disabled");
                loadingSignup.classList.remove("d-none");
                setTimeout(() => {
                    loadingSignup.classList.add("d-none");
                }, 3000);
            }
        };
</script>
<?php require __DIR__ . '/./partials/footer.php' ?>