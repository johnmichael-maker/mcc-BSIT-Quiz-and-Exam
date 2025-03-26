<?php
try {
    // Connect to the database
    $conn = new PDO("mysql:host=localhost;dbname=u510162695_bsit_quiz", "u510162695_bsit_quiz", "1Bsit_quiz");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the query to fetch all contestants
    $stmt = $conn->prepare("SELECT * FROM contestants");
    $stmt->execute();

    // Fetch the results
    $contestants = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any contestants
    if ($stmt->rowCount() > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Other Fields...</th>
                </tr>";
        
        // Loop through each row and display the data
        foreach ($contestants as $contestant) {
            echo "<tr>
                    <td>" . $contestant['id'] . "</td>
                    <td>" . $contestant['name'] . "</td>
                    <td>" . $contestant['score'] . "</td>
                    <td>Other values...</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No contestants found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
