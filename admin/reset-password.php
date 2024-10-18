<?php
require __DIR__ . '/./partials/header.php'
?>
<div class="h-100-vh d-flex align-items-center justify-content-center bg-danger">

    <div class="container">
        <form name="reset-pass" class="m-auto" id="signup-card">
            <div class="card">
                <div class="card-body">
                    <a href="login.php" class="btn btn-secondary mb-3"><i class="bx bx-arrow-back"></i></a>
                    <h5 class="mb-3 text-center">Reset Password</h5>

                    <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to login page....</p>
                    <p class="alert alert-danger py-2 d-none" id="alert-error"></p>

                    <label for="">Email</label>
                    <input type="email" class="form-control my-2" placeholder="Enter email" name="email">
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <label for="">Verification Code</label>
                    <input type="text" class="form-control my-2" placeholder="Enter verification code" name="verification">
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <label for="">New Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control my-2" placeholder="Enter new-password" name="new_pass">
                        <i class="bx bx-show fs-4 position-absolute top-0 end-0 mt-2 me-2" style="cursor: pointer;" id="show-pass1"></i>
                    </div>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <label for="">Confirm Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control my-2" placeholder="Re-enter new-password" name="confirm">
                        <i class="bx bx-show fs-4 position-absolute top-0 end-0 mt-2 me-2" style="cursor: pointer;" id="show-pass2"></i>
                    </div>
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
                    alertError.classList.add("d-none");
                    alert.classList.remove("d-none");
                }, 3000);
                setTimeout(() => {
                    window.location.href = "login.php";
                }, 7000);
            } else if (dataResponse === 'error') {
                alert.classList.add("d-none");
                setTimeout(() => {
                    alertError.classList.remove("d-none");
                    alertError.textContent = 'Error, Account doesn\'t exist';
                    resetPassword["button"].classList.remove("disabled");
                }, 3000);
            } else if (dataResponse === 'error_confirm') {
                alert.classList.add("d-none");
                setTimeout(() => {
                    alertError.classList.remove("d-none");
                    alertError.textContent = 'Error, Passwond don\'t match';
                    resetPassword["button"].classList.remove("disabled");
                }, 3000);
            } else if (dataResponse === 'error_verification') {
                alert.classList.add("d-none");
                setTimeout(() => {
                    alertError.classList.remove("d-none");
                    alertError.textContent = 'Error, Incorrect verification code';
                    resetPassword["button"].classList.remove("disabled");
                }, 3000);
            }
        } catch (error) {
            console.error(error);
        }
    };

    const resetPassword = document.forms["reset-pass"];

    resetPassword.onsubmit = (e) => {
        e.preventDefault();
        let errors = document.querySelectorAll(".errors");
        let loadingSignup = document.getElementById("loading-signup");

        const datas = {
            email: resetPassword["email"].value,
            verification: resetPassword["verification"].value,
            new_pass: resetPassword["new_pass"].value,
            confirm: resetPassword["confirm"].value,
            reset_password: true
        };

        if (datas.email == '') {
            errors[0].classList.remove("d-none");
            errors[0].innerHTML = "Please fill email";
        } else {
            errors[0].classList.add("d-none");
        }

        if (datas.verification == '') {
            errors[1].classList.remove("d-none");
            errors[1].innerHTML = "Please fill verification";
        } else {
            errors[1].classList.add("d-none");
        }

        if (datas.new_pass == '') {
            errors[2].classList.remove("d-none");
            errors[2].innerHTML = "Please fill password";
        } else {
            errors[2].classList.add("d-none");
        }

        if (datas.confirm == '') {
            errors[3].classList.remove("d-none");
            errors[3].innerHTML = "Please fill password";
        } else {
            errors[3].classList.add("d-none");
        }

        if (datas.new_pass !== datas.confirm) {
            errors[2].classList.remove("d-none");
            errors[2].innerHTML = "Password don't match";
        } else {
            errors[2].classList.add("d-none");
        }

        if (datas.email !== "" && datas.verification !== "" && datas.new_pass !== "" && datas.confirm !== "" && datas.new_pass === datas.confirm) {
            login(datas);
            resetPassword["button"].classList.add("disabled");
            loadingSignup.classList.remove("d-none");
            setTimeout(() => {
                loadingSignup.classList.add("d-none");
            }, 3000);
        }
    };


    let showPass1 = document.getElementById('show-pass1');
    showPass1.onclick = () => {
        let passwordInp = document.forms['reset-pass']['new_pass'];
        if (passwordInp.getAttribute('type') == 'password') {
            showPass1.classList.replace('bx-show', 'bx-low-vision')
            passwordInp.setAttribute('type', 'text')
        } else {
            showPass1.classList.replace('bx-low-vision', 'bx-show')
            passwordInp.setAttribute('type', 'password')
        }
    }

    let showPass2 = document.getElementById('show-pass2');
    showPass2.onclick = () => {
        let confirmInp = document.forms['reset-pass']['confirm'];
        if (confirmInp.getAttribute('type') == 'password') {
            showPass2.classList.replace('bx-show', 'bx-low-vision')
            confirmInp.setAttribute('type', 'text')
        } else {
            showPass2.classList.replace('bx-low-vision', 'bx-show')
            confirmInp.setAttribute('type', 'password')
        }
    }
</script>
<?php require __DIR__ . '/./partials/footer.php' ?>