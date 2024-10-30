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
  .footer-background {
  background-color: #002e5b; /* Dark blue background */
  color: #fff; /* White text color */
  padding: 50px 0;
}

.footer-background a {
  color: #ffffff; /* White text for links */
  text-decoration: none;
}

.footer-background a:hover {
  color: crimson; /* Change to crimson on hover */
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
        font-size: 14px; /* Adjust font size if needed */
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); /* Slight shadow to distinguish from the rest of the page */
    }

    .footer-copyright {
        color: #f8f9fa; /* Footer text color */
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
            <!-- Logo and Title (hidden on mobile) -->
            <div class="d-flex align-items-center d-none d-md-flex">
                <img src="assets/img/logo.png" alt="Logo" style="width: 130px; height: 90px; margin-left: 20px;">
                <h1 class="header-title text-blue ml-3" style="color: #4d4d4d; font-size: 2rem;">MADRIDEJOS COMMUNITY COLLEGE</h1>

             
            </div>
            
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <img src="assets/img/logo.png" alt="MCC Logo" class="logo-img smooth-move">
                </div>
                <div class="col-lg-8 h-100 my-auto text-light">
                    
    <div class="container text-light mt-3 py-3">
        <h3 class="border-bottom border-2" style="width: fit-content;">About Us</h3>
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

    <div class="container text-light mt-3 py-3">
    <h3 class="border-bottom border-2" style="width: fit-content;">History</h3>
        <div>
            <span class="ms-4"></span> Founded in 2005 through a community-led initiative, Madridejos Community College emerged as a beacon of accessible, high-quality education on Bantayan Island. Inspired by the dedication of local leaders and driven by the mission to empower through education.
        </div>

         <hr>

<div class="row">
    <div class="col-lg-6 fade-in-left">
        <img src="assets/img/img-1.jpeg" alt="image" class="w-100">
    </div>
    <br>
    <div class="col-lg-6 fade-in-right">
        <img src="assets/img/img-2.jpeg" alt="image" class="w-100">
    </div>
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
    </div>
  
           <footer class="h-100 footer-background">
  <div class="container">
<div class="footer-wrapper">

																												
							<div id="footer" class="footer footer-3"
>
			<div class="footer-main">
			<div class="container">
				
									<div class="row">
														<div class="col-lg-6">
									<aside id="text-2" class="widget widget_text">			<div class="textwidget"><h3 class="white_text ftr-logo-txt">Madridejos community College</h3>
<p class="ftr-txt">is a higher education institution located in Bunakan, Madridejos, a municipality in the province of Cebu, Philippines. The college was established to provide accessible and affordable education to the local community, focusing on developing skilled professionals who can contribute to the region's socioeconomic growth.</p>
</div>
		</aside><aside id="follow-us-widget-2" class="widget follow-us">		<div class="share-links">
        <a href="#" rel="noopener noreferrer" target="_blank" data-toggle="tooltip" data-bs-placement="bottom" title="Facebook" class="share-facebook">
            <i class="fab fa-facebook"></i> Facebook
        </a>
        <a href="#" rel="noopener noreferrer" target="_blank" data-toggle="tooltip" data-bs-placement="bottom" title="YouTube" class="share-youtube">
            <i class="fab fa-youtube"></i> YouTube
        </a>
        <a href="#" rel="noopener noreferrer" target="_blank" data-toggle="tooltip" data-bs-placement="bottom" title="Instagram" class="share-instagram">
            <i class="fab fa-instagram"></i> Instagram
        </a>
									</div>

		</aside>								</div>
																<div class="col-lg-2">
									<aside id="nav_menu-2" class="widget widget_nav_menu"><h3 class="widget-title">Links</h3><div class="menu-main-menu-container"><ul id="menu-main-menu-1" class="menu"><div id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-22"><a href="https://mccbsitquizandexam.com">Home</a></div>
<div id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-13 current_page_item menu-item-21"><a href="https://mccbsitquizandexam.com/about.php" aria-current="page">About us</a></div>
<div id="menu-item-19" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-19"><a href="https://mccbsitquizandexam.com/about.php">Contact Us</a></div>
</ul></div></aside>								</div>
																<div class="col-lg-4">
									<aside id="contact-info-widget-2" class="widget contact-info"><h3 class="widget-title">Contact Us</h3>		<div class="contact-info contact-info-block">
						<ul class="contact-details list list-icons">
									<div><i class="far fa-dot-circle"></i> <strong>Address:</strong> <span>Madridejos community college.</span></li></div>	<div><i class="far fa-dot-circle"></i> <strong></strong> <span>7P7F+F99, Bantayan – Madridejos Rd, Madridejos, 6053 Cebu</span></li></div>									<div><i class="fab fa-whatsapp"></i> <strong>Phone:</strong> <span>+639279817079</span></div>									</ul>
					</div>

		</aside>								</div>
													</div>
				
							</div>
		</div>
	
	<div class="footer-bottom">
	<div class="container">
		
    <div class="footers text-center">
    <span class="footer-copyright">
        Copyright © 2024 Madridejos Community College created by John Michaelle Robles
    </span>
</div>

												
					
		</div>
							
		</div>	
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
