-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 09, 2016 at 11:44 PM
-- Server version: 1.0.109
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `salon`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `angajat`
-- 

CREATE TABLE `angajat` (
  `ID_ANGAJAT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_FUNCTIE` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_ANGAJAT`),
  KEY `ID_FUNCTIE` (`ID_FUNCTIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `angajat`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `categorie`
-- 

CREATE TABLE `categorie` (
  `ID_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `Denumire` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_CATEGORIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `categorie`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `client`
-- 

CREATE TABLE `client` (
  `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `Telefon` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `client`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `detalii_programare`
-- 

CREATE TABLE `detalii_programare` (
  `ID_DETALII_PROGRAMARE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROGRAMARE` int(11) NOT NULL,
  `ID_ANGAJAT` int(11) NOT NULL,
  `ID_SERVICIU` int(11) NOT NULL,
  PRIMARY KEY (`ID_DETALII_PROGRAMARE`),
  KEY `ID_PROGRAMARE` (`ID_PROGRAMARE`),
  KEY `ID_ANGAJAT` (`ID_ANGAJAT`),
  KEY `ID_SERVICIU` (`ID_SERVICIU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `detalii_programare`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `functie`
-- 

CREATE TABLE `functie` (
  `ID_FUNCTIE` int(11) NOT NULL AUTO_INCREMENT,
  `Denumire` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_FUNCTIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `functie`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `programare`
-- 

CREATE TABLE `programare` (
  `ID_PROGRAMARE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENT` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Ora` time NOT NULL,
  PRIMARY KEY (`ID_PROGRAMARE`),
  KEY `ID_CLIENT` (`ID_CLIENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `programare`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `serviciu`
-- 

CREATE TABLE `serviciu` (
  `ID_SERVICIU` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CATEGORIE` int(11) NOT NULL,
  `Denumire` varchar(30) NOT NULL,
  `Durata` varchar(5) NOT NULL,
  `Pret` decimal(12,0) NOT NULL,
  PRIMARY KEY (`ID_SERVICIU`),
  KEY `ID_CATEGORIE` (`ID_CATEGORIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `serviciu`
-- 


-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `angajat`
-- 
ALTER TABLE `angajat`
  ADD CONSTRAINT `ANGAJAT_FUNCTIE_ID_FK` FOREIGN KEY (`ID_FUNCTIE`) REFERENCES `functie` (`ID_FUNCTIE`) ON UPDATE CASCADE;

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
