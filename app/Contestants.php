<?php

declare(strict_types=1);

namespace App;

use App\Database;
use App\Sessions;
use PDO;

class Contestants extends Database
{
    use Sessions;
    private $passed_data;
    public $message;
    public function __construct($passed_data)
    {
        $this->passed_data = json_decode(file_get_contents("php://input"), true);
    }

    public function signUpContestant()
    {
        $conn = $this->getConnection();
        
        $data = [
            $this->passed_data['fname'],
            $this->passed_data['lname'],
            $this->passed_data['mname'],
            $this->passed_data['level'],
            $this->passed_data['id_number'],
            $this->passed_data['section']
        ];

        $stmt = $conn->prepare("INSERT INTO contestants(fname,lname,mname,year,id_number,section) VALUES(?,?,?,?,?,?)");
        $name = [
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
            $data[5]
        ];

        $count = 0;

        $check = $this->checkContestantData($name);
        $get_id = $conn->prepare("SELECT * FROM contestants ORDER BY contestant_id DESC");
        $get_id->execute();
        if ($get_id->rowCount() > 0) {
            $count = $get_id->rowCount() + 1;
        } else {
            $count = 1;
        }

        if ($check->rowCount() > 0) {
            $current_data = $check->fetch();
            $current = [
                $current_data['fname'],
                $current_data['lname'],
                $current_data['mname'],
                $current_data['year'],
                $current_data['contestant_id'],
                 $current_data['section']
            ];
            $this->activateContestantSession($current);
            $this->message = "success";
        } else {
            $stmt->execute($data);
            if ($stmt) {
                array_push($data, $count);
                $this->activateContestantSession($data);
                $this->message = "success";
            } else {
                $this->message = "error";
            }
        }

        return $this->message;
    }

    // public function signUpExaminee()
    // {
    //     $conn = $this->getConnection();
        
    //     $data = [
    //         $this->passed_data['fname'],
    //         $this->passed_data['lname'],
    //         $this->passed_data['mname'],
    //         $this->passed_data['year_level'],
    //         $this->passed_data['id_number'],
    //         $this->passed_data['section'],
    //         $this->passed_data['exam_id']
    //     ];

    //     $stmt = $conn->prepare("INSERT INTO examinees(fname,lname,mname,year_level,id_number,section,exam_id) VALUES(?,?,?,?,?,?,?)");
    //     $name = [
    //         $data[0],
    //         $data[1],
    //         $data[2],
    //         $data[3],
    //         $data[4],
    //         $data[5],
    //         $data[6]
    //     ];

    //     $count = 0;

    //     $check = $this->checkExamineeData($name);
    //     $get_id = $conn->prepare("SELECT id FROM examinees ORDER BY id DESC");
    //     $get_id->execute();
    //     if ($get_id->rowCount() > 0) {
    //         $count = $get_id->rowCount() + 1;
    //     } else {
    //         $count = 1;
    //     }

    //     if ($check->rowCount() > 0) {
    //         $current_data = $check->fetch();
    //         $current = [
    //             $current_data['fname'],
    //             $current_data['lname'],
    //             $current_data['mname'],
    //             $current_data['year_level'],
    //             $current_data['id'],
    //             $current_data['exam_id'],
    //             $current_data['section']
    //         ];
    //         $this->activateExamineeSession($current);
    //         $this->message = "success";
    //     } else {
    //         $stmt->execute($data);
    //         if ($stmt) {
    //             array_push($data, $count);
    //             $this->activateExamineeSession($data);
    //             $this->message = "success";
    //         } else {
    //             $this->message = "error";
    //         }
    //     }

    //     return $this->message;
    // }

    public function saveAnswer()
    {
        $conn = $this->getConnection();
        $contestant_id = $_SESSION['ID'];
        $answer = $this->passed_data['answer'];
        $question_id = $this->passed_data['question_id'];
        $time = $this->passed_data['time'];
        $check_answer = $this->passed_data['correct'];
        $code = $this->passed_data['code'];

        $stmt = $conn->prepare("INSERT INTO answers(contestant_id,answer,time,check_answer,question_id,check_code) VALUES(:contestant, :answer, :time, :correct,:id,:code)");

        $check_point = $conn->prepare("SELECT * FROM points WHERE contestant_id = :id");
        $check_point->execute([':id' => $contestant_id]);

        $check = $this->checkAnswer([$contestant_id, $question_id]);

        if ($check->rowCount() > 0) {
            $this->message = "Already answered";
        } else {
            if ($stmt->execute([':contestant' => $contestant_id, ':answer' => $answer, ':time' => $time, ':correct' => $check_answer, ':id' => $question_id, ':code' => $code])) {
                if ($check_point->rowCount() > 0) {

                    if ($code == null || $code == '') {
                        $stmt_points = $conn->prepare("UPDATE points SET time = :time ,check_answer = :correct WHERE contestant_id = :contestant");
                        $stmt_points->execute([':time' => $time, ':correct' => $check_answer, ':contestant' => $contestant_id,]);
                    } else {
                        $stmt_points = $conn->prepare("UPDATE points SET time = :time ,check_answer = :correct,check_code = check_code + :code WHERE contestant_id = :contestant");
                        $stmt_points->execute([':time' => $time, ':correct' => $check_answer, ':code' => $code, ':contestant' => $contestant_id,]);
                    }
                } else {
                    $stmt_points = $conn->prepare("INSERT INTO points(contestant_id,time,check_answer,check_code) VALUES(:contestant, :time, :correct,:code)");
                    $stmt_points->execute([':contestant' => $contestant_id, ':time' => $time, ':correct' => $check_answer, ':code' => $code]);
                }

                if ($stmt_points) {
                    $this->message = "success";
                }
            }
        }
        return $this->message;
    }

    public function checkAnswer($data)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM answers WHERE contestant_id = :contestant AND question_id = :question");
        $stmt->execute([':contestant' => $data[0], ':question' => $data[1]]);
        return $stmt;
    }

    public function confirmQuestion()
    {
        $conn = $this->getConnection();
        $active = 1;
        $stmt = $conn->prepare("UPDATE questions SET activation = :active WHERE question_id = :id");
        $stmt->execute([':active' => $active, ':id' => $this->passed_data['question_id']]);
        if ($stmt) {
            $this->message = "success";
        } else {
            $this->message = "error";
        }

        return $this->message;
    }

    private function checkContestantData($value)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM contestants WHERE fname = ? AND lname = ? AND mname = ? AND year = ? AND id_number = ? AND section = ?");
        $stmt->execute($value);
        return $stmt;
    }

    // private function checkExamineeData($value)
    // {
    //     $conn = $this->getConnection();
    //     $stmt = $conn->prepare("SELECT * FROM examinees WHERE fname = ? AND lname = ? AND mname = ? AND year_level = ? AND id_number = ? AND section = ? AND exam_id = ?");
    //     $stmt->execute($value);
    //     return $stmt;
    // }

    public function checkAccountStatus()
    {
        $conn = $this->getConnection();
        $stat = 2;
        if (isset($_SESSION['ID'])) {
            $contestant_id = $_SESSION['ID'];
            $stmt = $conn->prepare("SELECT * FROM contestants WHERE contestant_id = :id AND status = :stat");
            $stmt->execute([':id' => $contestant_id, ':stat' => $stat]);

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch();
                if ($result['status'] == 1) {
                    if ($result['check_answer'] == 'wrong') {
                        $this->accountDisable();
                    }
                }
            }
        }
    }

    public function checkAccount()
    {
        $conn = $this->getConnection();
        $stat = 2;
        $contestant_id = $_SESSION['ID'];
        if (isset($_SESSION['DISABLED'])) {
            $stmt = $conn->prepare("UPDATE contestants SET status = :stat WHERE contestant_id = :id");
            $stmt->execute([':stat' => $stat, ':id' => $contestant_id]);

            if ($stmt) {
?>
                <div class="alert-modal" id="alert-modal">

                    <div class="card position-relative bg-transparent pt-4 border-0 error-card">
                        <div class="position-absolute top-0 text-center w-100 success-icon mb-5">
                            <img src="assets/img/wrong-delete-remove-trash-minus-cancel-close-svgrepo-com (1).png" alt="Icon-png">
                        </div>
                        <div class="card-body bg-light text-center pt-4 text-success">
                            <h3 class="mt-4">Account Disabled</h3>
                            <p>Sorry but you are eliminated from the competition.</p>
                        </div>
                    </div>
                </div>
<?php
            }
        }
    }

    public function logout(){

    }

    
}
