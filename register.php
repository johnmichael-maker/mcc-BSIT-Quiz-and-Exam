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
            background-color:#dc3545;

        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
           
        }
        .form-label{
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h1 class="text-center mb-4" style="color:#fff;">Instructor Registration</h1>
            
            <!-- Registration form -->
            <form method="POST" action="">
                <!-- Form fields for registration -->
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="firstname" required>
                </div>
                <div class="mb-3">
                    <label for="middleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Middlename">
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Lastname" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
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
