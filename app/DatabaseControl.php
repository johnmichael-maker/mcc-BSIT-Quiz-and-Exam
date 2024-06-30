<?php

namespace App;
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
            'Essay',
            'Enumeration',
            'Multiple Choice',
            'Identification'
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


    public function getExams(){
        $conn = $this->getConnection();
        $stmt = $conn->prepare("SELECT * FROM exams WHERE status = 1");
        $stmt->execute();
        return $stmt;
    }
}
