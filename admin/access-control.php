<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Admin | Access of mccbistquiandexam</title>
    <link rel="icon" href="../assets/img/file.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
         /* Global Styling */
         body {
            background-color: #f4f6f9;
            font-family: 'Source Sans Pro', sans-serif;
            overflow-y: hidden;
        }

        .lockscreen-wrapper {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding-top: 100px;
        }

        .lockscreen-logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #3c8dbc;
            margin-bottom: 20px;
        }

        .lockscreen-name {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .lockscreen-item {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .lockscreen-credentials {
            text-align: center;
        }

        /* Input Fields */
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #3c8dbc;
            box-shadow: 0 0 5px rgba(60, 141, 188, 0.5);
        }

        .verification-input {
            text-align: center;
            width: 50px;
            margin: 0 5px;
            font-size: 24px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .verification-input:focus {
            border-color: #3c8dbc;
            outline: none;
        }

        /* Buttons */
        .btn {
            background-color: #F40009;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn:hover {
            background-color: darkred;
            transform: scale(1.05); /* Adds a slight zoom effect */
        }

        /* Message Area */
        .help-block {
            padding-top: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            color: #dd4b39;
        }

        .text-success {
            color: #00a65a;
        }

        /* Footer */
        .lockscreen-footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        .lockscreen-footer a {
            color: #3c8dbc;
            text-decoration: none;
        }

        .lockscreen-footer a:hover {
            text-decoration: underline;
        }

        /* Spinner */
        .fa-spinner {
            animation: spin 2s infinite linear;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .lockscreen-wrapper {
                padding-top: 50px;
            }

            .verification-input {
                width: 40px;
                font-size: 20px;
                padding: 8px;
            }

            .verification-table {
                width: 100%;
            }

            .btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 768px) {
            .lockscreen-wrapper {
                padding-top: 80px;
            }

            .verification-input {
                width: 45px;
                font-size: 22px;
                padding: 9px;
            }

            .btn {
                font-size: 15px;
                padding: 9px 18px;
            }
        }

        input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="email"]:focus {
            border-color: #3c8dbc;
            box-shadow: 0 0 8px rgba(60, 141, 188, 0.5);
            outline: none;
        }
    </style>

    <!-- reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="hold-transition lockscreen">

    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a style="color: #F40009; font-size:30px;"><b>Admin</b> Access Control</a>
        </div>
        <div class="lockscreen-name">
           <b> BSIT QUIZ AND EXAM</b>
        </div>
        <div class="lockscreen-item">
            <div class="lockscreen-credentials">
                <!-- Email Form -->
                <form id="email-form">
                    <div class="input-group" style="flex-direction: column; align-items: center;">
                        <input type="email" class="form-control" name="email" placeholder="Send Email for Verification Code" required>
                    </div>

                    <!-- reCAPTCHA Widget -->
                    <div class="g-recaptcha" data-sitekey="6LcgCYQqAAAAAD189unJF2bvHYYVPTnJH3TorQWd" style="margin-top: 10px;"></div>
                </form>

                <!-- Code Form (Verification Table) -->
                <form id="code-form" style="display: none;">
                    <table class="verification-table" style="width: 100%; table-layout: fixed; margin: 0 auto;">
                        <tr>
                            <td><input type="text" class="form-control verification-input" maxlength="1" /></td>
                            <td><input type="text" class="form-control verification-input" maxlength="1" /></td>
                            <td><input type="text" class="form-control verification-input" maxlength="1" /></td>
                            <td><input type="text" class="form-control verification-input" maxlength="1" /></td>
                        </tr>
                    </table>
                    <div class="input-group-btn" style="text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn">Verify</button>
                    </div>
                </form>

                <!-- Message Area (Success/Error Feedback) -->
                <div class="help-block text-center" id="message"></div>
            </div>
        </div>
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2024 <b><a href="../index" class="text-black">Madridejos Community College</a></b><br>
            created by John Michaelle Robles
        </div>
    </div>    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(function () {
        // Handle email form submission
        $('#email-form').on('submit', function (e) {
            e.preventDefault();

            var email = $('input[name="email"]').val();
            var recaptchaResponse = grecaptcha.getResponse(); // Get reCAPTCHA response

            // Validate email format
            if (!validateEmail(email)) {
                $('#message').html('Please enter a valid email address.').removeClass('text-success').addClass('text-danger');
                speak("Please enter a valid email address.");
                return;
            }

            // Validate reCAPTCHA
            if (recaptchaResponse.length == 0) {
                $('#message').html('Please complete the reCAPTCHA.').removeClass('text-success').addClass('text-danger');
                speak("Please complete the reCAPTCHA.");
                return;
            }

            // AJAX call to verify email
            $.ajax({
                url: 'lock.php',  // PHP script to handle email verification
                method: 'POST',
                data: { email: email, recaptcha_response: recaptchaResponse },
                dataType: 'json',  // Expecting JSON response
                beforeSend: function () {
                    $('#message').html('<i class="fa fa-spinner fa-spin"></i> Sending verification code...').removeClass('text-danger').addClass('text-info');
                },
                success: function (response) {
                    if (response.success) {
                        $('#message').html(response.message).removeClass('text-danger').addClass('text-success');
                        $('#email-form').hide();  // Hide the email form after sending the code
                        $('#code-form').show();   // Show the verification code form
                        speak("Verification code is being sent.");
                    } else {
                        $('#message').html(response.message).removeClass('text-success').addClass('text-danger');
                    }
                },
                error: function (xhr, status, error) {
                    $('#message').html('An error occurred: ' + error).removeClass('text-success').addClass('text-danger');
                }
            });
        });

        // Function to validate email format
        function validateEmail(email) {
            var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return re.test(email);
        }

        // Function to speak the message using AI voice (Speech Synthesis)
        function speak(message) {
            var utterance = new SpeechSynthesisUtterance(message);
            utterance.lang = 'en-US'; // Set language to English (US)
            window.speechSynthesis.speak(utterance);
        }

        // Voice Command Listener
        if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
            var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'en-US'; // Set language for recognition
            recognition.continuous = false;
            recognition.interimResults = false;

            // Start listening when the page loads
            recognition.start();

            recognition.onresult = function (event) {
                var command = event.results[0][0].transcript.toLowerCase();

                // Check for the "send verification code" command
                if (command.includes('send verification code')) {
                    $('#email-form').submit();
                    speak("Verification code is being sent.");
                    console.log("Verification code triggered by voice command.");
                }
            };

            recognition.onerror = function (event) {
                console.log("Speech recognition error: " + event.error);
            };
        } else {
            console.log("Speech recognition is not supported by this browser.");
        }
    });
    </script>
</body>
</html>
