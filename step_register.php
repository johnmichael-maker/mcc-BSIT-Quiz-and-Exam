<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MS 365 Account Verification</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
    <div class="container">
        <img src="./assets/img/logo.png" alt="College Logo" class="logo">
        <div class="form-container">
         <h1 class="mb-4"><strong>Student Signup</strong></h1>
            <h2>MS 365 Account Verification</h2>
            <p>Enter your MS 365 Username to receive a registration link.</p>
            <form id="registrationForm" action="./app/submit_registration.php" method="post" onsubmit="return validateEmail()">
                <input type="email" id="email" name="Username" placeholder="MS 365 Email" required>
                <input type="submit" value="Send Registration Link">
            </form>
        </div>
        <p><a class="home-link" href="index.php">Back Home</a></p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    // Email validation to ensure the email ends with the specified domain
    function validateEmail() {
        const email = document.getElementById('email').value;
        const domain = "@mcclawis.edu.ph";

        if (!email.endsWith(domain)) {
            Swal.fire({
                title: 'Invalid Email',
                text: 'Please enter an email ending with ' + domain,
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return false; 
        }
    }

    
    function showPopup(message, type) {
        Swal.fire({
            title: message,
            icon: type,
            confirmButtonText: 'OK'
        });
    }

    
    $(document).ready(function () {
        $('#registrationForm').on('submit', function (e) {
            e.preventDefault(); 

            $.ajax({
                type: 'POST',
                url: './app/submit_registration.php', 
                data: $(this).serialize(), 
                dataType: 'json', 
                success: function (response) {
                   
                    if (response.status === 'success') {
                       
                        $('#registrationForm').html('<p>Thank you! The registration link has been sent to your email.</p>');

                      
                        showPopup('Registration link has been sent successfully.', 'success');
                    } else {
                        showPopup(response.status, 'error');
                    }
                },
                error: function () {
                    showPopup('An error occurred while sending the registration link.', 'error');
                }
            });
        });
    });
</script>

</body>
</html>
