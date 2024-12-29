<?php
// Database credentials
$servername = "localhost";  // Database host, usually 'localhost'
$user = "u510162695_bsit_quiz";  // Your MySQL username
$pass = "1Bsit_quiz";  // Your MySQL password
$db = "u510162695_bsit_quiz";  // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all tables in the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Tables in Database</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Tables in Database: <?php echo $db; ?></h1>

<!-- Table to display the list of tables -->
<table>
    <tr>
        <th>Table Name</th>
    </tr>

    <?php
    // Check if there are tables
    if ($result->num_rows > 0) {
        // Loop through and display each table name
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Tables_in_' . $db] . "</td>";  // Tables_in_<dbname> is the field name
            echo "</tr>";
        }
    } else {
        echo "<tr><td>No tables found in this database.</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
