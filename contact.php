<?php
// db_connection.php
$host = 'localhost'; // Database host
$db   = 'u510162695_bsit_quiz'; // Database name
$user = 'u510162695_bsit_quiz'; // Database username
$pass = '1Bsit_quiz'; // Database password

try {
    // Create a PDO instance to connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionally, you can set the character set to utf8mb4 for better compatibility
    $pdo->exec("SET NAMES 'utf8mb4'");

    // SQL query to drop the table and create the new 'ms_365_instructor' table
    $sql = "
    DROP TABLE IF EXISTS `ms_365_instructor`;
    CREATE TABLE `ms_365_instructor` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `first_name` varchar(100) NOT NULL,
        `last_name` varchar(100) NOT NULL,
        `username` varchar(100) NOT NULL,
        `token` varchar(255) NOT NULL,
        `token_expire` time NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
    LOCK TABLES `ms_365_instructor` WRITE;
    /*!40000 ALTER TABLE `ms_365_instructor` DISABLE KEYS */;
    
    INSERT INTO `ms_365_instructor` VALUES
    (1,'Alvine','Billones','Alvine.Billones@mcclawis.edu.ph','','00:00:00'),
    (2,'Juniel','Marfa','Juniel.Marfa@mcclawis.edu.ph','','00:00:00'),
    (3,'Kurt Bryan','Alegre','KurtBryan.Alegre@mcclawis.edu.ph','','00:00:00'),
    (4,'Dino','Ilustrisimo','Dino.Ilustrisimo@mcclawis.edu.ph','','00:00:00'),
    (5,'Jessica','Alcazar','Jessica.Alcazar@mcclawis.edu.ph','','00:00:00'),
    (6,'Jered','Cueva','Jered.Cueva@mcclawis.edu.ph','','00:00:00'),
    (7,'Danilo','Villarino','Danilo.Villarino@mcclawis.edu.ph','','00:00:00'),
    (8,'Jamaica Fe','Carabio','jamaicafe.carabio@mcclawis.edu.ph','','00:00:00'),
    (9,'John Michaelle Piedad','Robles','johnmichaelle.robles@mcclawis.edu.ph','fe7e3ac25fc4711d06d2474ee6948682','05:31:54'),
    (10,'Emily','Ilustrisimo','Emily.Ilustrisimo@mcclawis.edu.ph','','00:00:00');
    
    /*!40000 ALTER TABLE `ms_365_instructor` ENABLE KEYS */;
    UNLOCK TABLES;
    ";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    echo "The 'ms_365_instructor' table has been created and data inserted successfully.";

} catch (PDOException $e) {
    // If the connection fails or there's an error executing the query, display an error message
    echo "Error: " . $e->getMessage();
    exit;
}
?>
