<?php

// Database credentials
$servername = "localhost"; // your MySQL server
$username = "u510162695_grading_db"; // your MySQL username
$password = "1Grading_db"; // your MySQL password
$dbname = "u510162695_grading_db"; // your database name

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

// Display records of the selected table
if (isset($_POST['view_data'])) {
    $selected_table = $_POST['selected_table'];
    $data_query = "SELECT * FROM $selected_table"; // Fetch all data
    $data_result = $conn->query($data_query);
    
    if ($data_result && $data_result->num_rows > 0) {
        echo "<h3>Data in Table '$selected_table'</h3>";
        echo "<table class='data-table'>";
        echo "<tr><th>USER_ID</th><th>Last Name</th><th>First Name</th><th>Phone</th><th>User</th><th>User Type</th><th>Status</th><th>Actions</th></tr>";
        
        while ($row = $data_result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['USER_ID'] . "</td>";
            echo "<td>" . $row['LASTNAME'] . "</td>";
            echo "<td>" . $row['FIRSTNAME'] . "</td>";
            echo "<td>" . $row['PHONE'] . "</td>";
            echo "<td>" . $row['USER'] . "</td>";
            echo "<td>" . $row['USER_TYPE'] . "</td>";
            echo "<td>" . $row['STATUS'] . "</td>";
            // Edit and Delete actions
            echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='selected_table' value='$selected_table'>
                        <input type='hidden' name='USER_ID' value='" . $row['USER_ID'] . "'>
                        <button type='submit' name='edit_record' class='btn'>Edit</button>
                        <button type='submit' name='delete_record' class='btn' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='alert error'>No data found in '$selected_table'.</div>";
    }
}

// Edit specific record
if (isset($_POST['edit_record'])) {
    $selected_table = $_POST['selected_table'];
    $USER_ID = $_POST['USER_ID'];
    
    // Fetch the current data for the selected USER_ID
    $fetch_query = "SELECT * FROM $selected_table WHERE USER_ID = ?";
    $stmt = $conn->prepare($fetch_query);
    $stmt->bind_param('i', $USER_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        echo "<h3>Edit Data for USER_ID $USER_ID</h3>";
        echo "<form method='POST' action=''>";
        echo "<input type='hidden' name='selected_table' value='$selected_table'>";
        echo "<input type='hidden' name='USER_ID' value='$USER_ID'>";
        
        // Loop through each field and display it
        foreach ($row as $field => $value) {
            if ($field != 'USER_ID') {
                echo "<label for='$field'>$field</label>";
                echo "<input type='text' name='$field' id='$field' value='$value' required><br><br>";
            }
        }
        
        echo "<button type='submit' name='save_edit' class='btn'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "<div class='alert error'>No record found for USER_ID $USER_ID.</div>";
    }
}

// Save edited data
if (isset($_POST['save_edit'])) {
    $selected_table = $_POST['selected_table'];
    $USER_ID = $_POST['USER_ID'];
    
    // Prepare the update query dynamically
    $update_query = "UPDATE $selected_table SET ";
    $fields = [];
    $values = [];
    
    foreach ($_POST as $key => $value) {
        if ($key != 'selected_table' && $key != 'USER_ID' && $key != 'save_edit') {
            // If the field is password, hash it before updating
            if ($key == 'PASSWORD' && !empty($value)) {
                // Hash the new password using Argon2
                $value = password_hash($value, PASSWORD_ARGON2ID);
            }
            $fields[] = "$key = ?";
            $values[] = $value;
        }
    }
    
    $update_query .= implode(", ", $fields) . " WHERE USER_ID = ?";
    $values[] = $USER_ID;
    
    $stmt = $conn->prepare($update_query);
    
    // Dynamically bind parameters
    $types = str_repeat('s', count($values) - 1) . 'i'; // Assuming all fields are strings except USER_ID
    $stmt->bind_param($types, ...$values);
    
    if ($stmt->execute()) {
        echo "<div class='alert success'>Record updated successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div>";
    }
}

// Delete specific record
if (isset($_POST['delete_record'])) {
    $selected_table = $_POST['selected_table'];
    $USER_ID = $_POST['USER_ID'];
    
    // Prepare and execute the delete query
    $delete_query = "DELETE FROM $selected_table WHERE USER_ID = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param('i', $USER_ID);
    
    if ($stmt->execute()) {
        echo "<div class='alert success'>Record deleted successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!-- HTML Part for selecting the table -->
<h3>Select a Table to View and Edit Data</h3>
<form method="POST" action="">
    <table class="form-table">
        <tr><td>Select Table</td><td><select name="selected_table" required>
            <?php
            if ($table_names_result->num_rows > 0) {
                while ($row = $table_names_result->fetch_row()) {
                    echo "<option value='$row[0]'>$row[0]</option>";
                }
            }
            ?>
        </select></td></tr>
    </table>
    <button type="submit" name="view_columns" class="btn">View Columns</button>
    <button type="submit" name="view_data" class="btn">View Data</button>
</form>
