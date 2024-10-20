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
        body{
            background: url('./assets/img/mcc.png') no-repeat center center fixed;
           
        }
        .form-container {
            margin: 0 auto;
            padding: 20px;
           
        }
        .form-label{
            color: #fff;
        }
        .result, .result1{
            width: 73%;
            position: absolute;        
            z-index: 999;
            top: 100%;
            left: 0;
        }
        /* Formatting result items */
        .result p, .result1 p{
            margin: 0;
            padding: 5px 5px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
            background-color: white;
        }
        .result p:hover, .result1 p:hover{
            background: #f2f2f2;
        }
        
    .loader-wrapper {
      position: fixed;
      z-index: 999999;
      background: #fff;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0; }
      .loader-wrapper .loader {
        height: 100px;
        width: 100px;
        position: fixed; }
        .loader-wrapper .loader .loader-inner {
          border: 0 solid transparent;
          border-radius: 50%;
          width: 150px;
          height: 150px;
          position: absolute;
          top: calc(50vh - 75px);
          left: calc(50vw - 75px); }
          .loader-wrapper .loader .loader-inner:before {
            content: '';
            border: 1em solid #34d7e2;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: loader 2s linear infinite;
                    animation: loader 2s linear infinite;
            opacity: 0;
            -webkit-animation-delay: 0.5s;
                    animation-delay: 0.5s; }
          .loader-wrapper .loader .loader-inner:after {
            content: '';
            border: 1em solid #37e0c1;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: loader 2s linear infinite;
                    animation: loader 2s linear infinite;
            opacity: 0; }
    
    @-webkit-keyframes loader {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
        opacity: 0; }
      50% {
        opacity: 1; }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
        opacity: 0; } }
    
    @keyframes loader {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
        opacity: 0; }
      50% {
        opacity: 1; }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
        opacity: 0; } }
    
    .loader-box {
      height: 150px;
      text-align: center;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      vertical-align: middle;
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
      -webkit-transition: .3s color, .3s border, .3s transform, .3s opacity;
      transition: .3s color, .3s border, .3s transform, .3s opacity; }
      .loader-box [class*="loader-"] {
        display: inline-block;
        width: 50px;
        height: 50px;
        color: inherit;
        vertical-align: middle; }
    </style>
</head>
<body>
    <div class="loader-wrapper" id="preloader">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            loader.style.display = "none"
        })
    </script>
 <div class="container mt-5" style="max-width: 600px;">
    <div class="card">
        <div class="card-header text-center" style="background-color: #007bff; color: #fff;">
            <h1>Instructor Registration</h1>
        </div>
        <div class="card-body">
            <!-- Registration form -->
            <form method="POST" action="">
                <!-- Form fields for registration -->
                <div class="col-md-12 mb-2">
                   
                <label for="">Firstname</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="firstname" required>
                </div>
                <div class="col-md-12 mb-1">
                 
                <label for="">Middlename</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middlename">
                </div>
                <div class="col-md-12 mb-1">
                  
                <label for="">Lastname</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Lastname" required>
                </div>
                <div class="col-md-12 mb-3">
                 
                <label for="">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="col-md-12 mb-3">
                   
                <label for="">Phone number</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" required>
                </div>
                <div class="col-md-12 mb-3">
                   
                <label for="">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                </div>
                <div class="col-md-12 mb-3">
                  
                <label for="">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="col-md-12 mb-3">
                <label for="">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>
</div>





    <script>
        <?php if (!empty($successMessage)): ?>
            Swal.fire({
                icon: 'success',
                title: '<?= addslashes($successMessage) ?>',
                text: 'You will be redirected shortly.',
                showConfirmButton: false,
                timer: 3000
            }).then(function() {
                window.location.href = './admin/login.php';
            });
        <?php elseif (!empty($errorMessage)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= addslashes($errorMessage) ?>'
            });
        <?php endif; ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
