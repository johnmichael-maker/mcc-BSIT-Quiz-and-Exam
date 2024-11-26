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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="assets/img/file.png" type="image/x-icon">

    <title>MCC Competition : QUIZ BOWL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS (for icons) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="assets/img/file.png" type="">
    <link href="radiance/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/home.css" rel="stylesheet">
    <link href="radiance/css/responsive.css" rel="stylesheet">
    <style>
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
            color: #333;
        }

        .navbar-nav .nav-item-spacing::after {
            content: "";
            display: block;
            width: 0;
            height: 2px;
            background-color: red;
            transition: width 0.3s ease;
            position: absolute;
            bottom: -3px;
            left: 0;
        }

        .navbar-nav .nav-item-spacing:hover::after {
            width: 100%;
            color: #333;
        }

        .adjust-text {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .adjust-text h1 {
            margin-bottom: 15px;
        }

        .adjust-text h3 {
            margin-bottom: 10px;
        }

        .adjust-img {
            margin-top: 100px;
        }

        .adjust-img img {
            margin-top: 10px;
        }

        .hero_area {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .header-carousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .owl-carousel-item img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .carousel-content-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            text-align: center;
            color: white;
            padding: 0 20px;
        }

        .carousel-content-box h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .carousel-content-box p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }

        .carousel-content-box .btn {
            font-size: 1.2rem;
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .carousel-content-box .btn:hover {
            background-color: #0056b3;
        }

        .header-carousel .owl-dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .header-carousel .owl-dots .owl-dot span {
            background-color: white;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .header-carousel .owl-dots .owl-dot.active span {
            background-color: #007bff;
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

  
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
    }
/* Mobile-friendly adjustments */
@media (max-width: 768px) {
    /* Adjust navbar items spacing */
    .navbar-nav .nav-link {
        font-size: 16px;
    }

    /* Adjust modal buttons for sign-up */
    .btn-role {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Adjust carousel image for mobile */
    .owl-carousel-item img {
        width: 100%;
        height: auto;
    }

    /* Adjust the text in the About Us section for readability */
    .container {
        padding-left: 10px;
        padding-right: 10px;
    }

    .text-black {
        font-size: 14px;
    }

    .fs-5 {
        font-size: 16px;
    }

    /* Button styling on smaller screens */
    .btn-signup {
        width: 100%;
        font-size: 18px;
        padding: 10px 0;
    }
}
/* Make sure images are always responsive */
.header-carousel img {
    width: 100%;
    height: auto;
}

/* Adjust carousel content padding and margins on mobile */
@media (max-width: 768px) {
    .header-carousel .container {
        padding-left: 15px;
        padding-right: 15px;
    }

    .header-carousel h1 {
        font-size: 1.75rem; /* Smaller font size for smaller screens */
    }

    .header-carousel p {
        font-size: 1rem; /* Adjust paragraph font size */
    }

    .header-carousel .btn {
        padding: 10px 20px; /* Adjust button padding on smaller screens */
    }
}

/* Adjust font size for very small screens */
@media (max-width: 576px) {
    .header-carousel h1 {
        font-size: 1.5rem; /* Smaller font size for very small screens */
    }

    .header-carousel p {
        font-size: 0.875rem; /* Smaller paragraph text */
    }

    .header-carousel .btn {
        padding: 8px 16px; /* Further reduce button size */
    }
}

    </style>
</head>

<body>

  <!-- Header Section -->
  <header class="header_section">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="index.php">
        <img src="assets/img/file.png" alt="Logo" class="logo" style="max-height: 50px; margin-right: 10px;">
        <span style="color: #333; font-size: 20px;">BSIT QUIZ  <span style="color: #c82333;  font-size: 20px;" >AND EXAM</span></span>
        </a>

      
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        style="background-color: #f8f9fa; border-color: #c82333; padding: 8px; border-radius: 4px; margin-top: -8px; margin-right: -6px;">
            <span class="navbar-toggler-icon"></span>
          <span></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item active">
            <a href="index.php" class="nav-link nav-item-spacing" target="_blank">Home</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link nav-item-spacing" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="help.php" class="nav-link nav-item-spacing" target="_blank">Contact</a>
            </li>
            <li class="nav-item">
              <a id="dosdonts-link" href="javascript:void(0);" class="nav-link nav-item-spacing" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign up</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
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
  <!-- Carousel Start -->
  <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="assets/img/mcc-bg.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background:rgba(0, 0, 0, 0.6);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                            <h1 class="display-3 text-white animated slideInDown" style="font-weight: bold;">Welcome to the Pop Quiz Competition and Examination!</h1>

                            <p class="fs-5 text-white mb-4 pb-2">
                        <br><br>
                        Our carefully designed quizzes and exams offer a great way to evaluate your knowledge and track your progress. Get ready to compete, learn, and gain recognition for your achievements. Whether you're aiming for certification or just want to test your knowledge, this is the perfect platform for you.
                    </p>
                    <button class="btn btn-signup btn-danger py-md-3 px-md-5 me-3 animated slideInLeft openFormButton" data-bs-toggle="modal" data-bs-target="#signUpModal" >Sign up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

            <div class="owl-carousel-item position-relative">
    <img class="img-fluid" src="assets/img/graduation.png" alt="Graduation Image">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background:rgba(0, 0, 0, 0.6);">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-sm-10 col-lg-8">
                    <!-- Updated Heading for Examination -->
                    <h1 class="display-3 text-white animated slideInDown" style="font-weight: bold;" >Examinations & Certification</h1>
                    
                    <!-- Updated Description about Examinations -->
                    <p class="fs-5 text-white mb-4 pb-2">
                        Prepare for our comprehensive examinations designed to assess your knowledge and skills in various academic and professional fields. 
                        <br><br>
                        Take part in official exams and earn certifications that can open doors to new career opportunities and academic advancements. 
                        Whether you're looking to challenge yourself or gain official recognition for your knowledge, our examinations offer a structured, formalized approach to success.
                    </p>
                    
                    <!-- Sign In Button -->
                    <button class="btn btn-signup btn-danger py-md-3 px-md-5 me-3 animated slideInLeft openFormButton" data-bs-toggle="modal" data-bs-target="#signUpModal" >Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>


            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="assets/img/bsit.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background:rgba(0, 0, 0, 0.6);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown" style="font-weight: bold;">Join the Pop Quiz Competition</h1>
                                <p class="fs-5 text-white mb-4 pb-2"> Test your knowledge and compete with others in our exciting Pop Quiz Competition! Whether you're a student or a quiz enthusiast, this is your chance to show off your skills and win fantastic prizes.
                                <br><br>
                        Participate in a series of fun and challenging quizzes across various topics, ranging from general knowledge to specialized subjects. Are you ready to take the challenge and prove you're the best?
                        </p>
                                </p>
                                <button class="btn btn-signup btn-danger py-md-3 px-md-5 me-3 animated slideInLeft openFormButton" data-bs-toggle="modal" data-bs-target="#signUpModal" >Sign up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <!-- Carousel End -->

  <!-- About Us Section -->
  <div class="container text-black mt-3 py-3">
    <h3 class="border-bottom border-2" style="width: fit-content;" data-aos="fade-up" data-aos-duration="900">About Us</h3>
    <div data-aos="fade-left" data-aos-duration="900">
        <span class="ms-4">Madridejos</span> Community College (MCC) is a higher education institution located in Bunakan, Madridejos, a municipality in the province of Cebu, Philippines. The college was established to provide accessible and affordable education to the local community, focusing on developing skilled professionals who can contribute to the region's socioeconomic growth.
    </div>
    <hr>
    <div class="mt-3" data-aos="fade-left" data-aos-duration="900">
        <h5>Vision:</h5>
        <span class="ms-4">The </span> Madridejos Community College envisions a society comprised of fully competent individuals with benevolent character, innovative, service-oriented, and highly empowered to meet and exceed challenges as proactive participants in shaping our world's future.
    </div>
    <div class="mt-3" data-aos="fade-left" data-aos-duration="900">
        <h5>Mission:</h5>
        <span class="ms-4">Madridejos </span> Community College is a safe, accessible, and affordable learning environment that aims to foster academic and career success through development of critical thinking, creativity, informed research, and social responsibility.
    </div>
    <div class="mt-3" data-aos="fade-left" data-aos-duration="900">
        <h5>Goals:</h5>
        <span class="ms-4">Develop </span> globally competitive, value-laden professionals capable of making a positive social, environmental, and economic impact through research and community service.
    </div>

    <hr>

    <div class="mt-3" data-aos="fade-up" data-aos-duration="900">
        <span class="ms-4">Learning </span> Enhancement and Support. Foster student learning and support by leveraging student strengths and meeting their specific needs through targeted success pathways.
    </div>

    <div class="mt-3" data-aos="fade-up" data-aos-duration="900">
        <span class="ms-4">Inculcate </span> Inculcate moral values. Instill positive attitudes and high moral virtues towards daily activities in and outside the school.
    </div>

    <hr>

    <!-- Student Exam Feedback Section -->
    <div class="row mt-3">
      <div class="col-12">
        <h5>STUDENT EXAM FEEDBACKS</h5>
      </div>

      <!-- PHP Logic to Display Feedbacks -->
      <?php if ($feedbacks->rowCount() > 0): 
          $data = $feedbacks->fetchAll(PDO::FETCH_ASSOC);
      ?>
          <?php foreach ($data as $feedback): ?>
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
          <p>No feedback found.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- End of About Us and Feedback Sections -->
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
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script>
  $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
          loop: true,           // Enable looping of slides
          margin: 10,           // Space between slides
          nav: true,            // Show next/prev buttons
          items: 1,             // Number of items visible at a time
          autoplay: true,       // Enable autoplay
          autoplayTimeout: 3000, // Time between each slide
          autoplayHoverPause: true, // Pause on hover
      });
  });
</script>
</body>

</html>
