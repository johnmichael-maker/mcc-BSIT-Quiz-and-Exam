<?php
// Database configuration
$servername = "localhost";
$username = "u510162695_bsit_quiz"; // your username
$password = "1Bsit_quiz"; // your password
$dbname = "u510162695_bsit_quiz"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 1: Retrieve admin ID from URL or session
$admin_id = $_GET['admin_id']; // Get admin_id from URL, e.g., edit_admin.php?admin_id=1

// Step 2: SQL query to get the current admin data
$sql = "SELECT * FROM admin WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id); // Bind the admin_id as an integer parameter
$stmt->execute();
$result = $stmt->get_result();

// Fetch the record
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    echo "No record found for admin ID: $admin_id";
    exit;
}

$stmt->close();
$conn->close();
?>

<!-- Display form to edit admin details -->
<form method="POST" action="edit_admin_process.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $username; ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">

    <input type="submit" value="Update">
</form>
