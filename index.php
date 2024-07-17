<?php 
     require __DIR__ . '/./vendor/autoload.php';
     use App\DatabaseControl;

     $databaseController = new DatabaseControl;
    $feedbacks = $databaseController->getFeedbacks();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC Competition : QUIZ BOWL</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @media print {
            .dont-print {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }
        }

        header{
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url(./assets/img/bg-img.jpg);
        }
    </style>
</head>

<body>

    <header class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img src="assets/img/logo.png" alt="image" class="w-100">
                </div>
                <div class="col-lg-8 h-100 my-auto text-light">
                    <h1>MADRIDEJOS COMMUNITY COLLEGE</h1>
                    <h3>Quiz Bowl and Exam</h3>
                    <p>&copy; John Michaelle Robles 2024</p>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand navbar-dark">
            <div class="container">
                <ul class="navbar-nav mx-auto gap-lg-5 gap-3">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link border-bottom border-2 border-danger active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container text-light mt-3 py-3">
        <h3 class="border-bottom border-2" style="width: fit-content;">About Us</h3>
        <div>
            <span class="ms-4">Madridejos</span> Community College (MCC) is a higher education institution located in
            Bunakan, Madridejos, a municipality in the province of Cebu, Philippines. The college was established to
            provide accessible and affordable education to the local community, focusing on developing skilled
            professionals who can contribute to the region's socioeconomic growth.
        </div>

        <hr>

        <div class="mt-3">
            <h5>Vision:</h5>
            <span class="ms-4">The </span> Madridejos Community College envisions a society comprised of fully competent
            individuals with benevolent character innovative, service-oriented, and highly empowered to meet and exceed
            challenges as proactive participants in shaping our world's future.
        </div>

        <div class="mt-3">
            <h5>Mission:</h5>
            <span class="ms-4">Madridejos </span> Community College is a safe, accessible, and affordable learning
            environment that aims to foster academic and career success through development of critical thinking,
            creativity, informed research, and social responsibility. Our mission is to deliver academic programs that
            are timely, appropriate, and transformative in response to the demands of local, national, and international
            communities in a highly dynamic world.
        </div>

        <div class="mt-3">
            <h5>Goals:</h5>
            <span class="ms-4">Develop </span> globally competitive, value-laden professionals capable of making a
            positive social, environmental, and economic impact through research and community service.
        </div>

        <hr>

        <div class="mt-3">
            <span class="ms-4">Learning </span> Enhancement and Support. Foster student learning and support by
            leveraging student strengths and meeting their specific needs through targeted success pathways.

            Adaptive
            to change through innovation. Create an environment that encourages learners to be more innovative and
            resilient in order to adapt to today's highly dynamic world.

            Well-grounded
            in research. Conduct extensive research based on facts and sound
            reasoning to expand the learner's knowledge, promote effective learning, comprehend different concerns and
            trends, seek the truth, and identify opportunities that lie ahead.
        </div>

        <div class="mt-3">
            <span class="ms-4">Inculcate </span>
            Inculcate moral values. Instill positive attitudes and high moral virtues towards daily activities in and outside the school.
            Social Responsibility. Ensure the relevance, alignment and support of the community and businesses by providing outreach, bridge programs, and community-focused facilities.
        </div>

        <hr>

        <div class="row mt-3">
            <div class="col-12">
                <h5>STUDENT EXAM FEEDBACKS</h5>
            </div>

            <?php if($feedbacks->rowCount() > 0): 
                    $data = $feedbacks->fetchAll(PDO::FETCH_ASSOC);
                ?>
                
                <?php foreach($data as $feedback): ?>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="fw-bold"><?= $feedback['name'] ?></h5>
                        <p class="text-center">" <?= $feedback['feedback'] ?> "</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p>No record found</p>
                    </div>
                <?php endif; ?>

        </div>

    </div>
    
  <hr class="text-light">
 <footer class="h-100">
    <div class="container py-3 text-center" style="color: hsl(0, 0%, 80%);">
        <h5>Madridejos Community College</h5>
        <p class="mb-0">7P7F+F99, Bantayan – Madridejos Rd, Madridejos, 6053 Cebu</p>
        <p class="mb-0">+639279817079</p>
        <p class="mb-0">8:00 a.m. – 4:00 p.m.</p>
        <div class="d-flex justify-content-center mt-2">
            <a href="https://www.facebook.com/share/gcNmP9AbQT92p6E4/" class="mx-2">
                <i class="fab fa-facebook" style="font-size: 20px;  color:white;"></i>
            </a>
            <a href="https://www.google.com" class="mx-2">
                <i class="fab fa-google" style="font-size: 20px; color:white;" ></i>
            </a>
            <a href="tel:+639279817079" class="mx-2">
                <i class="fas fa-phone" style="font-size: 20px; color:white;"></i>
            </a>
        </div>
        <p class="mt-3">&copy; John Michaelle Robles 2024</p>
    </div>
</footer>

</body>
    
