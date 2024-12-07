<?php

$servername = "localhost"; // your MySQL server
$username = "u510162695_sillon"; // your MySQL username
$password = "1Sillon_pass"; // your MySQL password
$dbname = "u510162695_sillon"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all table names from the database
$table_names_query = "SHOW TABLES";
$table_names_result = $conn->query($table_names_query);

// Function to view columns of a selected table
if (isset($_POST['view_columns'])) {
    $selected_table = $_POST['selected_table'];
    $columns_query = "DESCRIBE $selected_table"; // Fetch the table structure (columns)
    $columns_result = $conn->query($columns_query);
    
    if ($columns_result && $columns_result->num_rows > 0) {
        echo "<h3>Columns in Table '$selected_table'</h3>";
        echo "<table class='data-table'>";
        echo "<tr><th>Column Name</th><th>Data Type</th><th>Nullable</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        
        while ($row = $columns_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Field'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Null'] . "</td>";
            echo "<td>" . $row['Key'] . "</td>";
            echo "<td>" . $row['Default'] . "</td>";
            echo "<td>" . $row['Extra'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='alert error'>Error: Unable to fetch columns for '$selected_table'.</div>";
    }
}

// Edit specific record (id)
if (isset($_POST['edit_record'])) {
    $selected_table = $_POST['selected_table'];
    $id = $_POST['id']; // Changed from admin_id to id
    
    // Fetch the current data for the selected id
    $fetch_query = "SELECT * FROM $selected_table WHERE id = ?"; // Changed admin_id to id
    $stmt = $conn->prepare($fetch_query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        // Display form to edit the data
        echo "<h3>Edit Data for ID $id</h3>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='selected_table' value='$selected_table'>";
        echo "<input type='hidden' name='id' value='$id'>"; // Changed from admin_id to id
        
        foreach ($row as $field => $value) {
            if ($field != 'id') { // Exclude the primary key from the edit form
                echo "<label for='$field'>$field</label>";
                echo "<input type='text' name='$field' id='$field' value='$value' required><br><br>";
            }
        }
        
        echo "<button type='submit' name='save_edit' class='btn'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "<div class='alert error'>No record found for id $id.</div>";
    }
}

// Save edited data
if (isset($_POST['save_edit'])) {
    $selected_table = $_POST['selected_table'];
    $id = $_POST['id']; // Changed from admin_id to id
    
    // Prepare the update query dynamically
    $update_query = "UPDATE $selected_table SET ";
    $fields = [];
    $values = [];
    
    foreach ($_POST as $key => $value) {
        if ($key != 'selected_table' && $key != 'id' && $key != 'save_edit') { // Changed from admin_id to id
            $fields[] = "$key = ?";
            $values[] = $value;
        }
    }
    
    $update_query .= implode(", ", $fields) . " WHERE id = ?"; // Changed admin_id to id
    $values[] = $id; // Add the id to the end of the values
    
    $stmt = $conn->prepare($update_query);
    
    // Dynamically bind parameters
    $types = str_repeat('s', count($values) - 1) . 'i'; // Assuming all fields are strings except id
    $stmt->bind_param($types, ...$values);
    
    if ($stmt->execute()) {
        echo "<div class='alert success'>Record updated successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div>";
    }
}

// Select a table and edit data
echo "<h3>Select a Table to View and Edit Data</h3>";
echo "<form method='POST' action=''>";
echo "<table class='form-table'>";

// Display a dropdown of table names for viewing columns
echo "<tr><td>Select Table</td><td><select name='selected_table' required>";
if ($table_names_result->num_rows > 0) {
    // Populate dropdown with table names
    while ($row = $table_names_result->fetch_row()) {
        $table = $row[0]; // Get the table name from the result
        echo "<option value='$table'>$table</option>";
    }
}
echo "</select></td></tr>";

echo "</table>";
echo "<button type='submit' name='view_columns' class='btn'>View Columns</button>";
echo "</form>";

// Display id field for editing
if (isset($_POST['view_columns'])) {
    $selected_table = $_POST['selected_table'];
    echo "<h3>Enter ID to Edit Data</h3>";
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='selected_table' value='$selected_table'>";
    echo "<label for='id'>ID</label>"; // Changed admin_id to id
    echo "<input type='text' name='id' id='id' required><br><br>"; // Changed admin_id to id
    echo "<button type='submit' name='edit_record' class='btn'>Edit Record</button>";
    echo "</form>";
}

$conn->close();
?>
