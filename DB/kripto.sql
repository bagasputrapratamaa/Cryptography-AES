-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2020 at 07:14 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kripto`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `file_name_source` varchar(255) NOT NULL,
  `file_name_finish` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `file_size` float NOT NULL,
  `password` varchar(40) NOT NULL,
  `tgl_upload` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `username`, `file_name_source`, `file_name_finish`, `file_url`, `file_size`, `password`, `tgl_upload`, `status`, `keterangan`) VALUES
(15, 'admin', 'coba.docx', 'coba.rda', 'file_encrypt/coba.rda', 9.83594, '202cb962ac59075b', '2020-12-21 14:52:50', 2, '123'),
(16, 'admin', '13.-BAB-III.pdf', '13.-BAB-III.rda', 'file_encrypt/13.-BAB-III.rda', 1073.94, '202cb962ac59075b', '2020-12-21 14:51:27', 1, '123'),
(17, 'admin', '2006-2-01268-IF-Bab-2.pdf', '2006-2-01268-IF-Bab-2.rda', 'file_encrypt/2006-2-01268-IF-Bab-2.rda', 128.145, '202cb962ac59075b', '2020-12-21 14:52:35', 1, '123'),
(18, 'admin', 'coba.docx', 'coba.rda', 'file_encrypt/coba.rda', 9.83594, 'c4ca4238a0b92382', '2020-12-22 08:22:04', 2, '1'),
(19, 'admin', 'coba.docx', 'coba.rda', 'file_encrypt/coba.rda', 9.83594, 'c81e728d9d4c2f63', '2020-12-22 08:24:54', 1, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `job_title` varchar(40) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin 2:manajer 3:pimpinan 4:karyawan'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fullname`, `job_title`, `level`) VALUES
(3, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Bagas Putra', 'Administrator', 1),
(19, 'direktur', 'ef55c764d670377f3b24cf6d065252f06ee031c5', 'dedek satrio', 'Direktur', 2),
(20, 'operationmanager', '2891baceeef1652ee698294da0e71ba78a2a4064', 'Sawal', 'Operation Manager', 3),
(21, 'marketingmanager', '8ede292aa080ad075b329e70dc3f831832016893', 'kicol', 'Marketing Manager', 4),
(25, 'bagas', 'cd19030730b5774fc3bd4c5bc9a956b34702d6f3', 'Bagas Putra', 'direktur', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
