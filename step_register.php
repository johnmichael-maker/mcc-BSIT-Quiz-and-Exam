<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title>MS 365 Account Verification</title>
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
            width: 100%;
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
        width: calc(100% - 16px); /* Adjusted width for better fit */
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
            <img src="./assets/img/logo.png" alt="Logo"> <!-- Ensure to use your logo here -->
        </div>
        <div class="right-section">
        <h1 class="mb-4"><strong>Student Signup</strong></h1>
        <p>Enter your MS 365 Username to receive a registration link.</p>
            <form id="registrationForm" action="./app/submit_registration.php" method="post"  onsubmit="return validateEmail()">
                <input type="email" id="email" name="Username" placeholder="example.juan2@mcclawis.edu.ph" required>
                <input type="submit" value="Submit">
            </form>
            <p><a class="home-link" href="index.php">Back Home</a></p>
        </div>
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



