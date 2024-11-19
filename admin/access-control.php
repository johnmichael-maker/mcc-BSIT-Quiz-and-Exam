<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>MCC ALUMNI TRACKER - Admin Lock Screen</title>
    
    <!-- Include Google Fonts and Font Awesome (for spinner) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Add Font Awesome -->

    <style>
        /* Your existing styles here */
        .help-block {
            padding-top: 20px;
        }
    </style>
</head>
<body class="hold-transition lockscreen" style="overflow-y: hidden;">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="#"><b>Admin</b> Access Control</a>
        </div>
        <div class="lockscreen-name">
            HITSUGAYA TOSHI
        </div>
        <div class="lockscreen-item">
            <div class="lockscreen-credentials">
                <!-- Email Form -->
                <form id="email-form">
                    <div class="input-group" style="flex-direction: column; align-items: center;">
                        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
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

                <!-- Message Area (Success/Error Feedback) -->
                <div class="help-block text-center" id="message"></div>
            </div>
        </div>
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2024-2025 <b><a href="" class="text-black"></a></b><br>
            All rights reserved
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function () {
            // Handle email form submission
            $('#email-form').on('submit', function (e) {
                e.preventDefault();

                var email = $('input[name="email"]').val();

                // AJAX call to verify email
                $.ajax({
                    url: 'lock.php',  // PHP script that verifies the email and sends the verification code
                    method: 'POST',
                    data: { email: email },
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
                    error: function (xhr, status, error) {
                        $('#message').html('An error occurred: ' + error).removeClass('text-success').addClass('text-danger');
                    }
                });
            });

            // Handle verification code form submission
            $('#code-form').on('submit', function (e) {
                e.preventDefault();

                var code = '';
                $('.verification-input').each(function () {
                    code += $(this).val();
                });

                if (code.length !== 4) { // Ensure the code has 4 digits
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
        });
    </script>
</body>
</html>
