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
}
