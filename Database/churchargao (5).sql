-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 09:08 AM
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
-- Database: `churchargao`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcenment_id` int(11) NOT NULL,
  `event_type` text NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `capacity` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcenment_id`, `event_type`, `title`, `description`, `schedule_id`, `date_created`, `capacity`) VALUES
(31, 'Baptism', 'MassBaptism', 'The word baptism comes from a Greek word (baptize), which means, “to immerse.” Baptism is a ceremony in which a Christian is immersed in water before the church to publically symbolize their belief in Christ. The water is a symbol of sin being washed away.', 523, '2024-06-21', 47),
(32, 'Confirmation', 'MassConfirmation', 'Confirmation, Christian rite by which admission to the church, established previously in infant baptism, is said to be confirmed (or strengthened and established in faith). It is considered a sacrament in Roman Catholic and Anglican churches, and it is equivalent to the Eastern Orthodox sacrament of chrismation', 526, '2024-06-21', 49),
(33, 'Marriage', 'MassMarriage', 'marriage, a legally and socially sanctioned union, usually between a man and a woman, that is regulated by laws, rules, customs, beliefs, and attitudes that prescribe the rights and duties of the partners and accords status to their offspring (if any)', 527, '2024-06-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_schedule`
--

CREATE TABLE `appointment_schedule` (
  `appsched_id` int(11) NOT NULL,
  `baptismfill_id` int(11) DEFAULT NULL,
  `confirmation_id` int(11) DEFAULT NULL,
  `defuctom_id` int(11) DEFAULT NULL,
  `marriage_id` int(11) DEFAULT NULL,
  `app_date` date NOT NULL,
  `app_time` time NOT NULL,
  `payable_amount` decimal(11,2) NOT NULL,
  `status` enum('Process','Delete','Completed') NOT NULL,
  `p_status` enum('Unpaid','Paid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_schedule`
--

INSERT INTO `appointment_schedule` (`appsched_id`, `baptismfill_id`, `confirmation_id`, `defuctom_id`, `marriage_id`, `app_date`, `app_time`, `payable_amount`, `status`, `p_status`) VALUES
(615, 254, NULL, NULL, NULL, '2024-08-20', '10:53:43', 0.00, 'Process', 'Unpaid'),
(616, 257, NULL, NULL, NULL, '2024-08-11', '09:19:38', 20.00, 'Process', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `baptismfill`
--

CREATE TABLE `baptismfill` (
  `baptism_id` int(11) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `citizen_id` int(11) DEFAULT NULL,
  `announcement_id` int(11) DEFAULT NULL,
  `d_birth` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `father_fullname` varchar(255) DEFAULT NULL,
  `pbirth` varchar(255) DEFAULT NULL,
  `mother_fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `parent_resident` text DEFAULT NULL,
  `godparent` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `event_name` varchar(255) NOT NULL DEFAULT 'Baptism,MassBaptism',
  `role` varchar(50) NOT NULL DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baptismfill`
--

INSERT INTO `baptismfill` (`baptism_id`, `schedule_id`, `citizen_id`, `announcement_id`, `d_birth`, `age`, `father_fullname`, `pbirth`, `mother_fullname`, `phone`, `religion`, `parent_resident`, `godparent`, `status`, `event_name`, `role`) VALUES
(254, 518, NULL, NULL, '2024-04-30', 1, 'Edgardo B.Siton Snr', 'Olango Island', 'Alice Siton', '09394245345', 'Catholic', 'Mambaling Cebu City', 'Wael', 'Pending', 'Baptism', 'Online'),
(257, NULL, 7, 31, '2024-04-30', 1, 'Kapoy', 'Kapoy', 'Kapoy', '09394245345', 'Kapoy', 'Kapoy', 'Kapoy', 'Pending', 'MassBaptism', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `citizend_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `c_date_birth` date NOT NULL,
  `age` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `valid_id` blob NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `r_status` varchar(50) NOT NULL,
  `c_current_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`citizend_id`, `fullname`, `email`, `gender`, `phone`, `c_date_birth`, `age`, `address`, `valid_id`, `password`, `user_type`, `r_status`, `c_current_time`) VALUES
(4, 'edgardo', 'edgardositon90@gmail.com', 'Male', '+639773844951', '0000-00-00', 0, 'Oakland Newzealand            ', '', '$2y$10$she3jio6MQnO4ct9z5eDWuFWASXLW.1PzP1nO1PJDcF49xFjIVq7a', 'Citizen', 'Approve', '2024-08-06'),
(5, 'daniel', 'admin@gmail.com', 'Male', '639394245345', '0000-00-00', 0, 'lowersaimongheart', '', '$2y$10$KFdTQLQDEwPAlRNFxRpPYOYOXQrJJWDDkZmut/oHdm8DGF7fug66q', 'Admin', '', '2024-07-10'),
(6, 'sweet', 'edgardositon92@gmail.com', 'Male', '639394245345', '0000-00-00', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$iJINoGhbUa3heLDFnZgEFuoGwQN7Ex6p2TWNUl8WlPRjRY2i8DYfe', 'Staff', '', '2024-07-23'),
(7, 'aeron', 'aeronvillafuerte2@gmail.com', 'Male', '639394245345', '0000-00-00', 0, 'lowewqrq', '', '$2y$10$ycjT75O0Q6MUQoe5lmaLuOqZh87maa0eI3OMkijqW1lfwYhmAjc3a', 'citizen', '', '2024-08-06'),
(11, 'Kapoy', 'aeronvillafuerte20@gmail.com', 'Female', '+639773844951', '0000-00-00', 0, 'Argao,Cebu', '', '$2y$10$QJuOmdKcYQtGOX4eSbNp7euJvR7WhtCMkFFhxP68zVQdVklxDuaaO', 'citizen', '', '2024-08-06'),
(13, 'XhydrikBartido', 'staff@gmail.com', 'Male', '09394366099', '0000-00-00', 0, 'qweqweqwe', '', '$2y$10$KDEuxvu2a1SyiQu5OxdIjuJ3CpQCWYBGLEwiPtpQeJXLqeGndaDtG', 'Staff', '', '2024-07-22'),
(14, 'XanderBartido', 'priest@gmail.com', 'Male', '09394245345', '0000-00-00', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$o0/5Gn66AEbwNdcRI6vfzuSaWr10uOAKHDCv7Y.S.AMWOon8defp2', 'Priest', '', '2024-07-15'),
(15, 'Jameban', 'edgardositon0@gmail.com', 'Male', '09394245345', '0000-00-00', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$ouRXkUPN8OaYjyE2SXLgmO/wCRcmwBnQE.LX9MfeEFLo3iGq2IVnW', 'citizen', '', '2024-07-16'),
(16, 'Kapoy', 'edgardositon96@gmail.com', 'Male', '09394245345', '2024-02-21', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$MBlaGI.Z8JXJ9spKvEQppeR8650pPKaBHC9G2mJ5q0AIofNslMm2.', 'Citizen', 'Pending', '2024-08-06'),
(17, 'Xhyndril', 'edgardositon98@gmail.com', 'Female', '09394245345', '2022-06-29', 2, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$Ix9TRVKGaxM/PRdJHUd0Z.xk8AMzl9O4bbnaMYnesFl049WPhtg.K', 'Citizen', 'Pending', '2024-08-06'),
(18, 'edgardosnr', 'evoletss@gmail.com', 'Male', '09394245345', '2024-07-30', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$rNUEoT3xMqf2jv24ZquE.ub/agID2LpAhkabjjEq7UDE3AxSOCA4W', 'Citizen', 'Pending', '2024-07-16'),
(19, 'chinchin', 'chinchin@gmail.com', 'Female', '09394245345', '2024-08-20', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$qE20.AXd.DzWZIrbC.jLherbIc88Ipjp2ZA.HRRhE1IYkUZpZNhCK', 'Citizen', 'pending', '2024-08-06'),
(20, 'chanchan', 'chanchan@gmail.com', 'Female', '09394245345', '2024-08-13', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$LFEiKZNaG/IH4g8vPR.IA.r/Zsej4Z78oHq4xEJccKh/3I53OOGdC', 'Citizen', 'Pending', '2024-08-06'),
(21, 'Sweetie Siton', 'SweetieSiton@gmail.com', 'Female', '09394245345', '2024-08-07', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$avtRCjUK14ZIoKyTe/V6NeTxF9Qtd45S3rkGxSflj6OkCY2DWCB8m', 'Citizen', 'Pending', '2024-08-06'),
(22, 'Eddi', 'Eddie@gmail.com', 'Male', '09394245345', '2024-08-07', 0, 'LowerCalajo-an Minglanilla Cebu', '', '$2y$10$GFtn71FaUQsT98mBn97BJeIV.gw3nj4DxwbEan/Ljdn0w11jvZq.W', 'Citizen', 'Pending', '2024-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `confirmationfill`
--

CREATE TABLE `confirmationfill` (
  `confirmationfill_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `citizen_id` int(11) DEFAULT NULL,
  `announcement_id` int(11) DEFAULT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `pod` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date_of_baptism` date NOT NULL,
  `name_of_church` varchar(255) NOT NULL,
  `father_fullname` varchar(255) NOT NULL,
  `mother_fullname` varchar(255) NOT NULL,
  `permission_to_confirm` varchar(10) NOT NULL,
  `church_address` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `event_name` varchar(50) NOT NULL DEFAULT 'Confirmation',
  `role` varchar(50) NOT NULL DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmationfill`
--

INSERT INTO `confirmationfill` (`confirmationfill_id`, `schedule_id`, `citizen_id`, `announcement_id`, `dob`, `age`, `pod`, `phone`, `date_of_baptism`, `name_of_church`, `father_fullname`, `mother_fullname`, `permission_to_confirm`, `church_address`, `status`, `event_name`, `role`) VALUES
(80, 516, NULL, NULL, '2024-08-14', 1, 'qweqwe', '09394245345', '2024-08-14', 'Kapoya', 'Kapoya', 'Kapoya', 'Yes', 'Kapoya', 'Pending', 'Confirmation', 'Online'),
(81, 516, NULL, NULL, '2024-08-14', 1, 'qweqwe', '09394245345', '2024-08-14', 'Kapoya', 'Kapoya', 'Kapoya', 'Yes', 'Kapoya', 'Pending', 'Confirmation', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `defuctomfill`
--

CREATE TABLE `defuctomfill` (
  `defuctomfill_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `gender` enum('female','male') NOT NULL,
  `cause_of_death` varchar(255) NOT NULL,
  `place_of_disposition` varchar(255) NOT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `type_of_disposition` varchar(255) NOT NULL,
  `father_fullname` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `mother_fullname` varchar(255) NOT NULL,
  `parents_residence` text DEFAULT NULL,
  `date_of_death` date NOT NULL,
  `place_of_death` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `event_name` varchar(50) NOT NULL DEFAULT 'Defuctom',
  `role` varchar(50) NOT NULL DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `defuctomfill`
--

INSERT INTO `defuctomfill` (`defuctomfill_id`, `schedule_id`, `gender`, `cause_of_death`, `place_of_disposition`, `marital_status`, `place_of_birth`, `type_of_disposition`, `father_fullname`, `date_of_birth`, `age`, `mother_fullname`, `parents_residence`, `date_of_death`, `place_of_death`, `status`, `event_name`, `role`) VALUES
(26, 521, 'male', 'Kapyo', 'qwe', 'Single', 'qweqwe', 'qweqwe', 'qweeqweqwee', '2024-08-20', 1, 'qweqweqwe', 'qweqweqe', '2024-08-28', 'qweqwe', 'Pending', 'Defuctom', 'Online'),
(27, 525, 'female', 'qwqweeqweeqwee', 'qweqweqweqwe', 'Single', 'qweqweqwe', 'qweqweqweqwe', 'qweqweqweqwe', '2024-08-20', 1, 'qweqweqwee', 'qwweqweqweqwe', '2024-08-13', 'qweqweqwe', 'Pending', 'Defuctom', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donation_id` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `amount` int(50) NOT NULL,
  `donated_on` date NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`donation_id`, `d_name`, `amount`, `donated_on`, `description`) VALUES
(1, 'SweetVeniceCasia', 500, '2024-05-21', 'HolyGirlfriend'),
(2, 'DarlaKaylaMayonoIpon', 300, '2024-05-25', 'Kinakusgan'),
(3, 'EdgardoSiton', 100, '2024-05-21', 'Walalang'),
(4, 'AeronVillafuerte', 500, '2024-05-25', 'But.an nga bata');

-- --------------------------------------------------------

--
-- Table structure for table `event_calendar`
--

CREATE TABLE `event_calendar` (
  `calendar_id` int(11) NOT NULL,
  `cal_fullname` varchar(50) NOT NULL,
  `cal_Category` varchar(50) NOT NULL,
  `cal_date` date NOT NULL,
  `cal_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `financial`
--

CREATE TABLE `financial` (
  `financial_id` int(15) NOT NULL,
  `appointment_id` int(15) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marriagefill`
--

CREATE TABLE `marriagefill` (
  `marriagefill_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `citizen_id` int(11) DEFAULT NULL,
  `announcement_id` int(11) DEFAULT NULL,
  `groom_dob` date NOT NULL,
  `groom_place_of_birth` varchar(255) NOT NULL,
  `groom_citizenship` varchar(255) NOT NULL,
  `groom_religion` varchar(100) NOT NULL,
  `groom_previously_married` enum('Yes','No') NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `bride_dob` date NOT NULL,
  `bride_place_of_birth` varchar(255) NOT NULL,
  `bride_citizenship` varchar(255) NOT NULL,
  `bride_phone` varchar(20) NOT NULL,
  `bride_address` varchar(255) NOT NULL,
  `bride_religion` varchar(100) NOT NULL,
  `bride_previously_married` enum('Yes','No') NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `event_name` varchar(50) NOT NULL DEFAULT 'Marriage',
  `role` varchar(50) NOT NULL DEFAULT 'Online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriagefill`
--

INSERT INTO `marriagefill` (`marriagefill_id`, `schedule_id`, `citizen_id`, `announcement_id`, `groom_dob`, `groom_place_of_birth`, `groom_citizenship`, `groom_religion`, `groom_previously_married`, `bride_name`, `bride_dob`, `bride_place_of_birth`, `bride_citizenship`, `bride_phone`, `bride_address`, `bride_religion`, `bride_previously_married`, `status`, `event_name`, `role`) VALUES
(66, 522, NULL, NULL, '2024-08-21', 'Kapoya', 'Kapoya', 'Kapoya', 'Yes', 'Kapoya', '2024-08-13', 'Kapoya', 'Kapoya', '093942425345', 'Kapoya', 'Kapoya', 'Yes', 'Pending', 'Marriage', 'Online'),
(67, 522, NULL, NULL, '2024-08-21', 'Kapoya', 'Kapoya', 'Kapoya', 'Yes', 'Kapoya', '2024-08-13', 'Kapoya', 'Kapoya', '093942425345', 'Kapoya', 'Kapoya', 'Yes', 'Pending', 'Marriage', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `message`, `time`, `status`) VALUES
(1, 'user_registration', 'New user registered: chanchan', '2024-08-06 12:37:37', 'read'),
(2, 'user_registration', 'New user registered: Sweetie Siton', '2024-08-06 12:56:22', 'unread'),
(3, 'user_registration', 'New user registered: Eddi', '2024-08-06 13:26:37', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `req_form`
--

CREATE TABLE `req_form` (
  `reqform_id` int(11) NOT NULL,
  `scheduel_id` int(11) NOT NULL,
  `req_name_pamisahan` varchar(255) DEFAULT NULL,
  `req_address` varchar(255) DEFAULT NULL,
  `req_category` varchar(255) DEFAULT NULL,
  `req_person` varchar(255) DEFAULT NULL,
  `req_pnumber` varchar(20) DEFAULT NULL,
  `req_dreceive` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_feedback`
--

CREATE TABLE `review_feedback` (
  `review_id` int(11) NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `citizen_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `citizen_id`, `date`, `start_time`, `end_time`) VALUES
(516, 15, '2024-06-22', '08:00:00', '00:00:00'),
(517, 15, '2024-06-26', '08:00:00', '00:00:00'),
(518, 15, '2024-06-27', '08:00:00', '00:00:00'),
(519, 15, '2024-07-01', '08:00:00', '00:00:00'),
(520, 15, '2024-07-04', '08:00:00', '00:00:00'),
(521, 15, '2024-07-06', '08:00:00', '00:00:00'),
(522, 7, '2024-06-22', '13:49:00', '00:00:00'),
(523, 0, '2024-06-22', '14:56:00', '00:00:00'),
(524, 7, '2024-06-22', '15:01:00', '00:00:00'),
(525, 7, '2024-06-22', '16:03:00', '00:00:00'),
(526, 7, '2024-06-22', '17:34:00', '00:00:00'),
(527, 7, '2024-06-29', '17:36:00', '00:00:00'),
(528, 15, '2024-06-28', '08:00:00', '00:00:00'),
(529, 15, '2024-07-15', '08:00:00', '00:00:00'),
(530, 15, '2024-10-29', '08:00:00', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcenment_id`),
  ADD KEY `announcement_ibfk_1` (`schedule_id`);

--
-- Indexes for table `appointment_schedule`
--
ALTER TABLE `appointment_schedule`
  ADD PRIMARY KEY (`appsched_id`),
  ADD KEY `baptismfill_id` (`baptismfill_id`),
  ADD KEY `confirmation_id` (`confirmation_id`),
  ADD KEY `defuctom_id` (`defuctom_id`),
  ADD KEY `marriage_id` (`marriage_id`);

--
-- Indexes for table `baptismfill`
--
ALTER TABLE `baptismfill`
  ADD PRIMARY KEY (`baptism_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `citizen_id` (`citizen_id`),
  ADD KEY `announcement_id` (`announcement_id`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`citizend_id`);

--
-- Indexes for table `confirmationfill`
--
ALTER TABLE `confirmationfill`
  ADD PRIMARY KEY (`confirmationfill_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `citizen_id` (`citizen_id`);

--
-- Indexes for table `defuctomfill`
--
ALTER TABLE `defuctomfill`
  ADD PRIMARY KEY (`defuctomfill_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donation_id`);

--
-- Indexes for table `event_calendar`
--
ALTER TABLE `event_calendar`
  ADD PRIMARY KEY (`calendar_id`);

--
-- Indexes for table `financial`
--
ALTER TABLE `financial`
  ADD PRIMARY KEY (`financial_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `marriagefill`
--
ALTER TABLE `marriagefill`
  ADD PRIMARY KEY (`marriagefill_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `citizen_id` (`citizen_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_form`
--
ALTER TABLE `req_form`
  ADD PRIMARY KEY (`reqform_id`),
  ADD KEY `scheduel_id` (`scheduel_id`);

--
-- Indexes for table `review_feedback`
--
ALTER TABLE `review_feedback`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `citizen_id` (`citizen_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedule_ibfk_1` (`citizen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcenment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `appointment_schedule`
--
ALTER TABLE `appointment_schedule`
  MODIFY `appsched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;

--
-- AUTO_INCREMENT for table `baptismfill`
--
ALTER TABLE `baptismfill`
  MODIFY `baptism_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `citizen`
--
ALTER TABLE `citizen`
  MODIFY `citizend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `confirmationfill`
--
ALTER TABLE `confirmationfill`
  MODIFY `confirmationfill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `defuctomfill`
--
ALTER TABLE `defuctomfill`
  MODIFY `defuctomfill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_calendar`
--
ALTER TABLE `event_calendar`
  MODIFY `calendar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `financial`
--
ALTER TABLE `financial`
  MODIFY `financial_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marriagefill`
--
ALTER TABLE `marriagefill`
  MODIFY `marriagefill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review_feedback`
--
ALTER TABLE `review_feedback`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointment_schedule`
--
ALTER TABLE `appointment_schedule`
  ADD CONSTRAINT `appointment_schedule_ibfk_1` FOREIGN KEY (`baptismfill_id`) REFERENCES `baptismfill` (`baptism_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_schedule_ibfk_2` FOREIGN KEY (`confirmation_id`) REFERENCES `confirmationfill` (`confirmationfill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_schedule_ibfk_3` FOREIGN KEY (`defuctom_id`) REFERENCES `defuctomfill` (`defuctomfill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_schedule_ibfk_4` FOREIGN KEY (`marriage_id`) REFERENCES `marriagefill` (`marriagefill_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `baptismfill`
--
ALTER TABLE `baptismfill`
  ADD CONSTRAINT `baptismfill_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baptismfill_ibfk_2` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`citizend_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baptismfill_ibfk_3` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`announcenment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `confirmationfill`
--
ALTER TABLE `confirmationfill`
  ADD CONSTRAINT `confirmationfill_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmationfill_ibfk_2` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`announcenment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `confirmationfill_ibfk_3` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`citizend_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `defuctomfill`
--
ALTER TABLE `defuctomfill`
  ADD CONSTRAINT `defuctomfill_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `financial`
--
ALTER TABLE `financial`
  ADD CONSTRAINT `financial_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment_schedule` (`appsched_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marriagefill`
--
ALTER TABLE `marriagefill`
  ADD CONSTRAINT `marriagefill_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marriagefill_ibfk_2` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`announcenment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marriagefill_ibfk_3` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`citizend_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `req_form`
--
ALTER TABLE `req_form`
  ADD CONSTRAINT `req_form_ibfk_1` FOREIGN KEY (`scheduel_id`) REFERENCES `schedule` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_feedback`
--
ALTER TABLE `review_feedback`
  ADD CONSTRAINT `review_feedback_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`citizend_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
