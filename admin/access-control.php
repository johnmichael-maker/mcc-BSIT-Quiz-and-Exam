<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>MCC ALUMNI TRACKER - Admin Lock Screen</title>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* Overall body and lock screen styling */
        body {
            background-color: #f7f9fc;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .lockscreen-wrapper {
            padding-top: 40px;
            text-align: center;
        }

        .lockscreen-logo a {
            font-size: 34px;
            font-weight: bold;
            color: #3498db;
            text-decoration: none;
        }

        .lockscreen-name {
            font-size: 22px;
            font-weight: 600;
            color: #444;
            margin-top: 10px;
        }

        .lockscreen-item {
            margin-top: 30px;
            padding: 25px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            text-align: center;
        }

        .lockscreen-image img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .verification-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            margin: 0 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .verification-input:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
            background-color: #fff;
        }

        .btn {
            background-color: #3498db;
            color: #fff;
            border-radius: 50%;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background-color: #2980b9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .help-block {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }

        .g-recaptcha {
            margin-top: 25px;
        }

        .lockscreen-footer {
            font-size: 14px;
            color: #999;
            margin-top: 30px;
        }
        /* Fixing the email input and button alignment */
/* Fixing the email input and button positioning */


.input-group .form-control {
    border-radius: 8px; /* Rounded corners for input */
    height: 50px;
}

.input-group .btn {
    border-radius: 8px; /* Rounded corners for button */
    height: 50px; /* Match the height of the input field */
    width: 100%; /* Make the button span the full width */
    margin-top: 10px; /* Adds space between the input field and the button */
    padding: 0 20px; /* Adjust padding for button text */
    border: none;
    cursor: pointer;
    background-color: #3498db;
    color: white;
    font-size: 18px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.input-group .btn:hover {
    background-color: #2980b9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}



    </style>
</head>
<body class="hold-transition lockscreen" style="overflow-y: hidden;">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="#"><b>Admin</b> Access Control</a>
        </div>
      
        <div class="lockscreen-item">
            <div class="lockscreen-image">
                <!-- Optional image can go here -->
            </div>
            <div class="lockscreen-credentials">
                <!-- Email Form -->
                <form id="email-form">
    <div class="input-group" style="flex-direction: column; align-items: center;">
        <input type="email" class="form-control" name="email" placeholder="" required>
        <button type="submit" class="btn" style="margin-top: 10px;">Next</button>
    </div>
</form>

<!-- Code Form (Table format) -->
<form id="code-form" style="display: none;">
    <table class="verification-table">
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


        <!-- Recaptcha -->
        <center>
            <div class="g-recaptcha" data-sitekey="6LcgCYQqAAAAAD189unJF2bvHYYVPTnJH3TorQWd"></div>
        </center>

        <!-- Message Area (Success/Error Feedback) -->
        <div class="help-block text-center" id="message"></div>

        <!-- Footer -->
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2024-2025 <b><a href="" class="text-black"></a></b><br>
            All rights reserved
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            // Handle email form submission
            $('#email-form').on('submit', function (e) {
                e.preventDefault();
                var email = $(this).find('input[name="email"]').val();
                var recaptchaResponse = grecaptcha.getResponse();

                // AJAX call to verify email
                $.ajax({
                    url: 'lock.php',  // This should be the PHP file for verifying email
                    method: 'POST',
                    data: {
                        email: email,
                        'g-recaptcha-response': recaptchaResponse
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('#message').html('<i class="fa fa-spinner fa-spin"></i> Sending verification code...').removeClass('text-danger').addClass('text-info');
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#message').html(response.message).removeClass('text-danger').addClass('text-success');
                            $('#email-form').hide();
                            $('#code-form').show();
                        } else {
                            $('#message').html(response.message).removeClass('text-success').addClass('text-danger');
                        }
                    },
                    error: function () {
                        $('#message').html('An error occurred. Please try again.').removeClass('text-success').addClass('text-danger');
                    }
                });
            });

            // Handle verification code form submission
            $('#code-form').on('submit', function (e) {
                e.preventDefault();

                // Collect the values from the input fields
                var code = '';
                $('.verification-input').each(function () {
                    code += $(this).val();
                });

                // Check if the code is complete (length check based on the expected code length)
                if (code.length !== 4) { // Assuming a 4-digit verification code
                    $('#message').html('Please enter the full verification code.').removeClass('text-success').addClass('text-danger');
                    return;
                }

                // Send the verification code for verification
                $.ajax({
                    url: 'verify_code.php',  // Server-side code to verify the entered code
                    method: 'POST',
                    data: { code: code },
                    dataType: 'json',
                    beforeSend: function () {
                        $('#message').html('<i class="fa fa-spinner fa-spin"></i> Verifying code...').removeClass('text-danger').addClass('text-info');
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#message').html(response.message).removeClass('text-danger').addClass('text-success');
                            setTimeout(function () {
                                window.location.href = response.redirect; // Redirect to dashboard or another page
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

            // Enable tooltips for better user experience
            $('[data-toggle="tooltip"]').tooltip({ html: true, container: 'body' });
        });
    </script>
</body>
</html>
