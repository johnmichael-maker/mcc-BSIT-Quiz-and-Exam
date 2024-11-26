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
	<link rel="shortcut icon" href="assets/img/file.png" type="">
	<link rel="stylesheet" href="assets/css/home.css">
    <style>
header {
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(./assets/img/school.jpg);
    background-size: cover;
    background-position: center;
    padding: 20px 0;
}

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
   <nav class="navbar navbar-expand-lg" style="background: #fff;">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      
        <div class="d-flex align-items-center">
           
          
            <img src="assets/img/logo.png" alt="Logo" style="width: 130px; height: 80px; margin-left: -18px;">
            
            <div class="d-none d-md-block">
                <h6 class="header-title text-blue ml-3" style="color: #666666; font-size: 15px;">
                    MADRIDEJOS <span style="color: #c82333;">COMMUNITY COLLEGE</span>
                </h6>
            </div>
            
            <div class="d-block d-md-none" style="margin-left: -13px;">
    <h6 class="header-title text-blue" style="color: #666666; font-size: 12px;">
        MADRIDEJOS <span style="color: #c82333;">COMMUNITY</span>
    </h6>
    <h6 class="header-title text-blue" style="color: #c82333; font-size: 12px; margin-top: -5px;">
        COLLEGE
    </h6>
 </div>
   </div>
            
       
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        style="background-color: #f8f9fa; border-color: #c82333; padding: 8px; border-radius: 4px; margin-top: -8px; margin-right: -6px;">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
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
                  <img src="assets/img/bsit-logo.png" alt="MCC Logo" class="logo-img smooth-move">
                </div>
                <div class="col-lg-8 h-100 my-auto text-light">
                    
       <div class="container text-light mt-3 py-3">
        <h3 class="border-bottom border-2" style="width: fit-content;"  data-aos="fade-up" data-aos-duration="900">About Us</h3>
        <div>
            <span class="ms-4">Madridejos</span> Community College (MCC) is a higher education institution located in
            Bunakan, Madridejos, a municipality in the province of Cebu, Philippines. The college was established to
            provide accessible and affordable education to the local community, focusing on developing skilled
            professionals who can contribute to the region's socioeconomic growth.
        </div>
                    
                </div>
            </div>
        </div>
    </header>

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
     body,
    html {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 100%;
    }

    footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

.footer-wrapper {
    display: flex;
    justify-content: space-between; /* Distribute space between the footer sections */
    align-items: center; /* Vertically align the content */
    flex-wrap: wrap; /* Ensure that content wraps on smaller screens */
    gap: 20px; /* Adds space between the items */
}

.footer-main {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    width: 100%;
}

.footer-bottom {
    background-color: #222;
    padding: 10px 0;
    text-align: center;
}

.footer-copyright {
    font-size: 14px;
}

/* Media query for smaller screens (mobile) */
@media (max-width: 768px) {
    .footer-wrapper {
        flex-direction: column; /* Stack footer items vertically */
        align-items: center; /* Center the items horizontally */
    }

    .footer-main {
        flex-direction: column; /* Stack footer content vertically */
        align-items: center;
    }

    .footer-copyright {
        font-size: 12px;
    }
}

    .home-hero{
        text-decoration: none;
    }
    .home-hero:hover{
        color: crimson;
    }

    .fade-in-left {
        animation: fadeInLeft 1s ease-in-out;
    }

    .fade-in-right {
        animation: fadeInRight 1s ease-in-out;
    }

    @keyframes fadeInLeft {
        0% {
            opacity: 0;
            transform: translateX(-50px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
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

    .hidden {
        opacity: 0;
    }

    .visible {
        opacity: 1;
    }
   /* Adjusting image size and applying border radius */
.img-style {
    width: 100%;
    max-width: 100%;
    height: auto;
    border-radius: 15px; /* Rounded corners */
    object-fit: cover;
}

/* Mobile (small screens) Layout */
@media (max-width: 768px) {
    .row {
        display: flex;
        flex-direction: column; /* Stack images vertically */
        gap: 20px; /* Add space between the images */
    }

    .col-lg-6 {
        width: 100%; /* Ensure the columns are full width on mobile */
    }

    .img-style {
        width: 100%; /* Make images full width on mobile */
    }
}

/* For extra small screens (very narrow viewports) */
@media (max-width: 480px) {
    .row {
        gap: 10px; /* Reduce the space between images */
    }
}

</style>
</head>

<body>


<div class="container text-light mt-3 py-3">
<div class="mt-3" data-aos="fade-left" data-aos-duration="900">
        <h3 class="border-bottom border-2" style="width: fit-content;" data-aos="fade-up" data-aos-duration="900">History</h3>
        <div>
            <span class="ms-4"></span> Founded in 2005 through a community-led initiative, Madridejos Community College
            emerged as a beacon of accessible, high-quality education on Bantayan Island. Inspired by the dedication of
            local leaders and driven by the mission to empower through education.
        </div>

        <hr>

        <div class="row">
    <div class="col-lg-6 fade-in-left">
        <img src="assets/img/img-1.jpeg" alt="image" class="img-style w-100">
    </div>
    <div class="col-lg-6 fade-in-right">
        <img src="assets/img/img-2.jpeg" alt="image" class="img-style w-100">
    </div>
</div>


        <hr>

        <div class="mt-3" data-aos="fade-left" data-aos-duration="900">
            <h5>Vision:</h5>
            <span class="ms-4">The </span> Madridejos Community College envisions a society comprised of fully competent
            individuals with benevolent character, innovative, service-oriented, and highly empowered to meet and exceed
            challenges as proactive participants in shaping our world's future.
        </div>

        <div class="mt-3" data-aos="fade-left" data-aos-duration="900">
            <h5>Mission:</h5>
            <span class="ms-4">Madridejos </span> Community College is a safe, accessible, and affordable learning
            environment that aims to foster academic and career success through the development of critical thinking,
            creativity, informed research, and social responsibility. Our mission is to deliver academic programs that are
            timely, appropriate, and transformative in response to the demands of local, national, and international
            communities in a highly dynamic world.
        </div>

        <div class="mt-3" data-aos="fade-left" data-aos-duration="900">
            <h5>Goals:</h5>
            <span class="ms-4">Develop </span> globally competitive, value-laden professionals capable of making a
            positive social, environmental, and economic impact through research and community service.
        </div>

        <hr>

        <div class="mt-3" data-aos="fade-up" data-aos-duration="900">
            <span class="ms-4">Learning </span> Enhancement and Support. Foster student learning and support by
            leveraging student strengths and meeting their specific needs through targeted success pathways.
            Adaptive to change through innovation. Create an environment that encourages learners to be more innovative
            and resilient in order to adapt to today's highly dynamic world.
            Well-grounded in research. Conduct extensive research based on facts and sound reasoning to expand the
            learner's knowledge, promote effective learning, comprehend different concerns and trends, seek the truth,
            and identify opportunities that lie ahead.
        </div>

        <div class="mt-3" data-aos="fade-right" data-aos-duration="900">
            <span class="ms-4">Inculcate </span>
            Inculcate moral values. Instill positive attitudes and high moral virtues towards daily activities in and
            outside the school.
            Social Responsibility. Ensure the relevance, alignment, and support of the community and businesses by
            providing outreach, bridge programs, and community-focused facilities.
        </div>
    </div>

</div>
<!-- Footer Section -->
<footer class="h-100 footer-background">
    <div class="container">
        <div class="footer-wrapper">
            <div id="footer" class="footer footer-3">
                <div class="footer-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <aside id="text-2" class="widget widget_text">
                                    <div class="textwidget">
                                        <h3 class="white_text ftr-logo-txt">Madridejos Community College</h3>
                                        <p class="ftr-txt">is a higher education institution located in Bunakan, Madridejos, a municipality in the province of Cebu, Philippines. The college was established to provide accessible and affordable education to the local community, focusing on developing skilled professionals who can contribute to the region's socioeconomic growth.</p>
                                    </div>
                                </aside>
                                <aside id="follow-us-widget-2" class="widget follow-us">
                                    <div class="share-links">
                                        <a href="#" class="home-hero"><i class="fab fa-facebook"></i> Facebook</a>
                                        <a href="#" class="home-hero"><i class="fab fa-youtube"></i> YouTube</a>
                                        <a href="#" class="home-hero"><i class="fab fa-instagram"></i> Instagram</a>
                                    </div>
                                </aside>
                            </div>
                            <div class="col-lg-2">
                                <aside id="nav_menu-2" class="widget widget_nav_menu">
                                    <h3 class="widget-title">Links</h3>
                                    <ul id="menu-main-menu-1" class="menu">
                                        <li><a href="https://mccbsitquizandexam.com" class="home-hero">Home</a></li>
                                        <li><a href="https://mccbsitquizandexam.com/about.php" aria-current="page" class="home-hero">About Us</a></li>
                                        <li><a href="https://mccbsitquizandexam.com/contact.php" class="home-hero">Contact Us</a></li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-lg-4">
                                <aside id="contact-info-widget-2" class="widget contact-info">
                                    <h3 class="widget-title">Contact Us</h3>
                                    <ul class="contact-details list list-icons">
                                        <li><i class="far fa-dot-circle"></i> <strong>Address:</strong> Madridejos Community College, 7P7F+F99, Bantayan – Madridejos Rd, Madridejos, 6053 Cebu</li>
                                        <li><i class="fab fa-whatsapp"></i> <strong>Phone:</strong> +639279817079</li>
                                    </ul>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="text-center">
                            <span class="footer-copyright">Copyright © 2024 Madridejos Community College created by John Michaelle Robles</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<!-- Optional: Intersection Observer for Scroll Animations -->
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

	document.addEventListener('contextmenu', function(e) {
    e.preventDefault(); // Disables right-click menu
});

// Prevent specific key combinations
document.addEventListener('keydown', function(e) {
    // Disable specific key combinations such as Ctrl + I, Ctrl + U, Ctrl + J, Ctrl + C, Ctrl + S, F12
    if (e.ctrlKey || e.metaKey) {
        if (
            e.key === 'i' ||  // Ctrl + I (Inspect)
            e.key === 'u' ||  // Ctrl + U (View Source)
            e.key === 'j' ||  // Ctrl + J (Console)
            e.key === 'c' ||  // Ctrl + C (Copy)
            e.key === 's' ||  // Ctrl + S (Save)
            e.key === 'k' ||  // Ctrl + K (Search Console)
            e.key === 'h' ||  // Ctrl + H (History)
            e.key === 'd' ||  // Ctrl + D (Bookmark)
            e.key === 'r' ||  // Ctrl + R (Reload)
            e.key === 'p' ||  // Ctrl + P (Print)
            e.key === 'f' ||  // Ctrl + F (Find)
            e.key === 'q' ||  // Ctrl + Q (Quit)
            e.key === 'F12'   // F12 (Developer Tools)
        ) {
            e.preventDefault();  // Prevent default action
            return false;
        }
    }
});

</script>

</body>

</html>
