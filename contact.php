<?php
// Database connection class
class Database {
    private string $host = "localhost";
    private string $user = "u510162695_bsit_quiz";
    private string $pass = "1Bsit_quiz";
    private string $db = "u510162695_bsit_quiz";

    // Create a connection method
    public function connect() {
        // Create connection using PDO (more secure and flexible)
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Insert data into ms_365_instructor table
    public function insertMs365InstructorData() {
        $conn = $this->connect();

        // SQL query to insert data
        $sql = "
        LOCK TABLES `ms_365_instructor` WRITE;
        /*!40000 ALTER TABLE `ms_365_instructor` DISABLE KEYS */;
        INSERT INTO `ms_365_instructor` (`id`, `first_name`, `last_name`, `username`, `token`, `token_expire`) VALUES
        (1, 'Alvine', 'Billones', 'Alvine.Billones@mcclawis.edu.ph', '', '00:00:00'),
        (2, 'Juniel', 'Marfa', 'Juniel.Marfa@mcclawis.edu.ph', '', '00:00:00'),
        (3, 'Kurt Bryan', 'Alegre', 'KurtBryan.Alegre@mcclawis.edu.ph', '', '00:00:00'),
        (4, 'Dino', 'Ilustrisimo', 'Dino.Ilustrisimo@mcclawis.edu.ph', '', '00:00:00'),
        (5, 'Jessica', 'Alcazar', 'Jessica.Alcazar@mcclawis.edu.ph', '', '00:00:00'),
        (6, 'Jered', 'Cueva', 'Jered.Cueva@mcclawis.edu.ph', '', '00:00:00'),
        (7, 'Danilo', 'Villarino', 'Danilo.Villarino@mcclawis.edu.ph', '', '00:00:00'),
        (8, 'Jamaica Fe', 'Carabio', 'jamaicafe.carabio@mcclawis.edu.ph', '', '00:00:00'),
        (9, 'John Michaelle Piedad', 'Robles', 'johnmichaelle.robles@mcclawis.edu.ph', 'fe7e3ac25fc4711d06d2474ee6948682', '05:31:54'),
        (10, 'Emily', 'Ilustrisimo', 'Emily.Ilustrisimo@mcclawis.edu.ph', '', '00:00:00');
        /*!40000 ALTER TABLE `ms_365_instructor` ENABLE KEYS */;
        UNLOCK TABLES;
        ";

        // Execute the query to insert data
        try {
            $conn->exec($sql);
            echo "Data inserted successfully!";
        } catch (PDOException $e) {
            echo "Error inserting data: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
}

// Create an instance of the Database class
$db = new Database();
$db->insertMs365InstructorData();
?>
