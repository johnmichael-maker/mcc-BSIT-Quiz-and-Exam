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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS (for icons) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
  
body {
    color: hsl(0, 0%, 20%); 
}

header {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url(./assets/img/mcc-bg.jpg);
    background-size: cover;
    background-position: center;
    padding: 0;
    height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.col-lg-8.h-100.my-auto.text-light {
    padding-top: 50px; 
}


@media (max-width: 768px) {
    header {
        height: auto; 
        padding: 20px 10px;
    }

    .col-lg-8.h-100.my-auto.text-light {
        padding-top: 20px; 
    }

    h1.fade-in-right {
        font-size: 24px; 
    }

    h3.fade-in-left {
        font-size: 18px; 
    }

    p {
        font-size: 14px; 
    }
}




header img {
    max-width: 100%; 
}

.nav-link {
    font-size: 20px;
}


.footer-background {
    background-color: #001f3f; 
    color: hsl(0, 0%, 80%); 
}

.footer-background a {
    color: white; 
}

.footer-background p {
    color: hsl(0, 0%, 90%); 
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50vh);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.fade-in-right {
    animation: fadeInRight 1s ease-in-out;
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-50vh);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.fade-in-left {
    animation: fadeInLeft 1s ease-in-out;
}


@media print {
    .dont-print {
        display: none !important;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }
}


.container {
    padding: 20px;
}

h3 {
    padding-bottom: 10px;
    color: #fff; 
}

h5 {
    color: #fff; 
    margin-bottom: 10px;
}

hr {
    border: 1px solid #e0e0e0; 
    margin: 20px 0;
}

span {
    font-weight: bold; 
}

.card {
    margin-bottom: 20px;
}


.hidden {
    opacity: 0;
    transform: translateY(50px); 
}


.visible {
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.6s ease, transform 0.6s ease;
}


.sticky-element {
    position: -webkit-sticky; 
    position: sticky;
    top: 0; 
    opacity: 1;
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.sticky-element.sticky-active {
    transform: translateY(0);
}

.sticky-element.sticky-inactive {
    transform: translateY(-50px); 
    opacity: 0;
}


@media (max-width: 1200px) {
    .nav-link {
        font-size: 18px;
    }
}

@media (max-width: 992px) {
    .container {
        padding: 15px;
    }

    .navbar-nav {
        text-align: center;
    }

    .card {
        margin-bottom: 15px;
    }
}

@media (max-width: 768px) {
    .header img {
        width: 80%; 
    }

    .nav-link {
        font-size: 16px;
    }
    
    .footer-background {
        padding: 15px;
    }

    .container {
        padding: 10px;
    }
}

@media (max-width: 576px) {
    .nav-link {
        font-size: 14px;
    }
    
    .footer-background p, .footer-background a {
        font-size: 14px;
    }

    .header img {
        width: 100%; 
    }
}

@keyframes smoothMove {
    0% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0); 
    }
}


.logo-img {
    max-width: 100%;
    height: auto;
}


.smooth-move {
    animation: smoothMove 3s ease-in-out infinite; 
}
.nav-link {
    text-decoration: none;
    padding: 10px;
   
}

.nav-link.active {
    font-weight: bold;
    color: red;
    border-bottom: 2px solid red;
}
h6.fw-bold {
    color: black; 
} .navbar-toggler { border: none; }
        .navbar-toggler-icon { background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30"%3E%3Cpath stroke="%23333" stroke-width="2" d="M5 6h20M5 12h20M5 18h20" /%3E%3C/svg%3E'); }
        .hidden { opacity: 0; transform: translateY(20px); transition: opacity 0.5s, transform 0.5s; }
        .visible { opacity: 1; transform: translateY(0); }
        .sticky-active { position: fixed; top: 0; width: 100%; z-index: 1000; }
        .sticky-inactive { position: static; }
        .logo-img { max-width: 100%; height: auto; }
        .navbar-toggler {
         border: none;
}

.navbar-toggler-icon {
    background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 30 30"%3E%3Cpath stroke="%23ff0000" stroke-width="2" d="M5 6h20M5 12h20M5 18h20" /%3E%3C/svg%3E');
    color: crimson; /* Fallback color */
    size: 15px;
}
/* Default link color and font family */
.navbar-nav .nav-link {
    color: #555; 
    font-size: 17px;
     font-weight: bold;
    text-transform: none; 
    letter-spacing: 0; 
    line-height: 1.5;
    text-decoration: none; 
    padding: 0.5rem 1rem; /
}
.navbar-nav .nav-item {
    margin: 0 1rem; 
}


.navbar-nav .nav-link:hover,
.navbar-nav .nav-link:focus {
   color: crimson; 
    font-size: 17px;
    text-decoration: none; 
}


.navbar-nav .nav-link.active {
  color: crimson; 
    font-size: 17px;
    text-decoration: none; 
}


.navbar-toggler {
    border: none; 
    padding: 0.5rem; 
}
  /* Modal Enhancements */
  .modal-content {
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
    }

    .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }

    .modal-body {
        font-size: 18px;
        color: #555;
        padding: 20px;
    }

    /* Role Buttons */
    .btn-role {
        border-radius: 30px;
        padding: 10px 25px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-role:hover {
        background-color: #0069d9;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Modal backdrop for a sleek effect */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .btn-signup {
        border-radius: 50px; /* Makes the button round */
        padding: 10px 25px; /* Increases button padding */
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    /* Optional: Button hover effect */
    .btn-signup:hover {
        background-color: #c82333; /* Slightly darker red on hover */
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background: #fff;">
    <div class="container-fluid mx-5">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="index.php" class="nav-link ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-signup btn-danger" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sign Up Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                 <h5 class="modal-title" id="signUpModalLabel" style="width: 100%; text-align: center; font-family: 'Arial', sans-serif;">Sign Up As</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

          <div class="modal-body">
                <p class="text-center mb-4">Select your role to sign up:</p>
                <div class="d-flex justify-content-center gap-4">
                    <a href="step_register.php" class="btn btn-role btn-success">Examinee</a>
                    <a href="./app/submit_instructor.php" class="btn btn-role btn-primary">Instructor</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <header class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                <img src="assets/img/logo.png" alt="MCC Logo" class="logo-img smooth-move">
                </div>
                <div class="col-lg-8 h-100 my-auto text-light">
                    <h1 class="fade-in-right">MADRIDEJOS COMMUNITY COLLEGE</h1>
                    <h3 class="fade-in-left">Pop Quiz and Exam</h3>
                       <p>&copy; John Michaelle Robles 2024</p>
                </div>
            </div>
        </div>
    </header>`

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
                            <h6 class="fw-bold"><?= htmlspecialchars($feedback['name']) ?></h6>
                            <p class="text-center">" <?= htmlspecialchars($feedback['feedback']) ?> "</p>
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
  
    <footer class="h-100 footer-background">
    <div class="container py-3 text-center">
        <h5 class="animate-on-scroll">Madridejos Community College</h5>
        <p class="mb-0 animate-on-scroll">7P7F+F99, Bantayan – Madridejos Rd, Madridejos, 6053 Cebu</p>
        <p class="mb-0 animate-on-scroll">+639279817079</p>
        <p class="mb-0 animate-on-scroll">8:00 a.m. – 4:00 p.m.</p>
        <div class="d-flex justify-content-center mt-2">
            <a href="https://www.facebook.com/share/gcNmP9AbQT92p6E4/" class="mx-2 animate-on-scroll">
                <i class="fab fa-facebook" style="font-size: 20px;"></i>
            </a>
            <a href="https://www.google.com" class="mx-2 animate-on-scroll">
                <i class="fab fa-google" style="font-size: 20px;"></i>
            </a>
            <a href="tel:+639279817079" class="mx-2 animate-on-scroll">
                <i class="fas fa-phone" style="font-size: 20px;"></i>
            </a>
        </div>
           <p class="mt-3">Copyright © 2024 Madridejos Community College | Create by John Michaelle Robles</p>
        </div>
    </footer>
    
    <script>
document.addEventListener("DOMContentLoaded", function() {
    
    const options = {
        root: null, 
        rootMargin: '0px',
        threshold: 0.1 
    };

   
    const handleIntersect = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); 
            }
        });
    };

   
    const observer = new IntersectionObserver(handleIntersect, options);

  
    const elements = document.querySelectorAll('.animate-on-scroll');

    
    elements.forEach(element => {
        element.classList.add('hidden'); 
        observer.observe(element);
    });
});

document.addEventListener("scroll", function() {
    const stickyElement = document.querySelector('.sticky-element');
    const rect = stickyElement.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom >= 0) {
        stickyElement.classList.add('sticky-active');
        stickyElement.classList.remove('sticky-inactive');
    } else {
        stickyElement.classList.add('sticky-inactive');
        stickyElement.classList.remove('sticky-active');
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.forEach(nav => nav.classList.remove('active')); 
            link.classList.add('active'); 
        });
    });
});

</script>
</body>
</html>
