<?php
// Database connection
$servername = "localhost";  // Change to your server's name if not localhost
$username = "u510162695_bsit_quiz"; // Your MySQL username
$password = "1Bsit_quiz"; // Your MySQL password
$dbname = "u510162695_bsit_quiz"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if question_id is set
if (isset($_GET['question_id']) && !empty($_GET['question_id'])) {
    $question_id = intval($_GET['question_id']); // Sanitize the input
    $sql = "SELECT * FROM questions WHERE question_id = $question_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $question_text = $row['question_text'];
    } else {
        echo "No question found with ID $question_id.";
        exit;
    }
} else {
    echo "No question_id provided.";
    exit;
}

// Update the question if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updated_question = $_POST['question_text'];
    $update_sql = "UPDATE questions SET question_text = '$updated_question' WHERE question_id = $question_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Question updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!-- Edit form -->
<h2>Edit Question</h2>
<form method="post" action="">
    <label for="question_text">Question:</label><br>
    <textarea name="question_text" id="question_text" rows="4" cols="50"><?php echo htmlspecialchars($question_text); ?></textarea><br><br>
    <input type="submit" name="submit" value="Update Question">
</form>
