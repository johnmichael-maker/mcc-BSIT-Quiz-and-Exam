CREATE TABLE `ms_365_instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_expire` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO ms_365_instructor (id, first_name, last_name, username, token, token_expire) VALUES 
('1', 'Alvine', 'Billones', 'Alvine.Billones@mcclawis.edu.ph', '', '00:00:00'),
('2', 'Juniel', 'Marfa', 'Juniel.Marfa@mcclawis.edu.ph', '', '00:00:00'),
('3', 'Kurt Bryan', 'Alegre', 'KurtBryan.Alegre@mcclawis.edu.ph', '', '00:00:00'),
('4', 'Dino', 'Ilustrisimo', 'Dino.Ilustrisimo@mcclawis.edu.ph', '', '00:00:00'),
('5', 'Jessica', 'Alcazar', 'Jessica.Alcazar@mcclawis.edu.ph', '', '00:00:00'),
('6', 'Jered', 'Cueva', 'Jered.Cueva@mcclawis.edu.ph', '', '00:00:00'),
('7', 'Danilo', 'Villarino', 'Danilo.Villarino@mcclawis.edu.ph', '', '00:00:00'),
('8', 'Jamaica Fe', 'Carabio', 'jamaicafe.carabio@mcclawis.edu.ph', '', '00:00:00'),
('9', 'John Michaelle Piedad', 'Robles', 'johnmichaelle.robles@mcclawis.edu.ph', 'fe7e3ac25fc4711d06d2474ee6948682', '05:31:54'),
('10', 'Emily', 'Ilustrisimo', 'Emily.Ilustrisimo@mcclawis.edu.ph', '', '00:00:00');
