-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 12:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nodemcu_rfid_iot_projects`
--

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(80) NOT NULL,
  `admin_pwd` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_pwd`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$89uX3LBy4mlU/DcBveQ1l.32nSianDP/E1MfUh.Z.6B4Z0ql3y7PK');


-- --------------------------------------------------------

--
-- Table structure for table `table_the_iot_projects`
--

CREATE TABLE `table_the_iot_projects` (
  `name` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `user_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dep` varchar(20) NOT NULL,
  `status` BOOLEAN NOT NULL DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `table_the_iot_projects`
--
INSERT INTO `table_the_iot_projects` (`name`, `id`,`pin`, `gender`, `email`, `mobile`, `user_date`, `dep`)
VALUES ('John Doe', 'JD123','7777', 'Male', 'johndoe@example.com', '1234567890', NOW(),'IT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_the_iot_projects`
--
ALTER TABLE `table_the_iot_projects`
  ADD PRIMARY KEY (`id`);
COMMIT;

--
-- Table structure for table `users logs`
--
CREATE TABLE `user_logs` (
   `name` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `dep` varchar(20) NOT NULL ,
  `time_in` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_out` DATETIME DEFAULT NULL,
  `methode` varchar(100) NOT NULL
)  ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `user_logs`
--

ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`time_in`);
COMMIT;

--
-- Dumping data for table `users_logs`
--
INSERT INTO `user_logs` (`name`, `id`,`pin`, `mobile`, `dep`, `time_in`,`methode`) VALUES ('wiam', '412578','7878', '0777985146', 'hr', current_timestamp(),'pin');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
