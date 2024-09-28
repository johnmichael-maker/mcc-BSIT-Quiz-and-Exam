<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MS 365 Account Verification</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <style>
          .result, .result1{
            width: 73%;
            position: absolute;        
            z-index: 999;
            top: 100%;
            left: 0;
        }
        /* Formatting result items */
        .result p, .result1 p{
            margin: 0;
            padding: 5px 5px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
            background-color: white;
        }
        .result p:hover, .result1 p:hover{
            background: #f2f2f2;
        }
        
    .loader-wrapper {
      position: fixed;
      z-index: 999999;
      background: #fff;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0; }
      .loader-wrapper .loader {
        height: 100px;
        width: 100px;
        position: fixed; }
        .loader-wrapper .loader .loader-inner {
          border: 0 solid transparent;
          border-radius: 50%;
          width: 150px;
          height: 150px;
          position: absolute;
          top: calc(50vh - 75px);
          left: calc(50vw - 75px); }
          .loader-wrapper .loader .loader-inner:before {
            content: '';
            border: 1em solid #34d7e2;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: loader 2s linear infinite;
                    animation: loader 2s linear infinite;
            opacity: 0;
            -webkit-animation-delay: 0.5s;
                    animation-delay: 0.5s; }
          .loader-wrapper .loader .loader-inner:after {
            content: '';
            border: 1em solid #37e0c1;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: loader 2s linear infinite;
                    animation: loader 2s linear infinite;
            opacity: 0; }
    
    @-webkit-keyframes loader {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
        opacity: 0; }
      50% {
        opacity: 1; }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
        opacity: 0; } }
    
    @keyframes loader {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
        opacity: 0; }
      50% {
        opacity: 1; }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
        opacity: 0; } }
    
    .loader-box {
      height: 150px;
      text-align: center;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      vertical-align: middle;
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
      -webkit-transition: .3s color, .3s border, .3s transform, .3s opacity;
      transition: .3s color, .3s border, .3s transform, .3s opacity; }
      .loader-box [class*="loader-"] {
        display: inline-block;
        width: 50px;
        height: 50px;
        color: inherit;
        vertical-align: middle; }
    </style>
</head>
<body>
    <div class="loader-wrapper" id="preloader">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            loader.style.display = "none"
        })
    </script>
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
