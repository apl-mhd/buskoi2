-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2019 at 05:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_koi`
--

-- --------------------------------------------------------

--
-- Table structure for table `accident_record`
--

CREATE TABLE `accident_record` (
  `bus_no` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `bus_lat` double NOT NULL,
  `bus_lon` double NOT NULL,
  `alert_hospital_lat` double DEFAULT NULL,
  `alert_hospital_lon` double DEFAULT NULL,
  `hospital_contact_no` varchar(15) NOT NULL,
  `alert_police_lat` double DEFAULT NULL,
  `alert_police_lon` double DEFAULT NULL,
  `police_contact_no` varchar(15) NOT NULL,
  `counter_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accident_record`
--

INSERT INTO `accident_record` (`bus_no`, `date_time`, `bus_lat`, `bus_lon`, `alert_hospital_lat`, `alert_hospital_lon`, `hospital_contact_no`, `alert_police_lat`, `alert_police_lon`, `police_contact_no`, `counter_id`) VALUES
('bus-2', '2019-12-08 07:47:37', 1.1, 2.2, 23.745472, 90.371727, '01676772959', 23.794785, 90.414247, '01642636676', NULL),
('bus-2', '2019-12-08 15:01:29', 90.5, 70.5, 23.797765, 90.423625, '01710453438', 23.794785, 90.414247, '01642636676', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `admin_type` varchar(30) DEFAULT NULL,
  `counter_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bus`
--

CREATE TABLE `Bus` (
  `Bus_No` varchar(50) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Total_capacity` int(2) NOT NULL,
  `Last_lat` double DEFAULT NULL,
  `Last_lon` double DEFAULT NULL,
  `Seat_plan` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Bus`
--

INSERT INTO `Bus` (`Bus_No`, `Author`, `Total_capacity`, `Last_lat`, `Last_lon`, `Seat_plan`) VALUES
('bus-1', 'Hanif', 40, 23.798329, 90.44894, NULL),
('bus-2', 'Dipjol', 40, 1.1, 2.2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `ID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Contact_number` varchar(15) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Lat` double NOT NULL,
  `Lon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`ID`, `Name`, `Contact_number`, `Location`, `Lat`, `Lon`) VALUES
('H-C1', 'Hanif', '01627677646', 'Notun Bazar', 23.797765, 90.423625);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `Hospital_name` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`lat`, `lon`, `Hospital_name`, `contact_no`) VALUES
(23.745472, 90.371727, 'Dhanmondi Hospital', '01676772959'),
(23.780113, 90.416939, 'Gulshan 1 Hospital', '01558971505'),
(23.797765, 90.423625, 'Notun Bazar Hospital', '01710453438');

-- --------------------------------------------------------

--
-- Table structure for table `logical`
--

CREATE TABLE `logical` (
  `ID` varchar(50) NOT NULL,
  `Source_Location` varchar(255) NOT NULL,
  `Destination_location` varchar(255) NOT NULL,
  `Total_capacity` int(2) NOT NULL,
  `Available_capacity` int(2) NOT NULL,
  `Dep_time_hour` int(2) NOT NULL,
  `Dep_time_minute` int(2) NOT NULL,
  `Bus_no` varchar(255) NOT NULL,
  `Fare` double NOT NULL,
  `Status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logical`
--

INSERT INTO `logical` (`ID`, `Source_Location`, `Destination_location`, `Total_capacity`, `Available_capacity`, `Dep_time_hour`, `Dep_time_minute`, `Bus_no`, `Fare`, `Status`) VALUES
('L1', 'Dhaka', 'Naogaon', 40, 40, 22, 0, 'bus-1', 500, 'non-ac'),
('L2', 'Dhaka', 'Bogra', 40, 40, 12, 0, 'bus-2', 400, 'non-ac');

-- --------------------------------------------------------

--
-- Table structure for table `logical_bus_record`
--

CREATE TABLE `logical_bus_record` (
  `Logical_id` varchar(50) NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp(),
  `bus_no` varchar(50) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`lat`, `lon`, `name`, `address`, `contact_no`) VALUES
(23.771273, 90.425723, 'Merul badda Police', 'Merul badda Police', '01733713503'),
(23.794785, 90.414247, 'Gulshan-2 Police', 'Gulshan-2 Police', '01642636676');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Date_time` datetime NOT NULL,
  `Dep_time_hour` int(2) NOT NULL,
  `Dep_time_min` int(2) NOT NULL,
  `Logical_ID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sos`
--

CREATE TABLE `sos` (
  `User_phone_no` varchar(15) NOT NULL,
  `sos1` varchar(50) DEFAULT NULL,
  `sos2` varchar(50) DEFAULT NULL,
  `sos3` varchar(50) DEFAULT NULL,
  `count_sos` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sos`
--

INSERT INTO `sos` (`User_phone_no`, `sos1`, `sos2`, `sos3`, `count_sos`) VALUES
('01739703058', '01739703058', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` varchar(50) NOT NULL,
  `logical_id` varchar(50) NOT NULL,
  `user_phn_no` varchar(15) NOT NULL,
  `seat_no` varchar(100) NOT NULL,
  `date_time` date NOT NULL,
  `booked_by` varchar(50) NOT NULL,
  `purchase_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `flag` tinyint(1) NOT NULL DEFAULT 1,
  `bus_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `logical_id`, `user_phn_no`, `seat_no`, `date_time`, `booked_by`, `purchase_datetime`, `flag`, `bus_no`) VALUES
('T1', 'L1', '01739703058', 'A3', '2019-12-04', 'own', '0000-00-00 00:00:00', 1, 'bus-1'),
('T2', 'L1', '01739703058', 'A1,A2,', '2019-12-09', 'own', '2019-12-08 20:31:21', 1, 'bus-1'),
('T3', 'L1', '01739703058', 'A2,', '2019-12-10', 'own', '2019-12-08 22:12:35', 1, 'bus-1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Phone_no` varchar(15) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Phone_no`, `Name`, `email`, `password`) VALUES
('016228989', 'manik', NULL, '1234'),
('01676772958', 'partho', NULL, '1234'),
('01739703058', 'Fuad', NULL, '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accident_record`
--
ALTER TABLE `accident_record`
  ADD PRIMARY KEY (`bus_no`,`date_time`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Bus`
--
ALTER TABLE `Bus`
  ADD PRIMARY KEY (`Bus_No`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`lat`,`lon`);

--
-- Indexes for table `logical`
--
ALTER TABLE `logical`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `logical_bus_record`
--
ALTER TABLE `logical_bus_record`
  ADD PRIMARY KEY (`Logical_id`,`date_time`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`lat`,`lon`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`Date_time`);

--
-- Indexes for table `sos`
--
ALTER TABLE `sos`
  ADD PRIMARY KEY (`User_phone_no`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Phone_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
