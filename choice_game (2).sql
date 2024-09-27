-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 08:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `choice_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `user_id`, `question_id`, `answer`, `created_at`) VALUES
(1, 1, 2, 'Canva, Word, Photoshop', '2024-09-19 12:41:27'),
(2, 2, 0, 'vdgegetbgbaeg', '2024-09-19 12:41:57'),
(3, 2, 1, 'Value addition tax', '2024-09-19 12:41:59'),
(4, 2, 0, 'febefbbgfbb', '2024-09-19 12:43:32'),
(5, 2, 0, 'febefbbgfbb', '2024-09-19 12:46:13'),
(6, 2, 0, 'tally, zoho', '2024-09-19 12:47:34'),
(7, 2, 0, 'gsrg', '2024-09-19 12:48:37'),
(8, 2, 1, 'Tracking customer complaints', '2024-09-19 12:48:48'),
(9, 2, 2, 'Vat authority tax', '2024-09-19 12:48:50'),
(10, 2, 3, 'Tally, Excel, Word', '2024-09-19 12:48:51'),
(11, 2, 4, 'Difficulty keeping up with tax regulations', '2024-09-19 12:48:52'),
(12, 3, 0, 'tally, zoho', '2024-09-19 12:49:57'),
(13, 3, 0, 'tally', '2024-09-19 12:55:38'),
(14, 3, 1, 'Tracking customer complaints', '2024-09-19 12:55:40'),
(15, 3, 2, 'Value addition tax', '2024-09-19 12:55:41'),
(16, 3, 3, 'Tally, QuickBooks, Zoho Books', '2024-09-19 12:55:42'),
(17, 3, 4, 'Delayed payments and outdated software', '2024-09-19 12:55:43'),
(18, 15, 0, 'tally', '2024-09-20 05:56:29'),
(19, 15, 1, 'Tracking customer complaints', '2024-09-20 05:56:31'),
(20, 15, 2, 'Value addition tax', '2024-09-20 05:56:32'),
(21, 15, 3, 'Tally, Excel, Word', '2024-09-20 05:56:33'),
(22, 15, 4, 'Delayed payments and outdated software', '2024-09-20 05:56:35'),
(23, 15, 5, 'Customer Service', '2024-09-20 05:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `total_questions` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company`) VALUES
(1, 'hari', 'ghh'),
(2, 'hari', 'cc'),
(3, 'gfdd', 'ghftgfuty'),
(4, '1', '1'),
(5, '1', '1'),
(6, 'a', 'a'),
(7, 'demo23', '3'),
(8, 'demo23', 'q'),
(9, 'offices', 'm'),
(10, 'qwsdeqwsed', 'q'),
(11, 'q', 'q'),
(12, 'offices', 'q'),
(13, 'offices', 'q'),
(14, 'offices', 'q'),
(15, 'offices', 'ilife technologies'),
(16, 'offices', 'q'),
(17, 'demo23', 'ilife technologies'),
(18, 'offices', 'q'),
(19, 'q', 'w'),
(20, 'offices', 'w'),
(21, 'offices', 'ilife technologies'),
(22, 'demo23', 'sss'),
(23, 'q', 'ilife technologies'),
(24, 'demo23', 'q'),
(25, 'offices', '465614615167'),
(26, 'offices', '054545454544'),
(27, 'offices', '056024502030'),
(28, 'offices', '02345343125'),
(29, 'offices', '05602450203'),
(30, 'offices', '02344573354'),
(31, 'offices', '05144364210'),
(32, 'offices', '0514436421');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
