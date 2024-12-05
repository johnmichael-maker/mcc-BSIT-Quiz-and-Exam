<?php
// Database connection details
$servername = "localhost";
$username = "u510162695_mcclrc";
$password = "1Mcclrc_pass";
$dbname = "u510162695_mcclrc"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get list of all tables in the database
$sql_tables = "SHOW TABLES";
$result_tables = $conn->query($sql_tables);

if ($result_tables->num_rows > 0) {
    while ($table = $result_tables->fetch_row()) {
        $tableName = $table[0];
        
        // Display table name
        echo "<h2>Table: $tableName</h2>";
        
        // 1. Show the columns of the table
        $sql_columns = "DESCRIBE $tableName";
        $result_columns = $conn->query($sql_columns);

        if ($result_columns->num_rows > 0) {
            echo "<h3>Columns in Table: $tableName</h3>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>
                    <tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
            while ($row = $result_columns->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Field']}</td>
                        <td>{$row['Type']}</td>
                        <td>{$row['Null']}</td>
                        <td>{$row['Key']}</td>
                        <td>{$row['Default']}</td>
                        <td>{$row['Extra']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No columns found for table $tableName.<br>";
        }

        // 2. Show the data in the table
        $sql_data = "SELECT * FROM $tableName";
        $result_data = $conn->query($sql_data);

        if ($result_data->num_rows > 0) {
            echo "<h3>Data in Table: $tableName</h3>";
            echo "<table border='1' cellpadding='5' cellspacing='0'>
                    <tr>";

            // Fetching table headers (column names)
            $fields = $result_data->fetch_fields();
            foreach ($fields as $field) {
                echo "<th>" . $field->name . "</th>";
            }
            echo "<th>Actions</th></tr>";  // Adding Actions column for Edit button

            // Fetching rows of data
            while ($row = $result_data->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                // Add Edit button to each row
                $rowId = $row[array_keys($row)[0]]; // assuming the first column is a unique ID
                echo "<td><a href='?edit=$rowId&table=$tableName'>Edit</a></td>";
                echo "</tr>";
            }
            echo "</table><br>";
        } else {
            echo "No data found in table $tableName.<br>";
        }
    }
} else {
    echo "No tables found in the database.<br>";
}

// Handle Edit form submission
if (isset($_GET['edit']) && isset($_GET['table'])) {
    $editId = $_GET['edit'];
    $editTable = $_GET['table'];

    // Fetch data for the row to be edited
    $sql_edit = "SELECT * FROM $editTable WHERE id = $editId"; // Assuming 'id' is the primary key column
    $result_edit = $conn->query($sql_edit);
    $editData = $result_edit->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect data from form submission
        $updateValues = [];
        foreach ($editData as $column => $value) {
            if ($column != 'id') {  // Assuming 'id' is the primary key, so we don't update it
                $updateValues[$column] = $conn->real_escape_string($_POST[$column]);
            }
        }
        // Build the UPDATE query
        $updateQuery = "UPDATE $editTable SET ";
        foreach ($updateValues as $column => $newValue) {
            $updateQuery .= "$column = '$newValue', ";
        }
        $updateQuery = rtrim($updateQuery, ', ') . " WHERE id = $editId";

        if ($conn->query($updateQuery) === TRUE) {
            echo "<p>Record updated successfully.</p>";
        } else {
            echo "<p>Error updating record: " . $conn->error . "</p>";
        }
    }

    // Display Edit Form
    echo "<h3>Edit Row in Table: $editTable</h3>";
    echo "<form method='POST' action=''>";
    foreach ($editData as $column => $value) {
        if ($column != 'id') {  // Skip the ID column
            echo "<label for='$column'>$column:</label>";
            echo "<input type='text' name='$column' value='" . htmlspecialchars($value) . "'><br><br>";
        }
    }
    echo "<input type='submit' value='Update'>";
    echo "</form>";
}

// Close connection
$conn->close();
?>
