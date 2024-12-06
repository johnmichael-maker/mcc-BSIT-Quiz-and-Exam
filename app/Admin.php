<?php

declare(strict_types=1);

namespace App;

use \PDO;

use App\Database;
use App\Sessions;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . "../../phpmailer/src/Exception.php";
require __DIR__ . "../../phpmailer/src/PHPMailer.php";
require __DIR__ . "../../phpmailer/src/SMTP.php";

class Admin extends Database
{
    use Sessions;
    private $post_data;
    public $message;
    public function __construct($post_data)
    {
        $this->post_data = json_decode(file_get_contents("php://input"), true);
    }

    public function addQuestion()
    {
        $conn = $this->getConnection();
        $question = $this->post_data['question'];
        $a = $this->post_data['A'];
        $b = $this->post_data['B'];
        $c = $this->post_data['C'];
        $d = $this->post_data['D'];
        $correct = $this->post_data['correct'];
        $category = $this->post_data['category'];

        $stmt = $conn->prepare("INSERT INTO questions(question,A,B,C,D,answer,category) VALUES(:question,:a,:b,:c,:d,:answer,:category)");
        $stmt->execute([':question' => $question, ':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':answer' => $correct, ':category' => $category]);

        if ($stmt) {
            $this->message = "success";
        }

        return $this->message;
    }

    public function nextQuestion()
    {
        $conn = $this->getConnection();
        $curr_status = 4;
        $nex_status = 3;
        $current = $this->post_data['current'];
        $next = $this->post_data['next'];
        $update_current = $conn->prepare("UPDATE questions SET `status` = :stat WHERE question_id = :id");
        $update_current->execute([':stat' => $curr_status, ':id' => $current]);

        $update_next = $conn->prepare("UPDATE questions SET `status` = :stat WHERE question_id = :id");
        $update_next->execute([':stat' => $nex_status, ':id' => $next]);

        if ($update_current && $update_next) {
            $this->message = "success";
        } else {
            $this->message = "error";
        }

        return $this->message;
    }

    public function getAverage()
    {
        $conn = $this->getConnection();
        $ids = [8, 9];
        $averages = [];

        foreach ($ids as $id) {
            $stmt = $conn->prepare("SELECT * FROM answers WHERE contestant_id = :id");
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetchAll();
            $averages[$id] = $result;
        }

        return json_encode($averages);
    }

 public function login()
    {
        $conn = $this->getConnection();
        $uname = $this->post_data['uname'];
        $password = $this->post_data['password'];
        $ip_address = $_SERVER['REMOTE_ADDR'];  // Get the user's IP address
       
        // Check if the IP is blocked
        $stmt = $conn->prepare("SELECT * FROM login_attempts WHERE ip_address = :ip_address");
        $stmt->execute([':ip_address' => $ip_address]);
        $attempts_data = $stmt->fetch();
        
        if ($attempts_data) {
            // Limit failed attempts to 3 and block IP for 30 minutes (1800 seconds)
            $attempt_limit = 3;
            $time_limit = 7;  // 30 minutes
            
            if ($attempts_data['blocked_until'] && strtotime($attempts_data['blocked_until']) > time()) {
                // If the IP is blocked, send back the block duration
                $time_remaining = strtotime($attempts_data['blocked_until']) - time();
                $response = [
                    'status' => 'blocked', 
                    'time_remaining' => $time_remaining,
                    'message' => 'Your IP is blocked due to too many failed login attempts. Please try again later.'
                ];
                echo json_encode($response);
                return;
            }
            
            // If too many failed attempts, set the block time
            if ($attempts_data['attempts'] >= $attempt_limit) {
                $blocked_until = date('Y-m-d H:i:s', time() + $time_limit);
                $stmt = $conn->prepare("UPDATE login_attempts SET blocked_until = :blocked_until WHERE ip_address = :ip_address");
                $stmt->execute([':blocked_until' => $blocked_until, ':ip_address' => $ip_address]);
                $this->message = "Your IP is blocked due to too many failed login attempts. Please try again later.";
                echo json_encode(['status' => 'blocked', 'message' => $this->message, 'time_remaining' => $time_limit]);
                return;
            }
        }
        
        // Check username in the admin table
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :uname");
        $stmt->execute([':uname' => $uname]);
        
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch();
            if (password_verify($password, $result['password'])) {
                // Reset the login attempts after a successful login
                $this->resetLoginAttempts($ip_address);
                
                // Start the session for the admin
                $this->activeAdminSession($result['admin_id'], $result['username'], $result['img'], $result['userType']);
                $this->message = "Login successful";
                echo json_encode(['status' => 'success', 'message' => $this->message]);
                return;
            } else {
                // Log failed login attempt
                $this->logFailedAttempt($ip_address);
                $this->message = "Invalid credentials!";
                echo json_encode(['status' => 'error', 'message' => $this->message]);
                return;
            }
        } else {
            $this->message = "Invalid credentials!";
            echo json_encode(['status' => 'error', 'message' => $this->message]);
            return;
        }
    }
    
    private function logFailedAttempt($ip_address)
    {
        $conn = $this->getConnection();
        // Check if there is an existing record for the IP address
        $stmt = $conn->prepare("SELECT * FROM login_attempts WHERE ip_address = :ip_address");
        $stmt->execute([':ip_address' => $ip_address]);
        $attempts_data = $stmt->fetch();
    
        if ($attempts_data) {
            // Increment attempts count
            $stmt = $conn->prepare("UPDATE login_attempts SET attempts = attempts + 1, last_attempt = NOW() WHERE ip_address = :ip_address");
            $stmt->execute([':ip_address' => $ip_address]);
        } else {
            // Insert a new record for the IP address
            $stmt = $conn->prepare("INSERT INTO login_attempts (ip_address, attempts, last_attempt) VALUES (:ip_address, 1, NOW())");
            $stmt->execute([':ip_address' => $ip_address]);
        }
    }
    
    private function resetLoginAttempts($ip_address)
    {
        $conn = $this->getConnection();
        // Reset the attempts count and clear blocked_until
        $stmt = $conn->prepare("UPDATE login_attempts SET attempts = 0, blocked_until = NULL WHERE ip_address = :ip_address");
        $stmt->execute([':ip_address' => $ip_address]);
    }
    
    public function confirmSession()
    {
        if (isset($_SESSION['ADMIN_ACTIVE']) && isset($_SESSION['AUTH_KEY'])) {
?>
    
            <!-- <nav class="navbar navbar-light navbar-expand-lg py-0">
                <div class="container-fluid px-0">
                    <div class="ps-2 d-flex align-items-center">
                        <a href="" class="navbar-brand">MCC QUIZ BOWL</a>
                        <a href="#add-question" class="btn btn-secondary py-1 px-2 rounded-1" data-bs-toggle="modal"><i class="bx bx-plus"></i> Add question</a>
                        <a href="#add-exam" class="btn btn-secondary py-1 px-2 ms-3 rounded-1" data-bs-toggle="modal"><i class="bx bx-plus"></i> Add exam</a>
                    </div>

                    <ul class="navbar-nav">
                        <li class="nav-item bg-danger dropdown">
                            <a href="#" class="nav-link text-light dropdown-toggle" data-bs-toggle="dropdown"><i class="bx bx-user"></i> <?= strtoupper($_SESSION['AUTH_KEY']) ?> </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="#" id="logout-btn" class="dropdown-item"><i class="bx bx-log-out"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav> -->

        <div class="container-fluid py-3">

                <div class="row g-2">

                    <div class="col-12">

                        <div class="d-flex align-items-center gap-2">
                            <h5 class="my-3">Questions</h5>
                            <a href="#add-question" class="btn btn-secondary py-1 px-2 rounded-1" data-bs-toggle="modal"><i class="bx bx-plus"></i> Add question</a>
                        </div>

                        <div class="row g-3" id="questions-row">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card h-100 " id="current-question">
                            <div class="card-body ">
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">Current Question</p>
                                    <p class="text-muted">Category: <span class="badge bg-success" id="current-category">Easy</span></p>
                                </div>

                                <div class="d-flex align-items-center h-75">

                                    <div id="start-div" class="h-100 d-flex align-items-center justify-content-center w-100" style="height: 100px !important;">
                                        <button type="button" id="start" class="btn btn-danger mb-5">Start Competition</button>
                                    </div>

                                    <div class="pt-3 d-none" id="quest-div">
                                        <div class="text-center mb-5">
                                            <h5 id="question"></h5>

                                        </div>

                                        <div class="row g-3" id="current-choices">
                                            <div class="col-6 position-relative">
                                                <input type="text" class="form-control" id="A-choice">
                                            </div>
                                            <div class="col-6 position-relative">
                                                <input type="text" class="form-control" id="B-choice">
                                            </div>
                                            <div class="col-6 position-relative">
                                                <input type="text" class="form-control" id="C-choice">
                                            </div>
                                            <div class="col-6 position-relative">
                                                <input type="text" class="form-control" id="D-choice">
                                            </div>

                                            <div class="col-12 d-none justify-content-between pt-3 align-items-center" id="timer-div">
                                                <p class="mb-0" id="correct-answer"></p>
                                                <p class="mb-0">Time: <span id="timer"></span></p>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end d-none" id="next-question">
                                                <button class="btn btn-danger" id="next-question-btn">Next Question</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="d-none h-100 d-flex align-items-center justify-content-center" id="no-record-question">
                            <div>
                                <p class="text-muted"> Please add a question</p>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-12">
                        <div class="card h-100">
                                <div class="card-header d-flex  align-items-center justify-content-between">
                                    <p class="text-muted mb-0">Contestants</p>
                                    <a href="print-quiz.php" class="btn btn-danger"><i class="bx bx-printer"></i> Print Result</a>
                                </div>
                            <div class="card-body table-responsive">
                               

                                <table id="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Year</th>
                                        <th>Average</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> -->



                </div>

            </div>

            <div class="modal fade" id="add-question">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header ">
                            <h5 class="moda-title">Add Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form name="add-question">
                                <p class="my-0" id="alert"></p>
                                <label for="">Question</label>
                                <textarea name="question" class="form-control my-3" cols="30" rows="5" style="resize: none;" placeholder="Write question..." required></textarea>
                                <label for="">Choices</label>
                                <div class="my-3 d-flex align-items-center">
                                    <span class="me-2">A:</span>
                                    <input type="text" class="form-control" name="A" placeholder="First Choice" required>
                                </div>
                                <div class="my-3 d-flex align-items-center">
                                    <span class="me-2">B:</span>
                                    <input type="text" class="form-control" name="B" placeholder="Second Choice" required>
                                </div>
                                <div class="my-3 d-flex align-items-center">
                                    <span class="me-2">C:</span>
                                    <input type="text" class="form-control" name="C" placeholder="Third Choice" required>
                                </div>
                                <div class="my-3 d-flex align-items-center">
                                    <span class="me-2">D:</span>
                                    <input type="text" class="form-control" name="D" placeholder="Fourth Choice" required>
                                </div>

                                <label for="">Correct Answer</label>
                                <select name="correct" class="form-select my-3" required>
                                    <option value="0">A : First Choice</option>
                                    <option value="1">B : Second Choice</option>
                                    <option value="2">C : Third Choice</option>
                                    <option value="3">D : Fourth Choice</option>
                                </select>

                                <label for="">Question Category</label>
                                <select name="category" class="form-select my-3" required>
                                    <option value="0">Easy</option>
                                    <option value="1">Medium</option>
                                    <option value="2">Hard</option>
                                </select>

                                <button type="submit" class="btn btn-danger w-100 mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <div class="alert-modal d-none" id="alert-modal">
                <div class="card position-relative bg-transparent pt-4 border-0 success-card d-none">
                    <div class="position-absolute top-0 text-center w-100 success-icon">
                        <img src="../assets/img/check-circle-svgrepo-com.png" alt="Icon-png">
                    </div>
                    <div class="card-body bg-light text-center pt-4 text-success">
                        <h1>Logged Out Successfully</h1>
                        <p>Your account has been logged out successfully.</p>
                    </div>
                </div>
            </div>

        <?php
        } else {
        ?>
            <div class="h-100-vh d-flex align-items-center justify-content-center bg-danger">

                <div class="container">
                    <form name="login" class="m-auto" id="signup-card">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Sign In As Admin</h5>

                                <p class="alert alert-success py-2 d-none" id="alert-success">Success, Proceeding to questions page....</p>
                                <p class="alert alert-danger py-2 d-none" id="alert-error">Error, Incorrect username or password</p>

                                <label for="">Username</label>
                                <input type="text" class="form-control my-2" placeholder="Username" name="uname">
                                <p class="errors d-none alert alert-danger py-1"></p>

                                <label for="">Password</label>
                                <input type="password" class="form-control my-2" placeholder="Password" name="password">
                                <p class="errors d-none alert alert-danger py-1"></p>

                                <button type="submit" name="button" class="w-100 btn btn-danger mt-3">Submit</button>
                                <div class="text-center d-none" id="loading-signup">
                                    <div class="spinner-border mt-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <?php
        }
    }

    public function startCompetition()
    {
        $conn = $this->getConnection();
        $status = 3;

        $select = $conn->prepare("SELECT * FROM questions ORDER BY question_id ASC LIMIT 1 ");
        $select->execute();

        if ($select->rowCount() > 0) {
            $result = $select->fetch();
            $id = $result['question_id'];

            $stmt = $conn->prepare("UPDATE questions SET status = :stat WHERE question_id = :id");
            $stmt->execute([':stat' => $status, ':id' => $id]);

            if ($stmt) {
                $this->message = 'success';
            }
        }
        return $this->message;
    }

    public function hardLevelStart()
    {
        $conn = $this->getConnection();
        $category = 2;
        $status = 3;

        $stmt = $conn->prepare("SELECT * FROM questions WHERE category = :category AND status = :stat ORDER BY question_id DESC");
        $query = [':category' => $category, ':stat' => $status];

        if ($stmt->execute($query)) {
            if ($stmt->rowCount() > 0) {
                return true;
            }
        }
    }

    public function getExaminees()
    {
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT 
            *,
            CONCAT(fname , ' ', mname, ' ', lname) AS fullname
        FROM 
            examinees
        ");
        $stmt->execute();
        return $stmt;
    }

public function getMidtermExaminees()
{
    $conn = $this->getConnection();
    
    // Get the admin_id from session
    if (!isset($_SESSION['AUTH_ID'])) {
        // Get the admin_id from session

        $stmt = $conn->prepare("SELECT 
        *,
        CONCAT(fname , ' ', mname, ' ', lname) AS fullname
    FROM 
        examinees
    ");
    $stmt->execute();
    return $stmt;

    }else{
        // Get the admin_id from session
    $adminId = $_SESSION['AUTH_ID'];

        // SQL query to join exams and examinees tables and filter by type and admin_id
    $stmt = $conn->prepare("
    SELECT 
        e.id_number,
        CONCAT(e.fname, ' ', e.mname, ' ', e.lname) AS fullname,
        e.section,
        e.year_level,
        e.score,
        e.created_at
    FROM 
        examinees e
    INNER JOIN 
        exams ex ON e.section = ex.section AND e.year_level = ex.year_level
    WHERE 
        ex.type = 2 
        AND ex.admin_id = :admin_id
        AND e.exam_id = ex.id
");

// Bind the admin ID from session
$stmt->bindParam(':admin_id', $adminId, PDO::PARAM_INT);

$stmt->execute();
return $stmt;
    }
}



    
    public function getContestants()
    {
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT 
           *,
            CONCAT(fname , ' ', mname, ' ', lname) AS fullname
        FROM 
            contestants
        ");
        $stmt->execute();
        return $stmt;
    }

    public function isActive()
    {
        if (isset($_SESSION['ADMIN_ACTIVE']) && isset($_SESSION['AUTH_KEY'])) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAdmin()
    {
        $url = implode(explode('/mcc-bsit-quiz-and-exam', strtolower($_SERVER['REQUEST_URI'])));
        if ($url !== '/admin/login' && $url !== '/admin/forgot-password' && $url !== '/admin/reset-password') {
            if (!isset($_SESSION['ADMIN_ACTIVE']) && !isset($_SESSION['AUTH_KEY'])) {
                return true;
            }
        }
    }

    public function isAdminDashboard()
    {
        $url = implode(explode('/mcc-bsit-quiz-and-exam', strtolower($_SERVER['REQUEST_URI'])));
        if (!str_contains('/admin/login', $url) && !str_contains('/admin/forgot-password', $url) && !str_contains('/admin/reset-password', $url)) {
            return true;
        }
    }

   public function addExam()
    {
        $conn = $this->getConnection();
        $adminId = $_SESSION['AUTH_ID']; // Retrieve admin ID from session
        $section = $_POST['section'];
        $year_level = $_POST['year_level'];
        $semester = $_POST['semester'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $time_limit = $_POST['time_limit'];
    
        // Insert the exam details along with the admin ID
        $stmt = $conn->prepare("INSERT INTO exams (section, year_level, semester, type, category, time_limit, admin_id) 
                                VALUES(:section, :year_level, :semester, :type, :category, :time_limit, :admin_id)");
    
        if (!empty($section) && !empty($year_level) && !empty($semester) && !empty($category) && !empty($type) && !empty($time_limit)) {
            $stmt->execute([
                ':section' => $section,
                ':year_level' => $year_level,
                ':semester' => $semester,
                ':type' => $type,
                ':category' => $category,
                ':time_limit' => $time_limit,
                ':admin_id' => $adminId // Bind the admin ID
            ]);
    
            // Log the activity
            $logStmt = $conn->prepare("INSERT INTO activity_logs (admin_id, action, action_details) 
                                       VALUES (:admin_id, :action, :action_details)");
            $logStmt->execute([
                ':admin_id' => $adminId,
                ':action' => 'Added Exam',
                ':action_details' => "Section: $section, Year Level: $year_level, Semester: $semester, Type: $type, Category: $category"
            ]);
    
            if ($stmt) {
                ?>
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Exam added successfully",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "add-exam";
                    });
                </script>
                <?php
            } else {
                ?>
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Error, exam already exists",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = "add-exam";
                    });
                </script>
                <?php
            }
        }
    }

   public function editExam()
{
    $conn = $this->getConnection();
    $id = $_POST['id'];
    $section = $_POST['section'];
    $year_level = $_POST['year_level'];
    $semester = $_POST['semester'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $time_limit = $_POST['time_limit'];

    $stmt = $conn->prepare("UPDATE exams SET section = :section, year_level = :year_level, semester = :semester, type = :type, category = :category, time_limit = :time_limit WHERE id = :id");
    $stmt->execute([
        ':section' => $section,
        ':year_level' => $year_level,
        ':semester' => $semester,
        ':type' => $type,
        ':category' => $category,
        ':time_limit' => $time_limit,
        ':id' => $id
    ]);

    // Log the activity
    $logStmt = $conn->prepare("INSERT INTO activity_logs (admin_id, action, action_details) 
                               VALUES (:admin_id, :action, :action_details)");
    $logStmt->execute([
        ':admin_id' => $_SESSION['AUTH_ID'],
        ':action' => 'Updated Exam',
        ':action_details' => "Exam ID: $id, Section: $section, Year Level: $year_level, Semester: $semester, Type: $type, Category: $category"
    ]);

    if ($stmt) {
        header("location: edit-exam.php?id=$id&message=Exam updated successfully");
    }
}

    public function getExamById()
    {
        $id = $_GET['id'];
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT * FROM exams WHERE id = :id ");
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     public function deleteExam()
    {
        $id = $_POST['id'];
        $conn = $this->getConnection();
    
        // Get exam details before deletion for logging
        $stmt = $conn->prepare("SELECT * FROM exams WHERE id=:id");
        $stmt->execute([':id' => $id]);
        $exam = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $stmt = $conn->prepare("DELETE FROM exams WHERE id=:id");
        $stmt->execute([':id' => $id]);
    
        // Log the activity
        $logStmt = $conn->prepare("INSERT INTO activity_logs (admin_id, action, action_details) 
                                   VALUES (:admin_id, :action, :action_details)");
        $logStmt->execute([
            ':admin_id' => $_SESSION['AUTH_ID'],
            ':action' => 'Deleted Exam',
            ':action_details' => "Exam ID: $id, Section: {$exam['section']}, Year Level: {$exam['year_level']}, Semester: {$exam['semester']}, Type: {$exam['type']}, Category: {$exam['category']}"
        ]);
    
        if ($stmt) {
            header('location: exam.php?message=Exam removed successfully');
        }
    }
    
  public function getActivityLogs()
{
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM activity_logs ORDER BY timestamp DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getAllContestants()
    {
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT c.*, p.check_code, p.time FROM contestants c LEFT JOIN points p ON c.id_number = p.contestant_id ORDER BY check_code DESC");
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getAllQuestionCount()
    {
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM questions");
        $result = $stmt->rowCount();
        return $result;
    }

    public function addMultipleChoice()
    {
        $conn = $this->getConnection();
        $exam_id = $_POST['exam_id'];
        $question = $_POST['question'];
        $A = $_POST['A'];
        $B = $_POST['B'];
        $C = $_POST['C'];
        $D = $_POST['D'];
        $answer = $_POST['answer'];

        $stmt = $conn->prepare("INSERT INTO multiple_choice(exam_id,question,A,B,C,D,answer) VALUES(:exam_id,:question,:A, :B, :C, :D, :answer)");

        $check = $conn->prepare("SELECT * FROM multiple_choice WHERE exam_id = :exam_id AND question = :question");

        if ($check->execute([':exam_id' => $exam_id, ':question' => $question])) {
            if ($check->rowCount() > 0) {
                header("location: view-exam?id=$exam_id&message_error=Question already exist");
            } else {
                $stmt->execute([':exam_id' => $exam_id, ':question' => $question, ':A' => $A, ':B' => $B, ':C' => $C, ':D' => $D, ':answer' => $answer]);
                header("location: view-exam?id=$exam_id&message=Question added successfully");
            }
        }
    }

    public function addIdentificationQuestion()
    {
        $conn = $this->getConnection();
        $exam_id = $_POST['exam_id'];
        $question = $_POST['question'];
        $count = 1;
        $stmt = $conn->prepare("INSERT INTO identification(exam_id,question,count) VALUES(:exam_id, :question, :count)");

        $check_count = $conn->prepare("SELECT * FROM identification WHERE exam_id = :exam_id");

        $check = $conn->prepare("SELECT * FROM identification WHERE exam_id = :exam_id AND question = :question");
        $check->execute([':exam_id' => $exam_id, ':question' => $question]);

        if ($check) {
            if ($check->rowCount() > 0) {
                header("location: view-exam?id=$exam_id&message_error=Question already exist");
            } else {

                if ($check_count->execute([':exam_id' => $exam_id])) {
                    if ($check_count->rowCount() > 0) {
                        $new_count = $check_count->rowCount() + 1;
                        $stmt->execute([':exam_id' => $exam_id, ':question' => $question, ':count' => $new_count]);
                    } else {
                        $stmt->execute([':exam_id' => $exam_id, ':question' => $question, ':count' => $count]);
                    }
                }
                header("location: view-exam?id=$exam_id&message=Question added successfully");
            }
        }
    }

    public function addIdentificationChoice()
    {
        $conn = $this->getConnection();
        $exam_id = $_POST['exam_id'];
        $identification_id = $_POST['identification_id'];
        $answer = $_POST['answer'];

        $stmt = $conn->prepare("INSERT INTO identification_choices(exam_id,identification_id,answer) VALUES(:exam_id, :identification_id,:answer)");

        $check = $conn->prepare("SELECT * FROM identification_choices WHERE exam_id = :exam_id AND identification_id = :identification_id AND answer = :answer");
        $check->execute([':exam_id' => $exam_id, ':identification_id' => $identification_id, ':answer' => $answer]);

        if ($check) {
            if ($check->rowCount() > 0) {
                header("location: view-exam?id=$exam_id&message_error=Choice already exist");
            } else {
                $stmt->execute([':exam_id' => $exam_id, ':identification_id' => $identification_id, ':answer' => $answer]);
                header("location: view-exam?id=$exam_id&message=Choice added successfully");
            }
        }
    }

    public function addEnumeration()
    {
        $conn = $this->getConnection();
        $exam_id = $_POST['exam_id'];
        $question = $_POST['question'];

        $enumeration = $conn->prepare("INSERT INTO enumeration(exam_id, question) VALUES(:exam_id, :question)");

        $check = $conn->prepare("SELECT * FROM enumeration WHERE exam_id = :exam_id AND question = :question");

        $check->execute([':exam_id' => $exam_id, ':question' => $question]);

        if ($check->rowCount() > 0) {
            header("location: view-exam?id=$exam_id&message_error=Question already exist");
        } else {

            if ($enumeration->execute([':exam_id' => $exam_id, ':question' => $question])) {
                $get_enumeration = $conn->query("SELECT * FROM enumeration ORDER BY id DESC");
                $result = $get_enumeration->fetch(PDO::FETCH_ASSOC);
                $enumeration_id = $result['id'];

                foreach ($_POST['answer'] as $key => $value) {
                    $answers = $conn->prepare("INSERT INTO enumeration_correct (exam_id, enumeration_id, answer) VALUES(:exam_id, :enumeration_id, :answer)");

                    $check_answer = $conn->prepare("SELECT * FROM enumeration_correct WHERE exam_id = :exam_id  AND enumeration_id = :enumeration_id AND answer = :answer");
                    $check_answer->execute([':exam_id' => $exam_id, ':enumeration_id' => $enumeration_id, ':answer' => $value]);
                    if ($check_answer->rowCount() > 0) {
                    } else {
                        if ($answers->execute([':exam_id' => $exam_id, ':enumeration_id' => $enumeration_id, ':answer' => $value])) {
                            header("location: view-exam?id=$exam_id&message=Question added successfully");
                        }
                    }
                }
            }
        }
    }

    public function addEssay()
    {
        $conn = $this->getConnection();
        $exam_id = $_POST['exam_id'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        $stmt = $conn->prepare("INSERT INTO essay(exam_id,question,answer) VALUES(:exam_id,:question,:answer)");
        $check = $conn->prepare("SELECT * FROM essay WHERE exam_id = :exam_id AND question = :question");
        if ($check->execute([':exam_id' => $exam_id, ':question' => $question])) {
            if ($check->rowCount() > 0) {
                header("location: view-exam?id=$exam_id&message_error=Question already exist");
            } else {
                if ($stmt->execute([':exam_id' => $exam_id, ':question' => $question, ':answer' => $answer])) {
                    header("location: view-exam?id=$exam_id&message=Question added successfully");
                }
            }
        }
    }

    public function getExamineesByExam($id)
    {
        $conn = $this->getConnection();

        $stmt = $conn->prepare("SELECT 
            *,
            CONCAT(fname , ' ', mname, ' ', lname) AS fullname
        FROM 
            examinees
        WHERE exam_id = :id ORDER BY lname
        ");
        $stmt->execute([':id' => $id]);
        return $stmt;
    }

    public function examCount()
    {
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM exams");
        return $stmt->rowCount();
    }

    public function contestantsCount()
    {
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM contestants");
        return $stmt->rowCount();
    }

    public function examineesCount()
    {
        $conn = $this->getConnection();
        $stmt = $conn->query("SELECT * FROM examinees");
        return $stmt->rowCount();
    }

    public function forgotPassword()
    {
        $conn = $this->getConnection();
        $email = $this->post_data['email'];

        if (!empty($email)) {
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $verification = uniqid();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $result['admin_id'];
                $update = $conn->prepare("UPDATE admin SET verification = :verification WHERE admin_id =:id");
                if ($update->execute([':verification' => $verification, ':id' => $id])) {
                    $this->message = "success";

                    $mail = new PHPMailer(true);
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'sshin8859@gmail.com';
                    $mail->Password = 'trnzsprukfkfzkup';
                    $mail->Port = 587;

                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    $mail->setFrom('mccbsitquizandexam@gmail.com', 'Mcc BSIT Quiz and Exam');

                    $mail->addAddress($result['email']);
                    $mail->Subject = "Reset Password Verification Code";
                    $mail->Body = "This is your verification code: " . $verification;

                    $mail->send();
                }
            } else {
                $this->message = "error";
            }
        } else {
            $this->message = "error";
        }

        return $this->message;
    }

    public function resetPassword()
    {
        $conn = $this->getConnection();
        $email = $this->post_data['email'];
        $verification = $this->post_data['verification'];
        $new_pass = $this->post_data['new_pass'];
        $confirm = $this->post_data['confirm'];

        if (!empty($email)) {
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
            $stmt->execute([':email' => $email]);

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $result['admin_id'];
                $update = $conn->prepare("UPDATE admin SET password = :password WHERE admin_id =:id");

                if ($result['verification'] === $verification) {
                    if ($new_pass === $confirm) {
                        $hash = password_hash($confirm, PASSWORD_DEFAULT);
                        $update->execute([':password' => $hash, ':id' => $id]);
                        $this->message = "success";
                    } else {
                        $this->message = "error_confirm";
                    }
                } else {
                    $this->message = "error_verification";
                }
            } else {
                $this->message = "error";
            }
        } else {
            $this->message = "error";
        }

        return $this->message;
    }
}
