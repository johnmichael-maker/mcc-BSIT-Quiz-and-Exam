
    <?php
require __DIR__ . '/./partials/header.php';
// echo password_hash('1Admin', PASSWORD_DEFAULT);

?>

<style>
    @media (max-width: 900px){
        .choose-card{
            width: 100% !important;
           
        }

        .choose-div{
            position: absolute;
            top: 0;
            left: 0;
            padding: 15px;
            height: 100%;
            display: grid;
            place-content: center;
        }
    }
      .home-link{
        text-decoration: none;
        padding: 15px 30px;
        color: rgb(128, 171, 184);
    }
    
  .animated-image {
  position: relative; 
  animation: moveUpDown 2s infinite; 
}

@keyframes moveUpDown {
  0% {
    transform: translateY(0); 
  }
  50% {
    transform: translateY(-19px); 
  }
  100% {
    transform: translateY(0); 
  }
}
 /* Formatting loader */
    .result, .result1{
            width: 73%;
            position: absolute;        
            z-index: 999;
            top: 100%;
            left: 0;
        }
        /* Formatting result items */
        .result p, .result1 p{
            margin: 0;
            padding: 5px 5px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
            background-color: white;
        }
        .result p:hover, .result1 p:hover{
            background: #f2f2f2;
        }
        
    .loader-wrapper {
      position: fixed;
      z-index: 999999;
      background: #fff;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0; }
      .loader-wrapper .loader {
        height: 100px;
        width: 100px;
        position: fixed; }
        .loader-wrapper .loader .loader-inner {
          border: 0 solid transparent;
          border-radius: 50%;
          width: 150px;
          height: 150px;
          position: absolute;
          top: calc(50vh - 75px);
          left: calc(50vw - 75px); }
          .loader-wrapper .loader .loader-inner:before {
            content: '';
            border: 1em solid #f0452e;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: loader 2s linear infinite;
                    animation: loader 2s linear infinite;
            opacity: 0;
            -webkit-animation-delay: 0.5s;
                    animation-delay: 0.5s; }
          .loader-wrapper .loader .loader-inner:after {
            content: '';
            border: 1em solid #f0452e;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: loader 2s linear infinite;
                    animation: loader 2s linear infinite;
            opacity: 0; }
    
    @-webkit-keyframes loader {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
        opacity: 0; }
      50% {
        opacity: 1; }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
        opacity: 0; } }
    
    @keyframes loader {
      0% {
        -webkit-transform: scale(0);
                transform: scale(0);
        opacity: 0; }
      50% {
        opacity: 1; }
      100% {
        -webkit-transform: scale(1);
                transform: scale(1);
        opacity: 0; } }
    
    .loader-box {
      height: 150px;
      text-align: center;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
          -ms-flex-align: center;
              align-items: center;
      vertical-align: middle;
      -webkit-box-pack: center;
          -ms-flex-pack: center;
              justify-content: center;
      -webkit-transition: .3s color, .3s border, .3s transform, .3s opacity;
      transition: .3s color, .3s border, .3s transform, .3s opacity; }
      .loader-box [class*="loader-"] {
        display: inline-block;
        width: 50px;
        height: 50px;
        color: inherit;
        vertical-align: middle; }
</style>
<div class="loader-wrapper" id="preloader">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <script>
        var loader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            loader.style.display = "none"
        })
    </script>
<body class="py-5" style="max-height: 100vh;">
    <div class="h-100-vh d-lg-flex align-items-lg-center justify-content-lg-center position-relative " >
   
        <div class="container pb-5">

        <?php if (!isset($_GET['signup'])) : ?>
    <div class="choose-div">
        <div class="card mx-auto choose-card" style="width: 500px;">
            <div class="card-body text-center p-4">
                <img src="./assets/img/logo.png" alt="Logo" class="animated-image" style="width: 70%;">
                <h1>Hello <span class="text-danger fw-bold">Welcome!</span></h1>
                <p>What do you want to sign up as?</p>
                <div class="d-flex align-items-center gap-2 mt-4">
                    <a href="?signup=quiz" class="btn btn-danger w-100"><i class="bx bx-question-mark"></i>Pop Quiz</a>
                    <a href="?signup=exam" class="btn btn-danger w-100"><i class="bx bx-file"></i> Exam</a>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($_GET['signup'] == 'quiz') : ?>
    <form name="signup" method="post" class="m-auto" id="signup-card">
        <div class="card">
            <div class="card-body">
                <a href="student-signup.php" class="btn btn-secondary mb-2">
                    <i class="bx bx-arrow-back"></i>
                </a>
                <h3 class="text-center fw-bold my-3"><i class="bx bx-question-mark"></i>Pop Quiz</h3>
                <h5 class="mb-3">Please sign up first</h5>

                <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to questions page....</p>
                
              <!--<div class="field">
                    <div class="label">Ms 365 Email</div>
                    <input type="text" class="form-control my-2" name="Username" id="username" placeholder="MS 365 Email"
                        value="<?php echo htmlspecialchars($username); ?>" readonly required />
                </div>-->

                <label for="">ID Number</label>
                <input type="text" class="form-control my-2" placeholder="Ex: 2021-1732" name="id_number" required pattern="^\d{4}-\d{4}$" id="id_number">
                <p class="errors d-none alert alert-danger py-1"></p>

                <label for="">First Name</label>
                <input type="text" class="form-control my-2" placeholder="First Name" name="fname" required>
                <p class="errors d-none alert alert-danger py-1"></p>

                <label for="">Last Name</label>
                <input type="text" class="form-control my-2" placeholder="Last Name" name="lname" required>
                <p class="errors d-none alert alert-danger py-1"></p>

                <label for="">Middle Name</label>
                <input type="text" class="form-control my-2" placeholder="Middle Name" name="mname" required>

                <label for="">Year Level</label>
                <select name="level" class="form-select my-2">
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>

                <label for="">Section</label>
                <select name="section" class="form-select my-2">
                    <?php 
                    for($i = 1; $i <= count($databaseController->getSections()); $i++): 
                    ?>
                        <option value="<?= $i ?>"><?= $databaseController->getSections()[$i] ?></option>
                    <?php endfor; ?>
                </select>


  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">
        I agree to the <a href="#" id="termsLink">Terms and Conditions</a>
    </label>
</div>
                                  <script>

document.getElementById('termsLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior

    // Show SweetAlert with Terms and Conditions
    Swal.fire({
        title: 'Terms and Conditions',
        html: `
            <div class="terms-content">
               <h3>Prohibited Activities</h3> <p>As a student participating in exams or pop quiz competitions, you are prohibited from the following activities:</p> <ul> <li>Sharing or distributing quiz or examination content without authorization.</li> <li>Engaging in or promoting cheating, fraud, or dishonesty during the exam or quiz.</li> <li>Using unauthorized resources, including but not limited to mobile devices, internet, or external help during the exam or quiz.</li> <li>Discriminating against or harassing other students based on race, gender, ethnicity, or any other protected characteristic.</li> <li>Attempting to interfere with or disrupt the functionality of the exam platform, including tampering with system settings or attempting to hack the system.</li> <li>Engaging in any behavior that violates the academic integrity and fairness of the exam or quiz competition.</li> </ul>
        `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'I Agree',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'terms-popup'  
        },
        didOpen: () => {
            
            const container = document.querySelector('.terms-popup .swal2-html-container');
            container.style.maxHeight = '400px';
            container.style.overflowY = 'auto';
            
           
            const termsContent = document.querySelector('.terms-popup .terms-content');
            termsContent.style.textAlign = 'justify';
            termsContent.style.lineHeight = '1.6';     
        }
    }).then((result) => {
        if (result.isConfirmed) {
            
            document.getElementById('exampleCheck1').checked = true;
            document.querySelector('button[type="submit"]').disabled = false; // Enable the submit button
            Swal.fire('Accepted!', 'You have accepted the Students Terms and Conditions.', 'success');
        }
    });
});
</script>
                            <button type="submit" name="button" class="w-100 btn btn-danger mt-3">Submit</button>
                            <div class="text-center d-none" id="loading-signup">
                                <div class="spinner-border mt-3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            <?php elseif ($_GET['signup'] == 'exam') : ?>
                <form name="signup-exam" class="m-auto" id="signup-card">
                    <div class="card ">
                        <div class="card-body">
                           <a href="student-signup.php?token=<?php echo urlencode($token); ?>" class="btn btn-secondary mb-2">
                       <i class="bx bx-arrow-back"></i>
                            </a>
                            <h3 class="text-center fw-bold my-3"><i class="bx bx-file"></i> Exam</h3>
                            <h5 class="mb-3">Please sign up first</h5>

                            <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to questions page....</p>

                            <p class="alert alert-danger py-2 d-none" id="alert-incorrect">Error, Credentials doesn't match</p>
                            <div class="field">
                      <div class="label">Ms 365 Email</div>
                     <input type="text" class="form-control my-2" name="Username" id="username" placeholder="MS 365 Email"
                    value="<?php echo htmlspecialchars($username); ?>" 
                    readonly required />
                   </div>
                            <label for="">ID Number</label>
                             <input type="text" class="form-control my-2" placeholder="Ex: 2021-1732" name="id_number" required pattern="^\d{4}-\d{4}$" id="id_number">
                            <p class="errors d-none alert alert-danger py-1"></p>

                            <label for="">First Name</label>
                            <input type="text" class="form-control my-2" placeholder="First Name" name="fname" required>
                            <p class="errors d-none alert alert-danger py-1"></p>

                            <label for="">Last Name</label>
                            <input type="text" class="form-control my-2" placeholder="Last Name" name="lname" required>
                            <p class="errors d-none alert alert-danger py-1"></p>

                            <label for="">Middle Name</label>
                            <input type="text" class="form-control my-2" placeholder="Middle Name" name="mname" required>

                            <label for="">Year Level</label>
                            <select name="year_level" class="form-select my-2">
                                <option value="1">1st Year</option>
                                <option value="2">2nd Year</option>
                                <option value="3">3rd Year</option>
                                <option value="4">4th Year</option>
                            </select>

                            <label for="">Section</label>
                            <select name="section" class="form-select my-2">
                                <?php 
                                for($i = 1; $i <= count($databaseController->getSections()) ; $i++): 
                                    
                                ?>
                                    <option value="<?= $i ?>"><?= $databaseController->getSections()[$i] ?></option>
                                <?php endfor; ?>
                            </select>

                            <label for="">Choose Exam</label>
                            <select name="exam_id" class="form-select my-2"  required>>
                                 <?php 
                                $exams = $databaseController->getstudentExams();
                                foreach($exams as $exam): 
                                   
                                ?>
                                    <option value="<?= $exam['id'] ?>"><?= $databaseController->sections($exam['section']) .' | '. $databaseController->yearLevel()[$exam['year_level']] ?> - <?= $databaseController->semester()[$exam['semester']] ?> / <?= $databaseController->examType()[$exam['type']] ?> </option>
                                <?php endforeach; ?>
                            </select>
                                     <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="exampleCheck1">
        I agree to the <a href="#" id="termsLink">Terms and Conditions</a>
    </label>
</div>
                            <button type="submit" name="button" class="w-100 btn btn-danger mt-3">Submit</button>
                            <div class="text-center d-none" id="loading-signup">
                                <div class="spinner-border mt-3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            <?php else : ?>
            <?php endif; ?>
        </div>

    </div>
       <script>

document.getElementById('termsLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default link behavior

    // Show SweetAlert with Terms and Conditions
    Swal.fire({
        title: 'Terms and Conditions',
        html: `
            <div class="terms-content">
               <h3>Prohibited Activities</h3> <p>As a student participating in exams or pop quiz competitions, you are prohibited from the following activities:</p> <ul> <li>Sharing or distributing quiz or examination content without authorization.</li> <li>Engaging in or promoting cheating, fraud, or dishonesty during the exam or quiz.</li> <li>Using unauthorized resources, including but not limited to mobile devices, internet, or external help during the exam or quiz.</li> <li>Discriminating against or harassing other students based on race, gender, ethnicity, or any other protected characteristic.</li> <li>Attempting to interfere with or disrupt the functionality of the exam platform, including tampering with system settings or attempting to hack the system.</li> <li>Engaging in any behavior that violates the academic integrity and fairness of the exam or quiz competition.</li> </ul>
        `,
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'I Agree',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        customClass: {
            popup: 'terms-popup'  
        },
        didOpen: () => {
            
            const container = document.querySelector('.terms-popup .swal2-html-container');
            container.style.maxHeight = '400px';
            container.style.overflowY = 'auto';
            
           
            const termsContent = document.querySelector('.terms-popup .terms-content');
            termsContent.style.textAlign = 'justify';
            termsContent.style.lineHeight = '1.6';     
        }
    }).then((result) => {
        if (result.isConfirmed) {
            
            document.getElementById('exampleCheck1').checked = true;
            document.querySelector('button[type="submit"]').disabled = false; // Enable the submit button
            Swal.fire('Accepted!', 'You have accepted the Students Terms and Conditions.', 'success');
        }
    });
});
</script>
     <script>
         
document.addEventListener("DOMContentLoaded", function() {
    
    const idNumberInput = document.getElementById("id_number");
    const submitButton = document.getElementById("submit-btn");

    const idPattern = /^\d{4}-\d{4}$/;


    function checkIdNumber() {
        const idValue = idNumberInput.value;

        if (idPattern.test(idValue)) {
            submitButton.disabled = false;  
        } else {
            submitButton.disabled = true;   
        }
    }


    idNumberInput.addEventListener("input", checkIdNumber);

    
    checkIdNumber();
});


    </script>
    <?php require __DIR__ . '/./partials/footer.php' ?>
