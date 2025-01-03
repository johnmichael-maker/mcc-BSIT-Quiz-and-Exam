<?php
// Database connection settings
$servername = "localhost";
$username = "u510162695_mcclrc";
$password = "1Mcclrc_pass";
$dbname = "u510162695_mcclrc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the uploaded profile image
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
            // Check file size (e.g., max 5MB)
            if ($fileSize <= 5000000) {  // 5MB max
                // Set a unique name for the uploaded file
                $newFileName = uniqid('', true) . '.' . $fileExt;

                // Set the target directory to upload the file (profile_images subfolder)
                $fileDestination = '../uploads/profile_images/' . $newFileName;

                // Ensure that the target directory exists
                if (!file_exists('../uploads/profile_images')) {
                    mkdir('../uploads/profile_images', 0777, true);  // Create the directory if it doesn't exist
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    echo "Profile image uploaded successfully!";
                } else {
                    echo "There was an error uploading the file.";
                }
            } else {
                echo "File is too large. Maximum file size is 5MB.";
            }
        } else {
            echo "There was an error uploading the file.";
        }
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}

// Close the database connection
$conn->close();
?>

<!-- HTML Form for Image Upload -->
<form action="your_php_script.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="profile_image" required>
    <button type="submit" name="submit">Upload Image</button>
</form>
