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
    <link rel="stylesheet" href="https://mccbsitquizandexam.com/assets/css/style.css">
    <link rel="stylesheet" href="https://mccbsitquizandexam.com/assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="https://mccbsitquizandexam.com/assets/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS (for icons) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://mccbsitquizandexam.com/dist/css/home.css">
    <link rel="shortcut icon" href="https://mccbsitquizandexam.com/assets/img/file.png" type="">
<style>
header {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(assets/img/mcc-bg.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 0;
    height: 120vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
 /* Define the pop-up animation */
 @keyframes popUp {
      0% {
        opacity: 0;
        transform: scale(0.8);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* Apply animation to individual elements with delays */
    .pop-up {
      animation: popUp 0.8s ease-out forwards;
    }

    .pop-up-delay-1 {
      animation-delay: 0.3s;
    }

    .pop-up-delay-2 {
      animation-delay: 0.6s;
    }

    .pop-up-delay-3 {
      animation-delay: 0.9s;
    }
    body, html {
        overflow-x: hidden; /* Prevent horizontal scrolling */
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 100%; /* Ensures container doesn't overflow */
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
    .header_section {
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .navbar-nav .nav-item-spacing {
            position: relative;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            margin-right: 0;
        }

        .navbar-nav .nav-item-spacing:hover {
            text-decoration: none;
            color: crimson;
        }

        .navbar-nav .nav-item-spacing::after {
            content: "";
            display: block;
            width: 0;
            height: 2px;
            background-color: crimson;
            transition: width 0.3s ease;
            position: absolute;
            bottom: -3px;
            left: 0;
        }

        .navbar-nav .nav-item-spacing:hover::after {
            width: 100%;
            color: crimson;
        }
	 h4 {
            font-weight: bold;
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid #fff;
            width: fit-content;
            animation: blinkCursor 0.7s steps(2) infinite;
        }

        
        @keyframes blinkCursor {
            0% {
                border-right-color: #fff;
            }
            50% {
                border-right-color: transparent;
            }
            100% {
                border-right-color: #fff;
            }
        }
</style>
</head>
<body>
  
  <nav class="navbar navbar-expand-lg" style="background: #fff;position: fixed; top: 0; left: 0; right: 0; z-index: 1000;">
    <div class="container-fluid d-flex align-items-center justify-content-between">
      
        <div class="d-flex align-items-center">
           
          
            <img src="assets/img/bsit-logo.png" alt="Logo" style="width: 90px; height: 70px; margin-left: -13px;">
            
            <div class="d-none d-md-block">
                <h6 class="header-title text-blue ml-3" style="color: #666666; font-size: 15px;">
                  MCC BSIT QUIZ<span style="color: #c82333;"> AND EXAMINATION</span>
                </h6>
            </div>
            
            <div class="d-block d-md-none" style="margin-left: -13px;">
    <h6 class="header-title text-blue" style="color: #666666; font-size: 12px;">
        MCC BSIT QUIZ<span style="color: #c82333;"> AND EXAMINATION</span>
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
                        <a href="index.php" class="nav-link nav-item-spacing">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link nav-item-spacing">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link nav-item-spacing">CONTACT</a>
                    </li>
                    <li class="nav-item">
                    <button class="btn btn-signup btn-danger" class="nav-link nav-item-spacing"  data-bs-toggle="modal" data-bs-target="#signUpModal">SIGN UP</button>
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
                    <a href="register_instructor.php" class="btn btn-role btn-primary">Instructor</a>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 h-100 my-auto text-light">
        <div class="content-left">
          <!-- Rotating Text Section -->
          <h1 class="display-3 text-white animated slideInDown pop-up pop-up-delay-1" style="font-weight: bold;">
            Welcome to the Pop Quiz Competition and Examination!
          </h1>
          <div id="rotatingText" class="pop-up pop-up-delay-2">
            <h3 class="rotating-text">Our carefully designed quizzes and exams offer a great way to evaluate your knowledge and track your progress.</h3>
            <h3 class="rotating-text">Join the competition and challenge yourself to excel in various topics!</h3>
            <h3 class="rotating-text">Track your learning progress with detailed results and feedback.</h3>
            <h3 class="rotating-text">Test your skills and boost your confidence with every quiz!</h3>
          </div>
	    <br>
	          <h4 id="autoWriteText"></h4>

<script>
    const text = "Madridejos Community College"; 
    const speed = 75; 
    let index = 0;

    function smoothAutoWrite() {
        const element = document.getElementById("autoWriteText");
        if (index <= text.length) {
            element.textContent = text.slice(0, index); 
            index++;
        } else {
            clearInterval(autoWriteInterval); 
            element.style.borderRight = "none"; 
        }
    }

    const autoWriteInterval = setInterval(smoothAutoWrite, speed);
</script>
          <p class="pop-up pop-up-delay-3">&copy; John Michaelle Robles</p>
        </div>
      </div>
      <div class="col-lg-4 d-flex justify-content-center align-items-center">
        <img class="right-img pop-up pop-up-delay-4" decoding="async" width="600" height="350" src="https://cdn2.exam.net/website-2024-11-05/wp-content/uploads/2024/03/home-hero-graphic-1-1024x762.png" alt="User Interface of Exam.net">
      </div>
    </div>
  </div>
</header>

<!-- Add JavaScript for smooth text rotation with delay -->
<script>
  let currentIndex = 0;
  const rotatingTexts = document.querySelectorAll('.rotating-text');
  
  function rotateText() {
    // Hide all texts
    rotatingTexts.forEach(text => {
      text.classList.remove('show');
    });
    
    // Show the current text with smooth transition
    rotatingTexts[currentIndex].classList.add('show');
    
    // Move to the next text or loop back to the first
    currentIndex = (currentIndex + 1) % rotatingTexts.length;
  }
  
  // Initialize the first text to display
  rotateText();
  
  // Set interval for text rotation with delay of 4 seconds (4000ms)
  setInterval(rotateText, 8000);
</script>

<!-- Add CSS for smooth rotation effect with delay -->
<style>
  #rotatingText {
    position: relative;
    height: 100px; /* Adjust according to the height of your text */
  }
  
  .rotating-text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    transition: opacity 1s ease-in-out; /* Smooth fade-in/out */
    transition-delay: 1s; /* Delay before the next fade */
  }
  
  .rotating-text.show {
    opacity: 1;
    transition-delay: 0s; /* Immediately show the next text */
  }
</style>



<head>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body>

<div class="container text-light mt-3 py-3">
    <h3 class="border-bottom border-2" style="width: fit-content;" data-aos="fade-up" data-aos-duration="900">
        About Us
    </h3>
    <div data-aos="fade-left" data-aos-duration="900">
        <span class="ms-4">Madridejos</span> Community College (MCC) is a higher education institution located in
        Bunakan, Madridejos, a municipality in the province of Cebu, Philippines. The college was established to
        provide accessible and affordable education to the local community, focusing on developing skilled
        professionals who can contribute to the region's socioeconomic growth.
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
        environment that aims to foster academic and career success through development of critical thinking,
        creativity, informed research, and social responsibility. Our mission is to deliver academic programs that
        are timely, appropriate, and transformative in response to the demands of local, national, and international
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

        Adaptive to change through innovation. Create an environment that encourages learners to be more innovative and
        resilient in order to adapt to today's highly dynamic world.

        Well-grounded in research. Conduct extensive research based on facts and sound reasoning to expand the learner's
        knowledge, promote effective learning, comprehend different concerns and trends, seek the truth, and identify
        opportunities that lie ahead.
    </div>

    <div class="mt-3" data-aos="fade-up" data-aos-duration="900">
        <span class="ms-4">Inculcate </span>
        Inculcate moral values. Instill positive attitudes and high moral virtues towards daily activities in and outside
        the school.
        Social Responsibility. Ensure the relevance, alignment, and support of the community and businesses by providing
        outreach, bridge programs, and community-focused facilities.
    </div>

    <!-- Student Exam Feedback Section -->
    <hr>
    <div class="row mt-3">
        <div class="col-12">
            <h5>STUDENT EXAM FEEDBACKS</h5>
        </div>

        <!-- PHP Logic to Display Feedbacks -->
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

// Disable F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
        document.onkeydown = function (e) {
            if (
                e.key === 'F12' ||
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
                (e.ctrlKey && e.key === 'U')
            ) {
                e.preventDefault();
            }
        };

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


        // Disable developer tools
        function disableDevTools() {
            if (window.devtools.isOpen) {
                window.location.href = "about:blank";
            }
        }

        // Check for developer tools every 100ms
        setInterval(disableDevTools, 100);

        // Disable selecting text
        document.onselectstart = function (e) {
            e.preventDefault();
        };
</script>

</body>

</html>
