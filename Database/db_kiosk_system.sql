-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 02:46 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kiosk_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `user_id` varchar(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`user_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `email`, `contact_no`, `address`, `password`, `role_id`, `avatar`, `create_at`) VALUES
('1', 'Maricio', 'Lopez', 'Reyes', 'Male', '2021-08-18', 'admin@gmail.com', '09304963878', 'Pias General Tinio Nueva Ecija', 'C56AE3560A8025B14928F06397BF5A20', 0, '../uploads/avatar_0.60681400 1636542090.jpg', '2021-11-10 19:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `class_id` int(11) NOT NULL,
  `classname` varchar(50) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`class_id`, `classname`, `schoolyear_id`, `level_id`, `status`) VALUES
(9, 'Class 1', 3, 7, 'active'),
(10, 'class 2', 3, 6, 'active'),
(11, 'Class 3', 3, 5, 'active'),
(12, 'Class4', 7, 8, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `evenst_id` int(11) NOT NULL,
  `color` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `end` datetime NOT NULL,
  `start` datetime NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`evenst_id`, `color`, `title`, `end`, `start`, `status`, `create_date`) VALUES
(48, '#0071c5', 'MATHEMATICS MONTH', '2021-01-02 00:00:00', '2021-01-01 00:00:00', 'Active', '2021-11-10 16:29:19'),
(49, '#0071c5', 'NATIONAL ARTS MONTH', '2021-02-02 00:00:00', '2021-02-01 00:00:00', 'Active', '2021-11-10 16:30:20'),
(50, '#FF8C00', 'RECOGNITION', '2021-04-02 00:00:00', '2021-04-01 00:00:00', 'Active', '2021-11-10 16:38:01'),
(51, '#FF8C00', 'BRIGADA ESKWELA', '2021-05-02 00:00:00', '2021-05-01 00:00:00', 'Active', '2021-11-10 16:33:38'),
(52, '#0071c5', 'ORIENTATION PROGRAM', '2021-06-02 00:00:00', '2021-06-01 00:00:00', 'Active', '2021-11-10 16:34:27'),
(53, '#008000', 'NUTRITION MONTH', '2021-07-02 00:00:00', '2021-07-01 00:00:00', 'Active', '2021-11-10 16:34:55'),
(54, '#0071c5', 'BUWAN NG WIKA', '2021-08-02 00:00:00', '2021-08-01 00:00:00', 'Active', '2021-11-10 16:35:56'),
(55, '#FF0000', 'SCIENCE MONTH', '2021-09-02 00:00:00', '2021-09-01 00:00:00', 'Active', '2021-11-10 16:36:18'),
(56, '#FF0000', 'AP MONTH', '2021-10-02 00:00:00', '2021-10-01 00:00:00', 'Active', '2021-11-10 16:36:47'),
(57, '#0071c5', 'ENGLISH FESTIVAL', '2021-11-02 00:00:00', '2021-11-01 00:00:00', 'Active', '2021-11-10 16:37:10'),
(58, '#FF8C00', 'CHRISTMAS PARTY', '2021-12-02 00:00:00', '2021-12-01 00:00:00', 'Active', '2021-11-10 16:37:41'),
(59, '#FF8C00', 'National Reading Month', '2021-11-18 00:00:00', '2021-11-15 00:00:00', 'Active', '2021-11-11 01:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `yearLevel_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `status` enum('new','old','','') NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `fullname`, `yearLevel_id`, `feedback`, `status`, `create_date`) VALUES
(2, 'Anonymous', 6, 'Ggfgg', 'old', '2021-11-10 14:07:07'),
(3, 'Anonymous', 6, 'I need form 137 for my child', 'new', '2021-11-11 00:05:18'),
(4, 'Anonymous', 7, 'Request for documents of school', 'new', '2021-11-11 00:55:41'),
(5, 'Jherimie Brinas', 7, 'any feedback', 'old', '2021-12-05 09:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_filereports`
--

CREATE TABLE `tbl_filereports` (
  `file_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `Type` varchar(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folder`
--

CREATE TABLE `tbl_folder` (
  `folder_id` int(11) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_folder`
--

INSERT INTO `tbl_folder` (`folder_id`, `folder_name`, `create_date`) VALUES
(4, 'Real Folder', '2021-12-08 09:16:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `galllery_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`galllery_id`, `filename`) VALUES
(10, './uploads/SchoolGallery_0.04549500 1633665236.jpg'),
(11, './uploads/SchoolGallery_0.75806600 1633665244.jpg'),
(12, './uploads/SchoolGallery_0.65698800 1633665264.jpg'),
(13, './uploads/SchoolGallery_0.76404300 1633665306.jpg'),
(14, './uploads/SchoolGallery_0.02839400 1633665342.jpg'),
(17, './uploads/SchoolGallery_0.62011000 1633665687.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gaurd`
--

CREATE TABLE `tbl_gaurd` (
  `gaurd_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `dob` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gaurd`
--

INSERT INTO `tbl_gaurd` (`gaurd_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `email`, `contact_no`, `address`, `password`, `role_id`, `avatar`, `create_at`, `status`) VALUES
(3, 'Carlos', 'M', 'Ramos', 'Male', '2019-04-11', 'Carlos@gmail.com', '0988776655', '09887766554', 'C56AE3560A8025B14928F06397BF5A20', 2, '../uploads/avatar_0.22206300 1636563762.png', '2021-11-10 17:08:39', 'Active'),
(4, 'Alexis', 'DeGuzman', 'Ramos', 'Male', '2021-11-10', 'Alex@gmail.com', '0988776655', 'Usa', 'C56AE3560A8025B14928F06397BF5A20', 2, '../uploads/avatar_0.23053200 1636593736.jpg', '2021-11-11 01:22:56', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gradelevel`
--

CREATE TABLE `tbl_gradelevel` (
  `level_id` int(11) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `discription` varchar(50) NOT NULL,
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gradelevel`
--

INSERT INTO `tbl_gradelevel` (`level_id`, `grade_level`, `discription`, `status`) VALUES
(4, 'Grade-7', 'sampaguita', 'unactive'),
(5, 'Grade-11', 'Sampaguita', 'active'),
(6, 'Grade-7', 'Ipil-Ipil', 'active'),
(7, 'Grade-7', 'Kamagong', 'active'),
(8, 'Grade-9', 'orchids', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grades`
--

CREATE TABLE `tbl_grades` (
  `grade_id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `schoolyearid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `adviserid` int(11) NOT NULL,
  `firstquarter` int(11) NOT NULL,
  `secondquarter` int(11) NOT NULL,
  `thirthquarter` int(11) NOT NULL,
  `fourthquarter` int(11) NOT NULL,
  `gradeaverage` int(11) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `status` enum('active','unactive','','') NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grades`
--

INSERT INTO `tbl_grades` (`grade_id`, `studentid`, `schoolyearid`, `subjectid`, `classid`, `adviserid`, `firstquarter`, `secondquarter`, `thirthquarter`, `fourthquarter`, `gradeaverage`, `remarks`, `status`, `add_date`) VALUES
(45, 22, 3, 4, 9, 6, 90, 80, 85, 89, 86, 'PASSED', 'unactive', '2021-11-10 16:44:39'),
(46, 22, 2, 5, 11, 6, 90, 85, 86, 99, 90, 'PASSED', 'active', '2021-11-11 01:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logo`
--

CREATE TABLE `tbl_logo` (
  `logo_id` int(11) NOT NULL,
  `logo_img` varchar(200) NOT NULL,
  `position` enum('left','right','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_logo`
--

INSERT INTO `tbl_logo` (`logo_id`, `logo_img`, `position`) VALUES
(7, './uploads/logo_0.18458300 1633664996.jpg', 'left'),
(8, './uploads/logo_0.28258900 1632849738.png', 'right');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logs_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `id_num` int(11) NOT NULL,
  `log_type` tinyint(4) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`logs_id`, `fname`, `mname`, `lname`, `type`, `id_num`, `log_type`, `avatar`, `created_date`) VALUES
(114, 'Joemar', 'Fernandez', 'Bulacan', 'Student', 23, 1, '../uploads/avatar_0.19507200 1636560827.jpg', '2021-11-11 00:59:39'),
(115, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 1, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-11-11 00:59:57'),
(116, 'Engr. Isidro', 'T', 'Pajarillaga', 'Visitors', 3, 1, '../assets/images/account.png', '2021-11-11 01:04:26'),
(117, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 1, '../uploads/avatar_0.32589100 1636561344.png', '2021-11-11 01:04:46'),
(118, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 2, '../uploads/avatar_0.32589100 1636561344.png', '2021-11-11 01:06:42'),
(119, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 1, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-11-11 01:22:09'),
(120, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 2, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-11-11 01:23:15'),
(121, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 1, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-11-11 01:32:19'),
(122, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 2, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-11-11 01:32:32'),
(123, 'Joven', 'Fernandez', 'Dulatre', 'Student', 34, 1, '../assets/images/account.png', '2021-11-11 01:33:27'),
(124, 'Joven', 'Fernandez', 'Dulatre', 'Student', 34, 2, '../assets/images/account.png', '2021-11-11 01:33:39'),
(125, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 1, '../uploads/avatar_0.32589100 1636561344.png', '2021-11-11 02:18:49'),
(126, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 2, '../uploads/avatar_0.32589100 1636561344.png', '2021-11-11 02:18:58'),
(127, 'Joemar', 'Fernandez', 'Bulacan', 'Student', 23, 1, '../uploads/avatar_0.19507200 1636560827.jpg', '2021-12-04 14:42:13'),
(128, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 1, '../uploads/avatar_0.32589100 1636561344.png', '2021-12-04 16:24:22'),
(129, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 2, '../uploads/avatar_0.32589100 1636561344.png', '2021-12-04 16:24:28'),
(130, 'Marilyn', 'P', 'Reyes', 'Teacher', 5, 1, '../uploads/avatar_0.32589100 1636561344.png', '2021-12-04 16:24:34'),
(131, 'Engr. Isidro', 'T', 'Pajarillaga', 'Visitors', 3, 1, '../assets/images/account.png', '2021-12-05 17:59:51'),
(132, 'asd', 'ven', 'asd', 'Visitors', 22, 1, '../assets/images/account.png', '2021-12-07 06:59:20'),
(133, 'asd', 'asdasda', 'asdasd', 'Visitors', 24, 1, '../assets/images/account.png', '2021-12-07 07:07:08'),
(134, 'Joemar', 'Fernandez', 'Bulacan', 'Student', 23, 1, '../uploads/avatar_0.19507200 1636560827.jpg', '2021-12-08 16:03:16'),
(135, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 1, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-12-08 16:05:00'),
(136, 'Joemar', 'Fernandez', 'Bulacan', 'Student', 23, 1, '../uploads/avatar_0.19507200 1636560827.jpg', '2021-12-08 16:05:22'),
(137, 'asd', 'asdasda', 'asdasd', 'Visitors', 24, 1, '../assets/images/account.png', '2021-12-09 07:05:10'),
(138, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 1, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-12-09 09:28:49'),
(139, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 2, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-12-09 09:29:46'),
(140, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 1, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-12-09 09:29:53'),
(141, 'Erickson', 'Batenga', 'Abes', 'Student', 22, 2, '../uploads/avatar_0.92828800 1636560906.jpg', '2021-12-09 09:30:00'),
(142, 'Joemar', 'Fernandez', 'Bulacan', 'Student', 23, 1, '../uploads/avatar_0.19507200 1636560827.jpg', '2021-12-09 09:30:08'),
(143, 'Joemar', 'Fernandez', 'Bulacan', 'Student', 23, 2, '../uploads/avatar_0.19507200 1636560827.jpg', '2021-12-09 09:30:17'),
(144, 'asd', 'asdasda', 'asdasd', 'Visitors', 24, 1, '../assets/images/account.png', '2021-12-09 09:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `text` text NOT NULL,
  `newspic` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `title`, `summary`, `text`, `newspic`, `create_date`) VALUES
(24, 'Metro Manila (CNN Philippines, July 20) ', 'Over 21 million kinder to high school students have enrolled for the coming school year.', 'Authorities are considering proposals to allow limited face-to-face classes in low risk areas. But for the most part, classrooms will remain empty due to safety concerns.', './uploads/News_0.92663100 1636548530.jpg', '2021-11-10 12:48:50'),
(25, 'The new set up is drawing mixed reactions from students', '“Matututo naman po kami kung focus kami sa ginagawa namin,” senior high school student Sittie Macunte tells CNN Philippines.', '“DepEd and CHED literally have students begging for money online just so they don’t get left behind with their academics, which is simply unacceptable considering the situation we are in,” the Samahan ng Progresibong Kabataan spokesman John Lazaro said in a statement.', './uploads/News_0.40545800 1636549446.jpg', '2021-11-10 13:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organization`
--

CREATE TABLE `tbl_organization` (
  `organization_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `position` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_organization`
--

INSERT INTO `tbl_organization` (`organization_id`, `fname`, `mname`, `lname`, `role`, `position`, `avatar`) VALUES
(1, 'Leonor', 'M', 'Briones', 'DepEd Secretary', 1, './uploads/avatar_0.98446200 1636544064.jpg'),
(2, 'Nicolas T. Capulong', 'PhD', 'CESO V', 'OIC. Regional Director. DepEd Region III', 2, './uploads/avatar_0.20600400 1636548901.jpg'),
(3, 'Ronilo', 'E', 'Hilario', 'OIC Asst. School Division Superintendent', 3, './uploads/avatar_0.06080600 1636548984.jpg'),
(4, 'Jessie Dancel', 'Ferrer', 'Ceso V', 'School Division Superintendent', 4, './uploads/avatar_0.54559600 1636549014.jpg'),
(5, 'MINA GRACIA ', 'L.', 'Acosta Cesco VI', 'Asst. School Superintendent', 5, './uploads/avatar_0.88427200 1636549107.jpg'),
(6, 'Janye', 'M', 'G Ed. D', 'Position', 6, './uploads/avatar_0.44971300 1636549200.jpg'),
(7, 'Evelyn', 'N', 'Reyes', 'Principal II', 7, './uploads/avatar_0.27162400 1636549131.jpg'),
(8, 'Luis', 'M', 'Calison', 'Position', 8, './uploads/avatar_0.67685300 1636549229.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schoolyear`
--

CREATE TABLE `tbl_schoolyear` (
  `id` int(11) NOT NULL,
  `schoolyear` varchar(100) NOT NULL,
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schoolyear`
--

INSERT INTO `tbl_schoolyear` (`id`, `schoolyear`, `status`) VALUES
(2, '2020 - 2021', 'active'),
(3, '2021 - 2022 ', 'active'),
(4, '2022 - 2023', 'unactive'),
(5, '2023 - 2024', 'unactive'),
(6, '2024 - 2025', 'unactive'),
(7, '2022-2023', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slidehow`
--

CREATE TABLE `tbl_slidehow` (
  `slidehow_id` int(11) NOT NULL,
  `slidehow_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slidehow`
--

INSERT INTO `tbl_slidehow` (`slidehow_id`, `slidehow_img`) VALUES
(138, './uploads/slideshow_0.02613600 1633664796.jpg'),
(136, './uploads/slideshow_0.03410500 1633664772.jpg'),
(134, './uploads/slideshow_0.10502200 1633664732.jpg'),
(137, './uploads/slideshow_0.17776400 1633664782.jpg'),
(142, './uploads/slideshow_0.49127500 1633665076.jpg'),
(139, './uploads/slideshow_0.50369700 1633664825.jpg'),
(140, './uploads/slideshow_0.58460900 1633664840.jpg'),
(143, './uploads/slideshow_0.79349100 1636593258.PNG'),
(141, './uploads/slideshow_0.83716300 1633664854.jpg'),
(135, './uploads/slideshow_0.84717100 1633664760.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `student_id` int(11) NOT NULL,
  `id_pass` varchar(255) NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','unactive','','') NOT NULL,
  `pinCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `id_pass`, `student_no`, `fname`, `mname`, `lname`, `dob`, `gender`, `address`, `email`, `contact_no`, `avatar`, `create_at`, `status`, `pinCode`) VALUES
(22, 'Student_60ab9d8125ed0', 'GT18-000001', 'Erickson', 'Batenga', 'Abes', '2004-02-05', 'Male', 'EastGeneralTinioNuevaEcija', 'erizapastor172324@gmail.com', '09093724628', '../uploads/avatar_0.92828800 1636560906.jpg', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(23, 'Student_60ab9f5028b9a', 'GT18-00002', 'Joemar', 'Fernandez', 'Bulacan', '2005-08-19', 'Female', 'PulongMatongGeneralTinioNuevaEcija', 'sres@gmail.com', '09271837221', '../uploads/avatar_0.19507200 1636560827.jpg', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(24, 'Student_618c722e64f2b', 'GT-18009', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766554', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(25, 'Student_618c722e7619f', 'GT-18010', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766555', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(26, 'Student_618c722e8cdf7', 'GT-18011', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766556', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(27, 'Student_618c722ea3148', 'GT-18012', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766557', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(28, 'Student_618c722eb56dc', 'GT-18013', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766558', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(29, 'Student_618c722ec8499', 'GT-18014', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766559', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(30, 'Student_618c722ed838c', 'GT-18015', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766560', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(31, 'Student_618c722ee5e39', 'GT-18016', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766561', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(32, 'Student_618c722f040b7', 'GT-18017', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766562', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(33, 'Student_618c722f13252', 'GT-18018', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766563', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(34, 'Student_618c722f233b5', 'GT-18019', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766564', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(35, 'Student_618c722f419e4', 'GT-18020', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766565', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(36, 'Student_618c722f78fab', 'GT-18021', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766566', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(37, 'Student_618c722fabe65', 'GT-18022', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766567', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0'),
(38, 'Student_618c722fc58e3', 'GT-18023', 'Joven', 'Fernandez', 'Dulatre', '0000-00-00', 'Male', 'Sampaguita', 'joven@gmail.com', '9887766568', '../assets/images/account.png', '2021-11-11 01:51:24', 'active', '5ED1F2254AC66F34A6038857002001E0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentclass`
--

CREATE TABLE `tbl_studentclass` (
  `studentclass_id` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_studentclass`
--

INSERT INTO `tbl_studentclass` (`studentclass_id`, `classid`, `studentid`, `subjectid`, `status`) VALUES
(4, 9, 22, 4, 'active'),
(5, 11, 35, 4, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `discription_subject` varchar(100) NOT NULL,
  `yearlevelid` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subject_name`, `discription_subject`, `yearlevelid`, `created_date`, `status`) VALUES
(4, 'Math', 'Algebra', 6, '2021-11-10 10:56:51', 'active'),
(5, 'Filipino', 'Makabayan', 5, '2021-11-10 10:57:33', 'active'),
(6, 'Math', 'ModernWorld', 8, '2021-11-11 01:24:58', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tabletitle`
--

CREATE TABLE `tbl_tabletitle` (
  `title_id` int(11) NOT NULL,
  `tabletitle` varchar(255) NOT NULL,
  `region` varchar(100) NOT NULL,
  `division` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tabletitle`
--

INSERT INTO `tbl_tabletitle` (`title_id`, `tabletitle`, `region`, `division`) VALUES
(1, '<u>LEONOR M. BAUTISTA NATIONAL HIGH SCHOOL</u>', '<b>REGION : </b>|||', '<b>DIVISION : </b>NUEVA ECIJA'),
(3, '<u>LEONOR M. BAUTISTA NHS</u>', '<b>REGION : </b>|||', '<b>DIVISION : </b>NUEVA ECIJA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `id_pass` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `email`, `contact_no`, `address`, `id_pass`, `password`, `role_id`, `avatar`, `create_at`, `status`) VALUES
(5, 'Marilyn', 'P', 'Reyes', 'Female', '1977-11-16', 'Marilyn@gmail.com', '09128374829', 'SanLeonardo', 'Teacher_60aba346befd5', 'C56AE3560A8025B14928F06397BF5A20', 1, '../uploads/avatar_0.32589100 1636561344.png', '2021-11-11 00:22:24', 'active'),
(6, 'Randy', 'M', 'Bautista', 'Male', '1983-06-22', 'Randy@gmail.com', '09282173192', 'SanMiguelBulacan', 'Teacher_618ba35b1e240', 'C56AE3560A8025B14928F06397BF5A20', 1, '../uploads/avatar_0.71391300 1636561322.png', '2021-11-11 00:22:02', 'active'),
(7, 'Christian', 'D', 'Pena', 'Male', '2021-11-24', 'Christian@gmail.com', '0988776655', 'West', 'Teacher_618c735156095', 'C56AE3560A8025B14928F06397BF5A20', 1, '../uploads/avatar_0.33511300 1636594513.png', '2021-11-11 09:35:13', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacheradvisory`
--

CREATE TABLE `tbl_teacheradvisory` (
  `teacheradvisory_id` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacheradvisory`
--

INSERT INTO `tbl_teacheradvisory` (`teacheradvisory_id`, `teacherid`, `classid`, `subjectid`, `status`) VALUES
(3, 6, 9, 4, 'active'),
(4, 7, 11, 5, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_title`
--

CREATE TABLE `tbl_title` (
  `title_id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_title`
--

INSERT INTO `tbl_title` (`title_id`, `title`) VALUES
(1, '<h1>LEONOR M. BAUTISTA NATIONAL HIGH SCHOOL</h1>\r\n                <h2>(Formerly Gen. Tinio National High School Pias Campus-Annex)</h2>\r\n                <h3><u>Pias, General Tinio, Nueva Ecija</u></h3>'),
(2, '<h2>LEONOR M. BAUTISTA NATIONAL HIGH SCHOOL</h2>\r\n                <h3>(Formerly Gen. Tinio National High School Pias Campus-Annex)</h3>\r\n                <h4><u>Pias, General Tinio, Nueva Ecija</u></h4>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE `tbl_video` (
  `video_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_video`
--

INSERT INTO `tbl_video` (`video_id`, `filename`) VALUES
(2, './uploads/HeaderVideo_0.75805900 1636588637.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitors`
--

CREATE TABLE `tbl_visitors` (
  `visitors_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contactno` int(11) NOT NULL,
  `porpose` varchar(255) NOT NULL,
  `id_pass` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','unactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_visitors`
--

INSERT INTO `tbl_visitors` (`visitors_id`, `fname`, `mname`, `lname`, `gender`, `dob`, `address`, `contactno`, `porpose`, `id_pass`, `create_date`, `status`) VALUES
(24, 'asd', 'asdasda', 'asdasd', 'Male', '2021-11-30', 'asdasd', 123123, 'asdasdasd', 'Visitors_12345', '2021-12-07 07:07:03', 'active'),
(25, 'Joven', 'Fernandez', 'Dulatre', 'Male', '2021-12-09', 'BrgySampaguitaGeneralTinioNuevaEcija', 2147483647, 'Visitonly', 'Visitors_1234', '2021-12-09 09:32:23', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`email`,`password`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `tbl_class_ibfk_1` (`level_id`),
  ADD KEY `schoolyear_id` (`schoolyear_id`);

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`evenst_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `yearLevel_id` (`yearLevel_id`);

--
-- Indexes for table `tbl_filereports`
--
ALTER TABLE `tbl_filereports`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `folder_id` (`folder_id`);

--
-- Indexes for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`galllery_id`);

--
-- Indexes for table `tbl_gaurd`
--
ALTER TABLE `tbl_gaurd`
  ADD PRIMARY KEY (`gaurd_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_gradelevel`
--
ALTER TABLE `tbl_gradelevel`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `adviserid` (`adviserid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `schoolyearid` (`schoolyearid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- Indexes for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schoolyear` (`schoolyear`);

--
-- Indexes for table `tbl_slidehow`
--
ALTER TABLE `tbl_slidehow`
  ADD PRIMARY KEY (`slidehow_id`),
  ADD UNIQUE KEY `slidehow_img` (`slidehow_img`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_no` (`student_no`),
  ADD UNIQUE KEY `email` (`email`,`contact_no`),
  ADD UNIQUE KEY `id_pass` (`id_pass`);

--
-- Indexes for table `tbl_studentclass`
--
ALTER TABLE `tbl_studentclass`
  ADD PRIMARY KEY (`studentclass_id`),
  ADD UNIQUE KEY `classid` (`classid`,`studentid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `yearlevelid` (`yearlevelid`);

--
-- Indexes for table `tbl_tabletitle`
--
ALTER TABLE `tbl_tabletitle`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`email`,`password`);

--
-- Indexes for table `tbl_teacheradvisory`
--
ALTER TABLE `tbl_teacheradvisory`
  ADD PRIMARY KEY (`teacheradvisory_id`),
  ADD UNIQUE KEY `teacherid` (`teacherid`,`classid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `tbl_title`
--
ALTER TABLE `tbl_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  ADD PRIMARY KEY (`visitors_id`),
  ADD UNIQUE KEY `id_pass` (`id_pass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `evenst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_filereports`
--
ALTER TABLE `tbl_filereports`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `galllery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_gaurd`
--
ALTER TABLE `tbl_gaurd`
  MODIFY `gaurd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_gradelevel`
--
ALTER TABLE `tbl_gradelevel`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_organization`
--
ALTER TABLE `tbl_organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_slidehow`
--
ALTER TABLE `tbl_slidehow`
  MODIFY `slidehow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_studentclass`
--
ALTER TABLE `tbl_studentclass`
  MODIFY `studentclass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_tabletitle`
--
ALTER TABLE `tbl_tabletitle`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_teacheradvisory`
--
ALTER TABLE `tbl_teacheradvisory`
  MODIFY `teacheradvisory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_title`
--
ALTER TABLE `tbl_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_visitors`
--
ALTER TABLE `tbl_visitors`
  MODIFY `visitors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD CONSTRAINT `tbl_class_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `tbl_gradelevel` (`level_id`),
  ADD CONSTRAINT `tbl_class_ibfk_2` FOREIGN KEY (`schoolyear_id`) REFERENCES `tbl_schoolyear` (`id`);

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `tbl_feedback_ibfk_1` FOREIGN KEY (`yearLevel_id`) REFERENCES `tbl_gradelevel` (`level_id`);

--
-- Constraints for table `tbl_filereports`
--
ALTER TABLE `tbl_filereports`
  ADD CONSTRAINT `tbl_filereports_ibfk_1` FOREIGN KEY (`folder_id`) REFERENCES `tbl_folder` (`folder_id`);

--
-- Constraints for table `tbl_grades`
--
ALTER TABLE `tbl_grades`
  ADD CONSTRAINT `tbl_grades_ibfk_1` FOREIGN KEY (`adviserid`) REFERENCES `tbl_teacher` (`teacher_id`),
  ADD CONSTRAINT `tbl_grades_ibfk_2` FOREIGN KEY (`classid`) REFERENCES `tbl_class` (`class_id`),
  ADD CONSTRAINT `tbl_grades_ibfk_3` FOREIGN KEY (`schoolyearid`) REFERENCES `tbl_schoolyear` (`id`),
  ADD CONSTRAINT `tbl_grades_ibfk_4` FOREIGN KEY (`studentid`) REFERENCES `tbl_student` (`student_id`),
  ADD CONSTRAINT `tbl_grades_ibfk_5` FOREIGN KEY (`subjectid`) REFERENCES `tbl_subject` (`subject_id`);

--
-- Constraints for table `tbl_studentclass`
--
ALTER TABLE `tbl_studentclass`
  ADD CONSTRAINT `tbl_studentclass_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `tbl_class` (`class_id`),
  ADD CONSTRAINT `tbl_studentclass_ibfk_2` FOREIGN KEY (`studentid`) REFERENCES `tbl_student` (`student_id`),
  ADD CONSTRAINT `tbl_studentclass_ibfk_3` FOREIGN KEY (`subjectid`) REFERENCES `tbl_subject` (`subject_id`);

--
-- Constraints for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD CONSTRAINT `tbl_subject_ibfk_1` FOREIGN KEY (`yearlevelid`) REFERENCES `tbl_gradelevel` (`level_id`);

--
-- Constraints for table `tbl_teacheradvisory`
--
ALTER TABLE `tbl_teacheradvisory`
  ADD CONSTRAINT `tbl_teacheradvisory_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `tbl_class` (`class_id`),
  ADD CONSTRAINT `tbl_teacheradvisory_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `tbl_subject` (`subject_id`),
  ADD CONSTRAINT `tbl_teacheradvisory_ibfk_3` FOREIGN KEY (`teacherid`) REFERENCES `tbl_teacher` (`teacher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
