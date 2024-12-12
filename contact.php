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

// Display the questions
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

echo "<h2>Questions List</h2>";

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Question ID</th>
                <th>Question Text</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['question_id'] . "</td>
                <td>" . $row['question_text'] . "</td>
                <td><a href='edit.php?question_id=" . $row['question_id'] . "'>Edit</a> | 
                <a href='delete.php?question_id=" . $row['question_id'] . "'>Delete</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No questions found.";
}

$conn->close();
?>
