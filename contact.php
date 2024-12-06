<?php
$servername = "localhost"; // your MySQL server
$username = "u510162695_bsit_quiz"; // your MySQL username
$password = "1Bsit_quiz"; // your MySQL password
$dbname = "u510162695_bsit_quiz"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all table names from the database
$table_names_query = "SHOW TABLES";
$table_names_result = $conn->query($table_names_query);

// Function to add a new column to an existing table
if (isset($_POST['add_column'])) {
    $table_name = $_POST['table_name_column'];
    $column_name = $_POST['column_name'];
    $data_type = $_POST['data_type'];
    
    // Check if table exists
    $check_table_query = "SHOW TABLES LIKE '$table_name'";
    $result = $conn->query($check_table_query);

    if ($result && $result->num_rows > 0) {
        // Construct SQL query to add a column
        $alter_query = "ALTER TABLE $table_name ADD COLUMN $column_name $data_type";

        // Execute the query to add the column
        if ($conn->query($alter_query)) {
            echo "<div class='alert success'>Column '$column_name' added to '$table_name' successfully!</div>";
            // Refresh the page after success
            header("Location: $_SERVER[PHP_SELF]"); 
            exit();
        } else {
            echo "<div class='alert error'>Error: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert error'>Error: Table '$table_name' does not exist.</div>";
    }
}

// Add column to an existing table form
echo "<h3>Add Column to Existing Table</h3>";
echo "<form method='POST' action=''>";
echo "<table class='form-table'>";

// Display a dropdown of table names
echo "<tr><td>Table Name</td><td><select name='table_name_column' required>";
if ($table_names_result->num_rows > 0) {
    // Populate dropdown with table names
    while ($row = $table_names_result->fetch_row()) {
        $table = $row[0]; // Get the table name from the result
        echo "<option value='$table'>$table</option>";
    }
}
echo "</select></td></tr>";

echo "<tr><td>Column Name</td><td><input type='text' name='column_name' required></td></tr>";
echo "<tr><td>Data Type</td><td><input type='text' name='data_type' required placeholder='e.g., VARCHAR(100)'></td></tr>";
echo "</table>";
echo "<button type='submit' name='add_column' class='btn'>Add Column</button>";
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
