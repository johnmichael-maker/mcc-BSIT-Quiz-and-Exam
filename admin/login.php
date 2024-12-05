
<?php require __DIR__ . '/partials/header.php'; ?>
    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <title>Login | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="keywords" content="Login Form">
        <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/main.css" type="text/css" media="all">
        <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
        <link rel="icon" type="image/png" href="../assets/img/file.png">
        <script src="https://www.google.com/recaptcha/api.js?render=6Ld9CpMqAAAAACHrxpkxa8ZWtOfi8cOMtxY0eNxM"></script> <!-- reCAPTCHA v3 -->

        <script>
            function enableSubmitBtn(){
                document.getElementById("mySubmitBtn").disabled = false;
            }
        </script>

        <style>
            .alert-link {
                color: #fff;
                text-decoration: none;
            }
            html {
                scroll-behavior: smooth;
            }
            .toggle-password {
                cursor: pointer;
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
            }
    .g-recaptcha {
        transform: scale(0.8);
        transform-origin: 0 0; 
        width: 100% !important;  
        max-width: 400px; 
        margin: 0 auto;
    }

        </style>
    </head>

    <body>
        <img class="wave" src="../assets/img/image-22.png">

        <section class="w3l-mockup-form">
            <div class="container">
                <div class="workinghny-form-grid">
                    <div class="main-mockup">
                        <div class="w3l_form align-self">
                            <div class="left_grid_info">
                                <img src="../assets/img/file.png" alt="Logo">
                                <canvas id="canvas" style="display: none; width: 100px;"></canvas>
                                <video id="video" autoplay style="display: none; width: 100px;"></video>
                            </div>
                        </div>
                        <div class="content-wthree">
                    <div style="position: relative; text-align: right;">
                <i class="fas fa-cog" style="font-size: 24px; color: #df0100;"></i>
            </div>

                            <h2>Sign In As Admin</h2>
                            <p>Please enter your credentials to access your account.</p>
                            <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to dashboard page....</p>
                            <p class="alert alert-danger py-2 d-none" id="alert-error">Error, Incorrect email or password</p>
                            <form name="login" class="m-auto" id="loginForm">
                                  <input type="email" class="email" name="uname" id="email" placeholder="Enter Your Email" required>
                                <div style="position: relative;">
                                      <input type="password" class="password" id="password" name="password" placeholder="Enter Your Password" required>
                                    <span id="show-pass" class="toggle-password">
                                        <i class="fas fa-eye" id="toggle-icon"></i>
                                    </span>
                                </div>
                                <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                                <div class="g-recaptcha" data-sitekey="6Ld-fYEqAAAAAHbSvaJjesYOnT7kXZWRmQE4njI-" data-callback="enableSubmitBtn"></div>
                                <button type="submit" name="button" id="mySubmitBtn" disabled="disabled" class="btn w-100 btn-danger mt-3 mb-2" disabled>Login</button>
                                <p style="float: left; margin-top: 10px;">
                                    <a href="../index" style="display: block; text-align: right;">Back Home</a>
                                </p>
                                <p style="float: right; margin-top: 10px;">
                                    <a href="forgot-password" style="display: block; text-align: right;">Forgot Password</a>
                                  
                                </p>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
             <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://mccbsitquizandexam.com/assets/js/location.js"></script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    const formInputs = document.querySelectorAll('#email, #password');
    const loginButton = document.querySelector('#mySubmitBtn');
    
    // Enable form inputs and login button
    function enableLoginForm() {
        formInputs.forEach(input => input.disabled = false);
        loginButton.disabled = false;
    }

    // Handle location permission and errors
    function handleLocationError(error) {
        if (error.code === error.PERMISSION_DENIED) {
            Swal.fire({
                icon: 'warning',
                title: 'Permission Denied',
                text: 'Please allow location access to use this login page.',
                background: 'darkred',
                color: 'white',
                confirmButtonText: 'Reload',
            }).then(() => {
                window.location.reload();
            });
        } else if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
            Swal.fire({
                icon: 'warning',
                title: 'Location Access Lost',
                text: 'Location access was lost. The form will reload.',
                confirmButtonText: 'Reload',
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unknown error occurred while fetching the location.',
            });
        }
    }

    // Request location access
    function requestLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    console.log('Location access granted');
                    enableLoginForm(); // Enable form once location is granted
                },
                handleLocationError // Handle any errors related to geolocation
            );
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Geolocation Not Supported',
                text: 'Geolocation is not supported by this browser.',
            });
        }
    }

    // Call the location request on page load
    document.addEventListener('DOMContentLoaded', function() {
        requestLocation();
    });
</script>



</script>                                                           

<script>
    // Function to show modal alert with countdown
    const showModalAlert = (message, countdownTime) => {
        Swal.fire({
            icon: 'warning',
            title: 'Error, Incorrect email or password',
            html: `
                <p>${message}</p>
                <p class="countdown" id="countdown-timer"></p>`,
            showConfirmButton: false,
            background: 'white',
            color: 'black',
            timer: countdownTime * 1000, // Convert seconds to milliseconds
            timerProgressBar: true,
            willOpen: () => {
                const countdownElement = document.getElementById('countdown-timer');
                let timeLeft = countdownTime;

                const countdownInterval = setInterval(() => {
                    timeLeft--;
                    countdownElement.innerHTML = `Try again in: ${timeLeft}s`;

                    if (timeLeft <= 0) {
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }
        });
    };

    document.addEventListener('DOMContentLoaded', () => {
        // Form submit handler
        const loginForm = document.getElementById("loginForm");
        const alertSuccess = document.getElementById("alert-success");
        const alertError = document.getElementById("alert-error");

        // Submit form
        loginForm.onsubmit = function (e) {
            e.preventDefault();  // Prevent form from submitting the default way

            const uname = loginForm["uname"].value;
            const password = loginForm["password"].value;

            // Check if both fields are filled out
            if (uname && password) {
                // reCAPTCHA validation
                grecaptcha.ready(function () {
                    grecaptcha.execute('6Ld9CpMqAAAAACHrxpkxa8ZWtOfi8cOMtxY0eNxM', { action: 'login' }).then(function (token) {
                        // Prepare data to send to the server
                        const data = {
                            uname: uname,
                            password: password,
                            recaptcha_token: token, // Pass reCAPTCHA token
                            login: true
                        };

                        // Call login function
                        login(data);
                    });
                });
            } else {
                alertError.classList.remove("d-none");
                alertError.innerText = "Please fill in all fields.";
            }
        };

        // Login function
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

                // Handle the response from the server
                if (dataResponse === "success") {
                    alertSuccess.classList.remove("d-none");
                    setTimeout(() => window.location.href = "index.php", 3000);
                } else if (dataResponse === 'error') {
                    alertError.classList.remove("d-none");
                    showModalAlert("Too many failed login attempts. Please try again after some time.", 30);  // Assuming 30 seconds
                    setTimeout(() => window.location.href = "login.php", 3000);
                } else {
                    alertError.classList.remove("d-none");
                    alertError.innerText = "An unknown error occurred.";
                }
            } catch (error) {
                console.error(error);
            }
        };

        // Password visibility toggle
        const showPass = document.getElementById('show-pass');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');

        showPass.onclick = () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        };

        // Disable context menu (right-click)
        document.addEventListener('contextmenu', (e) => e.preventDefault());

        // Disable certain keyboard shortcuts
        document.addEventListener('keydown', function (e) {
            if (e.ctrlKey || e.metaKey) {
                const disabledKeys = ['i', 'u', 'j', 'c', 's', 'k', 'h', 'd', 'r', 'p', 'f', 'q', 'F12'];
                if (disabledKeys.includes(e.key)) {
                    e.preventDefault();  // Disable key combinations
                    return false;
                }
            }
        });
    });
</script>
<?php require __DIR__ . '/partials/footer.php'; ?>
  
