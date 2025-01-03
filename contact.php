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

    // Method to update the user's profile image path in the database
    public function updateProfileImage($userId, $imagePath) {
        $sql = "UPDATE user SET profile_image = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $imagePath, $userId);
        return $stmt->execute();
    }

    // Method to close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the uploaded file
    $file = $_FILES['profile_image'];

    // Get file details
    $fileName = $_FILES['profile_image']['name'];
    $fileTmpName = $_FILES['profile_image']['tmp_name'];
    $fileSize = $_FILES['profile_image']['size'];
    $fileError = $_FILES['profile_image']['error'];
    $fileType = $_FILES['profile_image']['type'];

    // Allow certain file types (e.g., jpg, jpeg, png, gif)
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Check if file type is allowed
    if (in_array($fileExt, $allowed)) {
        // Check for upload errors
        if ($fileError === 0) {
            // Set a unique name for the uploaded file
            $newFileName = uniqid('', true) . '.' . $fileExt;

            // Set the target directory to upload the file
            $fileDestination = 'uploads/' . $newFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // Image uploaded successfully, now update the database
                $db = new Database();
                $userId = 398; // Example user ID, change it accordingly
                if ($db->updateProfileImage($userId, $fileDestination)) {
                    echo "Profile image uploaded successfully!";
                } else {
                    echo "Error updating profile image in the database.";
                }
                $db->closeConnection();
            } else {
                echo "There was an error uploading the file.";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
?>
