<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Contestants;
use App\Admin;
use App\DatabaseControl;
use App\Examinee;

$contestantController = new Contestants($_POST);
$adminController = new Admin($_POST);
$examineeController = new Examinee($_POST);
$databaseController = new DatabaseControl();
$contestantController->startSession();   
$data = json_decode(file_get_contents("php://input"), true);

if (isset($_POST)) {
    $response = '';
    if (isset($data['level'])) {
        $response = $contestantController->signUpContestant();
    }

    if (isset($data['year_level'])) {
        $response = $examineeController->signUpExaminee();
    }

    if (isset($data['answer'])) {
        $response = $contestantController->saveAnswer();
    }
    if (isset($data['question'])) {
        $response = $adminController->addQuestion();
    }

    if (isset($data['next'])) {
        $response = $adminController->nextQuestion();
    }

    if(isset($data['question_id'])){
        $response = $contestantController->confirmQuestion();
    }

    if(isset($data['get_average'])){
        $response = $adminController->getAverage();
    }

    if (isset($data['login'])) {
        $response = $adminController->login();
    }

    if (isset($data['forgot_password'])) {
        $response = $adminController->forgotPassword();
    }

    if (isset($data['reset_password'])) {
        $response = $adminController->resetPassword();
    }

    echo $response;
}

if (isset($_GET)) {
    if (isset($_GET['questions'])) {
      echo $databaseController->getQuestions();
    }

    if (isset($_GET['contestants'])) {
        echo $databaseController->getContestants();
    }
    if (isset($_GET['disableAccount'])) {
        $contestantController->accountDisable();
    }
    if (isset($_GET['logoutAccount'])) {
        if ($_GET['logoutAccount'] == 'shinratensiegomugomunobabyshark') {
            $adminController->sessionDestroy();
            echo "success";
        }
    }
    if (isset($_GET['start'])) {
        echo $adminController->startCompetition();
    }
    if (isset($_GET['answers'])) {
        echo $databaseController->getAnswers();
    }
    if (isset($_GET['contestantsData'])) {
        echo $databaseController->getContestantsData();
    }

    if (isset($_GET['add-exam'])) {
        echo $adminController->addExam();
    }

    if (isset($_GET['edit-exam'])) {
        echo $adminController->editExam();
    }

    if (isset($_GET['add-multiple-choice'])) {
        $adminController->addMultipleChoice();
    }

    if (isset($_GET['add-identification-question'])) {
        $adminController->addIdentificationQuestion();
    }

    if (isset($_GET['add-identification-choice'])) {
        $adminController->addIdentificationChoice();
    }

    if (isset($_GET['add-enumeration'])) {
        $adminController->addEnumeration();
    }

    if (isset($_GET['add-essay'])) {
        $adminController->addEssay();
    }

    
}