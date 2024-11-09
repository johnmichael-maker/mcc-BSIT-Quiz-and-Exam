<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/file.png">
    <title>Forgot Password</title>
    
    <link rel="stylesheet" href="../assets/css/bootstrap5.min.css" />
    <link rel="stylesheet" href=".assets/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/liness.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/login.css">

    <style>
        .back {
            font-size: 30px;
            color: black;
        }
        .back:hover {
            color: gray;
        }
        .home-link {
            text-decoration: none;
            color: #3b3663;
        }
        .home-link:hover {
            color: crimson;
        }
    </style>
</head>

<body style="background-image: url('../assets/img/image-22.png'); background-size: cover; background-position: center; background-attachment: fixed;">

    <section class="d-flex mt-1 flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="col mx-auto rounded shadow bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <img src="../assets/img/file.png" alt="logo"
                                 class="img-fluid d-none d-md-block  p-5" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 px-5 " style="margin-top: 60px;">
                        <div class="mt-3 mb-4">
                            <center>
                                <h2 class="m-0 fw-semibold text-danger">
                                    FORGOT PASSWORD
                                </h2>
                                <br>
                                <p class="fs-5 fw-semibold">Please enter the email address</p>
                            </center>
                        </div>
                       
                        <form name="forgot-pass" id="forgotPassForm" action="#" method="post" class="needs-validation" novalidate>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Enter your MS 365 Email" required>
                                    <label for="email">Email</label>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        Please enter your MS 365 Email.
                                    </div>
                                    
                                    <div class="errors d-none text-danger"></div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 md-3">
                                <button type="submit" name="button" class="btn btn-danger text-light font-weight-bolder btn-lg">Submit</button>
                            </div>

                           
                            <div id="loading-signup" class="d-none text-center mt-3">
                                <i class="bi bi-arrow-repeat spinner-border text-primary" role="status"></i>
                                <span>Sending...</span>
                            </div>

                            <div class="text-start mt-5 fw-bold">
                                <p>
                                    <a class="home-link" href="login.php">Back Home</a>
                                </p>
                            </div>
                        </form>

                        
                        <div id="alert-success" class="alert alert-success d-none mt-3">Password reset link sent successfully!</div>
                        <div id="alert-error" class="alert alert-danger d-none mt-3">Error, email address not found.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="assets/js/validation.js"></script>
    <script src="assets/js/show-hide-password.js"></script>
    <script src="assets/js/format_number.js"></script>
    <script src="assets/js/bootstrap5.bundle.min.js"></script>
    <script src="assets/js/tooltip.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="assets/js/alertify.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
