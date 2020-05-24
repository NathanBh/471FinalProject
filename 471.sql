-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2019 at 03:11 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `471`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `master` int(11) NOT NULL DEFAULT 0,
  `password` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`master`, `password`) VALUES
(1000000000, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `ID` int(11) NOT NULL,
  `DateTime` varchar(19) NOT NULL,
  `Confirmation` char(1) NOT NULL DEFAULT 'm',
  `Reason` varchar(255) DEFAULT NULL,
  `Doctor` varchar(50) NOT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Appointment`
--

INSERT INTO `Appointment` (`ID`, `DateTime`, `Confirmation`, `Reason`, `Doctor`, `Location`) VALUES
(2044783661, '12/06/2020 5:30 PM', 'y', 'I feel sick', 'Xie Chang', 'Country Hills'),
(7, '12/18/2019 5:00 PM', 'y', 'Sore Throat', 'Jacob Smith', 'University of Calgary'),
(7, '12/23/2019 11:30 AM', 'm', 'Cold', 'Jacob Smith', 'University of Calgary'),
(7, '12/25/2020 10:00 AM', 'n', 'Anemic', 'Jacob Smith', 'University of Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `Clinic`
--

CREATE TABLE `Clinic` (
  `Location` varchar(50) NOT NULL,
  `Owner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Clinic`
--

INSERT INTO `Clinic` (`Location`, `Owner`) VALUES
('Country Hills', 'Maxwell'),
('University of Calgary', 'Muhammad Ali');

-- --------------------------------------------------------

--
-- Table structure for table `ClinicStaff`
--

CREATE TABLE `ClinicStaff` (
  `EmID` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `JobType` char(1) DEFAULT NULL,
  `ClinicLocation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ClinicStaff`
--

INSERT INTO `ClinicStaff` (`EmID`, `Email`, `Name`, `Password`, `JobType`, `ClinicLocation`) VALUES
(1111532546, 'jsmith@gmail.com', 'Jacob Smith', 'bumbleB33!', 'p', 'University of Calgary'),
(1137583563, 'xiechang@yahoo.ca', 'Xie Chang', 'ph0noodaws', 'p', 'Country Hills'),
(1929473244, 'maria.garcia@outlook.ca', 'Maria Garcias', 'pik@77ChUwU', 'r', 'University of Calgary');

-- --------------------------------------------------------

--
-- Table structure for table `Medication`
--

CREATE TABLE `Medication` (
  `mID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Medication`
--

INSERT INTO `Medication` (`mID`, `Name`) VALUES
(594873, 'Amoxicillin'),
(235523, 'Tylenol');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `HealthNumber` int(10) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`HealthNumber`, `Email`, `DOB`, `PhoneNumber`, `Sex`, `Address`, `Password`, `Name`) VALUES
(7, 'u', '2019-12-04', '4031245678', 'M', 'u\'s house', 'u', 'u'),
(2044783661, 'cocopel@gmail.com', '1994-05-13', '5877774321', 'F', '69th Street Station SW', 'chocococoM001a', 'Conoco Pel'),
(2137477435, 'weee88@yahoo.ca', '2016-08-16', '4032465432', 'M', '51 ST NW', 'weabu88$', 'Wu Kong');

-- --------------------------------------------------------

--
-- Table structure for table `PatientLog`
--

CREATE TABLE `PatientLog` (
  `ID` int(11) NOT NULL,
  `Medication` text DEFAULT NULL,
  `Height` int(255) NOT NULL,
  `Weight` int(255) DEFAULT NULL,
  `RefersTo` int(11) DEFAULT NULL,
  `PastAppointments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PatientLog`
--

INSERT INTO `PatientLog` (`ID`, `Medication`, `Height`, `Weight`, `RefersTo`, `PastAppointments`) VALUES
(7, 'Tylenol', 165, 66, 912485772, '2019-01-29'),
(2137477435, 'Amoxicillin', 152, 49, NULL, '2018-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `Specialist`
--

CREATE TABLE `Specialist` (
  `sID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Specialization` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Specialist`
--

INSERT INTO `Specialist` (`sID`, `Name`, `Specialization`) VALUES
(911425171, 'Sandra King', 'Psychiatrist'),
(912485772, 'Jason Lang', 'Surgeon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`master`);

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`DateTime`,`Doctor`),
  ADD KEY `appointment_ibfk_1` (`ID`),
  ADD KEY `appointment_ibfk_2` (`Location`);

--
-- Indexes for table `Clinic`
--
ALTER TABLE `Clinic`
  ADD PRIMARY KEY (`Location`);

--
-- Indexes for table `ClinicStaff`
--
ALTER TABLE `ClinicStaff`
  ADD PRIMARY KEY (`EmID`),
  ADD KEY `Clinic Location` (`ClinicLocation`);

--
-- Indexes for table `Medication`
--
ALTER TABLE `Medication`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`HealthNumber`);

--
-- Indexes for table `PatientLog`
--
ALTER TABLE `PatientLog`
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `patientlog_ibfk_2` (`RefersTo`);

--
-- Indexes for table `Specialist`
--
ALTER TABLE `Specialist`
  ADD PRIMARY KEY (`sID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Patient` (`HealthNumber`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Location`) REFERENCES `Clinic` (`Location`);

--
-- Constraints for table `ClinicStaff`
--
ALTER TABLE `ClinicStaff`
  ADD CONSTRAINT `clinicstaff_ibfk_1` FOREIGN KEY (`ClinicLocation`) REFERENCES `Clinic` (`Location`);

--
-- Constraints for table `PatientLog`
--
ALTER TABLE `PatientLog`
  ADD CONSTRAINT `patientlog_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `Patient` (`HealthNumber`) ON DELETE CASCADE,
  ADD CONSTRAINT `patientlog_ibfk_2` FOREIGN KEY (`RefersTo`) REFERENCES `Specialist` (`sID`) ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
