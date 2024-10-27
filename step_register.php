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
        }

        .container {
            display: flex;
            flex-direction: row;
            width: 1100px;
            height: 500px; 
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .container .left-section {
            background-color: #b71c1c;
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
            animation: moveUpDown 2s ease-in-out infinite; 
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

        button {
            background-color: #d32f2f;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #b71c1c;
        }

        .container p {
            font-size: x-large;
            margin-top: 15px;
            color: #666;
            text-align: center;
        }

        
        .container .right-section p {
            width: 100%; 
            text-align: center; 
            margin-top: 20px; 
        }

        .home-link {
            text-decoration: none;
            font-size: medium;
            padding: 15px 20px;
            color: rgb(128, 171, 184);
            margin: 0 auto; 
            display: inline-block; 
            transition: color 0.3s ease; 
        }

        .home-link:hover {
            color: #005a9e; 
        }

        
        @media (max-width: 768px) {
            .container {
                width: 700px;
            }

            .container .left-section {
                display: none; 
            }

            .container .right-section {
                width: 100%; 
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
                width: 500px; 
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

        input[type="email"]:focus {
            border-color: crimson;
            box-shadow: 0 0 5px rgba(0,0,0,0.2); 
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
                width: calc(105% - 16px); 
                max-width: 400px; 
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

        .mb-4 {
            color: #007bff;
        }

        .prompt-text {
            color: black !important; 
            font-size: 16px; 
            margin-bottom: 20px; 
            font-weight: bold; 
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="./assets/img/logo.png" alt="Logo"> 
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
                            $('#registrationForm').html('<p>Registration link has been sent successfully .</p>');
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
