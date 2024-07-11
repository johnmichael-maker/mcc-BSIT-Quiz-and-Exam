<?php

namespace App;

use PDO;
// use App\Database;
class DatabaseControl extends Database
{
    public function getQuestions()
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM questions");
        $stmt->execute();
        $result = 0;
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        }
        return json_encode($result);
    }

    public function getContestantsData()
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM contestants");
        $stmt->execute();
        $result = 0;
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();  
        }
        return json_encode($result);
    }
    public function getContestants()
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT c.contestant_id, c.fname, c.lname, c.mname, c.year, c.status, c.created_at, c.updated_at, a.point_id, a.time, a.check_code as total_check_code
        FROM contestants c
        LEFT JOIN points a ON c.contestant_id = a.contestant_id
        ORDER BY a.check_code DESC");
        $stmt->execute();
        $result = 0;
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        }
        return json_encode($result);
    }

    public function getAnswers(){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM answers");
        $stmt->execute();
        $result = 0;
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        }
        return json_encode($result);
    }

    public function sections($id){
        $sections = [
            1 => 'North',
            2 => 'East',
            3 => 'West',
            4 => 'South',
            5 => 'North East',
            6 => 'South East'
        ];
        return $sections[$id];
    }

    public function getSections(){
        return [
            1 => 'North',
            2 => 'East',
            3 => 'West',
            4 => 'South',
            5 => 'North East',
            6 => 'South East'
        ];
    }

    public function questionTypes(){
        return [
            1 => 'Essay',
            2 => 'Enumeration',
            3 => 'Multiple Choice',
            4 => 'Identification'
        ];
    }

    public function examType(){
        return [
            1 => 'Preliminary',
            2 => 'Midterm',
            3 => 'Final'
        ];
    }

    public function yearLevel(){
        return [
            1 => '1st Year',
            2 => '2nd Year',
            3 => '3rd Year',
            4 => '4th Year'
        ];
    }

    public function questionDifficulty(){
        return [
            'Easy',
            'Medium',
            'Hard',
        ];
    }

    public function semester(){
        return [
            1 => '1st Semester',
            2 => '2nd Semester',
            3 => 'Summer',
        ];
    }


    public function getExams(){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM exams");
        $stmt->execute();
        return $stmt;
    }

    public function getMultipleChoice($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM multiple_choice WHERE exam_id = '$id'  ORDER BY RAND()");
        return $stmt;
    }

    public function getIdentification($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM identification WHERE exam_id = '$id'  ORDER BY RAND()");
        return $stmt;
    }

    public function getIdentificationIsNull($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT i.*
        FROM identification i
        LEFT JOIN identification_choices c ON i.id = c.identification_id
        WHERE i.exam_id = '$id'
          AND i.id NOT IN (
            SELECT identification_id
            FROM identification_choices
          );
        ");
        return $stmt;
    }

    public function getEnumeration($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM enumeration WHERE exam_id = '$id'  ORDER BY RAND()");
        return $stmt;
    }
    
    public function getEnumerationCorrect($id, $enumeration_id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM enumeration_correct WHERE exam_id = '$id' AND enumeration_id = '$enumeration_id'");
        return $stmt;
    }

    public function getEssay($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM essay WHERE exam_id = '$id' ");
        return $stmt;
    }

    public function getIdentificationChoices($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM identification_choices WHERE exam_id = '$id'");
        return $stmt;
    }

    public function getIdentificationChoicesAdmin($id){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT c.*, i.count FROM identification_choices c LEFT JOIN identification i ON c.identification_id = i.id  WHERE c.exam_id = '$id'");
        return $stmt;
    }

    public function identificationChoicesLetters(){
        $alphabet = [];
        for ($letter = ord('A'); $letter <= ord('Z'); $letter++) {
            $alphabet[] = chr($letter);
        }
        return $alphabet;
    }

    public function getFeedbacks(){
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT f.*, e.section, e.semester, e.year_level FROM feedbacks f INNER JOIN exams e ON f.exam_id = e.id ");
        return $stmt;
    }
    
}
