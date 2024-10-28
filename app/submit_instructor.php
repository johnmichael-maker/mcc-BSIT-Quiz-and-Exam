<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

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

        // Extract username from email for checking
        $username = strstr($email, '@', true); // Get the part before '@'

        // Server-side validation for email domain
        $domain = "@mcclawis.edu.ph";
        if (!str_ends_with($email, $domain)) {
            $errorMessage = "Invalid email address. Only emails ending with $domain are allowed.";
        } else {
            // Check if the MS 365 Username exists in the ms_365_instructor table
            $stmt = $conn->prepare("SELECT * FROM ms_365_instructor WHERE Username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                $errorMessage = "This MS 365 Username does not exist in our records.";
            } else {
                // Generate a registration token and expiration
                $token = bin2hex(random_bytes(32));
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $token_hash = hash('sha256', $token);

                // Store token and expiration in the database
                $stmt = $conn->prepare("UPDATE ms_365_instructor SET token = :token_hash, token_expire = :expires_at WHERE Username = :username");
                $stmt->bindParam(':token_hash', $token_hash);
                $stmt->bindParam(':expires_at', $expires_at);
                $stmt->bindParam(':username', $username);

                if ($stmt->execute()) {
                    $protocol = 'https';
                    $host = 'mccbsitquizandexam.com';
                    $register_link = "$protocol://$host/register.php?token=$token";

                    // Set up PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        // SMTP server settings
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'johnmichaellerobles345@gmail.com';
                        $mail->Password = 'ybhr uilh htvb xygk'; // Gmail App Password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        // Recipients
                        $mail->setFrom('johnmichaellerobles345@gmail.com', 'MCC-BSIT Quiz and Exam');
                        $mail->addAddress($email);

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

} catch (\Exception $e) {
    $errorMessage = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Instructor | Verification</title>
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
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-direction: row;
            width: 90%; 
            max-width: 1100px; 
            height: 500px; 
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .left-section {
            background-color: #d32f2f;
            padding: 20px; 
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 0 0 35%; 
        }

        .left-section img {
            max-width: 130%; 
            height: auto;
            display: block;
            margin: 0 auto 20px;
            animation: moveUpDown 2s ease-in-out infinite;
        }
        .right-section h1 {
    display: flex;
    justify-content: center; 
    margin-top: 20px; 
    text-align: center;
}

.right-section p {
    display: flex;
    justify-content: center; 
    margin-top: 20px; 
    text-align: center;
    margin-right: 30px;
}

        .right-section {
            max-width: 100%; 
            padding: 20px; 
            flex: 0 0 65%; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #005a9e;
            font-size: 24px;
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

        input[type="email"],
        input[type="submit"] {
            width: 90%; 
            max-width: 500px; 
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            padding: 12px;
            box-sizing: border-box; 
        }

        input[type="email"]:focus {
            border-color: skyblue;
            box-shadow: 0 0 5px rgba(0,0,0,0.2); 
        }

        input[type="email"] {
    
            border: 1px solid #ccc;
            outline: none;
            
        }

        input[type="submit"] {
            background-color: #d32f2f;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #b71c1c;
        }

        .home-link {
            text-decoration: none;
            color: rgb(128, 171, 184);
            margin-top: 15px;
            text-align: center; 
        }

        @media (max-width: 768px) {
            .left-section {
                display: none; 
            }

            .right-section {
                width: 100%; 
                padding: 20px; 
            }
        }

        @media (max-width: 500px) {
            .container {
                flex-direction: column;
                height: auto; 
            }

            .left-section {
                display: none; 
            }

            h1 {
                font-size: 20px; 
            }
           
            input[type="email"], 
            input[type="submit"] {
                padding: 10px; 
                width: 90%; 
                margin-right: 13px;
            }
        }

        @media (min-width: 769px) {
            input[type="email"],
            input[type="submit"] {
                max-width: 500px; 
                width: 100%; 
            }
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="../assets/img/bsit-logo.png" alt="Logo">
        </div>
        <div class="right-section">
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
                <h1><strong>Instructor Signup</strong></h1>
                <p>Enter your MS 365 Username to receive a registration link.</p>
                <input type="email" id="email" name="email" placeholder="example doe.juan@mcclawis.edu.ph" required>
                <input type="submit" value="Submit">
            </form>
            <p><a class="home-link" href="../index.php">Back Home</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
