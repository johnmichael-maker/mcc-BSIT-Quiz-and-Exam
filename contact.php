<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the new password and confirm password from form
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the passwords match
    if ($new_password === $confirm_password) {
        // Hash the new password using Argon2
        $hashed_password = password_hash($new_password, PASSWORD_ARGON2I);

        // Admin ID of the user to update
        $admin_id = 53; // Set the admin ID of the record you want to update

        // Create connection
        $conn = new mysqli($host, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to update the password for the specified admin_id
        $sql = "UPDATE `admin` SET `password` = ? WHERE `admin_id` = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters (hashed password and admin_id)
        $stmt->bind_param("si", $hashed_password, $admin_id); // 's' for string, 'i' for integer

        // Execute the query
        if ($stmt->execute()) {
            echo "Password updated successfully for admin_id $admin_id.";
        } else {
            echo "Error updating password: " . $conn->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Passwords do not match.";
    }
}
?>
