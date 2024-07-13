<?php
declare(strict_types=1);

namespace App;

Trait Sessions{
    public function startSession(){
        session_start();
    }
    
    private function activateContestantSession($data){
        $_SESSION['FNAME'] = $data[0];
        $_SESSION['LNAME'] = $data[1];
        $_SESSION['MNAME'] = $data[2];
        $_SESSION['LEVEL'] = $data[3];
        $_SESSION['ID'] = $data[4];
    }

    private function activateExamineeSession($data){
        $_SESSION['FNAME'] = $data[0];
        $_SESSION['LNAME'] = $data[1];
        $_SESSION['MNAME'] = $data[2];
        $_SESSION['LEVEL'] = $data[3];
        $_SESSION['ID'] = $data[4];
        $_SESSION['EXAM_ID'] = $data[6];
        $_SESSION['SECTION'] = $data[5];
    }

    public function accountDisable(){
        $_SESSION['DISABLED'] = 1;
    }

    public function checkSession(){
        if (!isset($_SESSION['FNAME']) && !isset($_SESSION['LNAME']) && !isset($_SESSION['MNAME']) && !isset($_SESSION['LEVEL']) && !isset($_SESSION['ID'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'signup.php')) {
                header("Location: signup.php");
            }
        }
    }

    private function activeAdminSession($username, $image){
        $_SESSION['AUTH_KEY'] = $username;
        $_SESSION['AUTH_IMG'] = $image;
        $_SESSION['ADMIN_ACTIVE'] = true;
    }

    public function sessionDestroy(){
        session_destroy();
    }

    public function sessionHard(){
        $_SESSION['HARD_LEVEL'] = true;
    }
}