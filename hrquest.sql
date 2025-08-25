-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 25, 2025 at 06:23 AM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrquest`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted`
--

DROP TABLE IF EXISTS `accepted`;
CREATE TABLE IF NOT EXISTS `accepted` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appliedjobs`
--

DROP TABLE IF EXISTS `appliedjobs`;
CREATE TABLE IF NOT EXISTS `appliedjobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

DROP TABLE IF EXISTS `attendance_records`;
CREATE TABLE IF NOT EXISTS `attendance_records` (
  `e_username` varchar(255) NOT NULL,
  `e_email` varchar(255) NOT NULL,
  `check_in_time` datetime NOT NULL,
  `check_out_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `e_username` varchar(200) DEFAULT NULL,
  `e_email` varchar(200) DEFAULT NULL,
  `e_password` varchar(200) DEFAULT NULL,
  `e_jobtitle` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_username`, `e_email`, `e_password`, `e_jobtitle`) VALUES
(NULL, NULL, NULL, NULL),
('dineshkummarc', 'mapmydestination@gmail.com', 'choudhary@123', 'Sr. Software Engineer'),
(NULL, NULL, NULL, NULL),
('dineshkummarc', 'mapmydestination@gmail.com', 'choudhary@123', 'Sr. Software Engineer'),
('dk', 'dk@hrquest.com', 'dk', 'sr. sse'),
('dk', 'dk@hrquest.com', 'dk', 'sr. sse');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `jobtype` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `m_username` varchar(200) DEFAULT NULL,
  `m_email` varchar(200) DEFAULT NULL,
  `m_password` varchar(200) DEFAULT NULL,
  `m_jobtitle` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`m_username`, `m_email`, `m_password`, `m_jobtitle`) VALUES
(NULL, NULL, NULL, NULL),
('dkm', 'dkm@hrquest.com', 'dkm', 'sr. sse');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('unread','read') DEFAULT 'unread',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rejected`
--

DROP TABLE IF EXISTS `rejected`;
CREATE TABLE IF NOT EXISTS `rejected` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `resume_path` varchar(255) DEFAULT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
CREATE TABLE IF NOT EXISTS `salaries` (
  `employee_email` varchar(255) NOT NULL,
  `month_year` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  `job_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Email`, `Password`) VALUES
('admin', 'admin@admin.com', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
