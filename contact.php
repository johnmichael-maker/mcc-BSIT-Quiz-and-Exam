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

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $address = $_POST['address'];
    $cell_no = $_POST['cell_no'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $year_level = $_POST['year_level'];
    $student_id_no = $_POST['student_id_no'];

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
            // Set a unique name for the uploaded file
            $newFileName = uniqid('', true) . '.' . $fileExt;

            // Set the target directory to upload the file
            $fileDestination = 'uploads/' . $newFileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // Image uploaded successfully, now update the database with the user info and image path
                $sql = "INSERT INTO user (lastname, firstname, middlename, gender, course, address, cell_no, birthdate, email, year_level, student_id_no, profile_image)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssssss", $lastname, $firstname, $middlename, $gender, $course, $address, $cell_no, $birthdate, $email, $year_level, $student_id_no, $fileDestination);

                if ($stmt->execute()) {
                    echo "Profile image uploaded successfully and user data saved!";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
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

// Close the database connection
$conn->close();
?>
