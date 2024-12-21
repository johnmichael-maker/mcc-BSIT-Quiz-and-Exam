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

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="dist/css/home.css">

    <link rel="shortcut icon" href="assets/img/file.png" type="">

<style>

header {

    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(assets/img/mcc-bg.jpg);

    background-size: cover;

    background-repeat: no-repeat;

    background-position: center;

    padding: 0;

    height: 110vh;

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

</style>

</head>

<body>

  

  <nav class="navbar navbar-expand-lg" style="background: #fff; position: fixed; top: 0; left: 0; right: 0; z-index: 1000;">

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



            <!-- Modal Body -->

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

                  

                </div>

                <div class="col-lg-8 h-100 my-auto text-light">

    

                <footer class="h-100 footer-background">

  <div class="container">

    <div class="footer-wrapper">

      <div id="footer" class="footer footer-3">

        <div class="footer-main">

          <div class="container">

            <div class="row">

              <!-- Google Maps Column -->

              <div class="col-lg-6">

                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-6fbe358">

                  <div class="elementor-widget-wrap elementor-element-populated">

                    <div class="elementor-element elementor-element-22f5606 elementor-widget-google_maps">

                      <div class="elementor-widget-container">

                        <div class="elementor-custom-embed">

                            <h3 class="fade-in-left">Madridejos community college</h3>

                          <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Madridejos%20Community%20College&t=m&z=16&output=embed&iwloc=near" title="Madridejos Community College" aria-label="Madridejos Community College"></iframe>

                        </div>

<i class="fab fa-envelope" class="fade-in-right"></i> Email: madridejoscommunitycollege@gmail.com

</a>

                      </div>

                    </div>

                  </div>

                </div>

              </div>



              <!-- Links Column -->

              <div class="col-lg-2">

                <aside id="nav_menu-2" class="widget widget_nav_menu">

                  <h3 class="widget-title">Links</h3>

                  <div class="menu-main-menu-container">

                    <ul id="menu-main-menu-1" class="menu">

                      <li id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home">

                        <a href="https://mccbsitquizandexam.com">Home</a>

                      </li>

                      <li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-13 current_page_item">

                        <a href="https://mccbsitquizandexam.com/about.php">About us</a>

                      </li>

                      <li id="menu-item-19" class="menu-item menu-item-type-post_type menu-item-object-page">

                        <a href="https://mccbsitquizandexam.com/about.php">Contact Us</a>

                      </li>

                    </ul>

                  </div>

                </aside>

              </div>



              <!-- Contact Us Column -->

              <div class="col-lg-4">

                <aside id="contact-info-widget-2" class="widget contact-info">

                  <h3 class="widget-title">Contact Us</h3>

                  <div class="contact-info contact-info-block">

                    <ul class="contact-details list list-icons">

                      <li>

                        <i class="far fa-dot-circle"></i> 

                        <strong>Address:</strong> 

                        <span>Madridejos Community College</span>

                      </li>

                      <li>

                        <i class="far fa-dot-circle"></i> 

                        <span>7P7F+F99, Bantayan – Madridejos Rd, Madridejos, 6053 Cebu</span>

                      </li>

                      <li>

                        <i class="fab fa-whatsapp"></i> 

                        <strong>Phone:</strong> 

                        <span>+639279817079</span>

                      </li>

                    </ul>

                  </div>

                </aside>

              </div>

            </div>

          </div>

        </div>



        <!-- Footer Bottom -->

        <div class="footer-bottom">

          <div class="container">

            <div class="footers text-center">

              <span class="footer-copyright">

                Copyright © 2024 Madridejos Community College created by John Michaelle Robles

              </span>

            </div>

          </div>

        </div>

      </div>

    </div>

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

// Prevent right-click

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



    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">





</body>

</html>
