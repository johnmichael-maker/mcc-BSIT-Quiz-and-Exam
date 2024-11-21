<?php
header('Content-Type: application/json');

try {
    // Database connection
    $db = new PDO('mysql:host=localhost;dbname=u510162695_bsit_quiz', 'u510162695_bsit_quiz', '1Bsit_quiz');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle POST request
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_id'])) {
        $admin_id = $_POST['admin_id'];

        // Sanitize and validate the admin_id (ensure it is an integer)
        if (!filter_var($admin_id, FILTER_VALIDATE_INT)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid admin ID.']);
            exit;
        }

        
        $stmt = $db->prepare("SELECT email FROM admin WHERE admin_id = :admin_id");
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if ($admin) {
            $email = $admin['email'];

            
            $db->beginTransaction();

            try {
                
                $stmt = $db->prepare("DELETE FROM admin WHERE admin_id = :admin_id");
                $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);

                
                if ($stmt->execute()) {
                   
                    $db->commit();
                    echo json_encode(['status' => 'success']);
                } else {
                    
                    $db->rollBack();
                    echo json_encode(['status' => 'error', 'message' => 'Failed to delete the admin.']);
                }
            } catch (PDOException $e) {
                
                $db->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'Error during deletion: ' . $e->getMessage()]);
            }

        } else {
            // If admin doesn't exist
            echo json_encode(['status' => 'error', 'message' => 'Admin not found.']);
        }
    } else {
        // Invalid request or missing admin_id
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }

} catch (PDOException $e) {
    // Catch database connection errors
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
}
