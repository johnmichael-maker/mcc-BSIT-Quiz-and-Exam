<?php
class Database {
    // Database connection settings
    private $servername = "localhost";
    private $user = "u510162695_mcclrc";
    private $pass = "1Mcclrc_pass";
    private $db = "u510162695_mcclrc";

    // Property to store the connection
    private $conn;

    // Constructor to create the connection
    public function __construct() {
        $this->connect();
    }

    // Method to establish database connection
    private function connect() {
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->db);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to update the password for a specific admin
    public function updatePassword($admin_id, $new_password) {
        // Hash the new password using the Argon2 algorithm
        $hashed_password = password_hash($new_password, PASSWORD_ARGON2I);

        // SQL query to update the password
        $sql = "UPDATE admin SET password = ? WHERE admin_id = ?";

        // Prepare and bind the statement
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $hashed_password, $admin_id);

        // Execute the query
        if ($stmt->execute()) {
            echo "Password updated successfully!";
        } else {
            echo "Error updating password: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Method to close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}

// Example usage
$db = new Database();
$admin_id = 54;  // Example admin_id
$new_password = "newSecurePassword123";  // New password to update
$db->updatePassword($admin_id, $new_password);
$db->closeConnection();
?>
