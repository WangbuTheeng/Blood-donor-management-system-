-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 02:14 PM
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
-- Database: `blood_donor_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(2, 'Wang', 'wang', 9866442916, 'wangbutamang44@gmail.com', 'a01610228fe998f515a72dd730294d87', '2024-11-05 14:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblblooddonars`
--

CREATE TABLE `tblblooddonars` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `Diseases` varchar(50) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblblooddonars`
--

INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Gender`, `Age`, `BloodGroup`, `Diseases`, `Weight`, `Address`, `Message`, `PostingDate`, `status`, `Password`, `approved`) VALUES
(6, 'Rakesh Theeng', '7797987981', 'rakesh@gmail.com', 'Male', 27, 'O-', 'No', '55 kg', 'KTM', ' Call me if blood require', '2024-10-17 12:43:41', 1, '202cb962ac59075b964b07152d234b70', 1),
(9, 'Avinsah', '9789797979', 'avi@gmail.com', 'Male', 30, 'A+', 'N0', '60', 'NayaBasti', 'Hello! ', '2024-10-21 06:09:08', 1, '202cb962ac59075b964b07152d234b70', 1),
(10, 'Sushal Singh', '1236547890', 'naruto@gmail.com', 'Male', 25, 'O-', 'Yes', '65', 'Boudha', ' NA', '2024-10-29 01:50:58', 1, 'f925916e2754e5e03f75dd58a5733251', NULL),
(11, 'amrat kumar', '1231231230', 'amratk@gmail.com', 'Male', 26, 'AB+', 'No', '40', 'Chabil', ' NA', '2024-10-29 01:22:52', 1, 'f925916e2754e5e03f75dd58a5733251', 0),
(12, 'sasuke uchiha', '1425362514', 'Suchicha@test.com', 'Male', 30, 'A-', 'Yes ', '60', 'Pokhara Village', ' NA', '2022-10-29 17:31:08', 1, 'f925916e2754e5e03f75dd58a5733251', 0),
(13, 'Eren yeager', '32421421', 'tatakae@gmail.com', 'Male', 23, 'O-', 'No', '66', 'paradise island', 'ADFSAD ', '2024-10-29 14:39:09', 1, 'e08c822067e64be2037d020826b078f1', NULL),
(19, 'Wangbu Thing Tamang', '9818207687', 'wangbutamang44@gmail.com', 'Male', 22, 'AB+', 'No', '80 ', '132kv colony', ' oihpjeqrw', '2024-09-24 17:38:41', 1, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(20, 'Nupur Khadgi', '9823849999', 'nupurkhadgi21@gmail.com', 'Female', 22, 'A+', 'No', '64', '132kv colony', ' kufyg', '2024-09-26 02:26:01', 1, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(22, 'Chiring', '9866442916', 'chiring@gmail.com', 'Male', 26, 'AB+', 'No', '70', 'Gokarna', ' Hello! I need Blood', '2024-11-11 01:22:19', 1, 'a01610228fe998f515a72dd730294d87', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblbloodgroup`
--

CREATE TABLE `tblbloodgroup` (
  `id` int(11) NOT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbloodgroup`
--

INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(1, 'A-', '2024-09-30 20:33:50'),
(2, 'AB-', '2024-09-30 20:34:00'),
(3, 'O-', '2024-09-30 20:34:00'),
(4, 'A-', '2024-09-30 20:34:00'),
(5, 'A+', '2024-09-30 20:34:00'),
(6, 'AB+', '2024-09-30 20:34:00'),
(8, 'O+', '2024-10-01 16:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblbloodrequirer`
--

CREATE TABLE `tblbloodrequirer` (
  `ID` int(10) NOT NULL,
  `BloodDonarID` int(10) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `EmailId` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `BloodRequirefor` varchar(250) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbloodrequirer`
--

INSERT INTO `tblbloodrequirer` (`ID`, `BloodDonarID`, `name`, `EmailId`, `ContactNumber`, `BloodRequirefor`, `Message`, `ApplyDate`) VALUES
(1, 6, 'Rakesh', 'rak@gmail.com', 7894561236, 'Father', 'Please help', '2024-05-17 11:57:24'),
(2, 3, 'Mukesh', 'muk@gmail.com', 5896231478, 'Others', 'Please help', '2024-05-17 11:58:48'),
(3, 6, 'Hitesh', 'hit@gmail.com', 1236547896, 'Brother', 'do the needful', '2024-05-17 12:02:12'),
(4, 10, 'Rahul Singh', 'rahk@gmail.com', 2536251425, 'Mother', 'Please help me', '2024-07-29 01:51:52'),
(5, 11, 'Anuj Kumar', 'ak@gmail.com', 8525232102, 'Others', 'Need blood on urgent basis', '2024-08-02 01:24:18'),
(6, 12, 'sad', 'sadsa@gmail.com', 0, 'Brother', 'asd', '2024-03-30 14:26:35'),
(7, 9, 'Saad', 'saad@yahoo.com', 1234, 'Others', 'hello shb', '2024-03-30 14:45:31'),
(8, 9, 'saad', 'saad@yahoo.com', 1234, 'Father', 'Hello to the universe', '2024-03-30 14:47:19'),
(9, 13, 'noor', 'noor@gmail.com', 3242142, 'Father', 'please work krly bhia', '2024-03-30 15:04:01'),
(10, 9, 'Noor', 'noor@yahoo.com', 12345, 'Sister', 'Plese Donate', '2024-04-01 20:12:41'),
(11, 17, 'Dora', 'dora@dora.com', 98, 'Mother', 'Please Doinbate', '2024-04-01 20:15:27'),
(12, 18, 'Muhammad Saad Alam', 'saadalamk555@gmail.com', 3033173484, 'Mother', 'Please Contact me i neeed blood urgently.', '2024-04-04 18:59:43'),
(13, 18, 'Muhammad Saad Alam', 'saadalamk555@gmail.com', 3033173484, 'Brother', 'Please Donate this blood.', '2024-04-05 14:34:34'),
(14, 17, 'naruto', 'naruto@leaf.com', 123, 'Brother', 'Please donate dattaybayo.', '2024-04-05 14:46:51'),
(15, 9, 'Wangbu Thing Tamang', 'wangbutamang44@gmail.com', 9818207687, 'Father', 'Please urgent', '0000-00-00 00:00:00'),
(16, 11, 'Wangbu Thing Tamang', 'wangbutamang44@gmail.com', 9818207687, 'Sister', 'lkn', '2024-09-24 17:48:27'),
(17, 11, 'Wangbu Thing Tamang', 'wangbutamang44@gmail.com', 9818207687, 'Sister', 'lkn', '2024-09-24 17:48:56'),
(18, 10, 'Nupur Khadgi', 'nupurkhadgi21@gmail.com', 9823849939, 'Others', 'Accident', '2024-11-05 14:42:13'),
(19, 17, 'Chiring', 'chiring@gmail.com', 9866442916, 'Others', 'Accident ', '2024-11-11 01:19:02'),
(20, 19, 'Nakesh', 'nakesh@gmail.com', 1111111, 'Sister', 'Emergency', '2024-11-11 01:31:35'),
(21, 11, 'Nakesh', 'nakesh@gmail.com', 1111111, 'Mother', 'lkkh', '2024-11-13 01:49:11'),
(22, 22, 'Ram Tamang', 'ram@gmail.com', 8717273747, 'Father', 'Please! Emergency', '2024-11-15 16:07:33'),
(23, 19, 'Hari', '1234@gmail.com', 0, 'Father', 'Help', '2024-11-16 05:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'Test Demo test demo																									', 'test@test.com', '8585233222');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(8, 'Saad Khan', 'saad@gmail.com', '2131', 'YEah!!1 boii\r\n', '2023-03-30 16:21:22', 1),
(9, 'Nakesh', 'nakesh@gmail.com', '1111111', 'Please I need blood', '2024-11-05 14:43:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(2, 'Why Become Donor', 'donor', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(3, 'About Us ', 'aboutus', '										<div style=\"text-align: center;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-weight: bold;\">Welcome to the blood bank donor management system.</span></div>\r\n										');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bgroup` (`BloodGroup`);

--
-- Indexes for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `BloodGroup` (`BloodGroup`),
  ADD KEY `BloodGroup_2` (`BloodGroup`);

--
-- Indexes for table `tblbloodrequirer`
--
ALTER TABLE `tblbloodrequirer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `donorid` (`BloodDonarID`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblbloodrequirer`
--
ALTER TABLE `tblbloodrequirer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
