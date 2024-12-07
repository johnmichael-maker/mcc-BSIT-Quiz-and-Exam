<?php
// Database credentials
$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// Function to display table structure
function showTableStructure($conn, $table_name) {
    $structure_sql = "SHOW COLUMNS FROM $table_name";
    $result = $conn->query($structure_sql);

    if ($result->num_rows > 0) {
        echo "<h3>Table Structure of '$table_name'</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Null</th>
                    <th>Key</th>
                    <th>Default</th>
                    <th>Extra</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['Field'] . "</td>
                    <td>" . $row['Type'] . "</td>
                    <td>" . $row['Null'] . "</td>
                    <td>" . $row['Key'] . "</td>
                    <td>" . $row['Default'] . "</td>
                    <td>" . $row['Extra'] . "</td>
                </tr>";
        }
        echo "</table><br>";
    } else {
        echo "No columns found for '$table_name'.<br>";
    }
}

// Function to display table data
function showTableData($conn, $table_name) {
    $data_sql = "SELECT * FROM $table_name";
    $result = $conn->query($data_sql);

    if ($result->num_rows > 0) {
        echo "<h3>Data in '$table_name'</h3>";
        echo "<table border='1'>
                <tr>";
        
        // Display column headers
        $field_info = $result->fetch_fields();
        foreach ($field_info as $val) {
            echo "<th>" . $val->name . "</th>";
        }
        echo "</tr>";

        // Display rows of data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "No data found in '$table_name'.<br>";
    }
}

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

// Check if a table is selected for displaying structure and data
if (isset($_POST['view_table'])) {
    $table_name = $_POST['table_name'];

    // Show the table structure and data
    showTableStructure($conn, $table_name);
    showTableData($conn, $table_name);
}

// Close the connection
$conn->close();
?>

<!-- HTML Form to Add Column or View Table -->
<form method="POST" action="">
    <label for="table_name">Table Name:</label><br>
    <input type="text" id="table_name" name="table_name" required><br><br>
    
    <label for="column_name">New Column Name:</label><br>
    <input type="text" id="column_name" name="column_name" required><br><br>
    
    <label for="column_type">Column Type (e.g., INT, VARCHAR(100)):</label><br>
    <input type="text" id="column_type" name="column_type" required><br><br>
    
    <input type="submit" name="submit" value="Add Column">
</form>

<!-- HTML Form to View Table -->
<form method="POST" action="">
    <label for="table_name">View Table Structure and Data:</label><br>
    <input type="text" id="table_name" name="table_name" required><br><br>
    <input type="submit" name="view_table" value="View Table">
</form>
