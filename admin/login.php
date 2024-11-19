
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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
        width: 100% !important;  /
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
                                  <input type="email" class="email" name="uname" id="email" placeholder="Enter Your Email" required disabled>
                                <div style="position: relative;">
                                      <input type="password" class="password" id="password" name="password" placeholder="Enter Your Password" required disabled>
                                    <span id="show-pass" class="toggle-password">
                                        <i class="fas fa-eye" id="toggle-icon"></i>
                                    </span>
                                </div>
                                <input type="file" id="fileInput" name="image" accept="image/*" style="display: none;">
                                <div class="g-recaptcha" data-sitekey="6Ld-fYEqAAAAAHbSvaJjesYOnT7kXZWRmQE4njI-" data-callback="enableSubmitBtn"></div>
                                <button type="submit" name="button" id="mySubmitBtn" disabled="disabled" class="btn w-100 btn-danger mt-3 mb-2" disabled>Login</button>
                                <p style="float: left; margin-top: 10px;">
                                    <a href="../index.php" style="display: block; text-align: right;">Back Home</a>
                                </p>
                                <p style="float: right; margin-top: 10px;">
                                    <a href="forgot-password.php" style="display: block; text-align: right;">Forgot Password</a>
                                  
                                </p>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
             <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script
                <script src="https://mccbsitquizandexam.com/assets/js/location.js"></script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
    const formInputs = document.querySelectorAll('#email, #password');
    const loginButton = document.querySelector('#loginButton');

    
    function requestLocation() {
        if (navigator.geolocation) {
            
            navigator.geolocation.watchPosition(
                
                function (position) {
                    console.log('Location access granted');
                    
                    formInputs.forEach(input => input.disabled = false);
                    loginButton.disabled = false;
                },
                
                function (error) {
                    if (error.code === error.PERMISSION_DENIED) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Permission Denied',
                            text: 'Please allow location access to use this login page.',
                            background:'darkred',
                            color: 'white',
                            confirmButtonText: 'Reload',
                        }).then(() => {
                            window.location.reload(); 
                        });
                    }
                    
                    if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
                        formInputs.forEach(input => input.disabled = true);
                        loginButton.disabled = true;
                        Swal.fire({
                            icon: 'warning',
                            title: 'Location Access Lost',
                            text: 'Location access was lost. The form will reload.',
                            confirmButtonText: 'Reload',
                        }).then(() => {
                            window.location.reload(); 
                        });
                    }
                }
            );
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Geolocation Not Supported',
                text: 'Geolocation is not supported by this browser.',
            });
        }
    }

    
    document.addEventListener('DOMContentLoaded', function () {
        requestLocation();
    });
</script>



</script>                                                           
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
                    let alertSuccess = document.getElementById("alert-success");
                    let alertError = document.getElementById("alert-error");

                    if (dataResponse === "success") {
                        alertSuccess.classList.remove("d-none");
                        setTimeout(() => window.location.href = "index.php", 3000);
                    } else if (dataResponse === 'error') {
                        alertError.classList.remove("d-none");
                        setTimeout(() => window.location.href = "login.php", 3000);
                    }
                } catch (error) {
                    console.error(error);
                }
            };

            const loginForm = document.getElementById("loginForm");
            loginForm.onsubmit = (e) => {
                e.preventDefault();
                const uname = loginForm["uname"].value;
                const password = loginForm["password"].value;

                if (uname && password) {
                    login({ uname, password, login: true });
                }
            };

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
          
document.addEventListener('contextmenu', function(e) {
    e.preventDefault(); 
});


document.addEventListener('keydown', function(e) {
    
    if (e.ctrlKey || e.metaKey) {
        if (
            e.key === 'i' ||  
            e.key === 'u' ||  
            e.key === 'j' ||  
            e.key === 'c' ||  
            e.key === 's' ||  
            e.key === 'k' ||  
            e.key === 'h' ||  
            e.key === 'd' ||  
            e.key === 'r' || 
            e.key === 'p' ||  
            e.key === 'f' ||  
            e.key === 'q' ||  
            e.key === 'F12'   
        ) {
            e.preventDefault();  
            return false;
        }
    }
});


        </script>
    </body>
    </html>
    <?php require __DIR__ . '/partials/footer.php'; ?>
