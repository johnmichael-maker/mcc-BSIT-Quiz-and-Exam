<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> 
    <title>Instructor Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            overflow: hidden; 
            height: 100vh; 
            touch-action: pan-y;
        }

        .outer-background {
            background-image: url(./assets/img/mcc.png);
            background-size: cover; 
            background-position: center; 
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative; 
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9); 
            width: 90%;
            max-width: 500px;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            color: black;
            z-index: 1;
            margin-top: 30px;
        }

        .logo {
            width: 100%; 
            max-width: 250px; 
            margin-bottom: -15px;
            height: auto;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #00c4ff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .btn-secondary {
            background-color: #ccc;
        }

        .footer-text {
            margin-top: 15px;
            color: black;
        }

        .footer-text a {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .form-container {
                max-width: 90%;
                padding: 15px;
                margin-top: 20px;
            }

            .form-title {
                font-size: 22px;
                margin-bottom: 15px;
            }

            .btn {
                font-size: 14px;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                max-width: 90%;
                padding: 10px; 
                margin-top: 30px;
            }

            .logo {
                width: 100%;
                margin-bottom: 5px;    
            }

            .madri-dejos {
                margin-top: -20px; 
                font-size: 28px; 
            }

            .form-title {
                font-size: 20px;
            }

            .btn {
                font-size: 14px;
                padding: 8px;
            }

            .footer-text {
                font-size: 16px; 
            }
        }
    </style>
</head>
<body>
    <div class="outer-background">
        <div style="text-align: center; position: absolute; top: 20px; width: 100%;"> 
            <img src="./assets/img/logo.png" alt="Logo" class="logo">
            <h1 class="madri-dejos" style="color: #000; font-size: 40px;">
                Madridejos Community College
            </h1>
        </div>
        <div class="form-container">
            <h2 class="form-title">Instructor Registration</h2>
            <button onclick="window.location.href='https://mccbsitquizandexam.com/step-123.php'" class="btn btn-danger">Create an Account</button>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
