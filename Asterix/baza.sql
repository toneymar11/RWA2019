-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2019 at 09:13 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `jelo`
--

CREATE TABLE `jelo` (
  `id` int(11) NOT NULL,
  `ime_jela` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `url_slike` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cijena` decimal(13,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jelo`
--

INSERT INTO `jelo` (`id`, `ime_jela`, `url_slike`, `cijena`) VALUES
(1, 'Mesna plata', 'images/menu-list/mesna_plata.jpg', '49'),
(2, 'Capricciosa', 'images/menu-list/capricciosa.jpg', '13'),
(8, 'Čevapčići', 'images/menu-list/čevapi-ili-ćevapi.jpg', '10');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `broj` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `rola` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `email`, `lozinka`, `adresa`, `grad`, `broj`, `rola`) VALUES
(18, 'Admin', 'Admin', 'admin@admin.com', 'admin', '', '', '', 0),
(19, 'User', 'User', 'user@user.com', 'user', 'Franjevačka', 'Mostar', '063123123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE `narudzba` (
  `id` int(11) NOT NULL,
  `korisnik_id` int(11) DEFAULT NULL,
  `narudzba` varchar(255) DEFAULT NULL,
  `vrijeme_narudzbe` datetime DEFAULT NULL,
  `vrijeme_dostave` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`id`, `korisnik_id`, `narudzba`, `vrijeme_narudzbe`, `vrijeme_dostave`) VALUES
(13, 19, '{\"8\":1,\"1\":2}', '2019-07-07 20:52:04', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jelo`
--
ALTER TABLE `jelo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jelo`
--
ALTER TABLE `jelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
