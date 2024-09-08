<?php require __DIR__ . '/./partials/header.php' ?>
<style>
        .h-100-vh {
            height: 100vh;
        }

        .background-image {
            background-image: url('../assets/img/mcc.png'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
        }

        .d-flex {
            display: flex;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-content-center {
            justify-content: center;
        }
         .nav-link{
            text-decoration: none;
            color: rgb(128, 171, 184);
            float: right;
        }
        .home-link{
        text-decoration: none;
        color: rgb(128, 171, 184);
    }
        .smoke-color {
            color: #6f6f6f; 
           font-family: sans-serif;
        }
    </style>
<div class="h-100-vh d-flex align-items-center justify-content-center background-image">

    <div class="container">
        <form name="login" class="m-auto" id="signup-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Sign In As Admin</h5>
                    <p class="smoke-color">Madridejos Community College</p>
                    <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to dashboard page....</p>
                    <p class="alert alert-danger py-2 d-none" id="alert-error">Error, email address not found.</p>

                    <label for="">Username</label>
                    <input type="text" class="form-control my-2" placeholder="Username" name="uname"required>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <label for="">Password</label>
                   <div class="position-relative">
                    <input type="password" class="form-control my-2" placeholder="Password" name="password"required>
                    <i class="bx bx-show fs-4 position-absolute top-0 end-0 mt-2 me-2" style="cursor: pointer;" id="show-pass"></i>
                   </div>
                    <p class="errors d-none alert alert-danger py-1"></p>

                    <button type="submit" name="button" class="w-100 btn btn-danger mt-3 mb-2">Submit</button>
                        
                    <a  class="home-link" href="../index.php">Back Home</a>
                    <a href="forgot-password.php" class="nav-link">Forgot Password?</a>
                        
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
                    window.location.href = "index.php";
                }, 6000);
            } else if (dataResponse === 'error') {
                setTimeout(() => {
                    alertError.classList.remove("d-none");
                }, 3000);
                setTimeout(() => {
                    window.location.href = "login.php";
                }, 7000);
            }
        } catch (error) {
            console.error(error);
        }
    };

    const loginForm = document.forms["login"];

  
        loginForm.onsubmit = (e) => {
            e.preventDefault();
            let errors = document.querySelectorAll(".errors");
            let loadingSignup = document.getElementById("loading-signup");

            const datas = {
                uname: loginForm["uname"].value,
                password: loginForm["password"].value,
                login: true
            };

            if (datas.uname == '') {
                errors[0].classList.remove("d-none");
                errors[0].innerHTML = "Please fill username";
            } else {
                errors[0].classList.add("d-none");
            }

            if (datas.password == '') {
                errors[1].classList.remove("d-none");
                errors[1].innerHTML = "Please fill password";
            } else {
                errors[1].classList.add("d-none");
            }

            if (datas.uname !== "" && datas.password !== "") {
                login(datas);
                loginForm["button"].classList.add("disabled");
                loadingSignup.classList.remove("d-none");
                setTimeout(() => {
                    loadingSignup.classList.add("d-none");
                }, 3000);
            }
        };
    
    let showPass = document.getElementById('show-pass');
    showPass.onclick = () => {
        let passwordInp = document.forms['login']['password'];
        if (passwordInp.getAttribute('type') == 'password') {
            showPass.classList.replace('bx-show', 'bx-low-vision')
            
            passwordInp.setAttribute('type', 'text')
        }else{
            showPass.classList.replace('bx-low-vision', 'bx-show')
            passwordInp.setAttribute('type', 'password')
        }
    }
</script>
<?php require __DIR__ . '/./partials/footer.php' ?>
