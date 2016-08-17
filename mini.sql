-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2016 at 06:59 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `stid` int(11) NOT NULL,
  `fname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qstn`
--

CREATE TABLE `qstn` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `qn` varchar(200) NOT NULL,
  `qnre` varchar(200) NOT NULL,
  `attmp` int(1) NOT NULL DEFAULT '1',
  `penal` varchar(1) NOT NULL DEFAULT 'N',
  `sid` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `done` int(11) NOT NULL DEFAULT '0',
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qstn`
--

INSERT INTO `qstn` (`id`, `qid`, `qn`, `qnre`, `attmp`, `penal`, `sid`, `batch`, `done`, `start`, `end`, `file`) VALUES
(1, 1002, 'jojojo\n', 'bibibi\n', 0, '', 2, 2, 0, '', '', ''),
(2, 1002, 'bibibi\n', 'jojoj\n', 0, '', 6, 2, 0, '', '', ''),
(3, 1005, '6\n', 'Second\n', 0, '', 2, 2, 0, '', '', ''),
(4, 1005, 'Second\n', '5\n', 0, '', 6, 2, 0, '', '', ''),
(5, 1003, 'third\n', 'second\n', 0, '', 2, 2, 0, '', '', ''),
(6, 1003, 'second\n', 'first\n', 0, '', 6, 2, 0, '', '', ''),
(7, 1002, 'jojojo\n', 'jojoj\n', 2, 'Y', 1, 1, 1, '1461002689', '1461002715', ''),
(8, 1002, 'jojoj\n', 'bibibi\n', 0, '', 4, 1, 0, '', '', ''),
(9, 1001, '6\n', '4\n', 0, '', 2, 2, 0, '', '', ''),
(10, 1001, '4\n', '0\n', 2, 'Y', 6, 2, 0, '1460949081', '', ''),
(13, 1006, 'HAHAHA QUstn 1\n', 'hurrrrrrrrrrr\n', 2, 'Y', 2, 2, 1, '', '', ''),
(14, 1006, 'hurrrrrrrrrrr\n', 'hahah qstn 3\n', 2, 'Y', 6, 2, 0, '', '', ''),
(15, 1007, 'iohoihiohioh\n', 'sdhfidslfho\n', 2, 'Y', 2, 2, 1, '', '', ''),
(17, 1008, 'saopdhfopfo\n', 'dlbfdslkbfdik\n', 1, 'N', 2, 2, 0, '', '', ''),
(18, 1008, 'dlbfdslkbfdik\n', 'jkhihih\n', 2, 'Y', 6, 2, 1, '1461004053', '1461004068', ''),
(19, 1008, 'jkhihih\n', 'saopdhfopfo\n', 1, 'N', 1, 1, 0, '', '', ''),
(20, 1008, 'saopdhfopfo\n', 'dlbfdslkbfdik\n', 2, 'Y', 4, 1, 0, '1460983541', '', ''),
(21, 1007, 'iohoihiohioh\n', 'sdhfidslfho\n', 1, 'N', 1, 1, 1, '1460998749', '1460998759', '2014BIT001_1007.txt'),
(22, 1007, 'sdhfidslfho\n', 'iohoihiohioh\n', 2, 'Y', 4, 1, 1, '1460997710', '1460998135', ''),
(23, 1009, 'Q3\n', 'Q4\n', 1, 'N', 2, 2, 0, '', '', ''),
(24, 1009, 'Q4\n', 'Q2\n', 1, 'N', 6, 2, 0, '', '', ''),
(25, 1009, 'Q3\n', 'Q2\n', 1, 'N', 1, 1, 1, '1461040957', '1461040982', ''),
(26, 1009, 'Q2\n', 'Q4\n', 1, 'N', 4, 1, 1, '1461041119', '1461041124', '2014BIT004_1009.txt');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `ccode` varchar(20) NOT NULL,
  `tid` int(11) NOT NULL,
  `durn` int(11) NOT NULL,
  `b1` int(11) NOT NULL,
  `b2` int(11) NOT NULL,
  `b3` int(11) NOT NULL,
  `b4` int(11) NOT NULL,
  `b5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `ccode`, `tid`, `durn`, `b1`, `b2`, `b3`, `b4`, `b5`) VALUES
(1001, '2IT401', 1, 0, 1, 1, 1, 1, 1),
(1002, '2IT406', 1, 0, 1, 1, 0, 0, 0),
(1003, '2IT401', 1, 0, 0, 1, 0, 0, 0),
(1004, '2ME103', 3, 0, 0, 0, 0, 0, 0),
(1005, '2IT406', 1, 0, 0, 1, 0, 0, 0),
(1006, '4IT201', 2, 0, 1, 1, 1, 0, 0),
(1007, '5IT100', 2, 0, 1, 1, 1, 0, 0),
(1008, '5IT100', 2, 0, 1, 1, 0, 0, 0),
(1009, '4IT201', 2, 120, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

CREATE TABLE `stud` (
  `id` int(10) NOT NULL,
  `prn` varchar(15) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `yr` varchar(2) NOT NULL,
  `bran` varchar(30) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud`
--

INSERT INTO `stud` (`id`, `prn`, `pwd`, `fname`, `mname`, `lname`, `yr`, `bran`, `batch`) VALUES
(1, '2014BIT001', 'e10adc3949ba59abbe56e057f20f883e', 'First', 'Middle', 'Last', '2', 'IT', 1),
(2, '2014BIT002', 'e10adc3949ba59abbe56e057f20f883e', 'Pooja', 'Papa', 'Patil', '2', 'IT', 2),
(3, '2014BIT003', 'e10adc3949ba59abbe56e057f20f883e', 'Netal', 'Papa', 'Mandhane', '3', 'IT', 2),
(4, '2014BIT004', 'e10adc3949ba59abbe56e057f20f883e', 'Shamu', 'Papa', 'Sawant', '2', 'IT', 1),
(5, '2014BCS001', 'e10adc3949ba59abbe56e057f20f883e', 'Vasudha', 'Papa', 'More', '3', 'CSE', 3),
(6, '2013BIT001', 'e10adc3949ba59abbe56e057f20f883e', 'Bijali', 'Papa', 'Chawala', '2', 'IT', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sub`
--

CREATE TABLE `sub` (
  `id` int(11) NOT NULL,
  `ccode` varchar(15) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cred` int(11) NOT NULL,
  `yr` int(11) NOT NULL,
  `branch` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub`
--

INSERT INTO `sub` (`id`, `ccode`, `cname`, `cred`, `yr`, `branch`) VALUES
(1, '2IT401', 'Programmin Lab I', 3, 2, 'IT'),
(2, '2IT406', 'Data Structures Lab', 2, 2, 'IT'),
(3, '4IT201', 'HAHAH Course', 5, 2, 'IT'),
(4, '5IT100', 'New Course', 3, 2, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `tchr`
--

CREATE TABLE `tchr` (
  `id` int(11) NOT NULL,
  `uname` varchar(12) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tchr`
--

INSERT INTO `tchr` (`id`, `uname`, `pwd`, `fname`, `mname`, `lname`) VALUES
(1, 'sps', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'First', 'Middle', 'Last'),
(2, 'priyanka', 'e10adc3949ba59abbe56e057f20f883e', 'Priyanka', 'Papa', 'Raidu');

-- --------------------------------------------------------

--
-- Table structure for table `trsub`
--

CREATE TABLE `trsub` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trsub`
--

INSERT INTO `trsub` (`id`, `tid`, `sid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qstn`
--
ALTER TABLE `qstn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stud`
--
ALTER TABLE `stud`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prn` (`prn`);

--
-- Indexes for table `sub`
--
ALTER TABLE `sub`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ccode` (`ccode`),
  ADD UNIQUE KEY `cname` (`cname`);

--
-- Indexes for table `tchr`
--
ALTER TABLE `tchr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `trsub`
--
ALTER TABLE `trsub`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qstn`
--
ALTER TABLE `qstn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;
--
-- AUTO_INCREMENT for table `stud`
--
ALTER TABLE `stud`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sub`
--
ALTER TABLE `sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tchr`
--
ALTER TABLE `tchr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trsub`
--
ALTER TABLE `trsub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
