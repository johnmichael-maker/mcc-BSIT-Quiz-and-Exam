<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>I'll Be Back Soon</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
body {
    background-color: #0a0a0a;
    color: #f5f5f5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.coming-back {
    padding: 40px;
    border-radius: 10px;
    background-color: #1a1a1a;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    animation: fadeZoom 1.5s ease-out forwards;
    opacity: 0;
    transform: scale(0.95);
}

@keyframes fadeZoom {
    to {
        opacity: 1;
        transform: scale(1);
    }
}

</style>
<body>
    <div class="coming-back">
        <h1>I'll Be Back Soon</h1>
        <p>This website is temporarily unavailable. Please check back later.</p>
    </div>
</body>
</html>
