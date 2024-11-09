
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="assets/img/file.png">
     <title>Instructor | Verification</title>
     
     <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
     <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="assets/css/liness.css">
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />
     <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
     <link rel="stylesheet" href="assets/css/login.css">

     <style>
          .back {
               font-size: 30px;
               color: black;
          }
          .back:hover {
               color: gray;
          }
          .home-link{
            text-decoration: none;
            color:#3b3663 ;
          }
          .home-link:hover{
            color: crimson;
          }
     </style>
</head>

<body style="background-image: url('assets/img/image-22.png'); background-size: cover; background-position: center; background-attachment: fixed;">

     <section class="d-flex mt-1 flex-column justify-content-center align-items-center">
          <div class="container">
               <div class="col mx-auto rounded shadow bg-white">
                    <div class="row">
                         <div class="col-md-6 ">
                              <div class="">
                                   <img src="assets/img/file.png" alt="logo"
                                        class="img-fluid d-none d-md-block  p-5" />
                              </div>
                         </div>
                         <div class="col-sm-12 col-md-6 px-5 " style="margin-top: 60px;">
                              <div class="mt-3 mb-4">
                                   <center>
                                        <h2 class="m-0 fw-semibold text-danger">
                                        INSTRUCTOR VERIFICATION
                                        </h4>
                                        <br>
                                        <p class="fs-5 fw-semibold">Enter your MS 365 Username account to receive a registration link.</p>
                                   </center>
                              </div>
                              <form id="registrationForm" action="./app/submit_instructor.php" method="post" class="needs-validation" novalidate onsubmit="return validateEmail(event)"
                              style="margin-top:30px;">
                                   <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                             <input type="email" id="email" class="form-control"
                                                  name="Username" placeholder="MS 365 Email" required>
                                             <label for="email">Enter MS 365 Email</label>
                                             <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                  Please enter your MS 365 Email.
                                             </div>
                                        </div>
                                   </div>
                                   <div class="d-grid gap-2 md-3">
                                        <button type="submit"  value="Submit"
                                             class="btn btn-danger text-light font-weight-bolder btn-lg">Submit</button>
                                     </div>


                                     <div class="text-start mt-5 fw-bold">
                                 <p>
                                 <a class="home-link" href="index.php">Back Home</a>
                                  </p>
                                </div>

                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function validateEmail(event) {
        event.preventDefault(); 
        const email = document.getElementById('email').value;
        const domain = "@mcclawis.edu.ph";
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
    Swal.fire({
        title: 'Please input the field with a valid email address',
        icon: 'warning',
        confirmButtonText: 'OK'
    });
    return false;
}

        if (!email.endsWith(domain)) {
            Swal.fire({
                title: 'Invalid Domain',
                text: 'Please enter an email address with the ' + domain + ' domain.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return false; 
        }

       
        submitForm();
        return false; 
    }

    function submitForm() {
    $.ajax({
        type: 'POST',
        url: './app/submit_instructor.php',
        data: $('#registrationForm').serialize(),
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                // Display success message centered
                $('#registrationForm').html('<div class="d-flex justify-content-center align-items-center" style="height: 100px;"><p>Registration link has been sent successfully.</p></div>');
                showPopup('Thank you! The registration link has been sent to your Outlook email.', 'success');
            } else {
                showPopup(response.status, 'error');
            }
        },
        error: function () {
            showPopup('An error occurred while sending the registration link.', 'error');
        }
    });
}


    function showPopup(message, type) {
        Swal.fire({
            title: message,
            icon: type,
            confirmButtonText: 'OK'
        });
    }
     
     (function() {
               'use strict';

               var forms = document.querySelectorAll('.needs-validation');

               Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                         form.addEventListener('submit', function(event) {
                              if (!form.checkValidity()) {
                                   event.preventDefault();
                                   event.stopPropagation();
                              }

                              form.classList.add('was-validated');
                         }, false);
                    });
          })();
    </script>
<script>
   
document.addEventListener('contextmenu', function(e) {
    e.preventDefault(); 
});


document.addEventListener('keydown', function(e) {
    
    if (e.ctrlKey || e.metaKey) {
        if (
            e.key === 'i' ||  
            e.key === 'u' ||  
            e.key === 'j' ||  
            e.key === 'c' ||  
            e.key === 's' ||  
            e.key === 'k' ||  
            e.key === 'h' ||  
            e.key === 'd' ||  
            e.key === 'r' || 
            e.key === 'p' ||  
            e.key === 'f' ||  
            e.key === 'q' ||  
            e.key === 'F12'   
        ) {
            e.preventDefault();  
            return false;
        }
    }
});

</script>
<script src="assets/js/validation.js"></script>
<script src="assets/js/show-hide-password.js"></script>
<script src="assets/js/format_number.js"></script>
<script src="assets/js/bootstrap5.bundle.min.js"></script>
<script src="assets/js/tooltip.js"></script>
<script src="assets/js/login.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="assets/js/alertify.min.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>
<script src="assets/js/aos.js"></script>
<script>
AOS.init();
</script>
</body>
</html></body>
</html>
