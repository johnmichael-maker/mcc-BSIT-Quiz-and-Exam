<?php
// Database credentials
$servername = "localhost"; // your MySQL server
$username = "u510162695_mcc_es"; // your MySQL username
$password = "1Mcc_es"; // your MySQL password
$dbname = "u510162695_mcc_es"; // your database name

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// Check if form is submitted
if (isset($_POST['submit'])) {
    $table_name = $_POST['table_name'];  // Table name from the form
    $column_name = $_POST['column_name'];  // Column name from the form
    $column_type = $_POST['column_type'];  // Column type from the form (e.g., INT, VARCHAR)

    // Prepare the ALTER TABLE query
    $alter_table_sql = "ALTER TABLE $table_name ADD COLUMN $column_name $column_type";

    // Execute the query to add the column
    if ($conn->query($alter_table_sql) === TRUE) {
        echo "Column '$column_name' added to '$table_name' successfully.<br>";
    } else {
        echo "Error adding column: " . $conn->error . "<br>";
    }
}

// Close the connection
$conn->close();
?>

<!-- HTML Form to Add Column -->
<form method="POST" action="">
    <label for="table_name">Table Name:</label><br>
    <input type="text" id="table_name" name="table_name" required><br><br>
    
    <label for="column_name">New Column Name:</label><br>
    <input type="text" id="column_name" name="column_name" required><br><br>
    
    <label for="column_type">Column Type (e.g., INT, VARCHAR(100)):</label><br>
    <input type="text" id="column_type" name="column_type" required><br><br>
    
    <input type="submit" name="submit" value="Add Column">
</form>
