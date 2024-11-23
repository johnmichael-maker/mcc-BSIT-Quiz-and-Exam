<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invalid Token</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        h1 {
            color: #f44336;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 8px 18px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invalid or Expired Token</h1>
        <p>The link you followed has expired or is invalid. Please request a new registration link.</p>
       
    </div>
</body>
</html>
