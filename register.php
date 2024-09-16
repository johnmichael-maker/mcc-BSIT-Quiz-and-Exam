<?php
// require_once('./config.php');

// Initialize variables for messages
$successMessage = '';
$errorMessage = '';

// Function to generate a random verification string
function generateVerificationCode($length = 20) {
    return bin2hex(random_bytes($length / 2)); // Generates a random string of specified length
}

// Check if a token is provided
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($token) {
    // Verify the token
    $tokenHash = hash('sha256', $token);
    $stmt = $conn->prepare("SELECT id, reset_token_hash_expires_at FROM signupinstructors WHERE reset_token_hash = ? AND reset_token_hash_expires_at > NOW()");
    $stmt->bind_param('s', $tokenHash);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // Token is valid
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Collect and validate form data
            $firstName = $_POST['firstName'];
            $middleName = $_POST['middleName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

            // Generate a random verification code
            $verification = generateVerificationCode();

            // Basic server-side validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage = "Invalid email address.";
            } else {
                // Start transaction to ensure both inserts happen
                $conn->begin_transaction();
                try {
                    // Insert into instructors table
                    $stmt = $conn->prepare("INSERT INTO instructors (first_name, middle_name, last_name, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param('ssssss', $firstName, $middleName, $lastName, $email, $phone, $address);
                    $stmt->execute();
                    
                    // Insert into admin table with userType of 2
                    $img = '../assets/img/logo.png'; // Default image
                    $userType = 2; // Set userType for instructor
                    $stmt = $conn->prepare("INSERT INTO admin (username, img, email, password, verification, userType, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
                    $stmt->bind_param('sssssi', $username, $img, $email, $password, $verification, $userType);
                    $stmt->execute();
                    
                    // Remove token from signupinstructors table
                    $stmt = $conn->prepare("DELETE FROM signupinstructors WHERE reset_token_hash = ?");
                    $stmt->bind_param('s', $tokenHash);
                    $stmt->execute();

                    // Commit transaction
                    $conn->commit();
                    
                    $successMessage = "Registration successful!";
                } catch (Exception $e) {
                    // Rollback transaction on error
                    $conn->rollback();
                    $errorMessage = "Error: " . $stmt->error;
                }
            }
        }
    } else {
        // Token is invalid or expired
        $errorMessage = "Invalid or expired token.";
    }
} else {
    $errorMessage = "No token provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h1 class="text-center mb-4">Instructor Registration</h1>
            
            <!-- Display success or error messages -->
            <?php if ($successMessage): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($successMessage) ?>
                </div>
            <?php elseif ($errorMessage): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>
            
            <?php if ($token && $stmt->num_rows > 0): ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            <?php else: ?>
                <p class="text-danger">Invalid or expired token. Please request a new registration link.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
