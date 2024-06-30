<?php

declare(strict_types=1);

namespace App;

use App\Database;
use App\Sessions;

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

        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :uname");
        $stmt->execute([':uname' => $uname]);

        if ($stmt) {
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch();
                if (password_verify($password, $result['password'])) {
                    $this->activeAdminSession($result['username']);
                    $this->message = "success";
                } else {
                    $this->message = "error";
                }
            } else {
                $this->message = "error";
            }
        }

        return $this->message;
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
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-body table-responsive">
                                <p class="text-muted">Contestants</p>

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
                    </div>



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

            <div class="modal fade" id="add-exam">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header ">
                            <h5 class="moda-title">Add Exam</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form name="add-question">
                                <p class="my-0" id="alert"></p>
                                <label for="">Question</label>
                                <textarea name="question" class="form-control my-3" cols="30" rows="5" style="resize: none;" placeholder="Write question..." required></textarea>
                                <label for="">Choices</label>

                                <label for="">Exam Type</label>
                                <select name="correct" class="form-select my-3" required>
                                    <option value="1">Essay</option>
                                    <option value="2">Enumeration</option>
                                    <option value="3">Multiple Choice</option>
                                    <option value="4">Identification</option>
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
        $url = implode(explode('/quiz_bowl', strtolower($_SERVER['REQUEST_URI'])));
        if ($url !== '/admin/login.php') {
            if (!isset($_SESSION['ADMIN_ACTIVE']) && !isset($_SESSION['AUTH_KEY'])) {
                return true;
            }
        }
    }

    public function isAdminDashboard()
    {
        $url = implode(explode('/quiz_bowl', strtolower($_SERVER['REQUEST_URI'])));
        if (!str_contains('/admin/login.php', $url)) {
            return true;
        }
    }
}
