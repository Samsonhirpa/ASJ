-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2026 at 10:33 AM
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

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`bookingId`, `roomName`, `description`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'Hall', 'This is description edit', 0, 1, '2022-06-17 21:52:00', 1, '2022-06-17 21:58:05'),
(2, 'Meeting room 2', 'Meeting room 2 booked for German client', 0, 1, '2022-06-17 21:58:44', NULL, NULL),
(3, 'Meeting room 2', 'Hold for developer and QA discussion', 0, 14, '2022-06-17 22:21:26', 14, '2022-06-17 22:21:55'),
(4, 'Meeting room 3', 'Meeting with BA & QA', 0, 1, '2022-06-18 20:22:38', 1, '2022-06-18 20:22:49');

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

--
-- Dumping data for table `tbl_journal_metrics`
--

INSERT INTO `tbl_journal_metrics` (`metricId`, `year`, `manuscriptsSubmitted`, `articlesPublished`, `totalAuthors`, `totalAffiliations`, `totalCountries`, `acceptanceRate`, `avgReviewDays`, `createdDtm`, `updatedDtm`) VALUES
(1, 2026, 0, 0, 0, 0, 0, NULL, NULL, '2026-03-06 07:08:05', NULL);

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
(39, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\",\"isAdmin\":\"1\"}', '::1', 'Chrome 145.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'Windows 10', '2026-03-08 01:25:54');

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
  `wordCount` int(11) DEFAULT NULL,
  `submittedBy` int(11) NOT NULL,
  `correspondingAuthorId` int(11) NOT NULL,
  `coAuthorsJson` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`coAuthorsJson`)),
  `status` enum('draft','submitted','under_review','revision_required','accepted','rejected','published') DEFAULT 'draft',
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

INSERT INTO `tbl_manuscripts` (`manuscriptId`, `manuscriptNumber`, `title`, `abstract`, `keywords`, `articleType`, `wordCount`, `submittedBy`, `correspondingAuthorId`, `coAuthorsJson`, `status`, `plagiarismScore`, `coverLetter`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'OJAS-2026-0001', 'dd', 'dd', 'dd', 'review', NULL, 15, 15, NULL, 'submitted', NULL, 'dd', 0, 15, '2026-03-07 14:40:59', NULL, NULL),
(2, 'OJAS-2026-0002', 'vghbh', 'hbj', 'bv fv', 'short_communication', NULL, 15, 15, NULL, 'submitted', NULL, 'cgcv bn', 0, 15, '2026-03-08 10:25:23', NULL, NULL);

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
(1, 1, 15, 1, 1, NULL, '2026-03-07 14:40:59'),
(2, 2, 15, 1, 1, NULL, '2026-03-08 10:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manuscript_author_details`
--

CREATE TABLE `tbl_manuscript_author_details` (
  `id` int(11) NOT NULL,
  `manuscriptId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `tbl_manuscript_author_details` (`id`, `manuscriptId`, `name`, `email`, `institution`, `country`, `orcid`, `isCorresponding`, `authorOrder`, `createdDtm`) VALUES
(1, 1, 'Samson Hirpa', 'samsonhirpa@gmail.com', 'NEXTEC', 'Uganda', '6666-7666-8876-8976', 1, 2, '2026-03-07 14:40:59'),
(2, 1, ' ', '', '', 'Ethiopia', '', 0, 3, '2026-03-07 14:40:59'),
(3, 2, ' ', '', '', '', '', 0, 2, '2026-03-08 10:25:23');

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
(1, 1, 'main', 'DOC-20250917-WA00011.doc', 'uploads/manuscripts/c13c6cc8c7d042796d887dd7951ff72e.doc', 2856448, 'application/msword', 1, 15, 0, '2026-03-07 14:40:59'),
(2, 1, 'figure', 'samson-removebg-preview_(1).png', 'uploads/manuscripts/34ca3388f2db50d15a58a5c0bdca9ea4.png', 128778, 'image/png', 1, 15, 0, '2026-03-07 14:40:59'),
(3, 2, 'main', 'Ejensii_KM_tti_Karoora_DGRKMK_bara_2018_edited.docx', 'uploads/manuscripts/584dbd0a31080d275ddc05e9e195d6d2.docx', 212552, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 1, 15, 0, '2026-03-08 10:25:23'),
(4, 2, 'figure', 'wor.jpg', 'uploads/manuscripts/8064e7dce4c7ec92b97eec6acada4a64.jpg', 13507, 'image/jpeg', 1, 15, 0, '2026-03-08 10:25:23');

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
  `reviewDueDate` date DEFAULT NULL,
  `reviewSubmittedDate` datetime DEFAULT NULL,
  `reviewFilePath` varchar(500) DEFAULT NULL,
  `recommendation` enum('minor_revision','moderate_revision','major_revision','not_suitable','reject') DEFAULT NULL,
  `commentsToEditor` text DEFAULT NULL,
  `commentsToAuthor` text DEFAULT NULL,
  `conflictDeclared` tinyint(1) DEFAULT 0,
  `status` enum('assigned','accepted','declined','completed','cancelled') DEFAULT 'assigned',
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(2, 'Manager', 1, 0, 0, '2021-01-13 00:00:00', NULL, NULL),
(3, 'Employee', 1, 0, 0, '2021-01-13 00:00:00', 1, '2021-01-22 18:11:16'),
(4, 'Office Boy', 1, 0, 1, '2021-01-22 17:40:24', 1, '2021-01-22 18:33:49'),
(5, 'Receptionist', 2, 0, 1, '2021-01-22 18:12:41', 1, '2021-02-05 17:32:13'),
(6, 'Project Manager', 1, 0, 1, '2021-02-05 18:25:00', NULL, NULL),
(7, 'Project Manager L2', 1, 0, 1, '2021-02-05 18:27:30', 1, '2021-03-26 14:54:08'),
(8, 'Project Manager L3', 1, 0, 1, '2021-02-05 18:29:11', 1, '2021-03-26 14:54:02'),
(9, 'Project Manager L4', 1, 0, 1, '2021-02-05 18:29:43', 1, '2021-03-26 14:53:51'),
(10, 'Project Manager L5', 1, 0, 1, '2021-02-05 18:56:47', 1, '2021-03-20 19:21:06'),
(11, 'Project Manager L6', 1, 0, 1, '2021-02-05 18:57:23', 1, '2022-06-17 20:56:55'),
(12, 'Data Entry Operator', 1, 0, 1, '2022-06-17 20:57:22', 1, '2022-06-18 20:50:52'),
(13, 'Editor-in-Chief', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(14, 'Associate Editor-in-Chief', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(15, 'Managing Editor', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(16, 'Associate Editor', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
(17, 'Specialty Chief Editor', 1, 0, 1, '2026-03-06 07:08:04', NULL, NULL),
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
(2, 'manager@example.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Manager', '9890098900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 2, 0, 0, 1, '2016-12-09 17:49:56', 1, '2020-02-01 19:36:12'),
(3, 'employee@example.com', '$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u', 'Employee', '9890098900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 1, 1, '2016-12-09 17:50:22', 1, '2019-11-09 18:13:17'),
(9, 'employee2@example.com', '$2y$10$DBnqnZDQMNW3GASPNJQ2RubfqG1WNupMBP4HKwHYRKQNHgA65Nhly', 'Employee2', '9890098900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 1, 1, '2019-03-26 11:40:50', 1, '2019-11-09 18:12:13'),
(10, 'employee@example.com', '$2y$10$DcK/YcVNOP/CxfGbcEDH1OzR8D4KyG1lpe/XgRGfijj158Ru0kKN.', 'Employee', '7410852000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 2, 0, 1, '2020-02-01 19:36:41', 1, '2022-04-01 19:27:27'),
(12, 'email@example.com', '$2y$10$CGJsY/FZMn8L4.JfO.ZojOwbK9RUCQSx4dnqU1NgkO3ffq26i0WDG', 'From', '8520741000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 3, 0, 0, 1, '2021-01-15 13:42:11', 1, '2021-02-05 17:25:44'),
(14, 'pml6@example.com', '$2y$10$VGwjdpcWYGfWe.ED4wlE8.B/0OOdKNaqvvSOaPbkZA.EMsbiyZIkG', 'Pml6', '7410852000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 12, 2, 0, 1, '2022-06-16 22:05:15', 1, '2022-06-18 20:27:04'),
(15, 'samsonhirpa0@gmail.com', '$2y$10$3zwr9qiluz.BUWw/VjzjyuO8ibXYWFJDovA5LsWaTn3UvWLc1e4Gy', 'Samuel  Hirpa', '0922222524', '', 'NexTech Software Technology', 'NexTech Software Technology', 'Ethiopia', 'Addis Ababa', 'NexTech Software Technology', 'NexTech Software Technology', '2e599f4b63c8e116b559be4bfa2557ae.jpg', 0, NULL, 21, 2, 0, 1, '2026-03-07 09:29:59', 1, '2026-03-07 12:43:13'),
(16, 'nextec22@gmail.com', '$2y$10$3LzFG/f9Fq3Wo8LExASwM.J99eN/QtvN1vtREBViEb2YW.U2oELnm', 'Samson Hirpa Tola', '0922222524', '3423-6578-8877-3322', 'NexTech Software Technology', 'SoFTWARE', 'Ethiopia', 'Addis Ababa', 'NexTech Software Technology', 'NexTech Software Technology', '6644cf07b631f445c527ff23d0681377.png', 0, NULL, 14, 1, 0, 1, '2026-03-07 10:24:38', NULL, NULL);

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
-- AUTO_INCREMENT for table `tbl_journal_activity`
--
ALTER TABLE `tbl_journal_activity`
  MODIFY `logId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_journal_issues`
--
ALTER TABLE `tbl_journal_issues`
  MODIFY `issueId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_journal_metrics`
--
ALTER TABLE `tbl_journal_metrics`
  MODIFY `metricId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_keywords`
--
ALTER TABLE `tbl_keywords`
  MODIFY `keywordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_manuscripts`
--
ALTER TABLE `tbl_manuscripts`
  MODIFY `manuscriptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_manuscript_authors`
--
ALTER TABLE `tbl_manuscript_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_manuscript_author_details`
--
ALTER TABLE `tbl_manuscript_author_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_manuscript_files`
--
ALTER TABLE `tbl_manuscript_files`
  MODIFY `fileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_manuscript_keywords`
--
ALTER TABLE `tbl_manuscript_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_print_orders`
--
ALTER TABLE `tbl_print_orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_published_articles`
--
ALTER TABLE `tbl_published_articles`
  MODIFY `articleId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reviewer_assignments`
--
ALTER TABLE `tbl_reviewer_assignments`
  MODIFY `assignmentId` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
