-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 09:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcc_bsit_quiz_and_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', '$2y$10$YUg1H1qYcqqfLu1huQRcSO9juip3JHD.IW5mzyhR0HOXUrIOh5QWa', '2024-03-15 15:25:36', '2024-06-29 05:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `contestant_id` text DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `time` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_answer` text DEFAULT NULL,
  `check_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers_enumeration`
--

CREATE TABLE `answers_enumeration` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `id_number` text NOT NULL,
  `enumeration_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers_essay`
--

CREATE TABLE `answers_essay` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `id_number` text NOT NULL,
  `essay_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers_identification`
--

CREATE TABLE `answers_identification` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `id_number` text NOT NULL,
  `identification_id` int(11) NOT NULL,
  `choice_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers_multiple_choice`
--

CREATE TABLE `answers_multiple_choice` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `id_number` text NOT NULL,
  `multiple_choice_id` int(11) NOT NULL,
  `answer` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `contestant_id` int(11) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `fname` text DEFAULT NULL,
  `lname` text DEFAULT NULL,
  `mname` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `section` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enumeration`
--

CREATE TABLE `enumeration` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enumeration`
--

INSERT INTO `enumeration` (`id`, `exam_id`, `question`) VALUES
(1, 1, 'list down 5 computer hardware'),
(2, 1, 'List down 3 software apps');

-- --------------------------------------------------------

--
-- Table structure for table `enumeration_correct`
--

CREATE TABLE `enumeration_correct` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `enumeration_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enumeration_correct`
--

INSERT INTO `enumeration_correct` (`id`, `exam_id`, `enumeration_id`, `answer`) VALUES
(1, 1, 1, 'RAM'),
(2, 1, 1, 'Keyboard'),
(3, 1, 1, 'Hard Disc Drive'),
(4, 1, 2, 'Google'),
(5, 1, 2, 'Visual Studio'),
(6, 1, 2, 'xampp'),
(7, 1, 1, 'Hello world');

-- --------------------------------------------------------

--
-- Table structure for table `essay`
--

CREATE TABLE `essay` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `essay`
--

INSERT INTO `essay` (`id`, `exam_id`, `question`, `answer`) VALUES
(1, 1, 'Describe CPU?', 'CPU is the central processor of the computer');

-- --------------------------------------------------------

--
-- Table structure for table `examinees`
--

CREATE TABLE `examinees` (
  `id` int(11) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `section` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `mname` text DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `time_limit` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,2=disabled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `section`, `year_level`, `semester`, `type`, `category`, `time_limit`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 3, 2, 3, 0, 60, 1, '2024-07-07 06:58:47', '2024-07-03 15:16:00'),
(6, 6, 4, 3, 3, 2, 30, 1, '2024-07-06 08:12:35', '2024-07-03 15:28:30'),
(9, 4, 4, 1, 1, 2, 20, 1, '2024-07-06 10:21:58', '2024-07-06 10:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `identification`
--

CREATE TABLE `identification` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identification`
--

INSERT INTO `identification` (`id`, `exam_id`, `question`, `count`) VALUES
(1, 1, 'What type of device is a computer monitor?', 1),
(4, 1, 'Who is the inventor of computers?', 2),
(5, 1, 'Which of the following is the most powerful type of computer?', 3),
(6, 1, 'Meaning Of RAM', 4),
(7, 1, 'Meaning of PHP\r\n', 5),
(8, 1, 'Meaning of CPU', 6),
(9, 1, 'Meaning of GPU', 7);

-- --------------------------------------------------------

--
-- Table structure for table `identification_choices`
--

CREATE TABLE `identification_choices` (
  `id` int(11) NOT NULL,
  `exam_id` int(1) NOT NULL,
  `identification_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `identification_choices`
--

INSERT INTO `identification_choices` (`id`, `exam_id`, `identification_id`, `answer`) VALUES
(1, 1, 1, 'Output'),
(2, 1, 5, 'Super Computer'),
(3, 1, 4, 'Charles Babbage'),
(4, 1, 9, 'graphics processing unit'),
(5, 1, 7, 'Hyper Preprocessor\r\n'),
(6, 1, 6, 'Random Access Memory'),
(7, 1, 8, 'Central Processing Unit');

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choice`
--

CREATE TABLE `multiple_choice` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(1) NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `multiple_choice`
--

INSERT INTO `multiple_choice` (`id`, `exam_id`, `question`, `answer`, `A`, `B`, `C`, `D`) VALUES
(1, 1, 'sdsd', 'A', 'sds', 'dsds', 'dsd', 'sdsds'),
(2, 1, 'What is software?', 'C', 'clothing designed to be worn by computer users', 'any part of the computer that has a physical structure', 'instructions that tell the hardware what to do', 'flexible parts of a computer case'),
(3, 1, 'The computer’s main circuit board is called a ________.', 'D', 'Bluetooth card', 'hard drive', 'monitor', 'motherboard');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `point_id` int(11) NOT NULL,
  `contestant_id` text DEFAULT NULL,
  `time` text DEFAULT NULL,
  `check_answer` text DEFAULT NULL,
  `check_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `A` text DEFAULT NULL,
  `B` text DEFAULT NULL,
  `C` text DEFAULT NULL,
  `D` text DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `activation` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `answers_enumeration`
--
ALTER TABLE `answers_enumeration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers_essay`
--
ALTER TABLE `answers_essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers_identification`
--
ALTER TABLE `answers_identification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers_multiple_choice`
--
ALTER TABLE `answers_multiple_choice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`contestant_id`);

--
-- Indexes for table `enumeration`
--
ALTER TABLE `enumeration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enumeration_correct`
--
ALTER TABLE `enumeration_correct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essay`
--
ALTER TABLE `essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinees`
--
ALTER TABLE `examinees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identification`
--
ALTER TABLE `identification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identification_choices`
--
ALTER TABLE `identification_choices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multiple_choice`
--
ALTER TABLE `multiple_choice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`point_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers_enumeration`
--
ALTER TABLE `answers_enumeration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers_essay`
--
ALTER TABLE `answers_essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers_identification`
--
ALTER TABLE `answers_identification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers_multiple_choice`
--
ALTER TABLE `answers_multiple_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `contestant_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enumeration`
--
ALTER TABLE `enumeration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enumeration_correct`
--
ALTER TABLE `enumeration_correct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `essay`
--
ALTER TABLE `essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `examinees`
--
ALTER TABLE `examinees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `identification`
--
ALTER TABLE `identification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `identification_choices`
--
ALTER TABLE `identification_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `multiple_choice`
--
ALTER TABLE `multiple_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `point_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
