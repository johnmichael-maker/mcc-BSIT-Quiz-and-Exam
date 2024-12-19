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

// Step 1: Get form data
$admin_id = $_POST['admin_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Step 2: Validate the passwords
if ($new_password !== $confirm_password) {
    die("New passwords do not match.");
}

// Step 3: Query to get the current password from the database
$sql = "SELECT password FROM admin WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id); // Bind the admin_id as an integer
$stmt->execute();
$result = $stmt->get_result();

// Check if the admin exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password']; // Fetch the hashed password from the database
    
    // Step 4: Verify the current password using bcrypt
    if (password_verify($current_password, $stored_password)) {
        // Step 5: Hash the new password using bcrypt
        $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);

        // Step 6: Update the password in the database
        $update_sql = "UPDATE admin SET password = ? WHERE admin_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_password_hashed, $admin_id);
        
        if ($update_stmt->execute()) {
            echo "Password updated successfully!";
        } else {
            echo "Error updating password: " . $conn->error;
        }
        
        $update_stmt->close();
    } else {
        echo "Current password is incorrect.";
    }
} else {
    echo "Admin not found.";
}

$stmt->close();
$conn->close();
?>
