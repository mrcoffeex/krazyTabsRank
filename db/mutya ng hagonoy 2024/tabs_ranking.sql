-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 05:24 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabs_ranking`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabs_candidates`
--

CREATE TABLE `tabs_candidates` (
  `tabs_can_id` int(11) NOT NULL,
  `tabs_can_number` int(11) NOT NULL,
  `tabs_can_name` text NOT NULL,
  `tabs_can_desc` text NOT NULL,
  `tabs_can_image` text NOT NULL,
  `tabs_can_eliminate` int(1) NOT NULL,
  `tabs_can_created` datetime NOT NULL,
  `tabs_event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs_candidates`
--

INSERT INTO `tabs_candidates` (`tabs_can_id`, `tabs_can_number`, `tabs_can_name`, `tabs_can_desc`, `tabs_can_image`, `tabs_can_eliminate`, `tabs_can_created`, `tabs_event_id`) VALUES
(6, 1, 'Candidate_1', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(7, 2, 'Candidate_2', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(8, 3, 'Candidate_3', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(9, 4, 'Candidate_4', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(10, 5, 'Candidate_5', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(11, 6, 'Candidate_6', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(12, 7, 'Candidate_7', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(13, 8, 'Candidate_8', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(14, 9, 'Candidate_9', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(15, 10, 'Candidate_10', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(16, 11, 'Candidate_11', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(17, 12, 'Candidate_12', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(18, 13, 'Candidate_13', '', 'empty', 0, '2024-07-04 11:03:43', 7),
(19, 14, 'Candidate_14', '', 'empty', 0, '2024-07-04 11:03:44', 7),
(20, 15, 'Candidate_15', '', 'empty', 0, '2024-07-04 11:03:44', 7),
(21, 16, 'Candidate_16', '', 'empty', 0, '2024-07-04 11:03:44', 7),
(22, 17, 'Candidate_17', '', 'empty', 0, '2024-07-04 11:03:44', 7),
(23, 18, 'Candidate_18', '', 'empty', 0, '2024-07-04 11:03:44', 7),
(24, 19, 'Candidate_19', '', 'empty', 0, '2024-07-04 11:03:44', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tabs_categories`
--

CREATE TABLE `tabs_categories` (
  `tabs_cat_id` int(11) NOT NULL,
  `tabs_cat_title` text NOT NULL,
  `tabs_cat_percentage` double NOT NULL,
  `tabs_cat_status` int(1) NOT NULL,
  `tabs_event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs_categories`
--

INSERT INTO `tabs_categories` (`tabs_cat_id`, `tabs_cat_title`, `tabs_cat_percentage`, `tabs_cat_status`, `tabs_event_id`) VALUES
(5, 'PRODUCTION', 0, 0, 7),
(6, 'SWIMSUIT', 0, 0, 7),
(9, 'EVENING GOWN', 0, 0, 8),
(10, 'SPEECH ROUND', 0, 0, 8),
(11, 'FINAL Q & A', 0, 0, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tabs_criterias`
--

CREATE TABLE `tabs_criterias` (
  `tabs_cri_id` int(11) NOT NULL,
  `tabs_cri_title` text NOT NULL,
  `tabs_cri_desc` text NOT NULL,
  `tabs_cri_score_min` double NOT NULL,
  `tabs_cri_score_max` double NOT NULL,
  `tabs_cri_percentage` double NOT NULL,
  `tabs_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs_criterias`
--

INSERT INTO `tabs_criterias` (`tabs_cri_id`, `tabs_cri_title`, `tabs_cri_desc`, `tabs_cri_score_min`, `tabs_cri_score_max`, `tabs_cri_percentage`, `tabs_cat_id`) VALUES
(5, 'POISE & BEARING <br> \r\nCOSTUME\'S UNIQUENESS & STYLE <br>  \r\nSELF-INTRODUCTION <br>  \r\nBEAUTY <br>  \r\nAUDIENCE IMPACT', ' ', 5, 10, 0, 5),
(6, 'POISE & PROJECTION <br> \r\nFITNESS & FORM <br>\r\nBEAUTY <br>\r\nAUDIENCE IMPACT			\r\n', '', 5, 10, 0, 6),
(7, 'POISE & PROJECTION <br>\r\nELEGANCE & SOPHISTICATION <br>\r\nBEAUTY <br>\r\nGOWN’S UNIQUENESS & STYLE		\r\n', '', 5, 10, 0, 7),
(8, 'WIT AND CONTENT <br>\r\nPROJECTION AND DELIVERY <br>\r\nSTAGE PRESENCE <br>\r\nOVERALL IMPACT			\r\n', '', 5, 10, 0, 8),
(9, 'POISE & PROJECTION <br>\r\nELEGANCE & SOPHISTICATION <br>\r\nBEAUTY <br>\r\nGOWN’S UNIQUENESS & STYLE			\r\n', '', 5, 10, 0, 9),
(10, 'WIT AND CONTENT <br>\r\nPROJECTION AND DELIVERY <br>\r\nSTAGE PRESENCE <br>\r\nOVERALL IMPACT			\r\n', '', 5, 10, 0, 10),
(11, 'WIT AND CONTENT/ <br>\r\nPROJECTION AND DELIVERY <br>\r\nSTAGE PRESENCE <br>\r\nOVERALL IMPACT			\r\n', '', 5, 10, 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tabs_events`
--

CREATE TABLE `tabs_events` (
  `tabs_event_id` int(11) NOT NULL,
  `tabs_event_title` text NOT NULL,
  `tabs_event_desc` text NOT NULL,
  `tabs_event_year` text NOT NULL,
  `tabs_event_status` int(1) NOT NULL,
  `tabs_event_eliminate` int(1) NOT NULL,
  `tabs_event_eliminate_title` text NOT NULL,
  `tabs_event_eliminate_num` int(2) NOT NULL,
  `tabs_event_scoretype` int(1) NOT NULL,
  `tabs_event_created` datetime NOT NULL,
  `tabs_event_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabs_events`
--

INSERT INTO `tabs_events` (`tabs_event_id`, `tabs_event_title`, `tabs_event_desc`, `tabs_event_year`, `tabs_event_status`, `tabs_event_eliminate`, `tabs_event_eliminate_title`, `tabs_event_eliminate_num`, `tabs_event_scoretype`, `tabs_event_created`, `tabs_event_updated`) VALUES
(7, 'MUTYA NG HAGONOY 2024', 'MUTYA NG HAGONOY 2024', '2024', 1, 0, '', 0, 0, '2024-07-04 11:01:00', '2024-07-04 11:17:56'),
(8, 'MUTYA NG HAGONOY 2024 TOP 10', 'MUTYA NG HAGONOY 2024 TOP 10', '2024', 1, 0, '', 0, 0, '2024-07-04 11:17:20', '2024-07-04 11:17:48'),
(9, 'MUTYA NG HAGONOY 2024 TOP 5', 'MUTYA NG HAGONOY 2024 TOP 5', '2024', 1, 0, '', 0, 0, '2024-07-04 11:17:27', '2024-07-04 11:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `tabs_my_project`
--

CREATE TABLE `tabs_my_project` (
  `tabs_project` int(1) NOT NULL,
  `tabs_project_name` text NOT NULL,
  `tabs_project_address` text NOT NULL,
  `tabs_system_title` text NOT NULL,
  `tabs_event_image` text NOT NULL,
  `tabs_year_origin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tabs_my_project`
--

INSERT INTO `tabs_my_project` (`tabs_project`, `tabs_project_name`, `tabs_project_address`, `tabs_system_title`, `tabs_event_image`, `tabs_year_origin`) VALUES
(1, 'UM Tabulation Team', 'Digos City', '', '20240613182725_20240529094828_Black Gold Elegant Minimalist Boutique Logo.png', '2022-08-31 11:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `tabs_notification`
--

CREATE TABLE `tabs_notification` (
  `tabs_notif_id` int(100) NOT NULL,
  `tabs_notif_type` text NOT NULL,
  `tabs_notif_text` text NOT NULL,
  `tabs_notif_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tabs_notification`
--

INSERT INTO `tabs_notification` (`tabs_notif_id`, `tabs_notif_type`, `tabs_notif_text`, `tabs_notif_date`) VALUES
(1, 'auth', 'Login - dev', '2023-05-30 11:12:59'),
(2, 'auth', 'Login - dev', '2023-05-30 11:18:19'),
(3, 'attempt', 'Login Attempt - judge1', '2023-05-30 11:41:42'),
(4, 'attempt', 'Login Attempt - judge1', '2023-05-30 11:44:43'),
(5, 'attempt', 'Login Attempt - judge1', '2023-05-30 11:44:50'),
(6, 'auth', 'Login - judge1', '2023-05-30 11:45:22'),
(7, 'auth', 'Logout - ', '2023-05-30 11:47:31'),
(8, 'attempt', 'Login Attempt - judge1', '2023-05-30 11:47:37'),
(9, 'auth', 'Login - judge1', '2023-05-30 11:48:01'),
(10, 'auth', 'Login - Judge1', '2023-05-30 12:35:21'),
(11, 'attempt', 'Login Attempt - judge1', '2023-05-30 13:08:38'),
(12, 'attempt', 'Login Attempt - judge1', '2023-05-30 13:08:43'),
(13, 'auth', 'Login - judge1', '2023-05-30 13:08:58'),
(14, 'auth', 'Logout - judge1', '2023-05-30 13:10:23'),
(15, 'auth', 'Logout - judge1', '2023-05-30 13:10:24'),
(16, 'auth', 'Login - judge2', '2023-05-30 13:10:31'),
(17, 'auth', 'Login - judge1', '2023-05-30 13:10:36'),
(18, 'attempt', 'Login Attempt - judge2', '2023-05-30 13:11:53'),
(19, 'auth', 'Login - judge2', '2023-05-30 13:11:57'),
(20, 'attempt', 'Login Attempt - judge1', '2023-05-30 13:37:48'),
(21, 'attempt', 'Login Attempt - judge1', '2023-05-30 13:37:51'),
(22, 'auth', 'Login - judge1', '2023-05-30 13:37:59'),
(23, 'auth', 'Logout - judge1', '2023-05-30 13:38:24'),
(24, 'auth', 'Login - judge2', '2023-05-30 13:38:34'),
(25, 'auth', 'Logout - judge2', '2023-05-30 14:06:27'),
(26, 'auth', 'Login - dev', '2023-05-30 14:06:33'),
(27, 'auth', 'Logout - dev', '2023-05-30 14:21:06'),
(28, 'auth', 'Login - judge1', '2023-05-30 14:21:15'),
(29, 'auth', 'Logout - judge1', '2023-05-30 14:31:03'),
(30, 'auth', 'Login - dev', '2023-05-30 14:31:07'),
(31, 'auth', 'Logout - dev', '2023-05-30 14:33:12'),
(32, 'auth', 'Login - dev', '2023-05-30 14:33:16'),
(33, 'auth', 'Logout - dev', '2023-05-30 14:33:21'),
(34, 'auth', 'Login - judge1', '2023-05-30 14:33:52'),
(35, 'attempt', 'Login Attempt - Judge 1', '2023-05-30 14:36:01'),
(36, 'attempt', 'Login Attempt - Judge 1', '2023-05-30 14:36:29'),
(37, 'auth', 'Login - Judge1', '2023-05-30 14:36:45'),
(38, 'attempt', 'Login Attempt - Judge4', '2023-05-30 14:38:19'),
(39, 'attempt', 'Login Attempt - Judge3', '2023-05-30 14:38:24'),
(40, 'attempt', 'Login Attempt - judge5', '2023-05-30 14:38:28'),
(41, 'auth', 'Login - Judge3', '2023-05-30 14:38:31'),
(42, 'auth', 'Login - judge5', '2023-05-30 14:38:36'),
(43, 'auth', 'Login - Judge4', '2023-05-30 14:38:41'),
(44, 'auth', 'Logout - judge3', '2023-05-30 14:38:46'),
(45, 'auth', 'Login - Judge3', '2023-05-30 14:38:53'),
(46, 'auth', 'Logout - judge3', '2023-05-30 14:38:55'),
(47, 'auth', 'Login - Judge3', '2023-05-30 14:39:06'),
(48, 'auth', 'Login - Judge2', '2023-05-30 14:39:28'),
(49, 'auth', 'Login - Judge3', '2023-05-30 14:42:11'),
(50, 'auth', 'Login - dev', '2023-05-30 14:43:34'),
(51, 'auth', 'Login - Judge3', '2023-05-30 14:46:59'),
(52, 'auth', 'Logout - judge5', '2023-05-30 14:47:46'),
(53, 'auth', 'Login - Judge3', '2023-05-30 14:47:59'),
(54, 'auth', 'Logout - judge3', '2023-05-30 14:48:48'),
(55, 'auth', 'Login - dev', '2023-05-30 14:49:40'),
(56, 'auth', 'Logout - dev', '2023-05-30 14:55:17'),
(57, 'auth', 'Logout - dev', '2023-05-30 14:55:21'),
(58, 'auth', 'Login - judge2', '2023-05-30 14:55:29'),
(59, 'attempt', 'Login Attempt - judge4', '2023-05-30 14:55:41'),
(60, 'auth', 'Login - Judge4', '2023-05-30 14:55:58'),
(61, 'auth', 'Logout - judge4', '2023-05-30 15:07:57'),
(62, 'auth', 'Login - dev', '2023-05-30 15:08:03'),
(63, 'auth', 'Login - Judge2', '2023-05-30 15:17:10'),
(64, 'auth', 'Login - Judge4', '2023-05-30 15:17:29'),
(65, 'auth', 'Login - Judge3', '2023-05-30 15:17:33'),
(66, 'attempt', 'Login Attempt - Judge5', '2023-05-30 15:18:43'),
(67, 'auth', 'Login - Judge3', '2023-05-30 15:18:58'),
(68, 'auth', 'Login - Judge5', '2023-05-30 15:19:09'),
(69, 'auth', 'Logout - judge4', '2023-05-30 15:19:14'),
(70, 'auth', 'Login - Judge3', '2023-05-30 15:19:31'),
(71, 'auth', 'Login - Judge3', '2023-05-30 15:22:41'),
(72, 'auth', 'Login - Judge3', '2023-05-30 15:34:01'),
(73, 'auth', 'Logout - judge3', '2023-05-30 15:36:18'),
(74, 'auth', 'Login - Judge4', '2023-05-30 15:36:21'),
(75, 'auth', 'Logout - judge1', '2023-05-30 16:35:20'),
(76, 'auth', 'Logout - judge1', '2023-05-30 16:35:26'),
(77, 'auth', 'Login - dev', '2023-05-30 16:35:38'),
(78, 'auth', 'Logout - dev', '2023-05-30 16:36:32'),
(79, 'auth', 'Login - judge1', '2023-05-30 16:37:41'),
(80, 'auth', 'Logout - judge1', '2023-05-30 16:39:08'),
(81, 'auth', 'Login - dev', '2023-05-30 16:39:15'),
(82, 'auth', 'Login - dev', '2023-05-30 18:07:36'),
(83, 'auth', 'Login - Judge3', '2023-05-30 18:07:39'),
(84, 'auth', 'Logout - dev', '2023-05-30 18:08:21'),
(85, 'auth', 'Login - dev', '2023-05-30 18:09:21'),
(86, 'auth', 'Login - Judge1', '2023-05-30 18:11:44'),
(87, 'auth', 'Logout - judge1', '2023-05-30 18:25:11'),
(88, 'attempt', 'Login Attempt - judge', '2023-05-30 18:31:23'),
(89, 'auth', 'Login - judge1', '2023-05-30 18:31:28'),
(90, 'auth', 'Logout - dev', '2023-05-30 18:31:31'),
(91, 'auth', 'Login - judge2', '2023-05-30 18:31:57'),
(92, 'auth', 'Login - dev', '2023-05-30 18:39:14'),
(93, 'auth', 'Login - judge1', '2023-05-30 19:34:51'),
(94, 'auth', 'Login - judge4', '2023-05-30 19:37:17'),
(95, 'auth', 'Login - Judge4', '2023-05-30 19:37:19'),
(96, 'auth', 'Logout - judge4', '2023-05-30 19:37:50'),
(97, 'auth', 'Login - Judge5', '2023-05-30 19:38:00'),
(98, 'auth', 'Logout - judge2', '2023-05-30 19:44:14'),
(99, 'auth', 'Logout - judge2', '2023-05-30 19:44:17'),
(100, 'auth', 'Login - dev', '2023-05-30 19:44:22'),
(101, 'auth', 'Login - Judge3', '2023-05-30 19:45:16'),
(102, 'auth', 'Login - judge2', '2023-05-30 19:45:23'),
(103, 'auth', 'Logout - dev', '2023-05-30 19:45:24'),
(104, 'auth', 'Logout - judge3', '2023-05-30 19:47:34'),
(105, 'auth', 'Logout - judge3', '2023-05-30 19:47:39'),
(106, 'auth', 'Login - Judge3', '2023-05-30 19:47:47'),
(107, 'auth', 'Login - judge4', '2023-05-30 19:48:11'),
(108, 'auth', 'Logout - ', '2023-05-30 19:48:34'),
(109, 'auth', 'Login - dev', '2023-05-30 19:48:39'),
(110, 'auth', 'Logout - judge3', '2023-05-30 19:48:41'),
(111, 'auth', 'Logout - ', '2023-05-30 19:48:46'),
(112, 'auth', 'Login - Judge3', '2023-05-30 19:49:11'),
(113, 'auth', 'Logout - judge1', '2023-05-30 19:49:24'),
(114, 'auth', 'Login - Judge1', '2023-05-30 19:50:14'),
(115, 'auth', 'Logout - dev', '2023-05-30 19:54:44'),
(116, 'auth', 'Login - judge3', '2023-05-30 19:54:55'),
(117, 'auth', 'Logout - judge3', '2023-05-30 19:56:09'),
(118, 'attempt', 'Login Attempt - dev', '2023-05-30 19:56:48'),
(119, 'auth', 'Login - dev', '2023-05-30 19:56:53'),
(120, 'auth', 'Login - dev', '2023-05-30 20:00:31'),
(121, 'auth', 'Login - judge2', '2023-05-30 21:12:30'),
(122, 'auth', 'Logout - dev', '2023-05-30 21:34:12'),
(123, 'auth', 'Login - judge1', '2023-05-30 21:34:23'),
(124, 'auth', 'Login - dev', '2023-05-30 21:36:50'),
(125, 'auth', 'Login - judge2', '2023-05-30 22:10:32'),
(126, 'auth', 'Logout - dev', '2023-05-30 22:15:44'),
(127, 'auth', 'Logout - dev', '2023-05-30 22:15:49'),
(128, 'auth', 'Login - judge3', '2023-05-30 22:15:59'),
(129, 'auth', 'Logout - judge3', '2023-05-30 22:16:33'),
(130, 'auth', 'Login - dev', '2023-05-30 22:16:45'),
(131, 'auth', 'Logout - judge1', '2023-05-30 22:30:34'),
(132, 'auth', 'Login - judge3', '2023-05-30 22:30:53'),
(133, 'auth', 'Logout - ', '2023-07-01 21:24:44'),
(134, 'auth', 'Login - judge1', '2023-07-01 21:24:57'),
(135, 'auth', 'Logout - judge1', '2023-07-01 21:25:18'),
(136, 'auth', 'Login - judge2', '2023-07-01 21:25:50'),
(137, 'auth', 'Logout - judge2', '2023-07-01 21:26:00'),
(138, 'auth', 'Login - judge3', '2023-07-01 21:26:08'),
(139, 'auth', 'Logout - judge3', '2023-07-01 21:27:08'),
(140, 'auth', 'Login - judge4', '2023-07-01 21:27:15'),
(141, 'auth', 'Logout - judge4', '2023-07-01 21:27:25'),
(142, 'auth', 'Login - judge2', '2023-07-01 22:42:39'),
(143, 'auth', 'Logout - judge2', '2023-07-01 22:42:59'),
(144, 'auth', 'Login - judge3', '2023-07-01 22:43:09'),
(145, 'auth', 'Login - dev', '2023-07-04 11:42:15'),
(146, 'auth', 'Login - judge1', '2023-07-04 11:42:57'),
(147, 'auth', 'Login - dev', '2023-09-06 11:26:24'),
(148, 'auth', 'Logout - dev', '2024-05-28 12:29:42'),
(149, 'auth', 'Login - dev', '2024-05-29 08:27:52'),
(150, 'auth', 'Login - judge1', '2024-05-29 08:43:58'),
(151, 'auth', 'Logout - judge1', '2024-05-29 08:57:28'),
(152, 'auth', 'Login - judge2', '2024-05-29 08:57:34'),
(153, 'auth', 'Logout - judge2', '2024-05-29 09:07:24'),
(154, 'auth', 'Login - judge3', '2024-05-29 09:07:31'),
(155, 'auth', 'Login - dev', '2024-06-13 18:26:56'),
(156, 'auth', 'Logout - dev', '2024-06-13 18:27:29'),
(157, 'auth', 'Login - dev', '2024-06-13 18:27:37'),
(158, 'auth', 'Login - judge1', '2024-06-13 18:31:05'),
(159, 'auth', 'Logout - ', '2024-06-20 08:09:23'),
(160, 'auth', 'Login - judge1', '2024-06-20 08:09:42'),
(161, 'auth', 'Login - judge1', '2024-07-04 10:53:50'),
(162, 'auth', 'Logout - judge1', '2024-07-04 10:54:51'),
(163, 'auth', 'Login - dev', '2024-07-04 10:54:55'),
(164, 'auth', 'Logout - dev', '2024-07-04 11:20:51'),
(165, 'auth', 'Login - dev', '2024-07-04 11:20:59'),
(166, 'auth', 'Logout - dev', '2024-07-04 11:21:29'),
(167, 'auth', 'Login - judge1', '2024-07-04 11:21:39'),
(168, 'auth', 'Logout - judge1', '2024-07-04 11:23:55'),
(169, 'auth', 'Login - dev', '2024-07-04 11:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `tabs_results`
--

CREATE TABLE `tabs_results` (
  `tabs_result_id` int(11) NOT NULL,
  `tabs_event_id` int(11) NOT NULL,
  `tabs_cat_id` int(11) NOT NULL,
  `tabs_cri_id` int(11) NOT NULL,
  `tabs_user_id` int(11) NOT NULL,
  `tabs_can_id` int(11) NOT NULL,
  `tabs_result_score` double NOT NULL,
  `tabs_result_rank` double NOT NULL,
  `tabs_result_catRank` double NOT NULL,
  `tabs_result_created` datetime NOT NULL,
  `tabs_result_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabs_users`
--

CREATE TABLE `tabs_users` (
  `tabs_user_id` int(10) NOT NULL,
  `tabs_user_code` varchar(30) NOT NULL,
  `tabs_full_name` varchar(255) NOT NULL,
  `tabs_username` varchar(50) NOT NULL,
  `tabs_password` varchar(100) NOT NULL,
  `tabs_user_type` int(5) NOT NULL,
  `tabs_user_status` int(1) NOT NULL,
  `tabs_user_profile_img` text NOT NULL,
  `tabs_event_id` int(11) NOT NULL,
  `tabs_user_current` varchar(100) NOT NULL,
  `tabs_user_created` datetime NOT NULL,
  `tabs_user_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tabs_users`
--

INSERT INTO `tabs_users` (`tabs_user_id`, `tabs_user_code`, `tabs_full_name`, `tabs_username`, `tabs_password`, `tabs_user_type`, `tabs_user_status`, `tabs_user_profile_img`, `tabs_event_id`, `tabs_user_current`, `tabs_user_created`, `tabs_user_updated`) VALUES
(1, '0', 'hotkopi', 'dev', 'gozElr3tOF4jED67gzd4r2smH2NWy83w+P89isjSSgM=', 0, 0, '', 0, '', '2022-08-04 00:00:00', '2022-09-04 14:24:33'),
(8, '20220804171234lPKZlLkU', 'joane may delima', 'joanemay', 'KYbhfSccmfgV6lsb1k23tk6Fz98VuKKfHX24W3k9F1Y=', 0, 0, '', 0, '', '2022-08-04 17:12:34', '2022-08-04 17:12:34'),
(41, '20240704110435fIza4UA2', 'Judge 1', 'judge1', 'EfSVuZ7WilbnyPpeU1vczWbq5rhBvyY8iMdYwPHAoY0=', 1, 0, '', 7, 'index', '2024-07-04 11:04:35', '2024-07-04 11:23:51'),
(42, '20240704110615agHlYkFG', 'Judge 2', 'judge2', 'EfSVuZ7WilbnyPpeU1vczWbq5rhBvyY8iMdYwPHAoY0=', 1, 0, '', 7, '', '2024-07-04 11:06:15', '2024-07-04 11:06:51'),
(43, '20240704110625JEoPIXRD', 'Judge 3', 'judge3', 'EfSVuZ7WilbnyPpeU1vczWbq5rhBvyY8iMdYwPHAoY0=', 1, 0, '', 7, '', '2024-07-04 11:06:25', '2024-07-04 11:06:54'),
(44, '20240704110630oovYp7fq', 'Judge 4', 'judge4', 'EfSVuZ7WilbnyPpeU1vczWbq5rhBvyY8iMdYwPHAoY0=', 1, 0, '', 7, '', '2024-07-04 11:06:30', '2024-07-04 11:06:56'),
(45, '20240704110636G5f9S7D0', 'Judge 5', 'judge5', 'EfSVuZ7WilbnyPpeU1vczWbq5rhBvyY8iMdYwPHAoY0=', 1, 0, '', 7, '', '2024-07-04 11:06:36', '2024-07-04 11:06:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabs_candidates`
--
ALTER TABLE `tabs_candidates`
  ADD PRIMARY KEY (`tabs_can_id`);

--
-- Indexes for table `tabs_categories`
--
ALTER TABLE `tabs_categories`
  ADD PRIMARY KEY (`tabs_cat_id`);

--
-- Indexes for table `tabs_criterias`
--
ALTER TABLE `tabs_criterias`
  ADD PRIMARY KEY (`tabs_cri_id`);

--
-- Indexes for table `tabs_events`
--
ALTER TABLE `tabs_events`
  ADD PRIMARY KEY (`tabs_event_id`);

--
-- Indexes for table `tabs_my_project`
--
ALTER TABLE `tabs_my_project`
  ADD PRIMARY KEY (`tabs_project`);

--
-- Indexes for table `tabs_notification`
--
ALTER TABLE `tabs_notification`
  ADD PRIMARY KEY (`tabs_notif_id`);

--
-- Indexes for table `tabs_results`
--
ALTER TABLE `tabs_results`
  ADD PRIMARY KEY (`tabs_result_id`);

--
-- Indexes for table `tabs_users`
--
ALTER TABLE `tabs_users`
  ADD PRIMARY KEY (`tabs_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabs_candidates`
--
ALTER TABLE `tabs_candidates`
  MODIFY `tabs_can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tabs_categories`
--
ALTER TABLE `tabs_categories`
  MODIFY `tabs_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tabs_criterias`
--
ALTER TABLE `tabs_criterias`
  MODIFY `tabs_cri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tabs_events`
--
ALTER TABLE `tabs_events`
  MODIFY `tabs_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tabs_my_project`
--
ALTER TABLE `tabs_my_project`
  MODIFY `tabs_project` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tabs_notification`
--
ALTER TABLE `tabs_notification`
  MODIFY `tabs_notif_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `tabs_results`
--
ALTER TABLE `tabs_results`
  MODIFY `tabs_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tabs_users`
--
ALTER TABLE `tabs_users`
  MODIFY `tabs_user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
