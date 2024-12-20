<?php
// Database connection settings
$host = 'localhost';  // Your database host
$username = 'u510162695_mcclrc';  // Your database username
$password = '1Mcclrc_pass';  // Your database password
$database = 'u510162695_mcclrc'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all data from the user table
$sql = "SELECT * FROM `user`";

// Execute the query
$result = $conn->query($sql);

// Check if any records are found
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>";
    echo "<tr><th>user_id</th><th>Lastname</th><th>Firstname</th><th>Middlename</th><th>Gender</th><th>Course</th><th>Address</th><th>Cell No</th><th>Birthdate</th><th>Email</th><th>Year Level</th><th>Student ID No</th><th>Password</th><th>Role</th><th>Status</th><th>User Added</th><th>QR Code</th><th>Verify Token</th><th>Token Used</th><th>Profile Image</th><th>Contact Person</th><th>Person Cell No</th><th>Logs</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['middlename'] . "</td>";
        echo "<td>" . $row['gender'] . "</td>";
        echo "<td>" . $row['course'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['cell_no'] . "</td>";
        echo "<td>" . $row['birthdate'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['year_level'] . "</td>";
        echo "<td>" . $row['student_id_no'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";  // You might want to hide this in a real-world scenario
        echo "<td>" . $row['role_as'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['user_added'] . "</td>";
        echo "<td>" . $row['qr_code'] . "</td>";
        echo "<td>" . $row['verify_token'] . "</td>";
        echo "<td>" . $row['token_used'] . "</td>";
        echo "<td>" . $row['profile_image'] . "</td>";
        echo "<td>" . $row['contact_person'] . "</td>";
        echo "<td>" . $row['person_cell_no'] . "</td>";
        echo "<td>" . $row['logs'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the connection
$conn->close();
?>
