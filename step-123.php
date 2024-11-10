<?php
// Database.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mcc_bsit_quiz_and_exam";

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
    </style>
</head>
<link rel="stylesheet" href="../assets/css/alertify.min.css" />
<link rel="stylesheet" href="../assets/css/alertify.bootstraptheme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            </div>
            <div class="field">
                <div class="label">Phone No.</div>
                <input type="tel" id="phone" name="phone" maxlength="11" placeholder="Enter Phone Number" required pattern="09\d{9}" />
                <div id="warning_message" style="display: none;">Invalid phone number. It should start with 09 and contain 11 digits.</div>
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
                <input type="email" name="username" id="username" placeholder="Enter Email" required />
            </div>
            <div class="field">
                <div class="label">Password</div>
                <input type="password" name="password" id="passwordInput" placeholder="Enter Password" required />
            </div>
            <div class="field">
                <div class="label">Confirm Password</div>
                <input type="password" name="cpassword" id="confirmPasswordInput" placeholder="Enter Password" required />
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
    
    function sanitizeInput(value) {
        
        const sanitizedValue = value.replace(/<script.*?>.*?<\/script>/gi, "")  // Remove script tags
                                    .replace(/<.*?>/g, "")  // Remove any other HTML tags
                                    .replace(/[\x00-\x1F\x7F-\x9F]/g, ""); // Remove non-printable characters
        return sanitizedValue;
    }

    // Function to validate all inputs and block malicious content
    function validateInputs() {
        const inputs = document.querySelectorAll("input");
        let isValid = true;

        // Loop through each input and check the value
        inputs.forEach(function(input) {
            let value = input.value.trim();
            value = sanitizeInput(value);  // Sanitize input to remove dangerous content
            input.value = value;  // Update the input field with sanitized value

            // Validate against certain patterns (you can extend this as needed)
            if (input.name === "firstName" || input.name === "middleName" || input.name === "lastName") {
                if (!/^[a-zA-Z\s]+$/.test(value)) {
                    // SweetAlert2 for invalid name input
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid name entered',
                        text: 'Only letters and spaces are allowed for names.',
                    });
                    isValid = false;
                }
            }
            if (input.name === "email") {
                // Basic email validation
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
                // Phone validation for numbers starting with 09 and exactly 11 digits
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

    // Attach a submit event to the form for validation
    document.getElementById("registrationForm").addEventListener("submit", function(e) {
        if (!validateInputs()) {
            e.preventDefault();  // Prevent form submission if inputs are invalid
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
                // Redirect to the login page after the success message is closed
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
        // Step Navigation
        const slidePage = document.querySelector(".slide-page");

const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const confirmSignupBtn = document.querySelector("#confirmSignupBtn");


        // Regular expressions for validation
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const phonePattern = /^09\d{9}$/; // 11 digits starting with 09
        const addressPattern = /^[a-zA-Z\s]+,\s[a-zA-Z\s]+,\s[a-zA-Z\s]+$/; // Basic address format (Brgy, Municipality, Province)

        // Step 1 Validation (Personal Details)
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

        // Step 2 Validation (Contact Info)
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
        slidePage.style.marginLeft = "0%"; // Slide back to the first page
    });

    // Go back from step 3 to step 2
    prevBtnThird.addEventListener("click", function () {
        slidePage.style.marginLeft = "-25%"; // Slide back to the second page
    });


        // Step 3 Validation (Login Details)
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


        
        // Final form submit validation
        document.getElementById('registrationForm').addEventListener('submit', function (e) {
            const password = document.getElementById('passwordInput').value;
            const confirmPassword = document.getElementById('confirmPasswordInput').value;

            // Password match and strength check
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

            // Success message
            Swal.fire({
                icon: 'success',
                title: 'Registration Complete',
                text: 'Your registration was successful!',
            });
        });
        
        // Validate Phone Number input (allow only numbers)
        document.getElementById('phone').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>

    
