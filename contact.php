<?php
// Database connection settings
$host = 'localhost';   // Your database host
$username = 'u510162695_mcclrc';    // Your database username
$password = '1Mcclrc_pass';        // Your database password
$database = 'u510162695_mcclrc'; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define user data to insert (user_id will auto increment if set as AUTO_INCREMENT in the table schema)
$user_id = null;  // user_id is auto-increment, so we can pass null or omit it
$user_name = 'John Doe';  // Example user name
$user_email = 'john.doe@example.com';  // Example user email

// SQL query to insert data into the user table
$sql = "INSERT INTO `user` (`user_id`, `name`, `email`) VALUES (?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $user_name, $user_email); // 'i' for integer, 's' for string

// Execute the query
if ($stmt->execute()) {
    echo "New user added successfully with ID: " . $stmt->insert_id;
} else {
    echo "Error inserting data: " . $conn->error;
}

// Query to fetch all tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output all table names
    echo "<h2>Tables in Database: $database</h2><ul>";

    while ($row = $result->fetch_assoc()) {
        // Get the table name
        $table_name = $row['Tables_in_' . $database];
        
        echo "<li><strong>Table: $table_name</strong>";

        // Query to fetch data from each table
        $data_sql = "SELECT * FROM `$table_name`";
        $data_result = $conn->query($data_sql);

        if ($data_result->num_rows > 0) {
            echo "<table border='1'><thead><tr>";

            // Fetch column names for the table
            $columns = $data_result->fetch_fields();
            foreach ($columns as $column) {
                echo "<th>" . $column->name . "</th>";
            }

            echo "</tr></thead><tbody>";

            // Fetch and display data
            while ($data_row = $data_result->fetch_assoc()) {
                echo "<tr>";
                foreach ($data_row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "No data found in this table.";
        }

        echo "</li><br>";
    }

    echo "</ul>";
} else {
    echo "No tables found in the database.";
}

// Close the connection
$stmt->close();
$conn->close();
?>
