<?php
// Database credentials
private string $user = "u510162695_bsit_quiz";
private string $pass = "1Bsit_quiz";
private string $db = "u510162695_bsit_quiz";
$servername = "localhost";  // This could be 'localhost' or your database host if different

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
    <title>Show All Tables</title>
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
    // Display tables from the database
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Tables_in_' . $db] . "</td>";  // Table name is in the field 'Tables_in_<dbname>'
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
