<?php

declare(strict_types=1);

namespace App;

use App\Database;
use App\Sessions;

class Examinee extends Database
{
    use Sessions;
    private $passed_data;
    public $message;
    public function __construct($passed_data)
    {
        $this->passed_data = json_decode(file_get_contents("php://input"), true);
    }

    public function signUpExaminee()
    {
        $conn = $this->getConnection();
        
        $data = [
            $this->passed_data['fname'],
            $this->passed_data['lname'],
            $this->passed_data['mname'],
            $this->passed_data['year_level'],
            $this->passed_data['id_number'],
            $this->passed_data['section'],
            $this->passed_data['exam_id']
        ];

        $stmt = $conn->prepare("INSERT INTO examinees(fname,lname,mname,year_level,id_number,section,exam_id) VALUES(?,?,?,?,?,?,?)");
        $name = [
            $data[0],
            $data[1],
            $data[2],
            $data[3],
            $data[4],
            $data[5],
            $data[6]
        ];

        $count = 0;

        $check = $this->checkExamineeData($name);
        $get_id = $conn->prepare("SELECT id FROM examinees ORDER BY id DESC");
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
                $current_data['year_level'],
                $current_data['id'],
                $current_data['exam_id'],
                $current_data['section']
            ];
            $this->activateExamineeSession($current);
            $this->message = "success";
        } else {
            $stmt->execute($data);
            if ($stmt) {
                array_push($data, $count);
                $this->activateExamineeSession($data);
                $this->message = "success";
            } else {
                $this->message = "error";
            }
        }

        return $this->message;
    }

    private function checkExamineeData($value)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM examinees WHERE fname = ? AND lname = ? AND mname = ? AND year_level = ? AND id_number = ? AND section = ? AND exam_id = ?");
        $stmt->execute($value);
        return $stmt;
    }

    public function isStudentDashboard(){
        $url = implode(explode('/mcc-bsit-quiz-and-exam', strtolower($_SERVER['REQUEST_URI'])));
        if (str_contains('/exam.php', $url)) {
            return true;
        }else{
            return false;
        }
    }

    public function getExamById(){
        $exam_id = $_SESSION['EXAM_ID'];
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM exams WHERE id = :id");
        $stmt->execute([':id' => $exam_id]);
        return $stmt;
    }


}
