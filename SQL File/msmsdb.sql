-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 11:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` char(50) DEFAULT NULL,
  `UserName` char(50) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 7898799798, 'tester1@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-07-25 06:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `ID` int(10) NOT NULL,
  `AptNumber` varchar(80) DEFAULT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `PhoneNumber` bigint(11) DEFAULT NULL,
  `AptDate` varchar(120) DEFAULT NULL,
  `AptTime` varchar(120) DEFAULT NULL,
  `Services` varchar(120) DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(250) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `RemarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `HairColor` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`ID`, `AptNumber`, `Name`, `Email`, `PhoneNumber`, `AptDate`, `AptTime`, `Services`, `ApplyDate`, `Remark`, `Status`, `RemarkDate`, `HairColor`) VALUES
(1, '319514619', 'lize', 'lize121600@gmail.com', 12345678, '2024-09-13', '05:48', 'Hair Wash', '2024-09-11 03:44:14', 'ok', '1', '2024-09-11 03:46:18', NULL),
(2, '452424880', 'Richie Chah', 'ritchie121600@gmail.com', 12345678, '2024-09-12', '14:30', 'Body Spa', '2024-09-11 06:30:01', NULL, NULL, NULL, NULL),
(3, '250367874', 'Richie Chah', 'ritchie121600@gmail.com', 12345678, '2024-09-12', '19:57', 'Deluxe Pedicure', '2024-09-11 07:54:45', 'po', '1', '2024-09-11 07:55:29', NULL),
(4, '401945245', 'Richie Chah', 'ritchie121600@gmail.com', 7899545665, '2024-09-19', '10:25', 'Hair Cut', '2024-09-18 01:24:14', '2345678', '1', '2024-09-18 01:24:58', NULL),
(5, '400699941', 'Richie Chah', 'ritchie121600@gmail.com', 12345678, '2024-09-20', '15:00', 'Loreal Hair Color(Full)', '2024-09-19 04:57:25', NULL, NULL, NULL, '#000000'),
(6, '860618643', 'Richie Chah', 'ritchie121600@gmail.com', 124478321, '2025-01-25', '10:15', 'Normal Menicure', '2025-01-17 01:15:52', NULL, NULL, NULL, '#000000'),
(7, '955540261', 'JAmes', 'james@gmail.com', 123456789, '2025-01-23', '11:32', 'Loreal Hair Color(Full)', '2025-01-21 03:27:18', NULL, NULL, NULL, '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `ID` int(10) NOT NULL,
  `Name` varchar(120) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `Gender` enum('Female','Male','Transgender') DEFAULT NULL,
  `Details` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`ID`, `Name`, `Email`, `MobileNumber`, `Gender`, `Details`, `CreationDate`, `UpdationDate`) VALUES
(2, 'Rahul Singh', 'singh@gmail.com', 5565565656, 'Male', 'Taken haircut by him', '2023-12-08 11:10:02', '2023-12-11 04:15:02'),
(5, 'Test user', 'testuser@gmail.com', 1234567890, 'Female', 'Test', '2023-12-08 11:10:02', '2023-12-11 04:15:10'),
(6, 'Manish', 'manish@gmail.com', 9879879798, 'Male', 'vjhgjhghg;lk;lklnhfjkhkjfnkl\r\nlkjklfjlkjlkc jjlkj\r\nl;ljlkj lkcjtkrjkjne', '2023-12-08 11:10:02', '2023-12-11 04:15:10'),
(7, 'Anuj kumar', 'ak@gmail.com', 1234567899, 'Transgender', 'Test', '2023-12-08 11:10:02', '2023-12-11 04:15:10'),
(8, 'lize', 'lize121600@gmail.com', 128462836, 'Male', 'ok', '2024-09-11 03:47:46', NULL),
(9, 'Richie Chah', 'ritchie121600@gmail.com', 123456789, 'Male', 'wertyu', '2024-09-18 00:55:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblhaircuts`
--

CREATE TABLE `tblhaircuts` (
  `id` int(11) NOT NULL,
  `haircutName` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `imagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblhaircuts`
--

INSERT INTO `tblhaircuts` (`id`, `haircutName`, `description`, `imagePath`) VALUES
(4, 'Hair1', '1', 'images/女发型1.jpg'),
(5, 'Hair2', '2', 'images/女发型2.jpg'),
(6, 'Hair3', '3', 'images/女发型3.jpg'),
(7, 'Hair4', '4', 'images/女发型4.jpg'),
(8, 'Hair5', '5', 'images/女发型6.jpg'),
(9, 'Hair6', '6', 'images/男生发型1.jpg'),
(10, 'Hair7', '8', 'images/男生发型2.webp'),
(11, 'Hair8', '8', 'images/男生发型3.jpeg'),
(12, 'Hair9', '9', 'images/男生发型4.jpeg'),
(13, 'Hair10', '10', 'images/男生发型5.jpg'),
(14, 'Hair11', '11', 'images/男生发型7.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoice`
--

CREATE TABLE `tblinvoice` (
  `id` int(11) NOT NULL,
  `Userid` int(11) DEFAULT NULL,
  `ServiceId` int(11) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinvoice`
--

INSERT INTO `tblinvoice` (`id`, `Userid`, `ServiceId`, `BillingId`, `PostingDate`) VALUES
(1, 7, 1, 529212751, '2023-12-11 05:39:34'),
(2, 7, 3, 529212751, '2023-12-11 05:39:34'),
(3, 8, 6, 387411357, '2024-09-11 03:48:06'),
(4, 8, 7, 387411357, '2024-09-11 03:48:06'),
(5, 8, 1, 215951404, '2024-09-18 00:34:10'),
(6, 8, 2, 215951404, '2024-09-18 00:34:10'),
(7, 8, 3, 215951404, '2024-09-18 00:34:10'),
(8, 8, 4, 215951404, '2024-09-18 00:34:10'),
(9, 8, 5, 215951404, '2024-09-18 00:34:10'),
(10, 8, 6, 215951404, '2024-09-18 00:34:10'),
(11, 8, 7, 215951404, '2024-09-18 00:34:10'),
(12, 8, 8, 215951404, '2024-09-18 00:34:10'),
(13, 8, 9, 215951404, '2024-09-18 00:34:10'),
(14, 8, 10, 215951404, '2024-09-18 00:34:10'),
(15, 8, 11, 215951404, '2024-09-18 00:34:10'),
(16, 8, 12, 215951404, '2024-09-18 00:34:10'),
(17, 8, 15, 215951404, '2024-09-18 00:34:10'),
(18, 8, 16, 215951404, '2024-09-18 00:34:10'),
(19, 8, 17, 215951404, '2024-09-18 00:34:10'),
(20, 8, 18, 215951404, '2024-09-18 00:34:10'),
(21, 9, 16, 858997932, '2024-09-18 00:56:08'),
(22, 8, 5, 388054094, '2024-09-18 01:25:31'),
(23, 8, 11, 524539783, '2024-09-22 05:06:46'),
(24, 8, 12, 524539783, '2024-09-22 05:06:46'),
(25, 8, 15, 524539783, '2024-09-22 05:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL,
  `Timing` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`, `Timing`) VALUES
(1, 'aboutus', 'About Us', '        Our main focus is on quality and hygiene. Our Parlour is well equipped with advanced technology equipments and provides best quality services. Our staff is well trained and experienced, offering advanced services in Skin, Hair and Body Shaping that will provide you with a luxurious experience that leave you feeling relaxed and stress free. The specialities in the parlour are, apart from regular bleachings and Facials, many types of hairstyles, Bridal and cine make-up and different types of Facials & fashion hair colourings.', NULL, NULL, NULL, ''),
(2, 'contactus', 'Contact Us', '191,Taman Sri Ampang 05050 Alor Serta Kedah', 'ritchie121600@gmail.com', 124478218, NULL, '10:30 am to 7:30 pm');

-- --------------------------------------------------------

--
-- Table structure for table `tblservices`
--

CREATE TABLE `tblservices` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `Cost` int(10) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblservices`
--

INSERT INTO `tblservices` (`ID`, `ServiceName`, `Description`, `Cost`, `CreationDate`) VALUES
(1, 'O3 Facial', 'Activated charcoal draws bacteria, toxins, dirt and oil from the skin.', 120, '2023-12-05 11:22:38'),
(2, 'Fruit Facial', 'If its a peel-off mask, it also works as an excellent exfoliator, ridding the skin of dead cells.', 500, '2023-12-05 11:22:38'),
(3, 'Charcol Facial', 'The end result is skin that is clean and clear. When used as a powder, charcoal masks can reach deep in your pores and suck out impurities with them.', 1000, '2023-12-05 11:22:38'),
(4, 'Deluxe Menicure', 'The end result is skin that is clean and clear. When used as a powder, charcoal masks can reach deep in your pores and suck out impurities with them.', 500, '2023-12-05 11:22:38'),
(5, 'Deluxe Pedicure', 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.', 600, '2023-12-05 11:22:38'),
(6, 'Normal Menicure', 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.', 300, '2023-12-05 11:22:38'),
(7, 'Normal Pedicure', 'A pedicure is a therapeutic treatment for your feet that removes dead skin, softens hard skin and shapes and treats your toenails.', 400, '2023-12-05 11:22:38'),
(8, 'Hair Cut', 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair', 250, '2023-12-05 11:22:38'),
(9, 'Style Haircut', 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair', 550, '2023-12-05 11:22:38'),
(10, 'Hair Wash', 'A hairstyle, hairdo, or haircut refers to the styling of hair, usually on the human scalp. Sometimes, this could also mean an editing of facial or body hair', 3999, '2023-12-05 11:22:38'),
(11, 'Loreal Hair Color(Full)', 'hgfhgj', 1200, '2023-12-05 11:22:38'),
(12, 'Body Spa', 'It is full body spa including hair wash', 1500, '2023-12-05 11:22:38'),
(15, 'ABC', 'gjhgjhgbkhhioljhoioi', 200, '2023-12-05 11:22:38'),
(16, 'Tradinational Cut', 'khghkhlkjlkjlkjflkrjnvoireyviutyouopyiuiosueoibvjmyruopo kjhkjhkhk kjh nkhu k iuyhiu kjhihiur', 45, '2023-12-05 11:22:38'),
(17, 'MUSTACHE TRIM', 'Trim Trim Trim', 85, '2023-12-05 11:22:38'),
(18, 'Beard Trim', 'Beard Trim', 10, '2023-12-05 11:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

CREATE TABLE `tblsubscriber` (
  `ID` int(5) NOT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `DateofSub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubscriber`
--

INSERT INTO `tblsubscriber` (`ID`, `Email`, `DateofSub`) VALUES
(1, 'ani@gmail.com', '2023-12-09 07:32:33'),
(2, 'rahul@gmail.com', '2023-12-09 07:32:33'),
(3, 'ganesh@gmail.com', '2023-12-09 07:32:33'),
(6, 'ritchie121600@gmail.com', '2025-01-07 06:58:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblhaircuts`
--
ALTER TABLE `tblhaircuts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblservices`
--
ALTER TABLE `tblservices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblhaircuts`
--
ALTER TABLE `tblhaircuts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblinvoice`
--
ALTER TABLE `tblinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservices`
--
ALTER TABLE `tblservices`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
