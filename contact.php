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

// SQL query to select all columns from the 'admin' table
$sql = "SELECT * FROM `admin`";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data for each row
    while($row = $result->fetch_assoc()) {
        echo "admin_id: " . $row["admin_id"]. " - firstname: " . $row["firstname"]. " - middlename: " . $row["middlename"]. " - lastname: " . $row["lastname"]. " - email: " . $row["email"]. " - address: " . $row["address"]. " - phone_number: " . $row["phone_number"]. " - password: " . $row["password"]. " - confirm_password: " . $row["confirm_password"]. " - admin_image: " . $row["admin_image"]. " - admin_type: " . $row["admin_type"]. " - admin_added: " . $row["admin_added"]. "<br>";
    }
} else {
    echo "0 results found.";
}

// Close the connection
$conn->close();
?>
