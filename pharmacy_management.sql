-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 09:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_management`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc` (IN `NAME` VARCHAR(40), IN `PASS` VARCHAR(20))   select * from employee_details where EMP_NAME = NAME && PASSWORD = PASS$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc1` (IN `name` VARCHAR(20), IN `pass` INT)   select * from admin where name = name && pass = pass$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `pass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `pass`) VALUES
('admin', 123),
('vaisiri', 420);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_invoice` int(11) NOT NULL,
  `drug_name` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_invoice`, `drug_name`, `quantity`, `price`, `total`) VALUES
(1, 'cough syrup', 1, 35, 35),
(1, 'ORS', 2, 45, 90),
(1, 'vicks', 1, 18, 18),
(2, 'cipla', 2, 7, 14),
(2, 'DOLO 650', 5, 6, 30),
(2, 'woodwards', 1, 125, 125),
(3, 'ORS', 2, 45, 90),
(3, 'pediasure', 1, 175, 175),
(3, 'aspirin', 2, 110, 220),
(3, 'PARA', 10, 12, 120),
(3, 'baby soap', 1, 52, 52),
(3, 'aspirin', 1, 110, 110),
(4, 'DOLO 650', 5, 6, 30),
(4, 'aspirin', 1, 110, 110),
(4, 'aspirin', 2, 110, 220),
(4, 'PARA', 40, 12, 480),
(1, 'aspirin', 4, 110, 440),
(1, 'aspirin', 5, 110, 550),
(7, 'PARA', 4, 12, 48);

--
-- Triggers `billing`
--
DELIMITER $$
CREATE TRIGGER `decrement_inventory` AFTER INSERT ON `billing` FOR EACH ROW UPDATE inventory SET
QTY=QTY-new.quantity
WHERE new.drug_name=inventory.PROD_NAME
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `EMP_NAME` varchar(40) NOT NULL,
  `EMP_ID` int(11) NOT NULL,
  `PHONE_NO` varchar(20) DEFAULT NULL,
  `ADDRESS` varchar(50) DEFAULT NULL,
  `SALARY` int(11) DEFAULT NULL,
  `PASSWORD` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`EMP_NAME`, `EMP_ID`, `PHONE_NO`, `ADDRESS`, `SALARY`, `PASSWORD`) VALUES
('pramitha', 9, '9876543', 'kokkarne', 20000, '111'),
('vaisiri', 10, '4567899', 'sirsi', 15000, '222'),
('ananya', 11, '32145698', 'kundapura', 15000, '333'),
('priya', 12, '9754780', 'shivmogga', 10000, '444');

-- --------------------------------------------------------

--
-- Table structure for table `grandtotal`
--

CREATE TABLE `grandtotal` (
  `bill_invoice` int(11) NOT NULL,
  `grand_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `PROD_NAME` varchar(30) NOT NULL,
  `QTY` int(11) DEFAULT NULL,
  `MFG_DATE` date NOT NULL,
  `EXP_DATE` date NOT NULL,
  `PUR_RATE` decimal(5,2) DEFAULT NULL,
  `SELL_RATE` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`PROD_NAME`, `QTY`, `MFG_DATE`, `EXP_DATE`, `PUR_RATE`, `SELL_RATE`) VALUES
('aspirin', 133, '2021-03-17', '2025-10-14', '105.00', '110.00'),
('baby soap', 24, '2022-03-02', '2024-02-21', '50.00', '52.00'),
('cipla', 98, '2022-03-01', '2024-03-01', '5.00', '7.00'),
('cough syrup', 199, '2022-03-04', '2024-10-20', '25.00', '35.00'),
('DOLO 650', 240, '2022-03-01', '2024-06-20', '5.00', '6.00'),
('ORS', 16, '2022-02-11', '2024-05-22', '38.00', '45.00'),
('PARA', 96, '2022-03-01', '2025-06-20', '10.00', '12.00'),
('pediasure', 14, '2022-03-04', '2024-02-21', '150.00', '175.00'),
('vicks', 49, '2022-03-03', '2024-01-22', '15.00', '18.00'),
('woodwards', 14, '2021-12-31', '2024-05-02', '110.00', '125.00');

--
-- Triggers `inventory`
--
DELIMITER $$
CREATE TRIGGER `tri` AFTER INSERT ON `inventory` FOR EACH ROW UPDATE triggertotal set total=total+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `triggertotal`
--

CREATE TABLE `triggertotal` (
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `triggertotal`
--

INSERT INTO `triggertotal` (`total`) VALUES
(10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
  ADD PRIMARY KEY (`EMP_ID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`PROD_NAME`,`SELL_RATE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `EMP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
