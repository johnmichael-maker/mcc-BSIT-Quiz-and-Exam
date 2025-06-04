<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="CONTENT-TYPE" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello, World!</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Verdana, sans-serif;
    }

    .header-box {
      height: 100vh;
      background: green;
    }

    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: silver;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
      flex-wrap: wrap;
    }

    .navlinks {
      flex: 1;
      text-align: right;
    }

    .navlinks ul {
      list-style: none;
    }

    .navlinks ul li {
      display: inline-block;
      padding: 10px 15px;
    }

    .navlinks ul li a {
      color: #fff;
      text-decoration: none;
    }

    .section1 {
      min-height: 50vh;
      background: silver;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      align-items: center;
      padding: 24px;
    }

    .card {
      width: 120px;
      height: 120px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-text {
      text-align: center;
      font-size: 14px;
    }

    footer {
      background: #000;
      color: #fff;
      padding: 20px 0;
    }

    .footer {
      text-align: center;
    }

    .footer-copy {
      background: gold;
      color: #000;
      text-align: center;
      padding: 10px 0;
    }

    .fade-in-right {
      animation: fadeInRight 1s ease-in-out;
    }

    @keyframes fadeInRight {
      0% {
        opacity: 0;
        transform: translateX(50px);
      }
      100% {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @media screen and (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
      }

      .navlinks {
        text-align: left;
        width: 100%;
      }

      .navlinks ul li {
        display: block;
        padding: 10px 0;
      }

      .section1 {
        flex-direction: column;
        padding: 16px;
      }

      .card {
        width: 90%;
        max-width: 300px;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="header-box">
      <nav>
        <div class="navlinks">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Service</a></li>
          </ul>
        </div>
      </nav>
    </div>
  </header>

  <section class="section1">
    <div class="card fade-in-right">
      <div class="card-text"><h1>1</h1></div>
    </div>
    <div class="card">
      <div class="card-text"><h1>2</h1></div>
    </div>
    <div class="card">
      <div class="card-text"><h1>3</h1></div>
    </div>
    <div class="card">
      <div class="card-text"><h1>4</h1></div>
    </div>
  </section>

  <footer>
    <div class="footer">
      <h1>Madridejos Community College</h1>
      <p>The Madridejos Community College is...</p>
    </div>
    <div class="footer-copy">
      <p>&copy; 2025 All Rights Reserved</p>
    </div>
  </footer>
</body>
</html>
