<?php
if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
    // Proceed with deleting the table if confirmed
    $host = "localhost";
    $user = "u510162695_bsit_quiz";
    $pass = "1Bsit_quiz";
    $db = "u510162695_bsit_quiz";

    // Create connection
    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete the 'admin' table
    $table_to_delete = "admin";
    $sql = "DROP TABLE `$table_to_delete`";

    if ($conn->query($sql) === TRUE) {
        echo "Table '$table_to_delete' deleted successfully.";
    } else {
        echo "Error deleting table: " . $conn->error;
    }

    $conn->close();
} else {
    // Display confirmation form if not yet confirmed
    echo "
    <form method='POST'>
        <p>Are you sure you want to delete the 'admin' table? This action cannot be undone.</p>
        <button type='submit' name='confirm_delete' value='yes'>Yes, delete it</button>
        <button type='submit' name='confirm_delete' value='no'>No, cancel</button>
    </form>
    ";
}
?>
