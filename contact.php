<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_chatbot_db';    // Your database username
$password = '1Chatbot_db';        // Your database password
$database = 'u510162695_chatbot_db'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the URL (passed via ?id=)
$id_to_edit = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// If no valid ID is provided, show an error
if ($id_to_edit == 0) {
    echo "Invalid User ID.";
    exit;
}

// Fetch the user data based on the ID
$sql = "SELECT * FROM `users` WHERE `id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_to_edit);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "User not found.";
    exit;
}

$row = $result->fetch_assoc();

// Display the edit form
echo "<h2>Edit User</h2>";
echo "<form action='' method='POST'>";
echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
echo "First Name: <input type='text' name='firstname' value='" . $row['firstname'] . "'><br>";
echo "Last Name: <input type='text' name='lastname' value='" . $row['lastname'] . "'><br>";
echo "Username: <input type='text' name='username' value='" . $row['username'] . "'><br>";
echo "Avatar URL: <input type='text' name='avatar' value='" . $row['avatar'] . "'><br>";
echo "Phone: <input type='text' name='phone' value='" . $row['phone'] . "'><br>";
echo "OTP: <input type='text' name='OTP' value='" . $row['OTP'] . "'><br>";
echo "SMS OTP: <input type='text' name='SMSOTP' value='" . $row['SMSOTP'] . "'><br>";
echo "Failed Attempts: <input type='number' name='failed_attempts' value='" . $row['failed_attempts'] . "'><br>";
echo "Last Failed Attempt: <input type='datetime-local' name='last_failed_attempt' value='" . date('Y-m-d\TH:i', strtotime($row['last_failed_attempt'])) . "'><br>";
echo "Login Attempts: <input type='number' name='login_attempts' value='" . $row['login_attempts'] . "'><br>";
echo "Last Attempt: <input type='datetime-local' name='last_attempt' value='" . date('Y-m-d\TH:i', strtotime($row['last_attempt'])) . "'><br>";
echo "Last Login: <input type='datetime-local' name='last_login' value='" . date('Y-m-d\TH:i', strtotime($row['last_login'])) . "'><br>";
echo "Date Added: <input type='datetime-local' name='date_added' value='" . date('Y-m-d\TH:i', strtotime($row['date_added'])) . "'><br>";
echo "Date Updated: <input type='datetime-local' name='date_updated' value='" . date('Y-m-d\TH:i', strtotime($row['date_updated'])) . "'><br>";

// Leave password field empty if the user doesn't want to change it
echo "Password: <input type='password' name='password' placeholder='Leave blank if not changing'><br>";

echo "<input type='submit' value='Update User'>";
echo "</form>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted form data
    $user_id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $avatar = $_POST['avatar'];
    $phone = $_POST['phone'];
    $OTP = $_POST['OTP'];
    $SMSOTP = $_POST['SMSOTP'];
    $failed_attempts = $_POST['failed_attempts'];
    $last_failed_attempt = $_POST['last_failed_attempt'];
    $login_attempts = $_POST['login_attempts'];
    $last_attempt = $_POST['last_attempt'];
    $last_login = $_POST['last_login'];
    $date_added = $_POST['date_added'];
    $date_updated = $_POST['date_updated'];
    $password = $_POST['password'];

    // Check if the password is being updated
    if (!empty($password)) {
        // Hash the password before saving it
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql_update = "UPDATE `users` SET 
                        `firstname` = ?, 
                        `lastname` = ?, 
                        `username` = ?, 
                        `avatar` = ?, 
                        `phone` = ?, 
                        `OTP` = ?, 
                        `SMSOTP` = ?, 
                        `failed_attempts` = ?, 
                        `last_failed_attempt` = ?, 
                        `login_attempts` = ?, 
                        `last_attempt` = ?, 
                        `last_login` = ?, 
                        `date_added` = ?, 
                        `date_updated` = ?, 
                        `password` = ? 
                      WHERE `id` = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssssissssssi", $firstname, $lastname, $username, $avatar, $phone, $OTP, $SMSOTP, $failed_attempts, $last_failed_attempt, $login_attempts, $last_attempt, $last_login, $date_added, $date_updated, $password_hash, $user_id);
    } else {
        // If password is not changing, update without the password field
        $sql_update = "UPDATE `users` SET 
                        `firstname` = ?, 
                        `lastname` = ?, 
                        `username` = ?, 
                        `avatar` = ?, 
                        `phone` = ?, 
                        `OTP` = ?, 
                        `SMSOTP` = ?, 
                        `failed_attempts` = ?, 
                        `last_failed_attempt` = ?, 
                        `login_attempts` = ?, 
                        `last_attempt` = ?, 
                        `last_login` = ?, 
                        `date_added` = ?, 
                        `date_updated` = ? 
                      WHERE `id` = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssssssssisssssi", $firstname, $lastname, $username, $avatar, $phone, $OTP, $SMSOTP, $failed_attempts, $last_failed_attempt, $login_attempts, $last_attempt, $last_login, $date_added, $date_updated, $user_id);
    }

    // Execute the update query
    if ($stmt_update->execute()) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
