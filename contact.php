<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC Competition : Pop Quiz</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS (for icons) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="assets/img/file.png" type="">
    <style>
    
body {
    color: hsl(0, 0%, 20%); 
}

header {
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(./assets/img/school.jpg);
    background-size: cover;
    background-position: center;
    padding: 20px 0;
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
     @keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.fade-in-left {
    animation: fadeInLeft 1s ease-in-out;
}

.fade-in-right {
    animation: fadeInRight 1s ease-in-out;
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
    color: red; 
    font-size: 17px;
    text-decoration: none; 
}


.navbar-nav .nav-link.active {
   color: red; 
    font-size: 17px;
    text-decoration: none; 
}


.navbar-toggler {
    border: none; 
    padding: 0.5rem; 
}

.row .col-lg-6 img {
    border-radius: 10px; 
}
    .nav-bot {
            display: inline-block;
            padding: 10px 20px;
            font-size: 15px;
            color: white;
            background-color: skyblue; 
            border: none;
            border-radius: 50px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .nav-bot:hover {
            background-color: crimson; 
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
        border-radius: 50px; 
        padding: 10px 25px; 
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    
    .btn-signup:hover {
        background-color: #c82333; 
    }
  .footer-background {
  background-color: #002e5b; 
  color: #fff; 
  padding: 50px 0;
}

.footer-background a {
  color: #ffffff; 
  text-decoration: none;
}

.footer-background a:hover {
  color: crimson; 
}

.footer-background h5 {
  font-family: 'Karla', sans-serif;
  font-weight: 700;
  margin-bottom: 10px;
}

.footer-background p {
  font-family: 'Karla', sans-serif;
  font-weight: 400;
  margin: 5px 0;
}

.footer-background .social-icons {
  margin-top: 20px;
}

.footer-background .social-icons a {
  font-size: 20px;
  margin: 0 10px;
  color: white;
  transition: color 0.3s ease;
}

.footer-background .social-icons a:hover {
  color: #ffffff; /* White text on hover */
}

.footer-background .container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

@media (min-width: 768px) {
  .footer-background .container {
    flex-direction: row;
    justify-content: space-between;
  }
}
.footers {
        bottom: 0;
        width: 100%;
        padding: 10px 0;
        font-size: 14px; 
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); 
    }

    .footer-copyright {
        color: #f8f9fa; 
    }
     .footer-bottom {
    background-color: #222;
    padding: 10px 0;
    text-align: center;
}
    </style>
</head>

<body>
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
                    <a href="index.php" class="nav-link ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link">About Us</a>
                </li>
                 <li class="nav-item">
                    <a href="about.php" class="nav-link">Contact</a>
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
                  <img src="assets/img/bsit-logo.png" alt="MCC Logo" class="logo-img smooth-move">
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
