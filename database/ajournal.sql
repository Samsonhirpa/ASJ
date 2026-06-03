
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 04:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_access_matrix`
--

CREATE TABLE `tbl_access_matrix` (
  `id` int(11) NOT NULL,
  `access` text DEFAULT NULL,
  `roleId` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_access_matrix`
--

INSERT INTO `tbl_access_matrix` (`id`, `access`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, '[{\"module\":\"Task\",\"total_access\":0,\"list\":1,\"create_records\":0,\"edit_records\":0,\"delete_records\":0},{\"module\":\"Booking\",\"total_access\":0,\"list\":1,\"create_records\":0,\"edit_records\":0,\"delete_records\":0}]', 12, 0, 1, '2022-06-17 21:01:02', 1, '2022-06-18 20:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `bookingId` int(4) NOT NULL,
  `roomName` varchar(256) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_editorial_assignments`
--

CREATE TABLE `tbl_editorial_assignments` (
  `assignmentId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `editorId` int(11) NOT NULL,
  `editorRole` enum('eic','aeic','me','ae','sce') NOT NULL,
  `assignedBy` int(11) NOT NULL,
  `assignedDate` datetime NOT NULL,
  `decision` enum('accept','minor_correction','major_correction','reject','send_for_review') DEFAULT NULL,
  `decisionDate` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `status` enum('assigned','processing','completed') DEFAULT 'assigned',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ethics_cases`
--

CREATE TABLE `tbl_ethics_cases` (
  `ethicsCaseId` int(11) NOT NULL,
  `manuscriptId` int(11) DEFAULT NULL,
  `reportedBy` int(11) NOT NULL,
  `status` enum('open','investigating','resolved','dismissed') DEFAULT 'open',
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `resolutionNotes` text DEFAULT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_activity`
--

CREATE TABLE `tbl_journal_activity` (
  `logId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ipAddress` varchar(45) DEFAULT NULL,
  `userAgent` text DEFAULT NULL,
  `referenceId` int(11) DEFAULT NULL,
  `referenceType` varchar(50) DEFAULT NULL,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_issues`
--

CREATE TABLE `tbl_journal_issues` (
  `issueId` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `issueNumber` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coverImage` varchar(255) DEFAULT NULL,
  `publishedDate` date DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'draft',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_journal_issues`
--

INSERT INTO `tbl_journal_issues` (`issueId`, `volume`, `issueNumber`, `year`, `month`, `title`, `description`, `coverImage`, `publishedDate`, `status`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 10, 1997856, 2026, 'June', 'we can', '', NULL, '2026-04-05', 'published', 0, 1, '2026-04-05 21:20:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_metrics`
--

CREATE TABLE `tbl_journal_metrics` (
  `metricId` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `manuscriptsSubmitted` int(11) DEFAULT 0,
  `articlesPublished` int(11) DEFAULT 0,
  `totalAuthors` int(11) DEFAULT 0,
  `totalAffiliations` int(11) DEFAULT 0,
  `totalCountries` int(11) DEFAULT 0,
  `acceptanceRate` decimal(5,2) DEFAULT NULL,
  `avgReviewDays` decimal(5,2) DEFAULT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_journal_policies`
--

CREATE TABLE `tbl_journal_policies` (
  `policyId` int(11) NOT NULL,
  `policyKey` varchar(100) NOT NULL,
  `policyTitle` varchar(255) NOT NULL,
  `policyContent` text NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `updatedDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keywords`
--

CREATE TABLE `tbl_keywords` (
  `keywordId` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `usageCount` int(11) DEFAULT 0,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_keywords`
--

INSERT INTO `tbl_keywords` (`keywordId`, `keyword`, `usageCount`, `createdDtm`) VALUES
(1, 'Agriculture', 0, '2026-03-06 07:08:05'),
(2, 'Agronomy', 0, '2026-03-06 07:08:05'),
(3, 'Soil Science', 0, '2026-03-06 07:08:05'),
(4, 'Crop Science', 0, '2026-03-06 07:08:05'),
(5, 'Animal Science', 0, '2026-03-06 07:08:05'),
(6, 'Agricultural Economics', 0, '2026-03-06 07:08:05'),
(7, 'Plant Breeding', 0, '2026-03-06 07:08:05'),
(8, 'Agroecology', 0, '2026-03-06 07:08:05'),
(9, 'Food Science', 0, '2026-03-06 07:08:05'),
(10, 'Agricultural Engineering', 0, '2026-03-06 07:08:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 99.0.4844.84', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Safari/537.36', 'Windows 7', '2022-04-04 22:19:07'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 01:33:45'),
(3, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 01:35:50'),
(4, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 01:36:25'),
(5, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:06:57'),
(6, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:08:21'),
(7, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:16:40'),
(8, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:17:26'),
(9, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:30:21'),
(10, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 02:30:39'),
(11, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-17 23:49:29'),
(12, 14, '{\"role\":\"11\",\"roleText\":\"Project Manager L6\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:41:39'),
(13, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:42:38'),
(14, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:51:18'),
(15, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 01:54:04'),
(16, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 02:15:01'),
(17, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:52:14'),
(18, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:53:41'),
(19, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:55:24'),
(20, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-18 23:57:25'),
(21, 14, '{\"role\":\"12\",\"roleText\":\"Data Entry Operator\",\"name\":\"Pml6\",\"isAdmin\":\"2\"}', '::1', 'Chrome 102.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Windows 7', '2022-06-19 00:21:13'),
(22, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-06 07:10:16'),
(23, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-06 07:38:47'),
(24, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-06 07:43:41'),
(25, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-06 07:53:08'),
(26, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 00:17:35'),
(27, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 03:43:58'),
(28, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 06:09:31'),
(29, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'Windows 10', '2026-03-07 06:11:56'),
(30, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'Windows 10', '2026-03-07 06:25:44'),
(31, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 06:26:52'),
(32, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 08:25:37'),
(33, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 08:26:10'),
(34, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 08:50:03'),
(35, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 08:50:29'),
(36, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 09:04:06'),
(37, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'Windows 10', '2026-03-07 09:05:05'),
(38, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-07 23:41:58'),
(39, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 01:25:54'),
(40, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 03:00:14'),
(41, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 03:39:03'),
(42, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 03:41:49'),
(43, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'Windows 10', '2026-03-08 03:50:29'),
(44, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 03:53:14'),
(45, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 03:54:36'),
(46, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 04:22:56'),
(47, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 04:27:53'),
(48, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 04:28:20'),
(49, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 04:43:54'),
(50, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'Windows 10', '2026-03-08 09:22:39'),
(51, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 09:23:34'),
(52, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 09:25:04'),
(53, 12, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 09:26:20'),
(54, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 09:31:14'),
(55, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 09:34:07'),
(56, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'Windows 10', '2026-03-08 09:37:33'),
(57, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 10:15:48'),
(58, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 10:17:23'),
(59, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 10:17:48'),
(60, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-09 01:11:44'),
(61, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-10 00:15:31'),
(62, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-10 05:23:04'),
(63, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-11 03:19:45'),
(64, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-11 03:19:46'),
(65, 18, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Amane\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-11 03:22:59'),
(66, 19, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Tamiru  Kabada\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 00:22:16'),
(67, 19, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Tamiru  Kabada\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 00:28:52'),
(68, 19, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Tamiru  Kabada\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 00:38:28'),
(69, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 00:48:01'),
(70, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 00:51:08'),
(71, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 00:58:43'),
(72, 19, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Tamiru  Kabada\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 01:06:23'),
(73, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-13 01:19:01'),
(74, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-17 01:19:41'),
(75, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-17 01:21:04'),
(76, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-17 01:29:42'),
(77, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 06:28:25'),
(78, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 06:28:41'),
(79, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 06:43:45'),
(80, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 06:44:26'),
(81, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 06:44:35'),
(82, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 07:11:15'),
(83, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 07:11:29'),
(84, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-28 08:11:37'),
(85, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-29 23:18:57'),
(86, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-29 23:20:34'),
(87, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-30 11:14:14'),
(88, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-30 11:16:03'),
(89, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-30 11:18:28'),
(90, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-30 11:19:48'),
(91, 18, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Amane\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-30 11:24:19'),
(92, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-03-30 11:24:54'),
(93, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 08:01:18'),
(94, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 08:41:46'),
(95, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 08:53:06'),
(96, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 08:54:42'),
(97, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 08:55:46'),
(98, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 08:56:15'),
(99, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 09:02:30'),
(100, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 09:05:33'),
(101, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-01 09:14:36'),
(102, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-05 09:56:07'),
(103, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-05 09:56:53'),
(104, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-05 09:58:12'),
(105, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-05 09:59:50'),
(106, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-05 11:58:53'),
(107, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-05 12:24:30'),
(108, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-06 12:02:29'),
(109, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-06 12:02:57'),
(110, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-06 12:10:20'),
(111, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'Windows 10', '2026-04-06 12:23:46'),
(112, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-06 13:04:19'),
(113, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-06 13:10:45'),
(114, 17, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Abenezer Tola\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-06 13:13:56'),
(115, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-07 00:14:13'),
(116, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-07 00:16:07'),
(117, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-07 00:17:17'),
(118, 20, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"DR. Teferi Diriba\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-07 00:33:57'),
(119, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-07 00:38:49'),
(120, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'Windows 10', '2026-04-07 00:43:04'),
(121, 20, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"DR. Teferi Diriba\",\"isAdmin\":\"2\"}', '::1', 'Chrome 146.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'Windows 10', '2026-04-07 01:05:17'),
(122, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 09:07:35'),
(123, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 09:07:51'),
(124, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 09:08:10'),
(125, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 09:19:16'),
(126, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 09:19:59'),
(127, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 09:41:58'),
(128, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 10:10:20'),
(129, 18, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Amane\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 10:11:04'),
(130, 18, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Amane\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 10:12:24'),
(131, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-08 10:14:34'),
(132, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 04:49:53'),
(133, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 05:01:12'),
(134, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 05:24:23'),
(135, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 05:55:05'),
(136, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 06:03:42'),
(137, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 06:05:28'),
(138, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 06:26:39'),
(139, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 06:58:00'),
(140, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 07:19:05'),
(141, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 07:53:51'),
(142, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 07:55:05'),
(143, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 07:59:16'),
(144, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 08:00:06'),
(145, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 08:00:57'),
(146, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 08:04:04'),
(147, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 08:24:22'),
(148, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 08:29:34'),
(149, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 09:42:40'),
(150, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 09:43:41'),
(151, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 09:54:45'),
(152, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-09 09:55:54'),
(153, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 02:08:58'),
(154, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 02:35:55'),
(155, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 02:38:24'),
(156, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 08:22:21'),
(157, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 08:27:18'),
(158, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 08:34:31'),
(159, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 08:36:56'),
(160, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'Windows 10', '2026-05-11 08:54:28'),
(161, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 09:07:47'),
(162, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 147.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'Windows 10', '2026-05-11 09:22:58'),
(163, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'Windows 10', '2026-05-11 09:25:03'),
(164, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-14 01:27:06'),
(165, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-14 07:30:20'),
(166, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-14 08:32:16'),
(167, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-14 08:33:42'),
(168, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'Windows 10', '2026-05-14 08:35:26'),
(169, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 05:45:35'),
(170, 15, '{\"role\":\"21\",\"roleText\":\"Author\",\"name\":\"Samuel  Hirpa\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'Windows 10', '2026-05-18 05:57:07'),
(171, 2, '{\"role\":\"15\",\"roleText\":\"Managing Editor\",\"name\":\"Manager\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 06:04:53'),
(172, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 06:06:37'),
(173, 16, '{\"role\":\"16\",\"roleText\":\"Associate Editor\",\"name\":\"Samson Hirpa Tola\",\"isAdmin\":\"1\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 06:08:38'),
(174, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 06:10:55'),
(175, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 06:20:48'),
(176, 12, '{\"role\":\"19\",\"roleText\":\"Reviewer\",\"name\":\"From\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 06:29:55'),
(177, 10, '{\"role\":\"13\",\"roleText\":\"Editor-in-Chief\",\"name\":\"Editorial\",\"isAdmin\":\"2\"}', '::1', 'Chrome 148.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Windows 10', '2026-05-18 07:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_managing_editor_screenings`
--

CREATE TABLE `tbl_managing_editor_screenings` (
  `screeningId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `managingEditorId` int(11) NOT NULL,
  `formattingScore` tinyint(3) NOT NULL DEFAULT 0,
  `completenessScore` tinyint(3) NOT NULL DEFAULT 0,
  `qualityScore` tinyint(3) NOT NULL DEFAULT 0,
  `templateScore` tinyint(3) NOT NULL DEFAULT 0,
  `totalScore` tinyint(3) NOT NULL DEFAULT 0,
  `comments` text NOT NULL,
  `resultFilePath` varchar(255) DEFAULT NULL,
  `resultStatus` enum('passed','failed') NOT NULL,
  `screenedDtm` datetime NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_managing_editor_screenings`
--

INSERT INTO `tbl_managing_editor_screenings` (`screeningId`, `manuscriptId`, `managingEditorId`, `formattingScore`, `completenessScore`, `qualityScore`, `templateScore`, `totalScore`, `comments`, `resultFilePath`, `resultStatus`, `screenedDtm`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(3, 9, 2, 22, 22, 22, 22, 88, 'approved ready for review', 'uploads/managing_editor/7b380357725a99b94cb1a5b25be8f0f3.pdf', 'passed', '2026-05-11 17:35:27', 2, '2026-05-11 17:35:27', 2, '2026-05-11 17:35:27'),
(4, 10, 2, 12, 11, 11, 11, 45, 'revision required', NULL, 'failed', '2026-05-11 17:36:07', 2, '2026-05-11 17:36:07', 2, '2026-05-11 17:36:07'),
(5, 11, 2, 19, 21, 19, 23, 82, 'there are many thinks to be fixed so need revision.', NULL, 'passed', '2026-05-11 17:58:58', 2, '2026-05-11 17:58:58', 2, '2026-05-11 17:58:58'),
(6, 12, 2, 20, 25, 25, 25, 95, 'test passtest passtest passtest passtest passtest passtest passtest passtest pass.', NULL, 'passed', '2026-05-18 15:06:10', 2, '2026-05-18 15:06:10', 2, '2026-05-18 15:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscripts`
--

CREATE TABLE `tbl_manuscripts` (
  `manuscriptId` int(11) NOT NULL,
  `manuscriptNumber` varchar(50) NOT NULL,
  `title` varchar(500) NOT NULL,
  `abstract` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `articleType` enum('research','review','short_communication','case_study','technical_note') NOT NULL,
  `thematicArea` varchar(255) NOT NULL,
  `wordCount` int(11) DEFAULT NULL,
  `submittedBy` int(11) NOT NULL,
  `correspondingAuthorId` int(11) NOT NULL,
  `assignedEditorId` int(11) DEFAULT NULL,
  `coAuthorsJson` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coAuthorsJson`)),
  `status` enum('draft','submitted','under_review','revision_required','accepted','rejected','published') DEFAULT 'draft',
  `screeningStatus` enum('pending','passed','failed') DEFAULT 'pending',
  `screeningNotes` text DEFAULT NULL,
  `technicalScreeningNotes` text DEFAULT NULL,
  `scopeScreeningNotes` text DEFAULT NULL,
  `eicScreeningDecision` enum('pending','accepted','rejected') DEFAULT 'pending',
  `eicScreenedBy` int(11) DEFAULT NULL,
  `eicScreenedDtm` datetime DEFAULT NULL,
  `managingEditorScreeningStatus` enum('pending','passed','failed') DEFAULT 'pending',
  `managingEditorScreeningScore` int(3) DEFAULT NULL,
  `managingEditorScreenedBy` int(11) DEFAULT NULL,
  `managingEditorScreenedDtm` datetime DEFAULT NULL,
  `eicMeDecision` enum('pending','approved','rejected') DEFAULT 'pending',
  `aeAssignmentResponse` enum('pending','accepted','declined') DEFAULT 'pending',
  `firstEditorialDecision` enum('accept_present','reject','minor_revision','major_revision','reject_resubmit') DEFAULT NULL,
  `firstEditorialDecisionBy` int(11) DEFAULT NULL,
  `firstEditorialDecisionDtm` datetime DEFAULT NULL,
  `revisionDueDtm` datetime DEFAULT NULL,
  `decisionLetter` text DEFAULT NULL,
  `plagiarismScore` decimal(5,2) DEFAULT NULL,
  `coverLetter` text DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_manuscripts`
--

INSERT INTO `tbl_manuscripts` (`manuscriptId`, `manuscriptNumber`, `title`, `abstract`, `keywords`, `articleType`, `thematicArea`, `wordCount`, `submittedBy`, `correspondingAuthorId`, `assignedEditorId`, `coAuthorsJson`, `status`, `screeningStatus`, `screeningNotes`, `technicalScreeningNotes`, `scopeScreeningNotes`, `eicScreeningDecision`, `eicScreenedBy`, `eicScreenedDtm`, `managingEditorScreeningStatus`, `managingEditorScreeningScore`, `managingEditorScreenedBy`, `managingEditorScreenedDtm`, `eicMeDecision`, `aeAssignmentResponse`, `firstEditorialDecision`, `firstEditorialDecisionBy`, `firstEditorialDecisionDtm`, `revisionDueDtm`, `decisionLetter`, `plagiarismScore`, `coverLetter`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(9, 'OJAS-2026-0001', 'Agricultural Inputs', 'Agricultural inputs are the various resources and materials used by farmers to improve agricultural production and increase crop and livestock productivity. These inputs include seeds, fertilizers, pesticides, herbicides, animal feed, irrigation equipment, machinery, and labor. Quality agricultural inputs play a major role in enhancing food security, improving soil fertility, controlling pests and diseases, and increasing farm efficiency. Modern farming depends heavily on the proper selection and use of these inputs to achieve sustainable agricultural development and higher yields. Effective management of agricultural inputs also helps reduce production costs and supports economic growth in rural communities.', 'Agricultural , Food inputs', 'research', 'agricultural_biotechnology', NULL, 15, 15, 16, NULL, 'accepted', 'passed', 'Technical Screening:\r\nGood To be screened\r\n\r\nScope Screening:\r\nGood To be screened', 'Good To be screened', 'Good To be screened', 'accepted', 10, '2026-05-11 17:33:07', 'passed', 88, 2, '2026-05-11 17:35:27', 'approved', 'accepted', 'accept_present', 16, '2026-05-14 18:10:29', NULL, 'Accept in Present Form: Accept in present form', NULL, 'Agricultural inputs are the various resources and materials used by farmers to improve agricultural production and increase crop and livestock productivity. These inputs include seeds, fertilizers, pesticides, herbicides, animal feed, irrigation equipment, machinery, and labor.', 0, 15, '2026-05-11 17:29:59', 16, '2026-05-14 18:10:29'),
(10, 'OJAS-2026-0002', 'The Oromo economy', 'The Oromo economy is primarily based on agriculture, livestock production, trade, and small-scale industries, which play a significant role in the livelihoods of the Oromo people in Ethiopia. Agriculture is the backbone of the economy, with farmers producing crops such as coffee, maize, teff, wheat, and barley, while pastoral communities depend on cattle, sheep, and goats for income and food security. Trade and local markets also contribute greatly to economic activities by facilitating the exchange of agricultural products and traditional goods. In recent years, urbanization, education, and infrastructure development have supported the growth of business and industrial sectors within Oromo regions. However, challenges such as climate change, unemployment, limited access to technology, and land-related issues continue to affect economic growth. Strengthening agricultural productivity, investment, and sustainable development policies can help improve the Oromo economy and enhance the living standards of the population.', 'Oromo Economy, Oromo History', 'research', 'agricultural_economics_extension', NULL, 15, 15, 10, NULL, 'under_review', 'passed', 'Technical Screening:\r\nExcellent To be screened\r\n\r\nScope Screening:\r\nExcellent To be screened', 'Excellent To be screened', 'Excellent To be screened', 'accepted', 10, '2026-05-11 17:33:36', 'failed', 45, 2, '2026-05-11 17:36:07', 'approved', 'pending', NULL, NULL, NULL, NULL, NULL, NULL, 'The Oromo economy is primarily based on agriculture, livestock production, trade, and small-scale industries, which play a significant role in the livelihoods of the Oromo people in Ethiopia. Agriculture is the backbone of the economy, with farmers producing crops such as coffee, maize, teff, wheat, and barley, while pastoral communities depend on cattle, sheep, and goats for income and food security. ', 0, 15, '2026-05-11 17:32:14', 10, '2026-05-18 15:07:27'),
(11, 'OJAS-2026-0003', 'Farming Methods', 'Farming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming Methods.', 'Farming Methods.', 'research', 'precision_farming', NULL, 15, 15, 10, NULL, 'under_review', 'passed', 'Technical Screening:\r\nFARMING PASSA\r\n\r\nScope Screening:\r\nFARMING PASSA', 'FARMING PASSA', 'FARMING PASSA', 'accepted', 10, '2026-05-18 15:04:14', 'passed', 82, 2, '2026-05-11 17:58:58', 'approved', 'accepted', 'minor_revision', 16, '2026-05-18 15:27:53', '2026-05-25 15:27:53', 'Author resubmitted revision. khgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgfkhgkhgkhjgkjgkjgkjghjhgjhfghfjhgjkgjfdfgyjhuiklkjhgf', NULL, 'Farming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming MethodsFarming Methods.', 0, 15, '2026-05-11 17:51:07', 15, '2026-05-18 15:29:00'),
(12, 'OJAS-2026-0004', 'Chala test', 'chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper', 'science, developer', 'review', 'fisheries_aquatic_life', NULL, 15, 15, 16, NULL, 'accepted', 'passed', 'Technical Screening:\r\nTEST PASS\r\n\r\nScope Screening:\r\nTEST PASS', 'TEST PASS', 'TEST PASS', 'accepted', 10, '2026-05-18 15:03:38', 'passed', 95, 2, '2026-05-18 15:06:10', 'approved', 'accepted', 'accept_present', 16, '2026-05-18 15:15:14', NULL, 'Accept in Present Form: acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike', NULL, ' chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper chala is a software drvelooper.', 0, 15, '2026-05-18 15:02:40', 16, '2026-05-18 15:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscript_authors`
--

CREATE TABLE `tbl_manuscript_authors` (
  `id` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `isCorresponding` tinyint(1) DEFAULT 0,
  `authorOrder` int(11) NOT NULL,
  `contributionRoles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`contributionRoles`)),
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_manuscript_authors`
--

INSERT INTO `tbl_manuscript_authors` (`id`, `manuscriptId`, `userId`, `isCorresponding`, `authorOrder`, `contributionRoles`, `createdDtm`) VALUES
(9, 9, 15, 1, 1, NULL, '2026-05-11 17:29:59'),
(10, 10, 15, 1, 1, NULL, '2026-05-11 17:32:14'),
(11, 11, 15, 1, 1, NULL, '2026-05-11 17:51:07'),
(12, 12, 15, 1, 1, NULL, '2026-05-18 15:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscript_author_details`
--

CREATE TABLE `tbl_manuscript_author_details` (
  `id` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT '',
  `first_name` varchar(64) NOT NULL DEFAULT '',
  `middle_name` varchar(64) NOT NULL DEFAULT '',
  `last_name` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `orcid` varchar(50) DEFAULT NULL,
  `isCorresponding` tinyint(1) DEFAULT 0,
  `authorOrder` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_manuscript_author_details`
--

INSERT INTO `tbl_manuscript_author_details` (`id`, `manuscriptId`, `title`, `first_name`, `middle_name`, `last_name`, `email`, `institution`, `country`, `orcid`, `isCorresponding`, `authorOrder`, `createdDtm`) VALUES
(11, 9, '', '', '', '', '', '', '', '', 0, 2, '2026-05-11 17:29:59'),
(12, 10, '', '', '', '', '', '', '', '', 0, 2, '2026-05-11 17:32:14'),
(13, 11, '', '', '', '', '', '', 'Ethiopia', '', 0, 2, '2026-05-11 17:51:07'),
(14, 12, '', '', '', '', '', '', '', '', 0, 2, '2026-05-18 15:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscript_files`
--

CREATE TABLE `tbl_manuscript_files` (
  `fileId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `fileType` enum('main','figure','table','supplementary','cover_letter') NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `filePath` varchar(500) NOT NULL,
  `fileSize` int(11) DEFAULT NULL,
  `mimeType` varchar(100) DEFAULT NULL,
  `version` int(11) DEFAULT 1,
  `uploadedBy` int(11) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_manuscript_files`
--

INSERT INTO `tbl_manuscript_files` (`fileId`, `manuscriptId`, `fileType`, `fileName`, `filePath`, `fileSize`, `mimeType`, `version`, `uploadedBy`, `isDeleted`, `createdDtm`) VALUES
(18, 9, 'main', 'Melo_NexTec_Casting_Management_System_with_Dynamic_Website_agreement.docx', 'uploads/manuscripts/750b123b6b71b7652be9c802c18e57cd.docx', 58911, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 15, 0, '2026-05-11 17:29:59'),
(19, 10, 'main', 'Haala_Waliigalaa_Ejensichaa.docx', 'uploads/manuscripts/c316eada0705681d556c6fa58ddd70f0.docx', 17490, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 15, 0, '2026-05-11 17:32:14'),
(20, 11, 'main', 'Melo_NexTec_Casting_Management_System_with_Dynamic_Website_agreement.docx', 'uploads/manuscripts/502ad8b0c3934ab65aff52cc288b3736.docx', 58911, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 15, 0, '2026-05-11 17:51:07'),
(21, 12, 'main', 'f56824170d63a4d42cb8149b41f87b15_(2).docx', 'uploads/manuscripts/9ecbe2033800e227202801382c598a6e.docx', 16722, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 15, 0, '2026-05-18 15:02:40'),
(22, 11, '', '9ecbe2033800e227202801382c598a6e.docx', 'uploads/manuscripts/8afee98948cb8858ea92b230ebf65a11.docx', 16722, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 15, 0, '2026-05-18 15:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscript_keywords`
--

CREATE TABLE `tbl_manuscript_keywords` (
  `id` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `keywordId` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscript_payments`
--

CREATE TABLE `tbl_manuscript_payments` (
  `paymentId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `otherDetails` text DEFAULT NULL,
  `transactionReference` varchar(120) DEFAULT NULL,
  `paymentStatus` enum('pending','free','paid') NOT NULL DEFAULT 'pending',
  `paidBy` int(11) DEFAULT NULL,
  `paidDtm` datetime DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `notificationId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `referenceId` int(11) DEFAULT NULL,
  `referenceType` varchar(50) DEFAULT NULL,
  `isRead` tinyint(1) DEFAULT 0,
  `readAt` datetime DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`notificationId`, `userId`, `type`, `subject`, `message`, `referenceId`, `referenceType`, `isRead`, `readAt`, `isDeleted`, `createdDtm`) VALUES
(26, 10, 'review_submitted', 'New reviewer comments submitted', 'A reviewer submitted comments for manuscript OJAS-2026-0005. Please approve or reject the review comments.', 9, 'review_assignment', 0, NULL, 0, '2026-04-07 09:51:27'),
(27, 20, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0005', 'Revision Required by Reviewer. Approved based on reviewer recommendations.\n- From: title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 10:27:40'),
(28, 20, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0005', 'Revision Required by Reviewer. Approved based on reviewer recommendations.\n- From: title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update title, content update.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:09:03'),
(29, 12, 'revision_resubmitted', 'Revised manuscript is available for your review', 'The author resubmitted manuscript OJAS-2026-0005. You can continue reviewing without new assignment.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:10:00'),
(30, 2, 'revision_resubmitted', 'Revised manuscript is available for your review', 'The author resubmitted manuscript OJAS-2026-0005. You can continue reviewing without new assignment.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:10:00'),
(31, 10, 'revision_resubmitted', 'Author revised manuscript resubmitted', 'Manuscript OJAS-2026-0005 was resubmitted and returned to review workflow.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:10:00'),
(32, 10, 'review_submitted', 'New reviewer comments submitted', 'A reviewer submitted comments for manuscript OJAS-2026-0005. Please approve or reject the review comments.', 9, 'review_assignment', 0, NULL, 0, '2026-04-07 11:11:18'),
(33, 20, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0005', 'Accepted. Approved based on reviewer recommendations.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:23:00'),
(34, 20, 'payment_pending', 'There is new payment pending', 'Your manuscript OJAS-2026-0005 is accepted and moved to payment gateway.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:23:00'),
(35, 20, 'payment_pending', 'Payment update available', 'There is new payment pending for manuscript OJAS-2026-0005.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:23:39'),
(36, 10, 'payment_submitted', 'Author submitted payment', 'Author submitted payment for manuscript OJAS-2026-0005.', 5, 'manuscript', 0, NULL, 0, '2026-04-07 11:24:35'),
(37, 15, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0008', 'Accepted at technical and scope screening. Technical Screening:\r\nnicely done so pass\r\n\r\nScope Screening:\r\nnicely done so pass', 8, 'manuscript', 0, NULL, 0, '2026-05-08 18:49:42'),
(38, 15, 'managing_editor_screening', 'Managing Editor screening for manuscript OJAS-2026-0008', 'Managing Editor screening passed with a score of 88/100. nice of hou', 8, 'manuscript', 0, NULL, 0, '2026-05-09 15:04:12'),
(39, 17, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0004', 'Accepted by EIC and sent to Managing Editor screening. Technical Screening:\r\ncheck ME\r\n\r\nScope Screening:\r\ncheck ME', 4, 'manuscript', 0, NULL, 0, '2026-05-09 15:38:36'),
(40, 16, 'ae_assignment', 'New Associate Editor assignment', 'You were assigned manuscript OJAS-2026-0008. Please accept or decline this request.', 8, 'manuscript', 0, NULL, 0, '2026-05-09 17:01:18'),
(41, 12, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 8, 'manuscript', 0, NULL, 0, '2026-05-09 18:24:26'),
(42, 16, 'review_invitation_response', 'Reviewer has accepted the assignment', 'From has accepted manuscript OJAS-2026-0008. Reason: ok', 11, 'review_assignment', 0, NULL, 0, '2026-05-09 18:55:13'),
(43, 20, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 8, 'manuscript', 0, NULL, 0, '2026-05-09 19:00:48'),
(44, 17, 'managing_editor_screening', 'Managing Editor screening for manuscript OJAS-2026-0004', 'Managing Editor screening passed with a score of 88/100. jkhsjldkfahnljn', 4, 'manuscript', 0, NULL, 0, '2026-05-09 19:02:02'),
(45, 16, 'ae_assignment', 'New Associate Editor assignment', 'You were assigned manuscript OJAS-2026-0004. Please accept or decline this request.', 4, 'manuscript', 0, NULL, 0, '2026-05-09 19:02:34'),
(46, 20, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 4, 'manuscript', 0, NULL, 0, '2026-05-09 19:03:51'),
(47, 16, 'ae_assignment', 'New Associate Editor assignment', 'You were assigned manuscript OJAS-2026-0004. Please accept or decline this request.', 4, 'manuscript', 0, NULL, 0, '2026-05-11 11:39:18'),
(48, 15, 'payment_pending', 'Payment update available', 'There is new payment pending for manuscript OJAS-2026-0001.', 1, 'manuscript', 0, NULL, 0, '2026-05-11 13:14:43'),
(49, 15, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0001', 'Accepted by EIC and sent to Managing Editor screening. Technical Screening:\r\nGood To be screened\r\n\r\nScope Screening:\r\nGood To be screened', 9, 'manuscript', 0, NULL, 0, '2026-05-11 17:33:07'),
(50, 15, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0002', 'Accepted by EIC and sent to Managing Editor screening. Technical Screening:\r\nExcellent To be screened\r\n\r\nScope Screening:\r\nExcellent To be screened', 10, 'manuscript', 0, NULL, 0, '2026-05-11 17:33:36'),
(51, 15, 'managing_editor_screening', 'Managing Editor screening for manuscript OJAS-2026-0001', 'Managing Editor screening passed with a score of 88/100. approved ready for review', 9, 'manuscript', 0, NULL, 0, '2026-05-11 17:35:27'),
(52, 15, 'managing_editor_screening', 'Managing Editor screening for manuscript OJAS-2026-0002', 'Managing Editor screening failed with a score of 45/100. revision required', 10, 'manuscript', 0, NULL, 0, '2026-05-11 17:36:07'),
(53, 15, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0003', 'Accepted by EIC and sent to Managing Editor screening. Technical Screening:\r\nUse this form to complete the Editor-in-Chief technical and journal-scope screening before reviewer assignment.\r\n\r\nScope Screening:\r\nUse this form to complete the Editor-in-Chief technical and journal-scope screening before reviewer assignment.', 11, 'manuscript', 0, NULL, 0, '2026-05-11 17:56:26'),
(54, 15, 'managing_editor_screening', 'Managing Editor screening for manuscript OJAS-2026-0003', 'Managing Editor screening failed with a score of 50/100. there are many thinks to be fixed so need revision.', 11, 'manuscript', 0, NULL, 0, '2026-05-11 17:58:58'),
(55, 16, 'ae_assignment', 'New Associate Editor assignment', 'You were assigned manuscript OJAS-2026-0001. Please accept or decline this request.', 9, 'manuscript', 0, NULL, 0, '2026-05-11 18:04:08'),
(56, 16, 'ae_assignment', 'New Associate Editor assignment', 'You were assigned manuscript OJAS-2026-0003. Please accept or decline this request.', 11, 'manuscript', 0, NULL, 0, '2026-05-11 18:06:31'),
(57, 12, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 9, 'manuscript', 0, NULL, 0, '2026-05-11 18:08:33'),
(58, 20, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 9, 'manuscript', 0, NULL, 0, '2026-05-11 18:21:13'),
(59, 12, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 11, 'manuscript', 0, NULL, 0, '2026-05-11 18:21:46'),
(60, 16, 'review_invitation_response', 'Reviewer has accepted the assignment', 'From has accepted manuscript OJAS-2026-0001. Reason: Sure', 14, 'review_assignment', 0, NULL, 0, '2026-05-11 18:23:48'),
(61, 16, 'review_submitted', 'New reviewer comments submitted', 'A reviewer submitted comments for manuscript OJAS-2026-0001. Please approve or reject the review comments.', 14, 'review_assignment', 0, NULL, 0, '2026-05-11 18:49:11'),
(62, 16, 'review_invitation_response', 'Reviewer has accepted the assignment', 'From has accepted manuscript OJAS-2026-0003. Reason: oky', 16, 'review_assignment', 0, NULL, 0, '2026-05-11 19:17:06'),
(63, 16, 'review_submitted', 'New reviewer comments submitted', 'A reviewer submitted comments for manuscript OJAS-2026-0003. Please approve or reject the review comments.', 16, 'review_assignment', 0, NULL, 0, '2026-05-11 19:37:13'),
(64, 15, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0003', 'Accept in Present Form. Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)\n- From: Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)\r\n  Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)', 11, 'manuscript', 0, NULL, 0, '2026-05-11 19:37:39'),
(65, 15, 'payment_pending', 'There is new payment pending', 'Your manuscript OJAS-2026-0003 is accepted and moved to payment gateway.', 11, 'manuscript', 0, NULL, 0, '2026-05-11 19:37:39'),
(66, 15, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0003', 'Accept in Present Form. Accepted as ASSOCIATE editor\n- From: Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)\r\n  Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)', 11, 'manuscript', 0, NULL, 0, '2026-05-14 17:34:47'),
(67, 15, 'payment_pending', 'There is new payment pending', 'Your manuscript OJAS-2026-0003 is accepted and moved to payment gateway.', 11, 'manuscript', 0, NULL, 0, '2026-05-14 17:34:47'),
(68, 15, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0003', 'Accept after Minor Revision (7-day revision time). ned revision accept after 7 days\n- From: Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)\r\n  Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)', 11, 'manuscript', 0, NULL, 0, '2026-05-14 18:09:13'),
(69, 15, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0001', 'Accept in Present Form. Accept in present form', 9, 'manuscript', 0, NULL, 0, '2026-05-14 18:10:29'),
(70, 15, 'payment_pending', 'There is new payment pending', 'Your manuscript OJAS-2026-0001 is accepted and moved to payment gateway.', 9, 'manuscript', 0, NULL, 0, '2026-05-14 18:10:29'),
(71, 15, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0004', 'Accepted by EIC and sent to Managing Editor screening. Technical Screening:\r\nTEST PASS\r\n\r\nScope Screening:\r\nTEST PASS', 12, 'manuscript', 0, NULL, 0, '2026-05-18 15:03:38'),
(72, 15, 'technical_scope_screening', 'Technical and scope screening for manuscript OJAS-2026-0003', 'Accepted by EIC and sent to Managing Editor screening. Technical Screening:\r\nFARMING PASSA\r\n\r\nScope Screening:\r\nFARMING PASSA', 11, 'manuscript', 0, NULL, 0, '2026-05-18 15:04:14'),
(73, 15, 'managing_editor_screening', 'Managing Editor screening for manuscript OJAS-2026-0004', 'Managing Editor screening passed with a score of 95/100. test passtest passtest passtest passtest passtest passtest passtest passtest pass.', 12, 'manuscript', 0, NULL, 0, '2026-05-18 15:06:10'),
(74, 16, 'ae_assignment', 'New Associate Editor assignment', 'You were assigned manuscript OJAS-2026-0004. Please accept or decline this request.', 12, 'manuscript', 0, NULL, 0, '2026-05-18 15:08:03'),
(75, 12, 'review_assignment', 'New manuscript assigned for review', 'You have been assigned a manuscript review. Please respond and submit your review before the due date.', 12, 'manuscript', 0, NULL, 0, '2026-05-18 15:10:33'),
(76, 16, 'review_invitation_response', 'Reviewer has accepted the assignment', 'From has accepted manuscript OJAS-2026-0004. Reason: ok', 17, 'review_assignment', 0, NULL, 0, '2026-05-18 15:11:21'),
(77, 16, 'review_submitted', 'New reviewer comments submitted', 'A reviewer submitted comments for manuscript OJAS-2026-0004. Please approve or reject the review comments.', 17, 'review_assignment', 0, NULL, 0, '2026-05-18 15:13:40'),
(78, 15, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0004', 'Accept in Present Form. acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike', 12, 'manuscript', 0, NULL, 0, '2026-05-18 15:15:14'),
(79, 15, 'payment_pending', 'There is new payment pending', 'Your manuscript OJAS-2026-0004 is accepted and moved to payment gateway.', 12, 'manuscript', 0, NULL, 0, '2026-05-18 15:15:14'),
(80, 15, 'editorial_decision', 'Editorial decision for manuscript OJAS-2026-0003', 'Accept after Minor Revision (7-day revision time). auther must submite revised manuscript in 7 days\n- From: Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)\r\n  Accept in Present Form\r\n  Accept after Minor Revision (7-day revision time)\r\n  Reconsider after Major Revision (15-day revision time)\r\n  Reject and Encourage Resubmission (if extensive new experiments are needed)\r\n  Reject (Serious flaws)', 11, 'manuscript', 0, NULL, 0, '2026-05-18 15:27:53'),
(81, 12, 'revision_resubmitted', 'Revised manuscript is available for your review', 'The author resubmitted manuscript OJAS-2026-0003. You can continue reviewing without new assignment.', 11, 'manuscript', 0, NULL, 0, '2026-05-18 15:29:00'),
(82, 10, 'revision_resubmitted', 'Author revised manuscript resubmitted', 'Manuscript OJAS-2026-0003 was resubmitted and returned to review workflow.', 11, 'manuscript', 0, NULL, 0, '2026-05-18 15:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_print_orders`
--

CREATE TABLE `tbl_print_orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `articleIds` text NOT NULL,
  `issueId` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `currency` varchar(3) DEFAULT 'USD',
  `shippingAddress` text NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_published_articles`
--

CREATE TABLE `tbl_published_articles` (
  `articleId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `issueId` int(11) NOT NULL,
  `doi` varchar(100) DEFAULT NULL,
  `pageStart` int(11) DEFAULT NULL,
  `pageEnd` int(11) DEFAULT NULL,
  `publishedDate` datetime NOT NULL,
  `viewsCount` int(11) DEFAULT 0,
  `downloadsCount` int(11) DEFAULT 0,
  `citationsCount` int(11) DEFAULT 0,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviewer_assignments`
--

CREATE TABLE `tbl_reviewer_assignments` (
  `assignmentId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `reviewerId` int(11) NOT NULL,
  `assignedBy` int(11) NOT NULL,
  `assignedDate` datetime NOT NULL,
  `responseDate` datetime DEFAULT NULL,
  `responseStatus` enum('pending','accepted','declined') DEFAULT 'pending',
  `responseReason` text DEFAULT NULL,
  `reviewDueDate` date DEFAULT NULL,
  `reviewSubmittedDate` datetime DEFAULT NULL,
  `editorReviewApprovalStatus` enum('pending','approved','rejected') DEFAULT 'pending',
  `editorReviewApprovalReason` text DEFAULT NULL,
  `editorReviewApprovalDate` datetime DEFAULT NULL,
  `editorSetPrice` decimal(10,2) DEFAULT NULL,
  `paymentStatus` enum('not_ready','pending_gateway','paid') DEFAULT 'not_ready',
  `reviewFilePath` varchar(500) DEFAULT NULL,
  `recommendation` enum('minor_revision','moderate_revision','major_revision','not_suitable','reject') DEFAULT NULL,
  `recommendationDecision` varchar(30) DEFAULT NULL,
  `commentsToEditor` text DEFAULT NULL,
  `confidentialComments` text DEFAULT NULL,
  `commentsToAuthor` text DEFAULT NULL,
  `score` tinyint(1) DEFAULT NULL,
  `conflictDeclared` tinyint(1) DEFAULT 0,
  `status` enum('assigned','accepted','declined','completed','cancelled') DEFAULT 'assigned',
  `reviewerRecognitionPoints` int(11) DEFAULT 0,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_reviewer_assignments`
--

INSERT INTO `tbl_reviewer_assignments` (`assignmentId`, `manuscriptId`, `reviewerId`, `assignedBy`, `assignedDate`, `responseDate`, `responseStatus`, `responseReason`, `reviewDueDate`, `reviewSubmittedDate`, `editorReviewApprovalStatus`, `editorReviewApprovalReason`, `editorReviewApprovalDate`, `editorSetPrice`, `paymentStatus`, `reviewFilePath`, `recommendation`, `recommendationDecision`, `commentsToEditor`, `confidentialComments`, `commentsToAuthor`, `score`, `conflictDeclared`, `status`, `reviewerRecognitionPoints`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(14, 9, 12, 16, '2026-05-11 18:08:33', '2026-05-11 18:23:48', 'accepted', 'Sure', '2026-05-25', '2026-05-11 18:49:11', 'approved', 'Accept in present form', '2026-05-14 18:10:29', NULL, 'pending_gateway', NULL, NULL, 'accept', 'The Comments to Author field must be at least 20 characters in length.\r\n\r\nThe Comments to Editor field must be at least 20 characters in length. ACCEPT AS IT IS', 'The Comments to Author field must be at least 20 characters in length.\r\n\r\nThe Comments to Editor field must be at least 20 characters in length. ACCEPT AS IT IS', 'The Comments to Author field must be at least 20 characters in length.\r\n\r\nThe Comments to Editor field must be at least 20 characters in length. ACCEPT AS IT IS', 5, 0, 'completed', 10, 0, 16, '2026-05-11 18:08:33', 16, '2026-05-14 18:10:29'),
(15, 9, 20, 16, '2026-05-11 18:21:13', NULL, 'pending', NULL, '2026-05-25', NULL, 'pending', NULL, NULL, NULL, 'not_ready', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'assigned', 0, 0, 16, '2026-05-11 18:21:13', NULL, NULL),
(16, 11, 12, 16, '2026-05-11 18:21:46', '2026-05-11 19:17:06', 'accepted', 'oky', '2026-05-25', NULL, 'pending', NULL, NULL, NULL, 'not_ready', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 'accepted', 10, 0, 16, '2026-05-11 18:21:46', 15, '2026-05-18 15:29:00'),
(17, 12, 12, 16, '2026-05-18 15:10:33', '2026-05-18 15:11:21', 'accepted', 'ok', '2026-06-01', '2026-05-18 15:13:40', 'approved', 'acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike acdcept what is it if y;ou go olike', '2026-05-18 15:15:14', NULL, 'pending_gateway', 'uploads/reviews/252cefcfbfea959fc0d48e00d9dd4a88.pdf', NULL, 'accept_present', 'Review passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewer  nice 1000000', 'Review passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewer  nice 1000000', 'Review passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewerReview passed by reviewer', 5, 0, 'completed', 10, 0, 16, '2026-05-18 15:10:33', 16, '2026-05-18 15:15:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review_rounds`
--

CREATE TABLE `tbl_review_rounds` (
  `roundId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `roundNumber` int(11) NOT NULL,
  `startedDate` datetime NOT NULL,
  `completedDate` datetime DEFAULT NULL,
  `status` enum('active','completed') DEFAULT 'active',
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_revisions`
--

CREATE TABLE `tbl_revisions` (
  `revisionId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `revisionNumber` int(11) NOT NULL,
  `submittedBy` int(11) NOT NULL,
  `submittedDate` datetime NOT NULL,
  `filePath` varchar(500) NOT NULL,
  `coverLetter` text DEFAULT NULL,
  `changesDescription` text DEFAULT NULL,
  `status` enum('submitted','under_review','approved') DEFAULT 'submitted',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`, `status`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'System Administrator', 1, 0, 0, '2021-01-21 00:00:00', 1, '2022-06-17 20:21:46'),
(13, 'Editor-in-Chief', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(14, 'Associate Editor-in-Chief', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(15, 'Managing Editor', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(16, 'Associate Editor', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(17, 'Publisher', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(18, 'Editorial Advisory Board', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(19, 'Reviewer', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(20, 'Guest Editor', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(21, 'Author', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_special_issues`
--

CREATE TABLE `tbl_special_issues` (
  `specialIssueId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `guestEditorId` int(11) NOT NULL,
  `submissionDeadline` date NOT NULL,
  `publicationDate` date DEFAULT NULL,
  `status` enum('open','closed','published') DEFAULT 'open',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_special_issue_submissions`
--

CREATE TABLE `tbl_special_issue_submissions` (
  `id` int(11) NOT NULL,
  `specialIssueId` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `submittedDate` datetime NOT NULL,
  `status` enum('submitted','under_review','accepted','rejected') DEFAULT 'submitted',
  `createdDtm` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `taskId` int(4) NOT NULL,
  `taskTitle` varchar(256) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`taskId`, `taskTitle`, `description`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'Small Task 1', 'Small task related to addition, substraction', 0, 1, '2022-06-18 20:47:47', 1, '2022-06-18 20:49:40'),
(2, 'Small Task 2', 'Closure task', 0, 1, '2022-06-18 20:49:48', 1, '2022-06-18 20:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `orcid_id` varchar(50) DEFAULT NULL,
  `institution` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `expertise_area` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `verification_token` varchar(255) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 2,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `orcid_id`, `institution`, `department`, `country`, `city`, `bio`, `expertise_area`, `profile_image`, `email_verified`, `verification_token`, `roleId`, `isAdmin`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@example.com', '$2y$10$6Y28WIo2Oz.p8xsEMYcCmuvvijXZU8.sRT3737ix.vN1CwGs3NJk6', 'System Administrator', '9890098900', '', 'NexTech Software Technology', '', 'Ethiopia', 'Addis Ababa', '', '', '966ddb86bc4e518805e1857c463b9f06.png', 0, NULL, 1, 1, 0, 0, '2015-07-01 18:56:49', 1, '2026-03-07 11:58:45'),
(2, 'manager@example.com', '$2y$10$.zz8lfC3qQ9lUqvOp63FFeqTu.HeCScQasR3nuKAbAeTYz7dEYHLq', 'Manager', '9890098900', '', 'NexTech Software Technology', 'Agriculture', 'Ethiopia', 'Addis Ababa', '', '', NULL, 0, NULL, 15, 2, 0, 1, '2016-12-09 17:49:56', 18, '2026-05-08 19:14:16'),
(3, 'employee@example.com', '$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u', 'Employee', '9890098900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 1, 1, '2016-12-09 17:50:22', 1, '2019-11-09 18:13:17'),
(9, 'employee2@example.com', '$2y$10$DBnqnZDQMNW3GASPNJQ2RubfqG1WNupMBP4HKwHYRKQNHgA65Nhly', 'Employee2', '9890098900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 1, 1, '2019-03-26 11:40:50', 1, '2019-11-09 18:12:13'),
(10, 'employee@example.com', '$2y$10$0WuDoRja4XdPj1jHt6LvL.wCR8jCdEy71KxTlkwGYmAsQNHX6FIaS', 'Editorial', '7410852000', '', '', '', '', '', '', '', '25715e799aced6e2b46c6997cc97fb0a.jpg', 0, NULL, 13, 2, 0, 1, '2020-02-01 19:36:41', 10, '2026-03-30 20:19:27'),
(12, 'email@example.com', '$2y$10$A9oX2QNEp3lET8yPscuf8.LHxw.JaqM87dXck7.XM00WJX2ea8D1u', 'From', '8520741000', '', '', '', '', '', '', '', '1dfe1b85ff8fac3383ea98c4cc2b3211.jpg', 0, NULL, 19, 2, 0, 1, '2021-01-15 13:42:11', 12, '2026-03-30 20:15:36'),
(14, 'pml6@example.com', '$2y$10$VGwjdpcWYGfWe.ED4wlE8.B/0OOdKNaqvvSOaPbkZA.EMsbiyZIkG', 'Pml6', '7410852000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 12, 2, 0, 1, '2022-06-16 22:05:15', 1, '2022-06-18 20:27:04'),
(15, 'samsonhirpa0@gmail.com', '$2y$10$KPq9V5g7dNQs3qwxJP2LI.EB7BkjnW5p5.8olzV9rWN9jAXZwwbDq', 'Samuel  Hirpa', '0922222524', '', 'NexTech Software Technology', 'NexTech Software Technology', 'Ethiopia', 'Addis Ababa', 'NexTech Software Technology', 'NexTech Software Technology', '2e599f4b63c8e116b559be4bfa2557ae.jpg', 0, NULL, 21, 2, 0, 1, '2026-03-07 09:29:59', 1, '2026-05-08 18:19:40'),
(16, 'ae@ojas.com', '$2y$10$lXuRTWOzhwBrY.iuT2ODjuLz3KdO.eDHl0vOKyGMCrMV.oL7WPhpi', 'Samson Hirpa Tola', '0922222524', '3423-6578-8877-3322', 'NexTech Software Technology', 'crop_sciences', 'Ethiopia', 'Addis Ababa', 'NexTech Software Technology', 'crop_sciences', '6644cf07b631f445c527ff23d0681377.png', 0, NULL, 16, 1, 0, 1, '2026-03-07 10:24:38', 1, '2026-05-09 17:00:35'),
(17, 'jalemathewos@gmail.com', '$2y$10$WpVy4kOMb9LqiV5AGM8kheT3P8Itcy8MALstwGmni4rSg3eOgukta', 'Abenezer Tola', '0922222524', '3423-6578-8877-3341', 'NexTech Software Technology', 'SoFTWARE', 'Ethiopia', 'Addis Ababa', '', '', '8f5a98345632afbc81700179027d2a7c.jpg', 0, NULL, 21, 2, 0, 0, '2026-03-08 11:00:04', 17, '2026-03-08 11:00:53'),
(18, 'aaa@aa.com', '$2y$10$5o42O2mIwYjXZCgEtqzUlOVTfo8N6rrn4cueKpiFfZM5Y.QiZxlKC', 'Amane', '0922222524', '', 'NexTech Software Technology', 'NexTech Software Technology', 'Ethiopia', 'Addis Ababa', '', '', NULL, 0, NULL, 15, 2, 0, 1, '2026-03-11 11:22:04', 18, '2026-05-08 19:13:00'),
(19, 'tame@gmail.com', '$2y$10$HARb76pX1MDy.zj2fx0X7.wk.u2o.ZjMtryceT15UWO2ij6kX6XZG', 'Tamiru  Kabada', '0987654321', '98765432', 'NexTech Software Technology', 'SoFTWARE', 'Ethiopia', 'Addis Ababa', '', '', '51e86d4a653b86f0b8e814b247cbf15e.jpg', 0, NULL, 21, 2, 0, 0, '2026-03-13 08:22:05', 19, '2026-03-13 08:28:12'),
(20, 'tt@gmail.com', '$2y$10$sv5VhzL9QFAK2bIMHt.xaeUwFVFzolCWAch8SV0vgOMMApW3G/QLu', 'Dr. Teferi Diriba', '0987654321', '870852798759', 'IQQO', 'Agriculture', 'Ethiopia', 'Addis Ababa', '', '', NULL, 0, NULL, 19, 2, 0, 0, '2026-04-07 09:33:35', 16, '2026-05-09 19:00:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `tbl_access_matrix`
--
ALTER TABLE `tbl_access_matrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `tbl_editorial_assignments`
--
ALTER TABLE `tbl_editorial_assignments`
  ADD PRIMARY KEY (`assignmentId`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_editorId` (`editorId`),
  ADD KEY `idx_assignedBy` (`assignedBy`);

--
-- Indexes for table `tbl_ethics_cases`
--
ALTER TABLE `tbl_ethics_cases`
  ADD PRIMARY KEY (`ethicsCaseId`);

--
-- Indexes for table `tbl_journal_activity`
--
ALTER TABLE `tbl_journal_activity`
  ADD PRIMARY KEY (`logId`),
  ADD KEY `idx_userId` (`userId`),
  ADD KEY `idx_action` (`action`),
  ADD KEY `idx_reference` (`referenceId`,`referenceType`);

--
-- Indexes for table `tbl_journal_issues`
--
ALTER TABLE `tbl_journal_issues`
  ADD PRIMARY KEY (`issueId`),
  ADD UNIQUE KEY `uk_volume_issue` (`volume`,`issueNumber`),
  ADD KEY `idx_createdBy` (`createdBy`);

--
-- Indexes for table `tbl_journal_metrics`
--
ALTER TABLE `tbl_journal_metrics`
  ADD PRIMARY KEY (`metricId`),
  ADD UNIQUE KEY `uk_year` (`year`);

--
-- Indexes for table `tbl_journal_policies`
--
ALTER TABLE `tbl_journal_policies`
  ADD PRIMARY KEY (`policyId`),
  ADD UNIQUE KEY `unique_policy_key` (`policyKey`);

--
-- Indexes for table `tbl_keywords`
--
ALTER TABLE `tbl_keywords`
  ADD PRIMARY KEY (`keywordId`),
  ADD UNIQUE KEY `keyword` (`keyword`),
  ADD KEY `idx_keyword` (`keyword`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_managing_editor_screenings`
--
ALTER TABLE `tbl_managing_editor_screenings`
  ADD PRIMARY KEY (`screeningId`),
  ADD UNIQUE KEY `unique_me_screening_manuscript` (`manuscriptId`),
  ADD KEY `idx_me_result_status` (`resultStatus`);

--
-- Indexes for table `tbl_manuscripts`
--
ALTER TABLE `tbl_manuscripts`
  ADD PRIMARY KEY (`manuscriptId`),
  ADD UNIQUE KEY `manuscriptNumber` (`manuscriptNumber`),
  ADD KEY `idx_submittedBy` (`submittedBy`),
  ADD KEY `idx_correspondingAuthor` (`correspondingAuthorId`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `tbl_manuscript_authors`
--
ALTER TABLE `tbl_manuscript_authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_userId` (`userId`);

--
-- Indexes for table `tbl_manuscript_author_details`
--
ALTER TABLE `tbl_manuscript_author_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manuscriptId` (`manuscriptId`);

--
-- Indexes for table `tbl_manuscript_files`
--
ALTER TABLE `tbl_manuscript_files`
  ADD PRIMARY KEY (`fileId`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_uploadedBy` (`uploadedBy`);

--
-- Indexes for table `tbl_manuscript_keywords`
--
ALTER TABLE `tbl_manuscript_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_keywordId` (`keywordId`);

--
-- Indexes for table `tbl_manuscript_payments`
--
ALTER TABLE `tbl_manuscript_payments`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `idx_payment_manuscript` (`manuscriptId`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`notificationId`),
  ADD KEY `idx_userId` (`userId`),
  ADD KEY `idx_isRead` (`isRead`);

--
-- Indexes for table `tbl_print_orders`
--
ALTER TABLE `tbl_print_orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `idx_userId` (`userId`),
  ADD KEY `idx_issueId` (`issueId`);

--
-- Indexes for table `tbl_published_articles`
--
ALTER TABLE `tbl_published_articles`
  ADD PRIMARY KEY (`articleId`),
  ADD UNIQUE KEY `uk_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_issueId` (`issueId`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reviewer_assignments`
--
ALTER TABLE `tbl_reviewer_assignments`
  ADD PRIMARY KEY (`assignmentId`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_reviewerId` (`reviewerId`),
  ADD KEY `idx_assignedBy` (`assignedBy`);

--
-- Indexes for table `tbl_review_rounds`
--
ALTER TABLE `tbl_review_rounds`
  ADD PRIMARY KEY (`roundId`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`);

--
-- Indexes for table `tbl_revisions`
--
ALTER TABLE `tbl_revisions`
  ADD PRIMARY KEY (`revisionId`),
  ADD KEY `idx_manuscriptId` (`manuscriptId`),
  ADD KEY `idx_submittedBy` (`submittedBy`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_special_issues`
--
ALTER TABLE `tbl_special_issues`
  ADD PRIMARY KEY (`specialIssueId`),
  ADD KEY `idx_guestEditor` (`guestEditorId`),
  ADD KEY `idx_createdBy` (`createdBy`);

--
-- Indexes for table `tbl_special_issue_submissions`
--
ALTER TABLE `tbl_special_issue_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_specialIssue` (`specialIssueId`),
  ADD KEY `idx_manuscript` (`manuscriptId`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`taskId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_access_matrix`
--
ALTER TABLE `tbl_access_matrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `bookingId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_editorial_assignments`
--
ALTER TABLE `tbl_editorial_assignments`
  MODIFY `assignmentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ethics_cases`
--
ALTER TABLE `tbl_ethics_cases`
  MODIFY `ethicsCaseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_journal_activity`
--
ALTER TABLE `tbl_journal_activity`
  MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_journal_issues`
--
ALTER TABLE `tbl_journal_issues`
  MODIFY `issueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_journal_metrics`
--
ALTER TABLE `tbl_journal_metrics`
  MODIFY `metricId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_journal_policies`
--
ALTER TABLE `tbl_journal_policies`
  MODIFY `policyId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_keywords`
--
ALTER TABLE `tbl_keywords`
  MODIFY `keywordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `tbl_managing_editor_screenings`
--
ALTER TABLE `tbl_managing_editor_screenings`
  MODIFY `screeningId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_manuscripts`
--
ALTER TABLE `tbl_manuscripts`
  MODIFY `manuscriptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_manuscript_authors`
--
ALTER TABLE `tbl_manuscript_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_manuscript_author_details`
--
ALTER TABLE `tbl_manuscript_author_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_manuscript_files`
--
ALTER TABLE `tbl_manuscript_files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_manuscript_keywords`
--
ALTER TABLE `tbl_manuscript_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_manuscript_payments`
--
ALTER TABLE `tbl_manuscript_payments`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_print_orders`
--
ALTER TABLE `tbl_print_orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_published_articles`
--
ALTER TABLE `tbl_published_articles`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reviewer_assignments`
--
ALTER TABLE `tbl_reviewer_assignments`
  MODIFY `assignmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_review_rounds`
--
ALTER TABLE `tbl_review_rounds`
  MODIFY `roundId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_revisions`
--
ALTER TABLE `tbl_revisions`
  MODIFY `revisionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_special_issues`
--
ALTER TABLE `tbl_special_issues`
  MODIFY `specialIssueId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_special_issue_submissions`
--
ALTER TABLE `tbl_special_issue_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `taskId` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_editorial_assignments`
--
ALTER TABLE `tbl_editorial_assignments`
  ADD CONSTRAINT `fk_editorial_assignedBy` FOREIGN KEY (`assignedBy`) REFERENCES `tbl_users` (`userId`),
  ADD CONSTRAINT `fk_editorial_editor` FOREIGN KEY (`editorId`) REFERENCES `tbl_users` (`userId`),
  ADD CONSTRAINT `fk_editorial_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_journal_activity`
--
ALTER TABLE `tbl_journal_activity`
  ADD CONSTRAINT `fk_activity_user` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userId`) ON DELETE SET NULL;

--
-- Constraints for table `tbl_journal_issues`
--
ALTER TABLE `tbl_journal_issues`
  ADD CONSTRAINT `fk_issues_createdBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_manuscripts`
--
ALTER TABLE `tbl_manuscripts`
  ADD CONSTRAINT `fk_manuscripts_corresponding` FOREIGN KEY (`correspondingAuthorId`) REFERENCES `tbl_users` (`userId`),
  ADD CONSTRAINT `fk_manuscripts_submittedBy` FOREIGN KEY (`submittedBy`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_manuscript_authors`
--
ALTER TABLE `tbl_manuscript_authors`
  ADD CONSTRAINT `fk_authors_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_authors_user` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_manuscript_author_details`
--
ALTER TABLE `tbl_manuscript_author_details`
  ADD CONSTRAINT `tbl_manuscript_author_details_ibfk_1` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_manuscript_files`
--
ALTER TABLE `tbl_manuscript_files`
  ADD CONSTRAINT `fk_files_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_files_uploadedBy` FOREIGN KEY (`uploadedBy`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_manuscript_keywords`
--
ALTER TABLE `tbl_manuscript_keywords`
  ADD CONSTRAINT `fk_mkeywords_keyword` FOREIGN KEY (`keywordId`) REFERENCES `tbl_keywords` (`keywordId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_mkeywords_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD CONSTRAINT `fk_notifications_user` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_print_orders`
--
ALTER TABLE `tbl_print_orders`
  ADD CONSTRAINT `fk_orders_issue` FOREIGN KEY (`issueId`) REFERENCES `tbl_journal_issues` (`issueId`),
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`userId`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_published_articles`
--
ALTER TABLE `tbl_published_articles`
  ADD CONSTRAINT `fk_published_issue` FOREIGN KEY (`issueId`) REFERENCES `tbl_journal_issues` (`issueId`),
  ADD CONSTRAINT `fk_published_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`);

--
-- Constraints for table `tbl_reviewer_assignments`
--
ALTER TABLE `tbl_reviewer_assignments`
  ADD CONSTRAINT `fk_reviewer_assignedBy` FOREIGN KEY (`assignedBy`) REFERENCES `tbl_users` (`userId`),
  ADD CONSTRAINT `fk_reviewer_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviewer_reviewer` FOREIGN KEY (`reviewerId`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_review_rounds`
--
ALTER TABLE `tbl_review_rounds`
  ADD CONSTRAINT `fk_rounds_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_revisions`
--
ALTER TABLE `tbl_revisions`
  ADD CONSTRAINT `fk_revisions_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_revisions_submittedBy` FOREIGN KEY (`submittedBy`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_special_issues`
--
ALTER TABLE `tbl_special_issues`
  ADD CONSTRAINT `fk_special_createdBy` FOREIGN KEY (`createdBy`) REFERENCES `tbl_users` (`userId`),
  ADD CONSTRAINT `fk_special_guestEditor` FOREIGN KEY (`guestEditorId`) REFERENCES `tbl_users` (`userId`);

--
-- Constraints for table `tbl_special_issue_submissions`
--
ALTER TABLE `tbl_special_issue_submissions`
  ADD CONSTRAINT `fk_special_submission_issue` FOREIGN KEY (`specialIssueId`) REFERENCES `tbl_special_issues` (`specialIssueId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_special_submission_manuscript` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Additional schema update for author registration name components
ALTER TABLE `tbl_users`
  ADD COLUMN `title` varchar(20) NOT NULL DEFAULT '' AFTER `name`,
  ADD COLUMN `first_name` varchar(64) NOT NULL DEFAULT '' AFTER `title`,
  ADD COLUMN `middle_name` varchar(64) NOT NULL DEFAULT '' AFTER `first_name`,
  ADD COLUMN `last_name` varchar(64) NOT NULL DEFAULT '' AFTER `middle_name`;
