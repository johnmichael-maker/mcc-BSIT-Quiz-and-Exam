<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException; // Alias PHPMailer's Exception

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
                    $protocol = 'https'; // Force HTTPS
                    $host = 'mccbsitquizandexam.com';  // Use your actual domain
                    $register_link = "$protocol://$host/register.php?token=$token";
                    
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
                    } catch (PHPMailerException $e) {
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

} catch (\Exception $e) { // Use PHP's global Exception class
    $errorMessage = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Instructor|Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('../assets/img/mcc.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: row;
            width: 700px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .container .left-section {
            background-color: #d32f2f;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 35%;
        }

        .container .left-section img {
            max-width: 150%;
            height: auto;
            display: block;
           margin: 0 auto 20px;
          animation: moveUpDown 2s ease-in-out infinite; /* Added animation */
          }
           @keyframes moveUpDown {
          0% {
          transform: translateY(0);
      }
        50% {
        transform: translateY(-15px); /* Adjust the movement distance as needed */
        }
        100% {
          transform: translateY(0);
   }
        }

        .container .right-section {
            padding: 60px 40px;
            width: 65%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
            font-weight: 600;
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            width: 100%;
            color: #333;
            text-align: left;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #d32f2f;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 106%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b71c1c;
        }

        .container p {
            margin-top: 15px;
            color: #666;
            text-align: center;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container {
                width: 700px; /* Fixed width for tablets */
            }

            .container .left-section {
                padding: 20px;
            }

            .container .right-section {
                padding: 40px 20px;
            }

            h2 {
                font-size: 24px;
            }

            input[type="email"], button {
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 500px; /* Fixed width for mobile */
            }

            .container .right-section {
                padding: 30px 15px;
            }

            h2 {
                font-size: 22px;
            }

            input[type="email"], button {
                font-size: 14px;
                padding: 10px;
            }

            button {
                padding: 10px;
            }
        }
        .home-link{
text-decoration: none;
padding: 15px 20px;
color: rgb(128, 171, 184);
margin-right: 2px;
}
input[type="email"]:focus {
    border-color: crimson;
    box-shadow: 0 0 5px rgba(0,0,0,0.2); /* Added focus effect */
}
input[type="email"] {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid #dddddd;
    border-radius: 4px;
    outline: none;
    font-size: larger;
}
input[type="submit"] {
    width: 106%;
    max-width: 420px;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    background-color: #dc3545;
    color: white;
    font-size: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: larger;
}
input[type="submit"]:hover {
    background-color: #005a9e;
}
@media (max-width: 500px) {
    .container {
        padding: 10px;
    }
    h2 {
        font-size: 20px;
    }
    h5 {
        font-size: 14px;
    }
   input[type="email"], input[type="submit"] {
        width: calc(106% - 0px); /* Adjusted width for better fit */
        padding: 10px;
        margin: 10px 0;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-sizing: border-box;
    }
}
h2 {
    color: #005a9e;
    margin-bottom: 10px;
    font-size: 24px;
    
}
.mb-4{
    color: blue;
}

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="../assets/img/logo.png" alt="Logo"> <!-- Ensure to use your logo here -->
        </div>
        <div class="right-section">
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
              <h1 class="mb-4"><strong>Instructor Signup</strong></h1>
             <p>Enter your MS 365 Username to receive a registration link.</p>
            <input type="email" class="form-control" id="email" name="email" placeholder="example.juan2@mcclawis.edu.ph" required>
            <button type="submit" class="btn btn-danger w-100">Submit</button>
            </form>
            <p><a class="home-link" href="../index.php">Back Home</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



