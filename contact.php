<?php
class Database {
    // Define the database credentials
    private $servername = "localhost";
    private $user = "u510162695_sillon";
    private $pass = "1Sillon_pass";
    private $db = "u510162695_sillon";
    private $conn;

    // Create a method to connect to the database
    public function connect() {
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to retrieve admin data by ID
    public function getAdminDataById($id) {
        $sql = "SELECT * FROM admin WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Method to update only the password in the admin data by ID
    public function updateAdminPassword($id, $newPassword) {
        // Hash the new password using Argon2
        $hashedPassword = password_hash($newPassword, PASSWORD_ARGON2ID);

        $sql = "UPDATE admin SET pass = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $hashedPassword, $id);
        return $stmt->execute();
    }

    // Close the database connection
    public function close() {
        $this->conn->close();
    }
}

// Create a new Database object
$database = new Database();
$database->connect();

// Check if the form is being submitted to update the password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $pass = $_POST['pass'];

    // Update the password
    if ($database->updateAdminPassword($id, $newPassword)) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password!";
    }
} else if (isset($_GET['id'])) {
    // If there is an ID in the URL, retrieve the data
    $id = $_GET['id'];
    $adminData = $database->getAdminDataById($id);
}

?>

<!-- Form to edit the password -->
<?php if (isset($adminData)) { ?>
    <h2>Edit Password for Admin ID: <?php echo $adminData['id']; ?></h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $adminData['id']; ?>">

        <label>New Password:</label><br>
        <input type="password" name="=pass" required><br>

        <input type="submit" value="Update Password">
    </form>
<?php } else {
    echo "No admin data found for the provided ID.";
} ?>

<?php
// Close the database connection
$database->close();
?>
