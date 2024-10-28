<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>Student | Verification</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: url('./assets/img/mcc.png') no-repeat center center fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        overflow: hidden; /* Prevent scrolling */
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
        overflow: hidden; /* Prevent scrolling in container */
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
        max-width: 100%; 
        height: auto;
        display: block;
        margin: 0 auto 20px;
        animation: moveUpDown 2s ease-in-out infinite;
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

    .right-section form {
        width: 100%; 
        display: flex;
        flex-direction: column; 
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
        width: 100%; 
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
    }

    .right-section p {
        display: flex;
        justify-content: center; 
        margin-top: 20px; 
        text-align: center;
    }

    @media (max-width: 768px) {
        .left-section {
            display: none; 
        }

        .right-section {
            width: 100%; 
            padding: 10px; 
        }
    }

    @media (max-width: 500px) {
        .container {
            flex-direction: column;
            height: auto; 
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
            <img src=".//assets/img/bsit-logo.png" alt="Logo"> 
        </div>
        <div class="right-section">
            <h1 class="mb-4"><strong>Student Signup</strong></h1>
            <p class="prompt-text">Enter your MS 365 Username to receive a registration link.</p>
            <form id="registrationForm" action="./app/submit_registration.php" method="post" onsubmit="return validateEmail()">
                <input type="email" id="email" name="Username" placeholder="example doe.juan@mcclawis.edu.ph" required>
                <input type="submit" value="Submit">
            </form>
            <p><a class="home-link" href="index.php">Back Home</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function validateEmail() {
            const email = document.getElementById('email').value;
            const domain = "@mcclawis.edu.ph";

            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!emailPattern.test(email)) {
                Swal.fire({
                    title: 'Invalid Email Format',
                    text: 'Please enter a valid email address.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false; 
            }

            if (!email.endsWith(domain)) {
                Swal.fire({
                    title: 'Invalid Domain',
                    text: 'Please enter an email address with the ' + domain + ' domain.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false; 
            }

            return true; 
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
                            $('#registrationForm').html('<p>Registration link has been sent successfully.</p>');
                            showPopup('Thank you! The registration link has been sent to your Outlook email.', 'success');
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
