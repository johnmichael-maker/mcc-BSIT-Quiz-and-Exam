<?php
declare(strict_types=1);

namespace App;
use App\Database;

Trait Sessions {
    public function startSession() {
        // Set secure session cookie parameters before starting session
        session_set_cookie_params([
            'httponly' => true,
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on', // Ensure it's only sent over HTTPS
            'samesite' => 'Strict', // Optional: to prevent CSRF attacks
        ]);
        session_start();
    }
    
    private function activateContestantSession($data){
        $_SESSION['FNAME'] = $data[0];
        $_SESSION['LNAME'] = $data[1];
        $_SESSION['MNAME'] = $data[2];
        $_SESSION['LEVEL'] = $data[3];
        $_SESSION['ID'] = $data[4];
        $_SESSION['SECTION'] = $data[5];
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
        $db = new Database;
        $conn = $db->getConnection();
        $contestant_id = $_SESSION['ID'];
        $query = $conn->query("UPDATE contestants SET status = '2' WHERE id_number = '$contestant_id'");
    }

    public function checkSession(){
        if (!isset($_SESSION['FNAME']) && !isset($_SESSION['LNAME']) && !isset($_SESSION['MNAME']) && !isset($_SESSION['LEVEL']) && !isset($_SESSION['ID'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'signup.php')) {
                header("Location: signup.php");
            }
        }
    }

   private function activeAdminSession($username, $image, $userType){
        $_SESSION['AUTH_KEY'] = $username;
        $_SESSION['AUTH_IMG'] = $image;
        $_SESSION['AUTH_UTYPE'] = $userType;
        $_SESSION['ADMIN_ACTIVE'] = true;
    }

    public function sessionDestroy(){
        session_destroy();
    }

    public function sessionHard(){
        $_SESSION['HARD_LEVEL'] = true;
    }
}
