<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../vendor/phpmailer/phpmailer/src/Exception.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require __DIR__ . "/../vendor/phpmailer/phpmailer/src/SMTP.php";
require '../vendor/autoload.php';

// Initialize variables for messages
$successMessage = '';
$errorMessage = '';

// Include the Database class
require_once './Database.php';

try {
    // Create a new instance of the Database class
    $database = new Database();
    $conn = $database->getConnection();

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];

        // Server-side validation for email domain
        $domain = "@mcclawis.edu.ph";
        if (!str_ends_with($email, $domain)) {
            $errorMessage = "Invalid email address. Only emails ending with $domain are allowed.";
        } else {
            // Check if the email already exists in the database
            $stmt = $conn->prepare("SELECT email FROM signupinstructors WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $errorMessage = "This email is already registered. Please check your inbox for the registration link.";
            } else {
                // Generate a registration token and expiration
                $token = bin2hex(random_bytes(32));
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $token_hash = hash('sha256', $token);

                // Store token and expiration in the database
                $stmt = $conn->prepare("INSERT INTO signupinstructors (email, reset_token_hash, reset_token_hash_expires_at) VALUES (:email, :token_hash, :expires_at)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':token_hash', $token_hash);
                $stmt->bindParam(':expires_at', $expires_at);

            if ($stmt->execute()) {
    // Create registration link with HTTPS protocol
    $protocol = 'https'; // Force HTTPS
    $host = $_SERVER['HTTP_HOST'];

    // Check if the host is localhost and replace it with your actual domain
    if ($host === 'localhost') {
        $host = 'mccbsitquizandexam.com';  // Replace with your actual domain
    }

    // Create the registration link
    $register_link = "$protocol://$host/register.php?token=$token";
}

                    // Set up PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        // SMTP server settings for Gmail
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // SMTP server for Gmail
                        $mail->SMTPAuth = true;
                        $mail->Username = 'johnmichaellerobles345@gmail.com'; // Your Gmail address
                        $mail->Password = 'ybhr uilh htvb xygk'; // Your Gmail App Password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                        $mail->Port = 587;

                        // Recipients
                        $mail->setFrom('johnmichaellerobles345@gmail.com', 'MCC-BSIT Quiz and Exam'); // Sender's email and name
                        $mail->addAddress($email); // Add recipient email

                        // Email content
                        $mail->isHTML(true);
                        $mail->Subject = 'Instructor Registration Request';
                        $mail->Body = "Hi,<br><br>Click the link below to complete your registration:<br><a href='$register_link'>$register_link</a><br><br>The link is valid for 1 hour.";

                        // Send email
                        $mail->send();
                        $successMessage = "Registration link sent to your email.";
                    } catch (Exception $e) {
                        $errorMessage = "Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $errorMessage = "Failed to save the token to the database.";
                }
            }
        }
    }

    // Close the database connection
    $database->closeConnection();

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Signup</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #dc3545;
        }

        .choose-card {
            width: 500px;
            max-width: 100%; /* Ensures it doesn't exceed 100% on smaller screens */
        }

        @media (max-width: 900px) {
            .choose-card {
                width: 100% !important;
            }

            .choose-div {
                padding: 15px;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        .home-link {
            text-decoration: none;
            padding: 15px 30px;
            color: rgb(128, 171, 184);
        }

        .animated-image {
            position: relative;
            animation: moveUpDown 2s infinite;
        }

        @keyframes moveUpDown {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-19px);
            }
            100% {
                transform: translateY(0);
            }
        }

        .form-label {
            color: #005a9e;
            margin-bottom: 10px;
            font-size: 24px;
        }

        /* Responsive form controls */
        .form-control, .btn {
            width: 100%;
        }

        /* Padding adjustment for small screens */
        @media (max-width: 576px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body class="py-5" style="max-height: 100vh;">
    <div class="h-100-vh d-lg-flex align-items-lg-center justify-content-lg-center position-relative">
        <div class="container pb-5">

            <div class="choose-div">
                <div class="card mx-auto choose-card" style="width: 500px;">
                    <div class="card-body text-center p-4">
                        <img src="../assets/img/logo.png" alt="Logo" class="animated-image" style="width: 70%;">
                        <h1 class="mb-4"><strong>Instructor Signup</strong></h1>

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

                        <form method="POST" action="">
                            <div class="mb-3">
                            <h5><label for="email" class="form-label"><strong>MS 365 Account Verification</strong></label></h5>
                                <p>Enter your MS 365 Username to receive a registration link.</p>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your MS Email" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Send Registration Link</button>
                        </form>
                        <p class="mt-3"><a class="home-link" href="index.php">Back Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
