<?php

declare(strict_types=1);

namespace App;

use PDO;
use App\Database;
use App\Sessions;
use App\DatabaseControl;

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
    
    // Sanitize and prepare the data
    $data = [
        htmlspecialchars(strip_tags(trim($this->passed_data['fname']))),
        htmlspecialchars(strip_tags(trim($this->passed_data['lname']))),
        htmlspecialchars(strip_tags(trim($this->passed_data['mname']))),
        intval($this->passed_data['year_level']), // Ensure year_level is an integer
        htmlspecialchars(strip_tags(trim($this->passed_data['id_number']))),
        intval($this->passed_data['section']), // Ensure section is an integer
        htmlspecialchars(strip_tags(trim($this->passed_data['exam_id']))) // Sanitize exam_id
    ];

    // Generate a random ID (16-character string)
    $random_id = bin2hex(random_bytes(8));  // Generates a random ID based on 8 bytes, resulting in a 16-character string.

    // Prepare the SQL statement for inserting the examinee data
    $stmt = $conn->prepare("INSERT INTO examinees(fname,lname,mname,year_level,id_number,section,exam_id,random_id) VALUES(?,?,?,?,?,?,?,?)");

    // Prepare the values to insert, including the generated random ID
    $data_with_random_id = array_merge($data, [$random_id]); // Add random ID to the data

    // Check if the student is valid
    if ($this->validateStudent($data[6])) {
        $check = $this->checkExamineeData($data);
        
        // If the examinee data already exists
        if ($check->rowCount() > 0) {
            // Fetch the existing examinee's data
            $current_data = $check->fetch();
            $current = [
                $current_data['fname'],
                $current_data['lname'],
                $current_data['mname'],
                $current_data['year_level'],
                $current_data['id_number'],
                $current_data['section'],
                $current_data['exam_id'],
            ];
            // Activate the examinee session
            $this->activateExamineeSession($current);
            $this->message = "success";
        } else {
            // Insert the new examinee with the random ID
            $stmt->execute($data_with_random_id);

            // Check if the insertion was successful
            if ($stmt) {
                // Push the random ID to the session data
                array_push($data, $random_id); // Add random ID to the session data
                $this->activateExamineeSession($data);
                $this->message = "success";
            } else {
                $this->message = "error";
            }
        }
    } else {
        $this->message = "error_incorrect";
    }

    return $this->message;
}


    private function checkExamineeData($value)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM examinees WHERE year_level = ? AND id_number = ? AND section = ? AND exam_id = ?");
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

    public function getExamByStudent(){
        $conn = $this->getConnection();
        $exam_id = $_SESSION['EXAM_ID'];

        $stmt = $conn->prepare("SELECT * FROM exams WHERE id = :exam_id");
        $stmt->execute([':exam_id' => $exam_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;

    }

    public function getIdentificationByExam($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM identification_choices");
        return $stmt;
    }

    public function submitAnswer(){
        $conn = $this->getConnection();
        $databaseController = new DatabaseControl;
        $exam_id = $_POST['exam_id'];
        $student_id = $_SESSION['ID'];

        $get_choices = $databaseController->getMultipleChoice($exam_id);

        foreach ($get_choices as $choice) {
            // echo $_POST["choices".$choice['id']];
            $multiple_choice = $conn->prepare("INSERT INTO answers_multiple_choice(id_number,multiple_choice_id,answer,exam_id) VALUES(:id_number, :multiple_choice_id, :answer,:exam_id)");
            $multiple_choice->execute([':id_number' => $student_id, ':multiple_choice_id' => $choice['id'], ':answer' => $_POST["choices".$choice['id']], ':exam_id' => $exam_id]);
        }

        $getIdentificationByExam = $databaseController->getIdentificationChoicesAdmin($exam_id);

        foreach ($getIdentificationByExam as $identif) {
            // var_dump($_POST['identification'.$identif['identification_id']]);

            $identification_answer = $conn->prepare("INSERT INTO answers_identification(exam_id,id_number,identification_id,choice_id,answer) VALUES(:exam_id,:id_number,:identification_id,:choice_id,:answer)");
            $identification_answer->execute([':exam_id' => $exam_id,':id_number' =>$student_id,':identification_id' => $identif['identification_id'], ':choice_id' => $identif['id'],':answer' => $_POST['identification'.$identif['identification_id']]]);

        }

        $get_enumeration = $databaseController->getEnumeration($exam_id);
    
        foreach ($get_enumeration as $enumeration) {
            for ($i = 0; $i < count($_POST['enumeration'. $enumeration['id']]); $i++) { 
                $enumeration_answer = $conn->prepare("INSERT INTO answers_enumeration(exam_id,id_number,enumeration_id,answer) VALUES(:exam_id,:id_number,:enumeration_id,:answer)");
                $enumeration_answer->execute([':exam_id' => $exam_id ,':id_number' => $student_id ,':enumeration_id' => $enumeration['id'],':answer' => $_POST['enumeration'. $enumeration['id']][$i]]);
            }
        }

        $get_essay = $databaseController->getEssay($exam_id);

        foreach ($get_essay as $essay) {
            $essay_answer = $conn->prepare("INSERT INTO answers_essay(exam_id,id_number,essay_id,answer) VALUES(:exam_id,:id_number,:essay_id,:answer)");
            $essay_answer->execute([':exam_id' => $exam_id ,':id_number' => $student_id ,':essay_id' => $essay['id'],':answer' => $_POST['essay'. $essay['id']]]);
        }

        $_SESSION['DISABLED'] = 1;

        header('location: finished.php');


    }

    public function checkMultiple($id){
        $conn = $this->getConnection();
        $student_id = $_SESSION['ID'];
        
        $stmt = $conn->prepare("SELECT * FROM multiple_choice WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $answer = $conn->prepare("SELECT * FROM answers_multiple_choice WHERE multiple_choice_id = :id AND id_number = :id_number");
        $answer->execute([':id' => $id, ':id_number' => $student_id]);
        $result_answer = $answer->fetch(PDO::FETCH_ASSOC);

        if ($answer->rowCount() > 0) {
            if ($result['answer'] == $result_answer['answer']) {
                return 1;
            }
        }

    }

    public function checkIdentification($id){
        $conn = $this->getConnection();
        $student_id = $_SESSION['ID'];
        
        $stmt = $conn->prepare("SELECT * FROM identification WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $answer = $conn->prepare("SELECT * FROM answers_identification WHERE identification_id = :id AND id_number = :id_number");
        $answer->execute([':id' => $id, ':id_number' => $student_id]);
        $result_answer = $answer->fetch(PDO::FETCH_ASSOC);

        if ($answer->rowCount() > 0) {
            if ($result['count'] == $result_answer['answer']) {
                return 1;
            }
        }

    }

    public function checkEnumeration($answer, $id){
        $conn = $this->getConnection();
        $student_id = $_SESSION['ID'];
        
        // $stmt = $conn->prepare("SELECT * FROM enumeration_correct WHERE enumeration_id = :id");
        // $stmt->execute([':id' => $id]);
        // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $answers = $conn->prepare("SELECT * FROM answers_enumeration WHERE enumeration_id = :id AND id_number = :id_number");
        $answers->execute([':id' => $id, ':id_number' => $student_id]);
        $result_answer = $answers->fetchAll(PDO::FETCH_ASSOC);

       foreach ($result_answer as $key => $value) {
        if (strtolower($answer) == strtolower($value['answer'])) {
            return 1;
        }
       }

    }

    public function updateScore($score){
        $conn = $this->getConnection();
        $student_id = $_SESSION['ID'];
        $status = 2;

        $stmt = $conn->prepare("UPDATE examinees SET score= :score, status = :status WHERE id_number = :id_number");
        $stmt->execute([':score' => $score, ':status' => $status, ':id_number' => $student_id]);

    }

    public function checkExaminee(){
        $conn = $this->getConnection();
        $status = 1;
        $student_id = $_SESSION['ID'];

        $stmt = $conn->prepare("SELECT * FROM examinees WHERE id_number = :id_number AND status = :status");
        $stmt->execute([':id_number' => $student_id, ':status' => $status]);

        if ($stmt->rowCount() > 0) {
            return 1;
        }else{
            $_SESSION['DISABLED'] = 1;
        }

    }

    public function checkExamineeSession(){
        if (!isset($_SESSION['EXAM_ID'])) {
            ?>
            <script>
                location.href = "index.html"
            </script>
            <?php 
        }
    }

    public function validateStudent(){
        $exam_id = $this->passed_data['exam_id'];
        $conn = $this->getConnection();

        $stmt = $conn->query("SELECT * FROM exams WHERE id = '$exam_id'");

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchObject();
            if ($result->year_level == $this->passed_data['year_level'] && $result->section == $this->passed_data['section']) {
                return true;
            }

        }


    }

  
    public function addFeedback() {
        $conn = $this->getConnection();
        
      
        $name = ucfirst($_SESSION['LNAME']) . ', ' . ucfirst($_SESSION['FNAME']) . ' ' . ucfirst($_SESSION['MNAME']);
        
      
        $feedback = $_POST['feedback'];
        
       
        $id_number = $_SESSION['ID'];
        $exam_id = $_SESSION['EXAM_ID'];
        
       
        $stmt = $conn->prepare("INSERT INTO feedbacks (id_number, exam_id, name, feedback) VALUES (:id_number, :exam_id, :name, :feedback)");
        
       
        $stmt->bindParam(':id_number', $id_number, PDO::PARAM_STR);
        $stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':feedback', $feedback, PDO::PARAM_STR);
        
      
        if ($stmt->execute()) {
           
            header('location: finished.php?message=Feedback added successfully');
            exit(); 
        } else {
          
            echo "Error adding feedback.";
        }
    }
    
    public function checkFeedback() {
        $conn = $this->getConnection();
        
       
        $name = ucfirst($_SESSION['LNAME']) . ', ' . ucfirst($_SESSION['FNAME']) . ' ' . ucfirst($_SESSION['MNAME']);
        $id_number = $_SESSION['ID'];
        $exam_id = $_SESSION['EXAM_ID'];
        
      
        $stmt = $conn->prepare("SELECT * FROM feedbacks WHERE id_number = :id_number AND exam_id = :exam_id");
        
        
        $stmt->bindParam(':id_number', $id_number, PDO::PARAM_STR);
        $stmt->bindParam(':exam_id', $exam_id, PDO::PARAM_INT);
        
       
        $stmt->execute();
        
       
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}    
 

  
