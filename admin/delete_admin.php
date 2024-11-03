<?php
header('Content-Type: application/json');

try {
    $db = new PDO('mysql:host=localhost;dbname=u510162695_bsit_quiz', 'u510162695_bsit_quiz', '1Bsit_quiz');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_id'])) {
        $admin_id = $_POST['admin_id'];

        
        $stmt = $db->prepare("SELECT email FROM admin WHERE admin_id = :admin_id");
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $email = $admin['email'];

            
            $stmt = $db->prepare("DELETE FROM admin WHERE admin_id = :admin_id");
            $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                
                $stmt = $db->prepare("DELETE FROM instructors WHERE email = :email");
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    echo json_encode(['status' => 'success']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to delete the instructor.']);
                }
            } else {
                
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete admin: ' . $errorInfo[2]]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Admin not found.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
}
