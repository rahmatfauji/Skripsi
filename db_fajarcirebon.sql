-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2019 at 08:51 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fajarcirebon`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id_bobot` varchar(10) NOT NULL,
  `id_penilaian` varchar(5) NOT NULL,
  `bobot_c1` int(1) NOT NULL,
  `bobot_c2` int(1) NOT NULL,
  `bobot_c3` int(1) NOT NULL,
  `bobot_c4` int(1) NOT NULL,
  `bobot_c5` int(1) NOT NULL,
  `bobot_c6` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id_bobot`, `id_penilaian`, `bobot_c1`, `bobot_c2`, `bobot_c3`, `bobot_c4`, `bobot_c5`, `bobot_c6`) VALUES
('BOBOTPL002', 'PL002', 2, 2, 1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `id_detail` varchar(20) NOT NULL,
  `id_penilaian` varchar(5) NOT NULL,
  `id_karyawan` varchar(12) NOT NULL,
  `c1` int(2) NOT NULL,
  `c2` int(2) NOT NULL,
  `c3` int(2) NOT NULL,
  `c4` int(2) NOT NULL,
  `c5` int(2) NOT NULL,
  `c6` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_nilai`
--

INSERT INTO `detail_nilai` (`id_detail`, `id_penilaian`, `id_karyawan`, `c1`, `c2`, `c3`, `c4`, `c5`, `c6`) VALUES
('PL0022012-06-0050', 'PL002', '2012-06-0050', 5, 2, 5, 2, 5, 2),
('PL0022013-02-0059', 'PL002', '2013-02-0059', 4, 4, 4, 4, 4, 4),
('PL0022013-04-0063', 'PL002', '2013-04-0063', 4, 4, 4, 4, 4, 4),
('PL0022013-09-0069', 'PL002', '2013-09-0069', 3, 3, 3, 3, 3, 3),
('PL0022015-11-0080', 'PL002', '2015-11-0080', 4, 5, 2, 2, 3, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `hasilhitung`
-- (See below for the actual view)
--
CREATE TABLE `hasilhitung` (
`id_penilaian` varchar(5)
,`id_karyawan` varchar(12)
,`C1` decimal(14,4)
,`C2` decimal(14,4)
,`C3` decimal(14,4)
,`C4` decimal(14,4)
,`C5` decimal(14,4)
,`C6` decimal(14,4)
,`Total` decimal(29,4)
);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(5) NOT NULL,
  `posisi_jabatan` varchar(30) NOT NULL,
  `status_jabatan` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `posisi_jabatan`, `status_jabatan`) VALUES
('PJ005', 'Staf Personalia', 'y'),
('PJ006', 'Staf Layout', 'y'),
('PJ007', 'Staf IT', 'y'),
('PJ008', 'manajer', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(12) NOT NULL DEFAULT '',
  `nama_karyawan` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `id_jabatan` varchar(5) NOT NULL,
  `status_karyawan` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `alamat`, `jk`, `id_jabatan`, `status_karyawan`) VALUES
('1111-11-1111', 'aaaa', 'aaaaaaaa', 'P', 'PJ007', 'n'),
('2012-06-0050', 'Fajar Sidiq Yunanda', 'Cirebon', 'L', 'PJ005', 'y'),
('2013-02-0059', 'Akhmad Royani', 'Cirebon', 'L', 'PJ006', 'y'),
('2013-04-0063', 'Sri Yani', 'Cirebon', 'P', 'PJ005', 'y'),
('2013-09-0069', 'Eris Prayatama', 'Majalengka', 'L', 'PJ006', 'y'),
('2015-11-0080', 'Fatianto Fadhillah', 'Cirebon', 'L', 'PJ007', 'y'),
('5555-55-5555', 'adadad', 'ddddd', 'P', 'PJ007', 'n'),
('7777-44-5555', 'cece', 'crb', 'L', 'PJ005', 'n'),
('9898-55-6698', 'dewa', 'cirebon', 'L', 'PJ006', 'n'),
('9999-99-9999', 'Dede', 'Cirebon', 'L', 'PJ005', 'n');

-- --------------------------------------------------------

--
-- Stand-in structure for view `nilaimaksimal`
-- (See below for the actual view)
--
CREATE TABLE `nilaimaksimal` (
`id_penilaian` varchar(5)
,`mC1` int(2)
,`mC2` int(2)
,`mC3` int(2)
,`mC4` int(2)
,`mC5` int(2)
,`mC6` int(2)
);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` varchar(5) NOT NULL,
  `waktu` year(4) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `status_penilaian` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `waktu`, `keterangan`, `status_penilaian`) VALUES
('PL002', 2020, 'Penilaian tahunan', 'y');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ranking`
-- (See below for the actual view)
--
CREATE TABLE `ranking` (
`id_penilaian` varchar(5)
,`id_karyawan` varchar(12)
,`Total` decimal(29,4)
,`ranking` int(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(1) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Structure for view `hasilhitung`
--
DROP TABLE IF EXISTS `hasilhitung`;

CREATE ALGORITHM=MERGE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hasilhitung`  AS  select `detail_nilai`.`id_penilaian` AS `id_penilaian`,`detail_nilai`.`id_karyawan` AS `id_karyawan`,(`detail_nilai`.`c1` / `nilaimaksimal`.`mC1`) AS `C1`,(`detail_nilai`.`c2` / `nilaimaksimal`.`mC2`) AS `C2`,(`detail_nilai`.`c3` / `nilaimaksimal`.`mC3`) AS `C3`,(`detail_nilai`.`c4` / `nilaimaksimal`.`mC4`) AS `C4`,(`detail_nilai`.`c5` / `nilaimaksimal`.`mC5`) AS `C5`,(`detail_nilai`.`c6` / `nilaimaksimal`.`mC6`) AS `C6`,(((((((`detail_nilai`.`c1` / `nilaimaksimal`.`mC1`) * `bobot`.`bobot_c1`) + ((`detail_nilai`.`c2` / `nilaimaksimal`.`mC2`) * `bobot`.`bobot_c2`)) + ((`detail_nilai`.`c3` / `nilaimaksimal`.`mC3`) * `bobot`.`bobot_c3`)) + ((`detail_nilai`.`c4` / `nilaimaksimal`.`mC4`) * `bobot`.`bobot_c4`)) + ((`detail_nilai`.`c5` / `nilaimaksimal`.`mC5`) * `bobot`.`bobot_c5`)) + ((`detail_nilai`.`c6` / `nilaimaksimal`.`mC6`) * `bobot`.`bobot_c6`)) AS `Total` from (((`detail_nilai` join `nilaimaksimal`) join `bobot`) join `penilaian`) where ((`nilaimaksimal`.`id_penilaian` = `penilaian`.`id_penilaian`) and (`detail_nilai`.`id_penilaian` = `penilaian`.`id_penilaian`) and (`bobot`.`id_penilaian` = `penilaian`.`id_penilaian`)) ;

-- --------------------------------------------------------

--
-- Structure for view `nilaimaksimal`
--
DROP TABLE IF EXISTS `nilaimaksimal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilaimaksimal`  AS  select `detail_nilai`.`id_penilaian` AS `id_penilaian`,max(`detail_nilai`.`c1`) AS `mC1`,max(`detail_nilai`.`c2`) AS `mC2`,max(`detail_nilai`.`c3`) AS `mC3`,max(`detail_nilai`.`c4`) AS `mC4`,max(`detail_nilai`.`c5`) AS `mC5`,max(`detail_nilai`.`c6`) AS `mC6` from `detail_nilai` group by `detail_nilai`.`id_penilaian` ;

-- --------------------------------------------------------

--
-- Structure for view `ranking`
--
DROP TABLE IF EXISTS `ranking`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ranking`  AS  select `hasilhitung`.`id_penilaian` AS `id_penilaian`,`hasilhitung`.`id_karyawan` AS `id_karyawan`,`hasilhitung`.`Total` AS `Total`,(select find_in_set(`hasilhitung`.`Total`,(select group_concat(distinct `hasilhitung`.`Total` order by `hasilhitung`.`Total` DESC separator ',') from `hasilhitung` where (`hasilhitung`.`id_penilaian` = `penilaian`.`id_penilaian`)))) AS `ranking` from (`hasilhitung` join `penilaian`) where (`hasilhitung`.`id_penilaian` = `penilaian`.`id_penilaian`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
