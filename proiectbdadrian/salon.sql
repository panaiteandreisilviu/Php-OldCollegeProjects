-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2016 at 08:26 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `angajat`
--

CREATE TABLE `angajat` (
  `ID_ANGAJAT` int(11) NOT NULL,
  `ID_CATEGORIE` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(64) NOT NULL,
  `usertype` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angajat`
--

INSERT INTO `angajat` (`ID_ANGAJAT`, `ID_CATEGORIE`, `Nume`, `Prenume`, `username`, `password`, `usertype`) VALUES
(1, 1, 'Popescu', 'Alexandru', 'alexandra10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(2, 1, 'Cojocaru', 'Ana', 'ana19', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(3, 2, 'Preda', 'Iulia', 'iulia10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(4, 2, 'Ispas', 'Luiza', 'luiza10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(5, 3, 'Oancea', 'Alina', 'alina10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(6, 3, 'Iacob', 'Andreea', 'andreea11', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(7, 4, 'Dumitrache', 'Luminita', 'luminita10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(8, 4, 'Irava', 'Alexandra', 'alexandra12', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(9, 5, 'Botezatu', 'Dragos', 'dragos10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(10, 5, 'Dulgheru', 'Monica', 'monica10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(11, 1, 'Sismanian', 'Vlad', 'vlad10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(12, 3, 'Petre', 'Pavel', 'pavel10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 1),
(13, 1, 'Grigore', 'Ion', 'admin', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `ID_CATEGORIE` int(11) NOT NULL,
  `Denumire` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID_CATEGORIE`, `Denumire`) VALUES
(1, 'Coafura'),
(2, 'Manichiura'),
(3, 'Cosmetica'),
(4, 'Machiaj'),
(5, 'Masaj');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID_CLIENT` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `Telefon` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID_CLIENT`, `Nume`, `Prenume`, `Telefon`, `username`, `password`) VALUES
(1, 'Ionescu', 'Ionica', '0760898989', 'user', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312'),
(2, 'Oancea', 'Catalin', '0721258258', 'catalin10', 'a80b568a237f50391d2f1f97beaf99564e33d2e1c8a2e5cac21ceda701570312'),
(3, 'Patrascu', 'Mihai', '0742656565', 'mihai_10', '2fd2f0989497f9a8819b0d8464becf762a27fab7b6475e8a9ef1a26c60c77452'),
(4, 'Badea', 'Ionut', '0762185985', 'ionut_10', '2fd2f0989497f9a8819b0d8464becf762a27fab7b6475e8a9ef1a26c60c77452'),
(5, 'Dumitrache', 'Monica', '0759184214', 'monica_10', '2fd2f0989497f9a8819b0d8464becf762a27fab7b6475e8a9ef1a26c60c77452'),
(6, 'Baltac', 'Adrian', '0778492649', 'adrian_10', '2fd2f0989497f9a8819b0d8464becf762a27fab7b6475e8a9ef1a26c60c77452'),
(7, 'Ganea', 'Aurel', '0736581284', 'aurel_10', '2fd2f0989497f9a8819b0d8464becf762a27fab7b6475e8a9ef1a26c60c77452'),
(9, 'Dinu', 'Theodora', '0752814648', 'theodora_10', '2fd2f0989497f9a8819b0d8464becf762a27fab7b6475e8a9ef1a26c60c77452');

-- --------------------------------------------------------

--
-- Table structure for table `detalii_programare`
--

CREATE TABLE `detalii_programare` (
  `ID_DETALII_PROGRAMARE` int(11) NOT NULL,
  `ID_PROGRAMARE` int(11) NOT NULL,
  `ID_ANGAJAT` int(11) NOT NULL,
  `ID_SERVICIU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalii_programare`
--

INSERT INTO `detalii_programare` (`ID_DETALII_PROGRAMARE`, `ID_PROGRAMARE`, `ID_ANGAJAT`, `ID_SERVICIU`) VALUES
(1, 1, 4, 2),
(2, 1, 3, 12),
(3, 2, 7, 4),
(4, 9, 5, 5),
(5, 9, 6, 9),
(6, 10, 5, 23),
(7, 11, 4, 3),
(8, 11, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `programare`
--

CREATE TABLE `programare` (
  `ID_PROGRAMARE` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `DataProgramare` date DEFAULT NULL,
  `Ora` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programare`
--

INSERT INTO `programare` (`ID_PROGRAMARE`, `ID_CLIENT`, `DataProgramare`, `Ora`) VALUES
(1, 1, '2016-01-29', '17:30:20'),
(2, 2, '2016-01-18', '09:20:40'),
(7, 4, '2016-01-18', '19:00:00'),
(9, 9, '2016-01-18', '01:00:00'),
(10, 1, '2014-11-19', '13:00:00'),
(11, 5, '2016-01-18', '01:00:00'),
(13, 9, '2016-01-18', '17:30:20'),
(14, 7, '2016-01-13', '	19:00:00'),
(16, 7, '2016-01-13', '	19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `serviciu`
--

CREATE TABLE `serviciu` (
  `ID_SERVICIU` int(11) NOT NULL,
  `ID_CATEGORIE` int(11) NOT NULL,
  `Denumire` varchar(30) NOT NULL,
  `Durata` varchar(5) NOT NULL,
  `Pret` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviciu`
--

INSERT INTO `serviciu` (`ID_SERVICIU`, `ID_CATEGORIE`, `Denumire`, `Durata`, `Pret`) VALUES
(1, 1, 'Tuns Barbati', '15', '10'),
(2, 1, 'Tuns Femei', '15', '20'),
(3, 1, 'Spalat Par', '10', '5'),
(4, 1, 'Coafat Par Mediu', '30', '30'),
(5, 1, 'Coafat Par Lung', '45', '60'),
(6, 1, 'Vopsit Par Mediu', '30', '40'),
(7, 1, 'Vopsit Par Lung', '30', '50'),
(8, 2, 'Manichiura Clasica', '20', '25'),
(9, 2, 'Pedichiura Clasica', '20', '25'),
(10, 2, 'Pictura Per Unghie', '10', '10'),
(11, 2, 'Constructie Gel', '40', '60'),
(12, 2, 'Intretinere Gel', '25', '30'),
(13, 3, 'Epilat Lung', '30', '30'),
(14, 3, 'Epilat Scurt', '40', '40'),
(15, 3, 'Epilat Inghinal', '10', '20'),
(16, 3, 'Epilat Axial', '10', '15'),
(17, 3, 'Epilat Brate', '30', '30'),
(18, 3, 'Pensat', '30', '20'),
(19, 4, 'Machiaj de zi', '30', '40'),
(20, 4, 'Machiaz de reimprospatare', '20', '30'),
(21, 4, 'Machiaj de seara', '30', '60'),
(22, 5, 'Masaj de relaxare', '60', '80'),
(23, 5, 'Masaj anticelulitic', '30', '60'),
(24, 5, 'Masaj de slabire', '40', '50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajat`
--
ALTER TABLE `angajat`
  ADD PRIMARY KEY (`ID_ANGAJAT`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `ID_FUNCTIE` (`ID_CATEGORIE`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID_CATEGORIE`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_CLIENT`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `detalii_programare`
--
ALTER TABLE `detalii_programare`
  ADD PRIMARY KEY (`ID_DETALII_PROGRAMARE`),
  ADD KEY `ID_PROGRAMARE` (`ID_PROGRAMARE`),
  ADD KEY `ID_ANGAJAT` (`ID_ANGAJAT`),
  ADD KEY `ID_SERVICIU` (`ID_SERVICIU`);

--
-- Indexes for table `programare`
--
ALTER TABLE `programare`
  ADD PRIMARY KEY (`ID_PROGRAMARE`),
  ADD KEY `ID_CLIENT` (`ID_CLIENT`);

--
-- Indexes for table `serviciu`
--
ALTER TABLE `serviciu`
  ADD PRIMARY KEY (`ID_SERVICIU`),
  ADD KEY `ID_CATEGORIE` (`ID_CATEGORIE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajat`
--
ALTER TABLE `angajat`
  MODIFY `ID_ANGAJAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `detalii_programare`
--
ALTER TABLE `detalii_programare`
  MODIFY `ID_DETALII_PROGRAMARE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `programare`
--
ALTER TABLE `programare`
  MODIFY `ID_PROGRAMARE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `serviciu`
--
ALTER TABLE `serviciu`
  MODIFY `ID_SERVICIU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `angajat`
--
ALTER TABLE `angajat`
  ADD CONSTRAINT `ANGAJAT_FUNCTIE_ID_FK` FOREIGN KEY (`ID_CATEGORIE`) REFERENCES `categorie` (`ID_CATEGORIE`) ON UPDATE CASCADE;

--
-- Constraints for table `detalii_programare`
--
ALTER TABLE `detalii_programare`
  ADD CONSTRAINT `DETALII_ANGAJAT_ID_FK` FOREIGN KEY (`ID_ANGAJAT`) REFERENCES `angajat` (`ID_ANGAJAT`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DETALII_PROGRAMARE_ID_FK` FOREIGN KEY (`ID_PROGRAMARE`) REFERENCES `programare` (`ID_PROGRAMARE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `DETALII_SERVICIU_ID_FK` FOREIGN KEY (`ID_SERVICIU`) REFERENCES `serviciu` (`ID_SERVICIU`) ON UPDATE CASCADE;

--
-- Constraints for table `programare`
--
ALTER TABLE `programare`
  ADD CONSTRAINT `PROGRAMARE_CLIENT_ID_FK` FOREIGN KEY (`ID_CLIENT`) REFERENCES `client` (`ID_CLIENT`) ON UPDATE CASCADE;

--
-- Constraints for table `serviciu`
--
ALTER TABLE `serviciu`
  ADD CONSTRAINT `SERVICIU_CATEGORIE_ID_FK` FOREIGN KEY (`ID_CATEGORIE`) REFERENCES `categorie` (`ID_CATEGORIE`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
