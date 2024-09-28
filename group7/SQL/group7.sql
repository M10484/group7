-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 12:41 PM
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
-- Database: `group7`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `certificate_type` varchar(255) NOT NULL,
  `date_issued` date NOT NULL,
  `valid_until` date NOT NULL,
  `resident_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `certificate_type`, `date_issued`, `valid_until`, `resident_id`) VALUES
(1, 'k', '2001-02-15', '2005-02-15', 20),
(2, 'k', '2001-02-15', '2005-02-15', 20);

-- --------------------------------------------------------

--
-- Table structure for table `clearance`
--

CREATE TABLE `clearance` (
  `id` int(11) NOT NULL,
  `resident_name` varchar(255) DEFAULT NULL,
  `clearance_type` varchar(255) DEFAULT NULL,
  `date_issue` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clearance`
--

INSERT INTO `clearance` (`id`, `resident_name`, `clearance_type`, `date_issue`, `valid_until`, `status`) VALUES
(1, 'Mike C', 'c', '2004-02-15', '2004-02-15', 'Pending'),
(2, 'Anmmw Clara', 'ss', '2004-02-15', '2004-02-15', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `community_tax`
--

CREATE TABLE `community_tax` (
  `id` int(11) NOT NULL,
  `tax_year` year(4) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_paid` date NOT NULL,
  `resident_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_tax`
--

INSERT INTO `community_tax` (`id`, `tax_year`, `amount`, `date_paid`, `resident_id`) VALUES
(1, '2024', 1000.00, '2024-02-15', 21),
(2, '2024', 1000.00, '2024-02-15', 21);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `ID` int(11) NOT NULL,
  `resident_name` varchar(255) NOT NULL,
  `complaint_type` varchar(255) NOT NULL,
  `date_field` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `description` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`ID`, `resident_name`, `complaint_type`, `date_field`, `status`, `description`) VALUES
(1, 'Mike C', 'Xnx', '2024-09-22 16:00:00', 'Pending', 'd'),
(2, 'Anmmw Clara', 'WA', '2024-09-22 16:00:00', 'Pending', 'WLLLLL'),
(3, 'Mike C', 'c', '2024-09-22 16:00:00', 'Pending', 'MAN');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'group7@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `manage_residents`
--

CREATE TABLE `manage_residents` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `birthday` date NOT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed','Divorced','Separated') NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `lot_number` varchar(50) DEFAULT NULL,
  `purok` varchar(50) DEFAULT NULL,
  `resident_status` varchar(50) NOT NULL,
  `voter_status` varchar(50) NOT NULL,
  `person_with_disability` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage_residents`
--

INSERT INTO `manage_residents` (`id`, `firstname`, `middlename`, `nickname`, `lastname`, `gender`, `birthday`, `place_of_birth`, `civil_status`, `occupation`, `religion`, `lot_number`, `purok`, `resident_status`, `voter_status`, `person_with_disability`) VALUES
(4, 'Michael', 'M', 'Boy Tapang', 'Gwapo', 'Male', '1985-06-15', 'tupi south cotabato', 'Single', 'Manogluy-ah', 'Muslim', '99', 'Purok MAnok', '', '', 'No'),
(5, 'Maria', 'N', 'Gata', 'LAbo', 'Female', '1990-02-20', 'North pool', 'Married', 'Teacher', 'Christian', '74', 'Purok Iniwan', '', '', 'No'),
(6, 'Many', 'T', 'Pakito', 'Pakyaw', 'Male', '1980-11-11', 'Banga cotabato', 'Single', 'Manog_hilot', 'Christian', '56', 'Purok Gwapo', '', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `position` varchar(100) NOT NULL,
  `term_start` date NOT NULL,
  `term_end` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `name`, `birthday`, `position`, `term_start`, `term_end`, `photo`) VALUES
(1, 'Maria', '2005-02-15', 'Captain', '2004-02-15', '2005-02-15', 'pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `nick_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `lot` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `resident_status` varchar(255) NOT NULL,
  `voter_status` varchar(255) NOT NULL,
  `person_with_disability` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `first_name`, `middle_name`, `last_name`, `nick_name`, `gender`, `birth_date`, `place_of_birth`, `civil_status`, `occupation`, `religion`, `lot`, `purok`, `resident_status`, `voter_status`, `person_with_disability`, `email`, `phone_number`, `telephone`, `photo`) VALUES
(20, 'Anmmw', 'Gata', 'Clara', 'Nenang', 'Male', '2005-02-15', 'Banga', 'Single', 'Kawatan', 'Baptist', '1234', 'Purok Mabuhay', 'Active', 'Yes', 'Yes', 'maria2282@gmail.com', '09896374842', '193-76852', 'pic.jpg'),
(21, 'Mike', 'Corona', 'C', 'Nonoy', 'Male', '2005-02-15', 'Banga', 'Single', 'Kawatan', 'Baptist', '1234', 'Purok Mabuhay', 'Active', 'Yes', 'Yes', 'maria22282@gmail.com', '09896374840', '193-768524', 'pic.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `clearance`
--
ALTER TABLE `clearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_tax`
--
ALTER TABLE `community_tax`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_id` (`resident_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_residents`
--
ALTER TABLE `manage_residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clearance`
--
ALTER TABLE `clearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_tax`
--
ALTER TABLE `community_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manage_residents`
--
ALTER TABLE `manage_residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`);

--
-- Constraints for table `community_tax`
--
ALTER TABLE `community_tax`
  ADD CONSTRAINT `community_tax_ibfk_1` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
