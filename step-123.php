<?php

// Database.php

$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for success and error messages
$successMessage = '';
$errorMessage = '';

// Function to generate a random verification string
function generateVerificationCode($length = 20) {
    return bin2hex(random_bytes($length / 2)); // Generates a random string of specified length
}

// Function to validate form inputs
function validateFormInput($input) {
    return trim(htmlspecialchars($input));
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and validate form data
    $firstName = validateFormInput($_POST['firstName']);
    $middleName = validateFormInput($_POST['middleName']);
    $lastName = validateFormInput($_POST['lastName']);
    $email = validateFormInput($_POST['email']);
    $phone = validateFormInput($_POST['phone']);
    $address = validateFormInput($_POST['address']);
    $username = validateFormInput($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Generate a random verification code
    $verification = generateVerificationCode();

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email address.";
    } else {
        // Check if username or email already exists in the admin table
        if ($stmt = $conn->prepare("SELECT admin_id FROM admin WHERE email = ? OR username = ?")) {
            $stmt->bind_param('ss', $email, $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $errorMessage = "An account with this email or username already exists.";
            } else {
                // Start a transaction to ensure both inserts happen
                $conn->begin_transaction();
                try {
                    // Insert into instructors table
                    if ($stmt = $conn->prepare("INSERT INTO instructors (first_name, middle_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)")) {
                        $stmt->bind_param('ssssss', $firstName, $middleName, $lastName, $email, $phone, $address);
                        $stmt->execute();
                    } else {
                        throw new Exception($conn->error);
                    }

                    // Insert into admin table with userType = 2 (Instructor)
                    $img = '../assets/img/logo.png'; // Default image
                    $userType = 2; // Set userType for instructor
                    if ($stmt = $conn->prepare("INSERT INTO admin (username, img, email, password, verification, userType, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())")) {
                        $stmt->bind_param('sssssi', $username, $img, $email, $password, $verification, $userType);
                        $stmt->execute();
                    } else {
                        throw new Exception($conn->error);
                    }

                    // Commit the transaction
                    $conn->commit();
                    $successMessage = "Registration successful!";
                } catch (Exception $e) {
                    // Rollback transaction in case of error
                    $conn->rollback();
                    error_log($e->getMessage(), 3, 'errors.log'); // Log error to a file
                    $errorMessage = "An error occurred during registration. Please try again.";
                }
            }
        } else {
            $errorMessage = "Database error. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
          body {
            background: url('./assets/img/image-22.png') no-repeat center center fixed;
            background-size: cover;
        }
        .loader-wrapper {
            position: fixed;
            z-index: 999999;
            background: #fff;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .loader {
            height: 100px;
            width: 100px;
            position: fixed;
        }
        .loader-inner {
            border: 0 solid transparent;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            position: absolute;
            top: calc(50vh - 75px);
            left: calc(50vw - 75px);
            border: 1em solid #34d7e2;
            animation: loader 2s linear infinite;
            opacity: 0;
            animation-delay: 0.5s;
        }
        @keyframes loader {
            0% { transform: scale(0); opacity: 0; }
            50% { opacity: 1; }
            100% { transform: scale(1); opacity: 0; }
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .progressbar {
            display: flex;
            justify-content: space-between;
            list-style-type: none;
            counter-reset: step;
            margin-bottom: 30px;
            padding: 0;
        }
        .progressbar li {
            counter-increment: step;
            text-align: center;
            flex-grow: 1;
            position: relative;
        }
        .progressbar li:before {
            content: counter(step);
            width: 30px;
            height: 30px;
            display: block;
            background-color: #ddd;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            line-height: 30px;
            text-align: center;
        }
        .progressbar li.active:before {
            background-color: #007bff;
            color: white;
        }
        .progressbar li:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ddd;
            top: 15px;
            left: -50%;
            z-index: -1;
        }
        .progressbar li:first-child:after {
            content: none;
        }
        .progressbar li.active + li:after {
            background-color: #007bff;
        }
        h3{
            text-align: center;
            color: #007bff;
        }
         .link-primary{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="loader-wrapper" id="preloader">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    </script>

    <div class="container mt-5" style="max-width: 600px;">
        <ul class="progressbar">
            <li class="active" id="progress1" style="color:#fff;"><b>Step 1</b></li>
            <li id="progress2"style="color:#fff;"><b>Step 2</b></li>
            <li id="progress3"style="color:#fff;"><b>Step 3</b></li>
        </ul>

        <div class="card" style="box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);">
            <div class="card-body">
                <!-- Step 1: Personal Info -->
                <form id="registrationForm" method="POST" action="">
                    <div id="step1" class="step active">
                        <h3><b>Instructor Registration</b></h3>
                        <h4 class="text-center mb-4">Personal Information</h4>
                        <div class="col-md-12 mb-2">
                            <label for="firstName">Firstname</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Firstname" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="middleName">Middlename</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middlename">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="lastName">Lastname</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Lastname" required>
                        </div>
                        <button type="button" class="btn btn-danger w-100 mt-3" id="next1">Next</button>
                    </div>

                    <!-- Step 2: Contact Info -->
                    <div id="step2" class="step">
                        <h4 class="text-center mb-4">Contact Information</h4>
                        <div class="col-md-12 mb-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 mb-3">
                          <label for="phone">Phone number</label>
                         <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone number" maxlength="11" pattern="\d{11}" title="Please enter an 11-digit phone number" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address"></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary w-100 mt-3" id="prev1">Previous</button>
                        <button type="button" class="btn btn-danger w-100 mt-3" id="next2">Next</button>
                    </div>

                    <!-- Step 3: Account Info -->
                    <div id="step3" class="step">
                        <h4 class="text-center mb-4">Account Information</h4>
                        <div class="col-md-12 mb-2">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <input type="checkbox" id="showPassword"> Show Password
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                            <input type="checkbox" id="showConfirmPassword"> Show Password
                        </div>
                        
                        <div class="fv-row mb-10">
        <label class="form-check form-check-custom form-check-solid form-check-inline">
            <input class="form-check-input" type="checkbox" id="toc" name="toc" value="1" required>
            <span class="form-check-label fw-bold text-gray-700 fs-6">
                I Agree
                <a href="#" rel="noopener noreferrer" class="ms-1 link-primary">Terms and Conditions</a>
            </span>
        </label>
    </div>
                        <button type="button" class="btn btn-secondary w-100 mt-3" id="prev2">Previous</button>
                        <button type="submit" class="btn btn-danger w-100 mt-3">Register</button>
                    </div>
                </form>
            </div>
        </div>
       
        <script>
        document.getElementById('next1').addEventListener('click', function() {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;

            // Validate Step 1 fields
            if (!firstName || !lastName) {
                Swal.fire({
                    icon: 'error',
                    title: 'Incomplete Information',
                    text: 'Please fill in all required fields in Step 1.',
                });
            } else {
               
                showStep(1);
            }
        });

        document.getElementById('next2').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            // Validate Step 2 fields
            if (!email || !phone) {
                let errorMessage = '';

                if (!email) {
                    errorMessage += '\n';
                }
                if (!phone) {
                    errorMessage += 'Please fill in all required fields in Step 2.\n';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Incomplete Information',
                    text: errorMessage,
                });
            } else if (phone.length !== 11) {
               
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Phone Number',
                    text: 'Phone number must be exactly 11 digits.',
                });
            } else {
               
                showStep(2);
            }
        });

        document.getElementById('prev1').addEventListener('click', function() {
            showStep(0);
        });

        document.getElementById('prev2').addEventListener('click', function() {
            showStep(1);
        });

       
        function showStep(stepIndex) {
            const steps = document.querySelectorAll('.step');
            const progressBar = document.querySelectorAll('.progressbar li');

            steps.forEach((step, index) => {
                step.classList.remove('active');
                step.style.display = index === stepIndex ? 'block' : 'none';
                progressBar[index].classList.toggle('active', index <= stepIndex);
            });
        }

       
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });

        document.getElementById('showConfirmPassword').addEventListener('change', function() {
            const confirmPasswordField = document.getElementById('confirmPassword');
            confirmPasswordField.type = this.checked ? 'text' : 'password';
        });

       
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

           
            if (password !== confirmPassword) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Passwords do not match. Please try again.',
                });
                return;
            }

           
            if (!passwordRegex.test(password)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must be at least 8 characters long, include one uppercase letter, one lowercase letter, one number, and one special character.',
                });
            }
        });

       
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
                Swal.fire('Error!', '<?php echo $errorMessage; ?>', 'error');
            <?php } ?>
        });
    </script>

    <script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
