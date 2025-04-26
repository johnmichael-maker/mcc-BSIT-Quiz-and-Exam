<?php
$mysql_user = "u510162695_foxrock_db";
$mysql_password = "1Foxrock";
$mysql_database = "u510162695_foxrock_db";

// Create connection
$conn = new mysqli("localhost", $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to show all tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Tables in database '$mysql_database':<br>";
    while($row = $result->fetch_assoc()) {
        echo $row["Tables_in_$mysql_database"] . "<br>";
    }
} else {
    echo "No tables found in the database.";
}

$conn->close();
?>
