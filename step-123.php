<?php
// Database.php

$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = '';
$errorMessage = '';

function generateVerificationCode($length = 20) {
    return bin2hex(random_bytes($length / 2));
}

function validateFormInput($input) {
    return trim(htmlspecialchars($input));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $firstName = validateFormInput($_POST['firstName']);
    $middleName = validateFormInput($_POST['middleName']);
    $lastName = validateFormInput($_POST['lastName']);
    $email = validateFormInput($_POST['email']);
    $phone = validateFormInput($_POST['phone']);  
    $address = validateFormInput($_POST['address']);
    $username = validateFormInput($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $verification = generateVerificationCode();

   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email address.";
    } else {

        
        if ($stmt = $conn->prepare("SELECT admin_id FROM admin WHERE email = ? OR username = ?")) {
            $stmt->bind_param('ss', $email, $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errorMessage = "An account with this email or username already exists.";
            } else {

               
                $conn->begin_transaction();
                try {

                    
                    $img = '../assets/img/logo.png'; 
                    $userType = 2;  

                    
                    if ($stmt = $conn->prepare("INSERT INTO admin (username, img, email, firstName, middleName, lastName, phone, address, password, verification, userType, created_at) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())")) {
                        
                        $stmt->bind_param('sssssssssss', $username, $img, $email, $firstName, $middleName, $lastName, $phone, $address, $password, $verification, $userType);
                        $stmt->execute();
                    } else {
                        throw new Exception($conn->error); 
                    }

                    
                    $conn->commit();
                    $successMessage = "Registration successful!";
                } catch (Exception $e) {
                    
                    $conn->rollback();
                    error_log($e->getMessage(), 3, 'errors.log'); 
                    $errorMessage = "An error occurred during registration. Please try again. Error: " . $e->getMessage();
                }
            }
        } else {
            $errorMessage = "Database error. Please try again later.";
        }
    }
}
?>
    <?php  
// Database connection (using PDO)
$host = 'localhost';
$dbname = 'u510162695_bsit_quiz';
$username = 'u510162695_bsit_quiz';
$password = '1Bsit_quiz';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Get token from URL
$token = isset($_GET['token']) ? $_GET['token'] : '';

// Check if token is provided
if (empty($token)) {
    // Redirect to error page if no token is provided
    header("Location: error_page.php");
    exit();
}

// Query to check if the token exists in the database
$query = "SELECT * FROM ms_365_instructor WHERE token = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$token]);
$user = $stmt->fetch();

// If token does not exist or is expired, redirect to error page
if (!$user) {
    header("Location: error_page.php");
    exit();
}

// Token exists, proceed to show the registration form
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/file.png">
    <title>Instructor | Registration</title>
    <style>
        #year_levelField {
            display: none;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        .toggle-password-icon {
            font-size: 16px;
        }

        .toggle-password:hover .toggle-password-icon {
            color: #333;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .is-invalid {
            border: 1px solid red;
        }

        .field {
            margin-bottom: 15px;
            position: relative;
        }

        .invalid-feedback {
            position: absolute;
            bottom: -20px;
            left: 0;
            display: none;
        }
        #warning_message {
            font-size: 12px;
            margin-top: -30px;
            margin-bottom: -10px;
            display: none;
            color: red;
        }
        #warning_messages {
            font-size: 12px;
            margin-top: -30px;
            margin-bottom: -10px;
            display: none;
            color: red;
        }

         /* Modal styles */
         .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow-y: auto;
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 1% auto; /* 5% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 600px;
        }

        #confirmSignupBtn {
            padding: 10px;
            background-color: #F40009;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        #confirmSignupBtn:hover,
        #confirmSignupBtn:focus {
            background-color: darkred;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 16px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .containers {
            display: flex;
            flex-wrap: wrap;
        }

        .containers .card {
            flex: 1 1 100%;
            max-width: 100%;
        }

        @media(min-width: 600px) {
            .containers .card {
                flex: 1 1 45%;
            }
        }

        @media(min-width: 900px) {
            .containers .card {
                flex: 1 1 30%;
            }
        }
        .form-check-label a{
            text-decoration: none;
        }
        #password-strength {
    margin-top: 10px;
}

#strength-bar {
    transition: width 0.3s ease;
}

.d-none {
    display: none;
}

.text-muted {
    font-size: 12px;
}
.field {
            position: relative;
            margin-bottom: 20px;
        }
        .label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            cursor: pointer;
            transform: translateY(-50%);
        }
    </style>
</head>
<link rel="stylesheet" href="../assets/css/alertify.min.css" />
<link rel="stylesheet" href="../assets/css/alertify.bootstraptheme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="./assets/css/ms.css">
<body style="background-image: url('assets/img/image-22.png'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="container">
        <header>
            <h5>Instructor<br><span>Registration</span></h5>
        </header>
        <header>
            <p style="color:#3b3663;">Madridejo Community College</p>
        </header>
        <div class="form-outer">
    <form id="registrationForm" method="POST" action="" enctype="multipart/form-data">
        <!-- Step 1 - Personal Details -->
        <div class="page slide-page">
            <div class="title">Personal Information:</div>
            <div class="field">
                <div class="label">First Name</div>
                <input type="text" name="firstName" id="firstName" placeholder="Enter First Name" required />
            </div>
            <div class="field">
                <div class="label">Middle Name</div>
                <input type="text" name="middleName" id="middleName" placeholder="Enter Middle Name" required />
            </div>
            <div class="field">
                <div class="label">Last Name</div>
                <input type="text" name="lastName" id="lastName" placeholder="Enter Last Name" required />
            </div>
            <div class="field option">
                <button type="button" class="firstNext next">Next</button>
            </div>
        </div>

        <!-- Step 2 - Contact Information -->
        <div class="page">
            <div class="title">Contact Info:</div>
            <div class="field">
    <div class="label">Email</div>
    <input type="email" name="email" id="email" placeholder="MS 365 Email" required />
    <span id="email-error" style="color: red; display: none; font-size: 12px;">Invalid email format. Please use a valid email from mcclawis.edu.ph domain.</span>
</div>

            <div class="field">
                <div class="label">Phone No.</div>
                <input type="tel" id="phone" name="phone" maxlength="11" placeholder="Enter Phone Number" required pattern="09\d{9}" />
                <div id="warning_message" style="display: none; margin-top:5px;">Invalid phone number. It should start with 09 and contain 11 digits.</div>
            </div>
            <div class="field">
                <div class="label">Address</div>
                <input type="text" name="address" id="address" placeholder="Enter Address" required />
            </div>
            <div class="field btns">
                <button type="button" class="prev-1 prev">Previous</button>
                <button type="button" class="next-1 next">Next</button>
            </div>
        </div>

        <!-- Step 3 - Login Details -->
        <div class="page">
            <div class="title">Login Details:</div>
            <div class="field">
                <div class="label">User Name</div>
                <input type="email" name="username" class="email" id="username" placeholder="Enter Email" required />
            </div>
             <div class="field">
        <div class="label">Password</div>
        <input type="password" name="password" id="passwordInput" placeholder="Enter Password" required />
        <span id="show-pass" class="toggle-password">
            <i class="fas fa-eye" id="toggle-icon-password"></i>  
        </span>
    </div>
<div class="field">
        <div class="label">Confirm Password</div>
        <input type="password" name="cpassword" id="confirmPasswordInput" placeholder="Confirm Password" required />
        <span id="show-pass-confirm" class="toggle-password">
            <i class="fas fa-eye" id="toggle-icon-confirm"></i>  
        </span>
    </div>

<div id="password-strength" class="d-none">
    <p class="text-muted" id="strength-text"></p>
    <div class="progress" style="height: 5px;">
        <div id="strength-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">I agree to the <a href="#" target="_blank">Terms and Conditions</a></label>
            </div>
            <div class="field btns">
                <button type="button" class="prev-2 prev">Previous</button>
                <button type="submit" id="confirmSignupBtn">Signup</button>
            </div>
        </div>
    </form>
</div>
    <!-- Scripts for Form Validation -->
    <script src="assets/js/format_number.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/validation.js"></script>
    <script src="assets/js/show-hide-password.js"></script>
    <!-- SweetAlert 2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
      const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');

        // Ensure the token is present and valid
        if (!token || token.length !== 32) {
            window.location.href = "error_page.html";  // Redirect to error page if token is invalid
        }
        
        function togglePasswordVisibility(passwordFieldId, iconId) {
            const passwordField = document.getElementById(passwordFieldId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordField.type === "password") {
                passwordField.type = "text"; 
                toggleIcon.classList.remove("fa-eye"); 
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";  
                toggleIcon.classList.remove("fa-eye-slash");  
                toggleIcon.classList.add("fa-eye");
            }
        }

        
        document.getElementById("show-pass").addEventListener("click", function() {
            togglePasswordVisibility("passwordInput", "toggle-icon-password");
        });

        
        document.getElementById("show-pass-confirm").addEventListener("click", function() {
            togglePasswordVisibility("confirmPasswordInput", "toggle-icon-confirm");
        });
    </script>
    <script>
        
function validateEmailDomain() {
    const emailInput = document.getElementById("email");
    const email = emailInput.value;
    const errorSpan = document.getElementById("email-error");


    const emailPattern = /^[a-zA-Z0-9._%+-]+@mcclawis\.edu\.ph$/;

    
    if (emailPattern.test(email)) {
        
        errorSpan.style.display = "none";
        return true;
    } else {
        
        errorSpan.style.display = "block";
        return false;
    }
}


document.getElementById("email").addEventListener("input", validateEmailDomain);


        
function checkPasswordStrength(password) {
    let strength = 0;

    
    const patterns = [
        /[a-z]/,  
        /[A-Z]/,  
        /[0-9]/,  
        /[^A-Za-z0-9]/,  
    ];

    
    patterns.forEach(pattern => {
        if (pattern.test(password)) {
            strength += 25;
        }
    });

    
    if (password.length >= 8) {
        strength += 10;
    }

    return strength;
}


function updatePasswordStrength(password) {
    const strength = checkPasswordStrength(password);
    const strengthText = document.getElementById("strength-text");
    const strengthBar = document.getElementById("strength-bar");
    const passwordStrengthDiv = document.getElementById("password-strength");

    
    if (password.length > 0) {
        passwordStrengthDiv.classList.remove("d-none");
    } else {
        passwordStrengthDiv.classList.add("d-none");
        return;
    }

    
    strengthBar.style.width = `${strength}%`;
    strengthBar.setAttribute("aria-valuenow", strength);


    if (strength < 30) {
        strengthText.textContent = "Weak Password";
        strengthBar.classList.remove("bg-success", "bg-warning", "bg-danger");
        strengthBar.classList.add("bg-danger");
    } else if (strength < 60) {
        strengthText.textContent = "Moderate Password";
        strengthBar.classList.remove("bg-success", "bg-danger", "bg-warning");
        strengthBar.classList.add("bg-warning");
    } else {
        strengthText.textContent = "Strong Password";
        strengthBar.classList.remove("bg-warning", "bg-danger", "bg-success");
        strengthBar.classList.add("bg-success");
    }
}

document.getElementById("passwordInput").addEventListener("input", function() {
    const password = this.value;
    updatePasswordStrength(password);
});


document.getElementById("confirmPasswordInput").addEventListener("input", function() {
    const password = document.getElementById("passwordInput").value;
    const confirmPassword = this.value;
    if (confirmPassword && confirmPassword !== password) {
        this.setCustomValidity("Passwords do not match");
    } else {
        this.setCustomValidity("");
    }
});

    
    function sanitizeInput(value) {
        
        const sanitizedValue = value.replace(/<script.*?>.*?<\/script>/gi, "")  
                                    .replace(/<.*?>/g, "")  
                                    .replace(/[\x00-\x1F\x7F-\x9F]/g, ""); 
        return sanitizedValue;
    }

    
    function validateInputs() {
        const inputs = document.querySelectorAll("input");
        let isValid = true;

        inputs.forEach(function(input) {
            let value = input.value.trim();
            value = sanitizeInput(value);  
            input.value = value;  

            
            if (input.name === "firstName" || input.name === "middleName" || input.name === "lastName") {
                if (!/^[a-zA-Z\s]+$/.test(value)) {
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid name entered',
                        text: 'Only letters and spaces are allowed for names.',
                    });
                    isValid = false;
                }
            }
            if (input.name === "email") {
        
                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid email format',
                        text: 'Please enter a valid email address.',
                    });
                    isValid = false;
                }
            }
            if (input.name === "phone") {
             
                if (!/^09\d{9}$/.test(value)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid phone number',
                        text: 'Phone number must start with "09" and be 11 digits long.',
                    });
                    isValid = false;
                }
            }
        });

        return isValid;
    }

    
    document.getElementById("registrationForm").addEventListener("submit", function(e) {
        if (!validateInputs()) {
            e.preventDefault();
        }
    });

</script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (!empty($successMessage)) { ?>
            Swal.fire({
                title: 'Success!',
                text: '<?php echo $successMessage; ?>',
                icon: 'success'
            }).then(function() {
            
                window.location.href = './admin/login.php';
            });
        <?php } elseif (!empty($errorMessage)) { ?>
            Swal.fire({
                title: 'Error!',
                text: '<?php echo $errorMessage; ?>',
                icon: 'error'
            });
        <?php } ?>
    });
</script>
    <script>
        
        const slidePage = document.querySelector(".slide-page");

const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const confirmSignupBtn = document.querySelector("#confirmSignupBtn");


        
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const phonePattern = /^09\d{9}$/; 
        const addressPattern = /^[a-zA-Z\s]+,\s[a-zA-Z\s]+,\s[a-zA-Z\s]+$/; 

        
        nextBtnFirst.addEventListener("click", function () {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const middleName = document.getElementById('middleName').value;

            if (!firstName || !lastName || !middleName) {
                Swal.fire({
                    title: "Error!",
                    text: "Please fill in all fields.",
                    icon: "error"
                });
            } else {
                slidePage.style.marginLeft = "-25%";
            }
        });

    
        nextBtnSec.addEventListener("click", function () {
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;

            if (!phonePattern.test(phone)) {
                document.getElementById('warning_message').style.display = "block";
            } else if (!address) {
                Swal.fire({
                    title: "Error!",
                    text: "Please fill in your address.",
                    icon: "error"
                });
            } else {
                document.getElementById('warning_message').style.display = "none";
                slidePage.style.marginLeft = "-50%";
            }
        });

        prevBtnSec.addEventListener("click", function () {
        slidePage.style.marginLeft = "0%"; 
    });

    prevBtnThird.addEventListener("click", function () {
        slidePage.style.marginLeft = "-25%"; 
    });


        
        nextBtnThird.addEventListener("click", function () {
            const password = document.getElementById('passwordInput').value;
            const confirmPassword = document.getElementById('confirmPasswordInput').value;

            if (password !== confirmPassword) {
                Swal.fire({
                    title: "Error!",
                    text: "Passwords do not match.",
                    icon: "error"
                });
            } else if (!passwordPattern.test(password)) {
                Swal.fire({
                    title: "Weak Password",
                    text: "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.",
                    icon: "error"
                });
            } else {
                slidePage.style.marginLeft = "-75%";
            }
        });


        document.getElementById('registrationForm').addEventListener('submit', function (e) {
            const password = document.getElementById('passwordInput').value;
            const confirmPassword = document.getElementById('confirmPasswordInput').value;

            
            if (password !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Passwords do not match. Please try again.',
                });
                return;
            }

            if (!passwordPattern.test(password)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.',
                });
                return;
            }

            
            Swal.fire({
                icon: 'success',
                title: 'Registration Complete',
                text: 'Your registration was successful!',
            });
        });
        
        
        document.getElementById('phone').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>

    

    
