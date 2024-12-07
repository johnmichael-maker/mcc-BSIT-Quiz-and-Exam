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
    $id = $_POST['id'];  // Use id instead of admin_id
    
    // Fetch the current data for the selected id
    $fetch_query = "SELECT * FROM $selected_table WHERE id = ?";
    $stmt = $conn->prepare($fetch_query);
    $stmt->bind_param('i', $id);  // Bind id as integer
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        // Display form to edit the data
        echo "<h3>Edit Data for ID $id</h3>";
        echo "<form method='POST' action='' enctype='multipart/form-data'>";  // Add enctype for file upload
        echo "<input type='hidden' name='selected_table' value='$selected_table'>";
        echo "<input type='hidden' name='id' value='$id'>";
        
        foreach ($row as $field => $value) {
            if ($field != 'id') { // Exclude the primary key from the edit form
                // Check if the field is a password field (Argon2 hash stored)
                if ($field == 'password') {
                    echo "<label for='$field'>Enter New Password (Leave blank to keep the current one):</label>";
                    echo "<input type='password' name='$field' id='$field'><br><br>";
                } else {
                    echo "<label for='$field'>$field</label>";
                    echo "<input type='text' name='$field' id='$field' value='$value' required><br><br>";
                }
            }
        }

        // Image upload field
        echo "<label for='image'>Upload Image:</label>";
        echo "<input type='file' name='image' id='image' accept='image/*'><br><br>"; // Only allow image files
        
        echo "<button type='submit' name='save_edit' class='btn'>Save Changes</button>";
        echo "</form>";
    } else {
        echo "<div class='alert error'>No record found for ID $id.</div>";
    }
}

// Save edited data
if (isset($_POST['save_edit'])) {
    $selected_table = $_POST['selected_table'];
    $id = $_POST['id'];  // Use id instead of admin_id
    
    // Prepare the update query dynamically
    $update_query = "UPDATE $selected_table SET ";
    $fields = [];
    $values = [];
    
    // Handle the image upload if a file is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        
        // Check for allowed image extensions (JPEG, PNG, GIF)
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($image_ext, $allowed_ext)) {
            // Set a unique name for the image and move it to the "uploads" directory
            $image_new_name = uniqid() . '.' . $image_ext;
            $image_path = 'uploads/' . $image_new_name;

            if (move_uploaded_file($image_tmp, $image_path)) {
                // Add the image path to the database update
                $fields[] = "image = ?";
                $values[] = $image_path;
            } else {
                echo "<div class='alert error'>Failed to upload image.</div>";
            }
        } else {
            echo "<div class='alert error'>Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.</div>";
        }
    }

    // Handle other form fields
    foreach ($_POST as $key => $value) {
        if ($key != 'selected_table' && $key != 'id' && $key != 'save_edit' && $key != 'image') { // Change admin_id to id
            // If the field is password, hash it before updating
            if ($key == 'password' && !empty($value)) {
                // Hash the new password using Argon2
                $value = password_hash($value, PASSWORD_ARGON2ID);
            }
            $fields[] = "$key = ?";
            $values[] = $value;
        }
    }

    $update_query .= implode(", ", $fields) . " WHERE id = ?";
    $values[] = $id;  // Add the id to the end of the values

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
    echo "<label for='id'>ID</label>";  // Change label to ID
    echo "<input type='text' name='id' id='id' required><br><br>";  // Change input to id
    echo "<button type='submit' name='edit_record' class='btn'>Edit Record</button>";
    echo "</form>";
}

$conn->close();
?>

<style>
    /* Basic Styling */
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f9;
    }

    h1, h2, h3 {
        color: #333;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-weight: bold;
        color: #fff;
    }

    .alert.success {
        background-color: #4CAF50;
    }

    .alert.error {
        background-color: #f44336;
    }

    .data-table, .form-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .data-table th, .data-table td, .form-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .data-table th {
        background-color: #4CAF50;
        color: white;
        text-align: left;
    }

    .data-table td {
        text-align: left;
    }

    .form-table td {
        text-align: left;
    }

    .form-table input[type='text'], .form-table textarea, .form-table select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-table input[type='file'] {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .data-table, .form-table {
            width: 100%;
        }

        .form-table input[type='text'], .form-table textarea, .form-table select {
            width: 100%;
        }

        .form-table td {
            display: block;
            margin-bottom: 10px;
        }

        .form-table td:first-child {
            font-weight: bold;
        }
    }
</style>
