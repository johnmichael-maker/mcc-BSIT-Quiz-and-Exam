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

// Step 1: Retrieve the admin record that needs to be edited (using an ID)
$admin_id = 1; // Example admin ID, you can get this from a URL or session
$sql = "SELECT * FROM admin WHERE id = $admin_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the current record
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
} else {
    echo "No record found.";
    exit;
}

$conn->close();
?>

<!-- HTML form to edit admin data -->
<form method="POST" action="edit_admin.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $username; ?>" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <input type="hidden" name="id" value="<?php echo $admin_id; ?>">

    <input type="submit" value="Update">
</form>
