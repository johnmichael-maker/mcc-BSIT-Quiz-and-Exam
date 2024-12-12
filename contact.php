<?php
// Database connection
$servername = "localhost";  // Change to your server's name if not localhost
$username = "u510162695_bsit_quiz";         // Your MySQL username
$password = "1Bsit_quiz";             // Your MySQL password
$dbname = "u510162695_bsit_quiz";  // Replace with your database name


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if question_id is set and not empty
if (isset($_GET['question_id']) && !empty($_GET['question_id'])) {
    $question_id = $_GET['question_id']; // Get the question_id parameter from URL (e.g., delete.php?question_id=1)

    // Sanitize the input to prevent SQL injection
    $question_id = intval($question_id); // Casting the value to an integer for security

    // Query to delete data from the 'questions' table
    $sql = "DELETE FROM questions WHERE question_id = $question_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record with question_id $question_id has been deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No question_id provided for deletion.";
}

// Close connection
$conn->close();
?>
