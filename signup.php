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
                      <p> <a  class="home-link" href="index.php">Back Home</a></p>
                </div>
                </div>
            <?php elseif ($_GET['signup'] == 'quiz') : ?>
                <form name="signup" method="post" class="m-auto" id="signup-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="signup.php" class="btn btn-secondary mb-2"><i class="bx bx-arrow-back"></i></a>
                            <h3 class="text-center fw-bold my-3"><i class="bx bx-question-mark"></i>Pop Quiz</h3>
                            <h5 class="mb-3">Please sign up first</h5>

                            <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to questions page....</p>

                            <label for="">ID Number</label>
                            <input type="text" class="form-control my-2" placeholder="ID Number" name="id_number" required>
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
                                for($i = 1; $i <= count($databaseController->getSections()) ; $i++): 
                                    
                                ?>
                                    <option value="<?= $i ?>"><?= $databaseController->getSections()[$i] ?></option>
                                <?php endfor; ?>
                            </select>

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
                            <a href="signup.php" class="btn btn-secondary mb-2"><i class="bx bx-arrow-back"></i></a>
                            <h3 class="text-center fw-bold my-3"><i class="bx bx-file"></i> Exam</h3>
                            <h5 class="mb-3">Please sign up first</h5>

                            <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to questions page....</p>

                            <p class="alert alert-danger py-2 d-none" id="alert-incorrect">Error, Credentials doesn't match</p>

                            <label for="">ID Number</label>
                            <input type="text" class="form-control my-2" placeholder="ID Number" name="id_number" required>
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
                            <select name="exam_id" class="form-select my-2">
                                <?php 
                                $exams = $databaseController->getExams();
                                foreach($exams as $exam): 
                                   
                                ?>
                                    <option value="<?= $exam['id'] ?>"><?= $databaseController->sections($exam['section']) .' | '. $databaseController->yearLevel()[$exam['year_level']] ?> - <?= $databaseController->semester()[$exam['semester']] ?> / <?= $databaseController->examType()[$exam['type']] ?> </option>
                                <?php endforeach; ?>
                            </select>
                                    
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
    <?php require __DIR__ . '/./partials/footer.php' ?>
