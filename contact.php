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

<!-- HTML Form for Data Input and File Upload -->
<form action="your_php_script.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="lastname" placeholder="Last Name" required>
    <input type="text" name="firstname" placeholder="First Name" required>
    <input type="text" name="middlename" placeholder="Middle Name">
    <input type="text" name="gender" placeholder="Gender" required>
    <input type="text" name="course" placeholder="Course" required>
    <input type="text" name="address" placeholder="Address">
    <input type="text" name="cell_no" placeholder="Cell Number">
    <input type="date" name="birthdate" placeholder="Birthdate">
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="year_level" placeholder="Year Level">
    <input type="text" name="student_id_no" placeholder="Student ID" required>

    <input type="file" name="profile_image" required>

    <button type="submit" name="submit">Submit</button>
</form>
