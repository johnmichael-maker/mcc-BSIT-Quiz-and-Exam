<?php

$servername = "localhost";
$username = "u510162695_bsit_quiz";
$password = "1Bsit_quiz";
$dbname = "u510162695_bsit_quiz";


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save_csv_data'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    
    $allowedType = ['csv'];
    
    if (in_array($fileExtension, $allowedType)) {
      
        if (($file = fopen($fileTmpName, "r")) !== FALSE) {
           
            fgetcsv($file);
            
           
            while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
                $first_name = ucfirst(strtolower($row[0])); 
                $last_name = ucfirst(strtolower($row[1])); 

               
                $username = $first_name . "." . $last_name . "@mcclawis.edu.ph";
                
              
                $sql = "INSERT INTO ms_365_users (first_name, last_name, Username) 
                        VALUES ('$first_name', '$last_name', '$username')";
                
                if (!$conn->query($sql)) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            fclose($file);
            echo "Data imported successfully!";
        }
    } else {
        echo "Invalid file type. Only CSV files are allowed.";
    }
}

// Close connection
$conn->close();
?>
