<?php
// Database connection details
class Database {
    private $servername = "localhost";
    private $user = "u510162695_bsit_quiz";
    private $pass = "1Bsit_quiz";
    private $db = "u510162695_bsit_quiz";
    private $conn;

    public function __construct() {
        // Create a connection to the database
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->db);

        // Check for connection errors
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class AdminData {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Update password for a specific user
    public function updatePassword($admin_id, $newPassword) {
        // Hash the new password using Argon2
        $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2I);

        // Prepare the SQL statement to update the password
        $updateQuery = "UPDATE admin SET password = ? WHERE admin_id = ?";

        // Prepare and bind the statement
        if ($stmt = $this->db->prepare($updateQuery)) {
            $stmt->bind_param("si", $hashedPassword, $admin_id);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Password updated successfully!";
            } else {
                echo "Error updating password: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->db->error;
        }
    }
}

// Instantiate the Database connection
$db = new Database();

// Instantiate the AdminData class with the database connection
$adminData = new AdminData($db->getConnection());

// Example: Update password for admin with ID 1
$newPassword = "khelkhel2367"; // The new password
$admin_id = 1; // Example admin ID
$adminData->updatePassword($admin_id, $newPassword);

// Close the connection
$db->closeConnection();
?>
