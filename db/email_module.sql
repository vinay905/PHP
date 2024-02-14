-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 09:02 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_module`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vinaysingh@gmail.com', 'vinay@33', 'dbac407c25b1e948eeb1325ee695fb44', '1', '2022-04-08 06:11:44', '2022-04-14 00:00:00'),
(2, 'admin@gmail.com', 'admin23', '5f2cc1e625686cef12e269b9ea695b88', '1', '2022-04-16 05:33:53', '2022-04-16 11:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `speciality` varchar(300) NOT NULL,
  `logo` text NOT NULL,
  `website` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `speciality`, `logo`, `website`, `content`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Ethics Infotech', 'IT Services,Infrastructure,Toursim ', '1653890972_ef13680fba21b2a57904.jpeg', 'https://www.ethicsinfotech.in', 'This is private content.', '0', '2022-05-30 11:42:57', '2022-04-21 11:47:36'),
(2, 'Nexus Technology', 'Data Solution', '1653890883_a9bebcbc613c7466ed9c.jpeg', 'https://nexushub.gov', 'This is Nexus Technology data limited', '0', '2022-05-30 11:38:03', '2022-04-21 11:48:36'),
(3, 'Uttarakhand Tourism ', 'Tourism,Infrastructure', '1653890896_d5520393be092f24efa7.jpg', 'https://www.uttarakhandtourism.gov.in', 'Content of this data is solely for professional purpose.', '0', '2022-05-30 11:43:23', '2022-04-21 11:50:10'),
(4, 'Dell', 'Data Services, IT Products', '1653890905_096b13726617736b25ef.jpg', 'https://dell.co.in', 'Dell inc.', '0', '2022-05-30 11:38:25', '2022-04-28 09:36:39'),
(6, 'Microsoft ', 'IT Services, Data Solution, IT Products', '1653890915_d6fc77b3005af1ba83aa.png', 'https://www.microsoft.com', 'Microsoft Corporation is an American multinational technology corporation which produces computer software, consumer electronics, personal computers, and related services.', '0', '2022-05-30 11:38:35', '2022-04-29 09:48:14'),
(10, 'Wipro', 'IT Services', '1653890923_e552d833030a53d1de7a.jpg', 'https://www.wipro.com', 'Wipro company limited', '0', '2022-05-30 11:38:43', '2022-04-30 05:19:30'),
(11, 'SAP', 'Product Services', '1653890950_0ebb823eb0e46821593d.jpg', 'https://www.sap.com', 'SAP is a Germany based company', '0', '2022-05-30 11:39:10', '2022-04-30 05:23:53');

-- --------------------------------------------------------

--
-- Table structure for table `company_address`
--

CREATE TABLE `company_address` (
  `id` int(100) NOT NULL,
  `company_id` int(100) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_address`
--

INSERT INTO `company_address` (`id`, `company_id`, `address`) VALUES
(1, 1, 'I.T Park, Sidcul Sahastradhara Road\r\n248001-Dehradun, Uttarakhand'),
(2, 1, 'Vadodra,Gujarat India'),
(3, 3, 'Garhi Cantt. Dehradun, 248001, India'),
(4, 2, 'Nexus Technology Street No. 118,Big Ben, London'),
(6, 4, 'Dell International Services India Pvt. Ltd\r\nDivyashree Greens, Ground Floor,\r\nSys Nos.12/1, 12/2A and 13/1A,\r\nChallaghatta Village, Varthur Hobli,\r\nBengaluru, 560071'),
(7, 6, 'Redmond, Washington, United States');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(250) NOT NULL,
  `company_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `contact_no` bigint(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `company_id`, `employee_name`, `designation`, `contact_no`, `email`, `image`, `created_at`) VALUES
(1, 1, 'Vinay Singh', 'PHP Developer', 9878979879, 'vinaysingh@gmail.com', 'k5uAfk2Ikz.png', '2022-04-29 09:53:58'),
(2, 4, 'Satyam Singh', 'Android Developer', 8787676786, 'satyamssingh@gmail.com', '56RbkgFkd9.png', '2022-04-29 09:56:29'),
(3, 6, 'Deeshank Singh', 'Java Developer', 9789798787, 'deeshanksingh@gmail.com', 'vlJB8OYef5.png', '2022-04-29 09:57:47'),
(4, 1, 'Vinay Singh', 'PHP Developer', 9879879869, 'vinaysinghworkspace@gmail.com', 'A7xIhgXLro.png', '2022-04-29 11:45:58'),
(5, 4, 'Sachin Singh', 'React Native Developer', 9879879879, 'sachinpanwar@gmail.com', 'b1dZTDg1nm.png', '2022-04-29 11:51:24'),
(6, 6, 'Shailendra Singh', 'C++ Developer', 8789789798, 'shailendrasingh@gmail.com', 'WG5QkDY89S.png', '2022-04-30 04:45:27'),
(7, 3, 'Vinay Singh', 'PHP Developer', 8977987987, 'vinaysinghworkspace@gmail.com', 'VPJtTQSvvQ.png', '2022-05-03 04:14:49'),
(8, 6, 'Vinay Singh', 'PHP Developer', 9789798798, 'vinaysinghworkspace@gmail.com', 'b4eBXSJERM.png', '2022-05-03 05:08:51'),
(9, 3, 'Diksha Singhal', 'PHP Developer', 9879879879, 'Dikshasinghal@gmail.com', 'hELGg0ZFh1.png', '2022-05-03 05:16:08'),
(10, 2, 'Satyam Singh', 'Android Developer', 9879780989, 'satyamsingh@gmail.com', 'OAddwycuk6.png', '2022-05-03 05:21:43'),
(11, 3, 'Piyush Sharma', 'Customer Service', 9878979879, 'piyushsharma@gmail.com', '9kdMyAHQVs.png', '2022-05-03 05:22:43'),
(12, 1, 'Vinay Singh', 'PHP Developer', 9789798789, 'vinaysingh@gmail.com', 'qYhSrwcePK.png', '2022-05-07 09:10:25'),
(13, 3, 'Dipak', 'Sales Force', 9798798798, 'deepakkumar@gmail.com', 'mpbffG3OIs.png', '2022-05-07 09:12:11'),
(14, 1, 'Vinay Singh', 'PHP Developer', 9879878978, 'vinaysingh@gmail.com', 'A0OY78h7g2.png', '2022-05-30 05:53:51'),
(15, 1, 'Diksha Singhal', 'PHP Developer', 7897897987, 'dikshasinghal@gmail.com', 'xCa5UEFH1J.jpg', '2022-05-30 06:19:27'),
(16, 2, 'asdsad', 'Android Developer', 5656756756, 'asdsad@gmail.com', 'Spnx5jzPUz.jpg', '2022-05-30 06:21:37'),
(17, 1, 'Vinay Singh', 'PHP FULLSTACK DEV', 9878978979, 'vinaysingh@gmail.com', 'GFpcwfbi5W.jpg', '2022-05-30 06:23:02'),
(18, 1, 'Vinay Singh', 'PHP Developer', 9789798789, 'vinaysingh@gmail.com', 'fYrXV0J30I.jpg', '2022-05-30 06:24:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_address`
--
ALTER TABLE `company_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company_address`
--
ALTER TABLE `company_address`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_address`
--
ALTER TABLE `company_address`
  ADD CONSTRAINT `company_address_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
