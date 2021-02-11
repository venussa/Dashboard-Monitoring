-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 04:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_group`
--

CREATE TABLE `data_group` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_group`
--

INSERT INTO `data_group` (`id`, `title`, `description`, `timestamp`, `project_id`) VALUES
(1, 'Energy', 'Ini Adalah deskripsi untuk group energy.', 1611704092, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_node`
--

CREATE TABLE `data_node` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_node`
--

INSERT INTO `data_node` (`id`, `title`, `description`, `timestamp`, `group_id`) VALUES
(1, 'Component ', 'Ini adalah deskripsi untuk node component.', 1611704092, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_project`
--

CREATE TABLE `data_project` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_project`
--

INSERT INTO `data_project` (`id`, `title`, `description`, `timestamp`) VALUES
(1, 'Power Management', 'Ini adalah Deskripsi untuk project power management.', 1611704092);

-- --------------------------------------------------------

--
-- Table structure for table `data_sensor`
--

CREATE TABLE `data_sensor` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` text NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `node_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_sensor`
--

INSERT INTO `data_sensor` (`id`, `title`, `type`, `status`, `timestamp`, `node_id`) VALUES
(1, 'Sensor Daya', '4.2 #', 1, 1611704092, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_table`
--

CREATE TABLE `data_table` (
  `id` int(11) NOT NULL,
  `datetime` bigint(20) NOT NULL,
  `value` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_table`
--

INSERT INTO `data_table` (`id`, `datetime`, `value`, `status`) VALUES
(1, 1578886785, '48,91 #', 0),
(2, 1578907943, '82,72 #', 0),
(3, 1578938398, '68,83 #', 0),
(4, 1578964673, '89,62 #', 1),
(5, 1578997022, '91,66 #', 0),
(6, 1579011814, '21,15 #', 0),
(7, 1579055050, '74,35 #', 0),
(8, 1579113389, '76,88 #', 0),
(9, 1579127270, '19,88 #', 0),
(10, 1579192771, '28,81 #', 1),
(11, 1579205676, '39,59 #', 0),
(12, 1579220153, '28,95 #', 1),
(13, 1579290073, '22,44 #', 1),
(14, 1579340954, '89,26 #', 1),
(15, 1579380339, '64,99 #', 1),
(16, 1579457922, '32,32 #', 1),
(17, 1579497836, '72,55 #', 0),
(18, 1579565000, '67,61 #', 1),
(19, 1579632381, '54,30 #', 1),
(20, 1579667465, '72,32 #', 1),
(21, 1579725113, '48,34 #', 0),
(22, 1579779188, '81,46 #', 1),
(23, 1579840217, '86,31 #', 1),
(24, 1579856208, '90,40 #', 0),
(25, 1579923681, '48,69 #', 1),
(26, 1579959110, '62,56 #', 0),
(27, 1580012595, '33,12 #', 1),
(28, 1580029093, '88,70 #', 1),
(29, 1580081047, '86,94 #', 0),
(30, 1580099970, '28,11 #', 0),
(31, 1580158799, '83,71 #', 0),
(32, 1580169618, '82,95 #', 1),
(33, 1580220252, '49,41 #', 1),
(34, 1580284604, '40,43 #', 1),
(35, 1580333935, '20,66 #', 0),
(36, 1580359392, '70,75 #', 1),
(37, 1580437729, '16,60 #', 0),
(38, 1580500845, '34,33 #', 1),
(39, 1580571488, '54,96 #', 1),
(40, 1580648793, '40,80 #', 1),
(41, 1580666574, '17,54 #', 1),
(42, 1580736591, '39,91 #', 1),
(43, 1580771865, '49,59 #', 0),
(44, 1580793276, '81,63 #', 1),
(45, 1580832525, '58,55 #', 0),
(46, 1580870250, '25,43 #', 0),
(47, 1580944240, '69,11 #', 1),
(48, 1581022658, '72,58 #', 0),
(49, 1581091346, '31,78 #', 1),
(50, 1581164071, '19,50 #', 1),
(51, 1581216118, '57,72 #', 1),
(52, 1581272011, '59,73 #', 0),
(53, 1581339079, '96,18 #', 1),
(54, 1581386825, '23,73 #', 0),
(55, 1581420833, '67,98 #', 1),
(56, 1581450780, '77,87 #', 1),
(57, 1581528935, '63,68 #', 1),
(58, 1581546930, '84,86 #', 1),
(59, 1581617851, '35,57 #', 1),
(60, 1581636691, '36,16 #', 0),
(61, 1581713187, '81,71 #', 1),
(62, 1581748677, '31,36 #', 1),
(63, 1581769939, '61,87 #', 0),
(64, 1581803909, '25,92 #', 1),
(65, 1581881193, '18,81 #', 1),
(66, 1581956699, '81,52 #', 1),
(67, 1581988840, '63,90 #', 0),
(68, 1582039126, '16,30 #', 1),
(69, 1582101000, '61,43 #', 0),
(70, 1582135743, '97,12 #', 0),
(71, 1582201037, '31,18 #', 1),
(72, 1582227191, '71,12 #', 1),
(73, 1582242535, '93,65 #', 1),
(74, 1582275704, '98,97 #', 1),
(75, 1582307782, '21,83 #', 1),
(76, 1582333322, '23,18 #', 1),
(77, 1582409602, '11,36 #', 0),
(78, 1582450075, '71,57 #', 1),
(79, 1582467262, '62,76 #', 1),
(80, 1582527235, '86,46 #', 1),
(81, 1582602429, '53,22 #', 1),
(82, 1582669084, '98,53 #', 0),
(83, 1582733798, '26,30 #', 0),
(84, 1582774503, '24,85 #', 1),
(85, 1582831141, '75,38 #', 0),
(86, 1582892492, '100,28 #', 1),
(87, 1582932630, '11,100 #', 1),
(88, 1582972728, '42,42 #', 1),
(89, 1583044746, '25,37 #', 1),
(90, 1583066439, '59,31 #', 1),
(91, 1583090689, '81,91 #', 0),
(92, 1583124327, '46,58 #', 0),
(93, 1583180622, '22,72 #', 1),
(94, 1583196158, '61,94 #', 1),
(95, 1583214290, '26,21 #', 1),
(96, 1583235658, '96,100 #', 0),
(97, 1583297152, '70,10 #', 1),
(98, 1583316170, '13,11 #', 1),
(99, 1583334719, '32,22 #', 1),
(100, 1583398902, '75,10 #', 1),
(101, 1583456692, '83,77 #', 1),
(102, 1583498876, '20,76 #', 1),
(103, 1583516924, '31,13 #', 1),
(104, 1583559027, '96,85 #', 0),
(105, 1583581063, '68,12 #', 0),
(106, 1583646459, '38,76 #', 1),
(107, 1583681349, '78,16 #', 1),
(108, 1583755288, '36,30 #', 1),
(109, 1583797063, '39,73 #', 0),
(110, 1583820912, '12,96 #', 1),
(111, 1583865258, '66,35 #', 1),
(112, 1583942307, '100,43 #', 1),
(113, 1583957164, '93,99 #', 0),
(114, 1584022434, '34,61 #', 1),
(115, 1584091893, '10,54 #', 0),
(116, 1584161878, '26,11 #', 1),
(117, 1584208209, '54,55 #', 1),
(118, 1584270504, '61,54 #', 0),
(119, 1584308894, '69,37 #', 1),
(120, 1584361575, '66,27 #', 0),
(121, 1584433582, '92,90 #', 0),
(122, 1584496918, '100,57 #', 1),
(123, 1584545090, '49,76 #', 0),
(124, 1584592874, '72,26 #', 0),
(125, 1584660196, '63,99 #', 0),
(126, 1584677470, '10,65 #', 0),
(127, 1584694043, '12,28 #', 0),
(128, 1584731119, '58,65 #', 1),
(129, 1584766195, '87,26 #', 1),
(130, 1584799895, '98,33 #', 1),
(131, 1584863388, '94,72 #', 1),
(132, 1584912404, '89,63 #', 1),
(133, 1584966714, '64,99 #', 1),
(134, 1585044778, '62,73 #', 0),
(135, 1585068844, '40,12 #', 1),
(136, 1585101993, '52,23 #', 0),
(137, 1585123549, '78,99 #', 0),
(138, 1585157376, '58,78 #', 1),
(139, 1585198573, '40,36 #', 0),
(140, 1585244642, '31,95 #', 0),
(141, 1585317037, '87,11 #', 0),
(142, 1585358290, '45,50 #', 0),
(143, 1585371196, '19,14 #', 1),
(144, 1585431704, '70,37 #', 1),
(145, 1585453453, '36,48 #', 1),
(146, 1585465718, '23,31 #', 0),
(147, 1585479692, '83,76 #', 1),
(148, 1585491850, '30,33 #', 1),
(149, 1585506486, '52,74 #', 1),
(150, 1585549883, '28,100 #', 0),
(151, 1585581350, '25,85 #', 1),
(152, 1585648497, '49,69 #', 0),
(153, 1585662351, '50,59 #', 1),
(154, 1585675514, '27,47 #', 0),
(155, 1585694057, '23,70 #', 1),
(156, 1585710218, '16,80 #', 1),
(157, 1585720438, '56,40 #', 1),
(158, 1585791600, '29,97 #', 1),
(159, 1585849984, '60,16 #', 1),
(160, 1585867784, '51,93 #', 1),
(161, 1585907037, '24,54 #', 1),
(162, 1585966586, '71,12 #', 0),
(163, 1586013148, '41,43 #', 0),
(164, 1586044626, '65,86 #', 1),
(165, 1586099268, '50,22 #', 0),
(166, 1586160179, '72,67 #', 0),
(167, 1586207575, '57,66 #', 1),
(168, 1586224637, '66,63 #', 0),
(169, 1586274773, '35,11 #', 0),
(170, 1586351479, '11,74 #', 1),
(171, 1586394743, '29,32 #', 0),
(172, 1586417459, '97,34 #', 1),
(173, 1586491009, '46,30 #', 0),
(174, 1586565548, '61,14 #', 1),
(175, 1586603899, '16,100 #', 0),
(176, 1586639996, '66,83 #', 0),
(177, 1586682177, '99,68 #', 1),
(178, 1586747055, '74,20 #', 1),
(179, 1586776546, '75,11 #', 1),
(180, 1586855851, '65,48 #', 0),
(181, 1586912047, '56,83 #', 0),
(182, 1586985011, '10,68 #', 1),
(183, 1587047130, '57,57 #', 1),
(184, 1587097087, '24,100 #', 1),
(185, 1587156599, '11,22 #', 1),
(186, 1587213280, '90,88 #', 0),
(187, 1587284456, '28,16 #', 1),
(188, 1587363052, '51,64 #', 1),
(189, 1587440905, '37,41 #', 1),
(190, 1587469040, '29,76 #', 1),
(191, 1587511314, '55,33 #', 0),
(192, 1587552143, '82,63 #', 1),
(193, 1587581632, '11,17 #', 0),
(194, 1587631257, '65,41 #', 0),
(195, 1587696903, '82,78 #', 0),
(196, 1587765369, '87,15 #', 0),
(197, 1587802485, '18,37 #', 1),
(198, 1587846367, '35,58 #', 0),
(199, 1587865273, '30,42 #', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `photo` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `fullname`, `photo`, `email`, `mobile`, `username`, `password`, `role`, `timestamp`) VALUES
(1, 'Steaven Roger', '1612515040.png', 'steavenroger@gmail.com', '0821-1087-9552', 'steavenroger', '453bbddfa16f5b619c08044e0f371e8b', 'Admin', 1611704092),
(27, 'Natasha Romanove', '1612515051.png', 'natasha@avenger.com', '0821-1097-6559', 'blackwidow', '453bbddfa16f5b619c08044e0f371e8b', 'User', 1611704092),
(43, 'Amelia Evans', '1612415769.png', 'pekerja@gmail.com', '0822-9674-6723', 'pekerja', 'a8ab9d33308a8a77d7f440acf8352e36', 'User', 1612415696);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_group`
--
ALTER TABLE `data_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_node`
--
ALTER TABLE `data_node`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_project`
--
ALTER TABLE `data_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_sensor`
--
ALTER TABLE `data_sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_table`
--
ALTER TABLE `data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_group`
--
ALTER TABLE `data_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_node`
--
ALTER TABLE `data_node`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_project`
--
ALTER TABLE `data_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_sensor`
--
ALTER TABLE `data_sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `data_table`
--
ALTER TABLE `data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
