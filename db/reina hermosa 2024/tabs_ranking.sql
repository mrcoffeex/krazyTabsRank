-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 03:14 AM
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
(1, 1, 'Candidate 1', 'Candidate 1', 'empty', 0, '2024-05-29 08:41:49', 6),
(2, 2, 'Candidate 2', 'Candidate 2', 'empty', 0, '2024-05-29 08:42:04', 6),
(3, 3, 'Candidate 3', 'Candidate 3', 'empty', 0, '2024-05-29 08:42:13', 6),
(4, 4, 'Candidate 4', 'Candidate 4', 'empty', 0, '2024-05-29 08:42:21', 6),
(5, 5, 'Candidate 5', 'Candidate 5', 'empty', 0, '2024-05-29 08:42:27', 6);

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
(1, 'PRODUCTION', 25, 0, 6),
(2, 'SWIMSUIT', 25, 0, 6),
(3, 'GOWN', 25, 0, 6),
(4, 'SPEECH ROUND', 25, 0, 6);

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
(1, 'POISE & BEARING / COSTUME\'S UNIQUENESS & STYLE / SELF-INTRODUCTION / BEAUTY / AUDIENCE IMPACT', 'HIGHEST IS 10.0 LOWEST IS 5.0', 5, 10, 0, 1),
(2, 'POISE & PROJECTION/ FITNESS & FORM/ BEAUTY/AUDIENCE IMPACT', 'HIGHEST IS 10.0 AND LOWEST IS 5.0', 5, 10, 100, 2),
(3, 'POISE & PROJECTION/ELEGANCE & SOPHISTICATION/BEAUTY/GOWN’S UNIQUENESS & STYLE', 'HIGHEST IS 10.0 AND LOWEST IS 5.0', 5, 10, 100, 3),
(4, 'WIT AND CONTENT/ PROJECTION AND DELIVERY/STAGE PRESENCE/OVERALL IMPACT', 'HIGHEST IS 10.0 AND LOWEST IS 5.0', 5, 10, 100, 4);

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
(6, 'Reyna Hermosa 2024', 'Reyna Hermosa 2024', '2024', 1, 0, '', 0, 0, '2023-09-06 11:28:53', '2024-05-29 08:28:34');

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
(1, 'UM Tabulation Team', 'Digos City', '', '20230530180617_mutya ng guihing.jpg', '2022-08-31 11:27:07');

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
(154, 'auth', 'Login - judge3', '2024-05-29 09:07:31');

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

--
-- Dumping data for table `tabs_results`
--

INSERT INTO `tabs_results` (`tabs_result_id`, `tabs_event_id`, `tabs_cat_id`, `tabs_cri_id`, `tabs_user_id`, `tabs_can_id`, `tabs_result_score`, `tabs_result_rank`, `tabs_result_catRank`, `tabs_result_created`, `tabs_result_updated`) VALUES
(1, 6, 1, 1, 38, 1, 10, 1.5, 4, '2024-05-29 08:44:25', '2024-05-29 08:44:55'),
(2, 6, 1, 1, 38, 2, 9.2, 3, 2, '2024-05-29 08:44:46', '2024-05-29 08:44:56'),
(3, 6, 1, 1, 38, 3, 8.2, 4, 5, '2024-05-29 08:44:49', '2024-05-29 08:44:56'),
(4, 6, 1, 1, 38, 4, 10, 1.5, 1, '2024-05-29 08:44:52', '2024-05-29 08:44:56'),
(5, 6, 1, 1, 38, 5, 8, 5, 3, '2024-05-29 08:44:54', '2024-05-29 08:44:56'),
(6, 6, 1, 1, 39, 1, 9, 4, 4, '2024-05-29 08:57:38', '2024-05-29 09:00:39'),
(7, 6, 1, 1, 39, 2, 9.1, 3, 2, '2024-05-29 08:57:38', '2024-05-29 08:57:50'),
(8, 6, 1, 1, 39, 3, 8.7, 5, 5, '2024-05-29 08:57:41', '2024-05-29 08:57:50'),
(9, 6, 1, 1, 39, 4, 10, 1, 1, '2024-05-29 08:57:42', '2024-05-29 08:57:50'),
(10, 6, 1, 1, 39, 5, 9.5, 2, 3, '2024-05-29 08:57:48', '2024-05-29 08:57:50'),
(11, 6, 1, 1, 40, 1, 8.9, 5, 4, '2024-05-29 09:07:34', '2024-05-29 09:07:45'),
(12, 6, 1, 1, 40, 2, 10, 1, 2, '2024-05-29 09:07:36', '2024-05-29 09:07:45'),
(13, 6, 1, 1, 40, 3, 9.5, 3, 5, '2024-05-29 09:07:38', '2024-05-29 09:07:45'),
(14, 6, 1, 1, 40, 4, 9.3, 4, 1, '2024-05-29 09:07:40', '2024-05-29 09:07:45'),
(15, 6, 1, 1, 40, 5, 9.9, 2, 3, '2024-05-29 09:07:43', '2024-05-29 09:07:45');

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
  `tabs_user_created` datetime NOT NULL,
  `tabs_user_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tabs_users`
--

INSERT INTO `tabs_users` (`tabs_user_id`, `tabs_user_code`, `tabs_full_name`, `tabs_username`, `tabs_password`, `tabs_user_type`, `tabs_user_status`, `tabs_user_profile_img`, `tabs_event_id`, `tabs_user_created`, `tabs_user_updated`) VALUES
(1, '0', 'hotkopi', 'dev', 'gozElr3tOF4jED67gzd4r2smH2NWy83w+P89isjSSgM=', 0, 0, '', 0, '2022-08-04 00:00:00', '2022-09-04 14:24:33'),
(8, '20220804171234lPKZlLkU', 'joane may delima', 'joanemay', 'KYbhfSccmfgV6lsb1k23tk6Fz98VuKKfHX24W3k9F1Y=', 0, 0, '', 0, '2022-08-04 17:12:34', '2022-08-04 17:12:34'),
(37, '202305301957082kCstBKD', 'judge6', 'judge6', 'QtaL994MTXiJsDOu1fFHeZqzplNaLVI9k8tNeqRkWtY=', 0, 1, '', 0, '2023-05-30 19:57:08', '2023-05-30 19:57:08'),
(38, '20240529084029rf015k5T', 'JUDGE 1', 'judge1', 'gozElr3tOF4jED67gzd4r2smH2NWy83w+P89isjSSgM=', 1, 0, '', 6, '2024-05-29 08:40:29', '2024-05-29 08:43:46'),
(39, '2024052908404191NFavjT', 'JUDGE 2', 'judge2', 'gozElr3tOF4jED67gzd4r2smH2NWy83w+P89isjSSgM=', 1, 0, '', 6, '2024-05-29 08:40:41', '2024-05-29 08:43:49'),
(40, '202405290840482XJbX2eY', 'JUDGE 3', 'judge3', 'gozElr3tOF4jED67gzd4r2smH2NWy83w+P89isjSSgM=', 1, 0, '', 6, '2024-05-29 08:40:48', '2024-05-29 08:43:53');

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
  MODIFY `tabs_can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tabs_categories`
--
ALTER TABLE `tabs_categories`
  MODIFY `tabs_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tabs_criterias`
--
ALTER TABLE `tabs_criterias`
  MODIFY `tabs_cri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tabs_events`
--
ALTER TABLE `tabs_events`
  MODIFY `tabs_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tabs_my_project`
--
ALTER TABLE `tabs_my_project`
  MODIFY `tabs_project` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tabs_notification`
--
ALTER TABLE `tabs_notification`
  MODIFY `tabs_notif_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `tabs_results`
--
ALTER TABLE `tabs_results`
  MODIFY `tabs_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tabs_users`
--
ALTER TABLE `tabs_users`
  MODIFY `tabs_user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
