<?php

$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";

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

    // Fetch and display the data of the selected table
    $data_query = "SELECT * FROM $selected_table";
    $data_result = $conn->query($data_query);

    if ($data_result && $data_result->num_rows > 0) {
        echo "<h3>Data in Table '$selected_table'</h3>";
        echo "<table class='data-table'>";
        
        // Fetch the field names for table headers
        $field_info = $data_result->fetch_fields();
        echo "<tr>";
        foreach ($field_info as $val) {
            echo "<th>" . $val->name . "</th>";
        }
        echo "</tr>";
        
        // Fetch the rows of the data and display them
        while ($row = $data_result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='alert error'>Error: Unable to fetch data for '$selected_table'.</div>";
    }
}

// Select a table and view columns and data
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
echo "<button type='submit' name='view_columns' class='btn'>View Columns and Data</button>";
echo "</form>";

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
