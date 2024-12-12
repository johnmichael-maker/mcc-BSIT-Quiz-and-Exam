<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Admin | Access of mccbistquiandexam</title>
      <link rel="icon" href="../assets/img/file.png">

    <!-- Include Google Fonts and Font Awesome (for spinner) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>

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
            width: 30px;
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
</head>
<body class="hold-transition lockscreen">
   <div class="lockscreen-wrapper">
        <!-- Logo Section -->
        <div class="lockscreen-logo">
            <a style="color: #F40009; font-size:30px; font-weight: bold;">
                <b>Authorized Access</b>
            </a>
        </div>
       
         <!-- Security Message Section -->
       <div class="security-message" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; border: 1px solid #f5c6cb;">
            <strong>Security Notice:</strong> This area is restricted to <b>authorized users only</b>. Unauthorized access is prohibited and may result in legal action.
        </div>
        <br>
       
        <div class="lockscreen-item">
            <div class="lockscreen-credentials">
                <!-- Email Form -->
                <form id="email-form">
                    <div class="input-group" style="flex-direction: column; align-items: center;">
                        <input type="email" class="form-control" name="email" placeholder="Send Email for Verification " required>
                    </div>
                </form>

                <!-- Code Form (Table format) -->
                <form id="code-form" style="display: none;">
                    <table class="verification-table" style="width: 100%; table-layout: fixed; margin: 0 auto;">
                        <tr>
                            <td><input type="text" class="form-control verification-input" maxlength="1" /></td>
                            <td><input type="text" class="form-control verification-input" maxlength="1" /></td>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Ld9CpMqAAAAACHrxpkxa8ZWtOfi8cOMtxY0eNxM"></script>
    <script>
        $(function () {
            // Handle email form submission
            $('#email-form').on('submit', function (e) {
                e.preventDefault();

                var email = $('input[name="email"]').val();

                // Validate email format
                if (!validateEmail(email)) {
                    $('#message').html('Please enter a valid email address.').removeClass('text-success').addClass('text-danger');
                    return;
                }

                // Get reCAPTCHA token
                grecaptcha.ready(function () {
                    grecaptcha.execute('6Ld9CpMqAAAAACHrxpkxa8ZWtOfi8cOMtxY0eNxM', { action: 'submit' }).then(function (token) {
                        // AJAX call to verify email
                        $.ajax({
                            url: 'lock.php',  // PHP script to handle email verification
                            method: 'POST',
                            data: { email: email, recaptcha_response: token },
                            dataType: 'json',  // Expecting JSON response
                            beforeSend: function () {
                                $('#message').html('<i class="fa fa-spinner fa-spin"></i> Sending verification code...').removeClass('text-danger').addClass('text-info');
                            },
                            success: function (response) {
                                if (response.success) {
                                    $('#message').html(response.message).removeClass('text-danger').addClass('text-success');
                                    $('#email-form').hide();
                                    $('#code-form').show();
                                    $('.verification-input').first().focus();

                                    // Trigger voice feedback when verification code is sent
                                    if ('speechSynthesis' in window) {
                                        var msg = new SpeechSynthesisUtterance("The verification code has been sent to your email.");
                                        msg.lang = 'en-US';
                                        window.speechSynthesis.speak(msg);
                                    }
                                } else {
                                    $('#message').html(response.message).removeClass('text-success').addClass('text-danger');
                                }
                            },
                            error: function (xhr, status, error) {
                                $('#message').html('An error occurred: ' + error).removeClass('text-success').addClass('text-danger');
                            }
                        });
                    });
                });
            });

            // Handle verification code form submission
            $('#code-form').on('submit', function (e) {
                e.preventDefault();

                var code = '';
                $('.verification-input').each(function () {
                    code += $(this).val();
                });

                if (code.length !== 6) { // Ensure the code has 6 digits
                    $('#message').html('Please enter the full verification code.').removeClass('text-success').addClass('text-danger');
                    return;
                }

                var email = $('input[name="email"]').val();

                // AJAX call to verify the code
                $.ajax({
                    url: 'verify_code.php',  // PHP script that verifies the code
                    method: 'POST',
                    data: { email: email, code: code },
                    dataType: 'json',
                    beforeSend: function () {
                        $('#message').html('<i class="fa fa-spinner fa-spin"></i> Verifying code...').removeClass('text-danger').addClass('text-info');
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#message').html(response.message).removeClass('text-danger').addClass('text-success');
                            setTimeout(function () {
                                window.location.href = response.redirect; // Perform the redirection after a delay
                            }, 1500);
                        } else {
                            $('#message').html(response.message).removeClass('text-success').addClass('text-danger');
                        }
                    },
                    error: function () {
                        $('#message').html('An error occurred. Please try again.').removeClass('text-success').addClass('text-danger');
                    }
                });
            });

            // Email validation function
            function validateEmail(email) {
                var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                return re.test(email);
            }

            // Voice Command Integration
if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
    // Create a SpeechRecognition instance
    var recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    recognition.lang = 'en-US';
    recognition.continuous = false;  // We don't need continuous speech input
    recognition.interimResults = false;  // Don't show intermediate results

    recognition.onstart = function () {
        $('#message').html('Listening for your command...').removeClass('text-danger').addClass('text-info');
    };

    recognition.onerror = function (event) {
        // Handle errors more clearly
        if (event.error === 'not-allowed' || event.error === 'service-not-allowed') {
            $('#message').html('Permission to access the microphone was denied. Please allow microphone access.').removeClass('text-success').addClass('text-danger');
        } else if (event.error === 'network') {
            $('#message').html('Network error occurred during speech recognition.').removeClass('text-success').addClass('text-danger');
        } else if (event.error === 'no-speech') {
            $('#message').html('No speech detected. Please speak clearly into the microphone.').removeClass('text-success').addClass('text-danger');
        } else {
            $('#message').html('There was an error with speech recognition: ' + event.error).removeClass('text-success').addClass('text-danger');
        }
    };

    recognition.onresult = function (event) {
        var command = event.results[0][0].transcript.toLowerCase();

        if (command.includes('send verification code') || command.includes('send code')) {
            // Trigger email form submission
            $('#email-form').submit();
        } else if (command.includes('verify') || command.includes('enter code')) {
            // Trigger code form submission
            $('#code-form').submit();
        } else if (command.includes('enter') && command.includes('@')) {
            // Fill email field using voice
            $('input[name="email"]').val(command).focus();
            $('#message').html('Email address filled: ' + command).removeClass('text-danger').addClass('text-success');
        } else {
            $('#message').html('Command not recognized. Try again.').removeClass('text-success').addClass('text-danger');
        }
    };

    // Start voice recognition automatically
    try {
        recognition.start();
    } catch (error) {
        $('#message').html('Speech recognition failed to start. Please ensure your microphone is working and permissions are granted.').removeClass('text-success').addClass('text-danger');
    }
} else {
    $('#message').html('Speech recognition is not supported in your browser.').removeClass('text-success').addClass('text-danger');
}


        document.addEventListener('contextmenu', function(e) {
            e.preventDefault(); 
        });

        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                if (
                    e.key === 'i' ||  
                    e.key === 'u' ||  
                    e.key === 'j' ||  
                    e.key === 'c' ||  
                    e.key === 's' ||  
                    e.key === 'k' ||  
                    e.key === 'h' ||  
                    e.key === 'd' ||  
                    e.key === 'r' || 
                    e.key === 'p' ||  
                    e.key === 'f' ||  
                    e.key === 'q' ||  
                    e.key === 'F12'   
                ) {
                    e.preventDefault();  
                    return false;
                }
            }
        });

        // Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
        document.onkeydown = function (e) {
            if (
                e.key === 'F12' ||
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
                (e.ctrlKey && e.key === 'U')
            ) {
                e.preventDefault();
            }
        };

        // Disable selecting text
        document.onselectstart = function (e) {
            e.preventDefault();
        };
    </script>
</body>
