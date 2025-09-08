-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 07:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ph906` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ph906`, `username`, `password`, `last_name`, `first_name`, `contact_number`, `address`) VALUES
('John', '0906701', '10310322', NULL, NULL, NULL, NULL),
('Nica', '0906700', '123456', 'Cabigon', 'John Arnel', '1111', 'Sitio City Centralm');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_date`, `event_title`) VALUES
(1, '2025-01-01', 'new year'),
(2, '2025-01-01', 'age 14-15 class'),
(3, '2025-01-04', '9-14'),
(4, '2025-01-11', 'dvdvdvd'),
(6, '2025-09-13', 'First Aid and Rescue Awareness');

-- --------------------------------------------------------

--
-- Table structure for table `masterlist`
--

CREATE TABLE `masterlist` (
  `ph906` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `caseworker_assigned` varchar(255) NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_mobile` varchar(255) DEFAULT NULL,
  `water_baptized` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masterlist`
--

INSERT INTO `masterlist` (`ph906`, `last_name`, `first_name`, `sex`, `birthday`, `age`, `caseworker_assigned`, `teacher`, `mobile`, `nickname`, `mobile_number`, `address`, `guardian_name`, `guardian_mobile`, `water_baptized`) VALUES
('552', 'Nuevo', 'Joanna Mae', 'F', '2004-12-17', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('557', 'Torres', 'Ramciel', 'M', '2003-11-14', 22, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('570', 'Markines', 'Barbette', 'F', '2003-09-19', 22, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('655', 'Coming', 'Jincl', 'F', '2004-10-12', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('666', 'Alolor', 'Fatima', 'F', '2006-09-13', 19, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('667', 'Albaren', 'Julia Francine', 'F', '2007-04-12', 19, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('676', 'Fuentes', 'Niño', 'M', '2005-01-12', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('677', 'Goliat', 'Micky Gean', 'F', '2007-02-27', 19, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('678', 'Gomia', 'Sofia Nicole', 'F', '2007-01-02', 19, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('681', 'Intong', 'Shierra Marie', 'F', '2007-04-06', 19, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('682', 'Invento', 'Jhea', 'F', '2007-07-06', 18, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('687', 'Markines', 'Stephen', 'M', '2004-10-09', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('688', 'Miranda', 'Jasmine', 'F', '2007-01-21', 19, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('689', 'Pason', 'Eula Mae', 'F', '2004-11-15', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('692', 'Rentuma', 'Andrea', 'F', '2003-10-08', 22, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('695', 'Sanchez', 'Franz Bernard', 'M', '2006-04-19', 20, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('696', 'Tejada', 'Chelsy', 'F', '2005-10-12', 20, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('697', 'Villariba', 'Paloma', 'F', '2003-08-24', 22, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('700', 'Biscayno', 'Andrey Mir', 'M', '2006-01-31', 20, 'TBA', 'Aessyl', '09311520166', '', '', '', '', '', ''),
('701', 'Biscayno', 'John Mirson', 'M', '2006-01-31', 20, 'John', 'Aessyl', '', '', '', '', '', '', ''),
('705', 'Castro', 'Janine Rose', 'F', '2007-07-16', 18, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('706', 'DelaCruz', 'Mark Bernard', 'M', '2004-01-15', 22, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('710', 'Flores', 'Sedon', 'M', '2005-06-11', 20, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('714', 'Malinao', 'Lorrain', 'F', '2005-04-29', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('715', 'Niepes', 'Mary Joy', 'F', '2004-06-18', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('716', 'Saga', 'Zildjian', 'M', '2010-10-03', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('718', 'Anga', 'Daniece Joy', 'F', '2010-12-31', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('719', 'Aquino', 'Brianna Shin Niz', 'F', '2011-08-27', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('720', 'Balansag', 'Fionah Adah', 'F', '2009-07-30', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('721', 'Baranggan', 'April Jane', 'F', '2010-04-12', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('722', 'Cabajar', 'Alfred Joseph', 'M', '2009-12-09', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('723', 'Cuevas', 'Jan Clerk', 'M', '2009-01-04', 17, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('727', 'Mahinay', 'Dwayne Steve', 'M', '2011-12-27', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('728', 'Malabago', 'Jean Carmel', 'F', '2011-07-18', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('729', 'Mara', 'Stephanie Kyla', 'F', '2010-03-26', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('730', 'Pelonio', 'Georwel Ann', 'F', '2009-02-16', 17, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('731', 'Pocdol', 'Jasha Mae', 'F', '2009-07-18', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('733', 'Sumaya', 'Kimberly', 'F', '2009-07-27', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('734', 'Salvador', 'Krisha Althea', 'F', '2011-03-15', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('736', 'Vasquez', 'Sarah Jane', 'F', '2010-09-30', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('738', 'Alia', 'Danica', 'F', '2008-12-18', 17, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('740', 'Baquero', 'Debbie Sophia', 'F', '2010-07-25', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('741', 'Cahilig', 'Mark Jhon', 'M', '2010-07-03', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('743', 'Rosario', 'Cham Del', 'M', '2008-05-28', 18, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('744', 'Dinogyao', 'Princess Mae', 'F', '2011-04-21', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('747', 'Hinaloc', 'Erica Mae', 'F', '2008-10-09', 17, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('750', 'Quirong', 'Mary Grace', 'F', '2009-09-18', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('751', 'Quirong', 'Marc Zaijan', 'M', '2009-09-18', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('753', 'Sanchez', 'Aisha Kelly', 'F', '2009-07-15', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('756', 'Tigbas', 'Mary Aicelle', 'F', '2009-11-29', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('757', 'Zabala', 'Jacob', 'M', '2010-12-26', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('758', 'Zabala', 'Matthew', 'M', '2009-01-21', 17, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('759', 'Villaflor', 'Princess Merry', 'F', '2010-12-02', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('760', 'Aguillon', 'Joelbabe', 'F', '2011-01-14', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('761', 'Arboladura', 'Hannah', 'F', '2010-06-11', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('762', 'Asis', 'Jirah Maxwell', 'M', '2009-10-03', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('765', 'Cameros', 'Julianne Joseph', 'M', '2010-11-28', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('766', 'Flores', 'Jaden Kyle', 'M', '2010-04-08', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('767', 'Castro', 'Jessica May', 'F', '2010-05-05', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('768', 'Oyon-oyon', 'Sophia Marie', 'F', '2009-12-31', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('769', 'Palen', 'Jae Driel', 'M', '2011-10-24', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('770', 'Sanchez', 'Rochelle', 'F', '2010-03-23', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('771', 'Cinco', 'Franzin Gem', 'F', '2010-11-16', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('772', 'Tagarao', 'Clark Justin', 'M', '2009-07-15', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('774', 'Reponte', 'Jherniel Jy', 'M', '2009-06-16', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('775', 'Vilbar', 'Herlijah Yvanca', 'F', '2011-02-24', 15, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('776', 'Silao', 'Spyke Macgyver', 'M', '2009-08-04', 16, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('777', 'Trazona', 'Arfil', 'M', '2004-12-17', 21, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('778', 'Trazona', 'Cendie Fil', 'F', '2008-01-28', 18, 'TBA', 'Aessyl', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('779', 'Solitario', 'Jannix Clyde', 'M', '2012-01-12', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('780', 'Villaver', 'Alyssa Joy', 'F', '2012-12-29', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('781', 'Barcoma', 'Calyx Andrei', 'M', '2012-07-20', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('782', 'Tagalog', 'Precious Iona', 'F', '2012-06-15', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('783', 'Villaflor', 'Faith Margarett', 'F', '2012-02-25', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('784', 'Solitario', 'Axcel', 'F', '2012-04-05', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('785', 'Macaraya', 'Red', 'M', '2012-05-15', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('786', 'Quinatadcan', 'Jeselle Mitch', 'F', '2012-12-28', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('787', 'Diamante', 'Franz', 'M', '2012-09-01', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('789', 'Catubay', 'Athena', 'F', '2013-03-16', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('791', 'Patoc', 'Messiah Zeck', 'M', '2012-07-29', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('792', 'Oberes', 'Ashanti Jane', 'F', '2012-03-30', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('793', 'Completo', 'Princess May', 'F', '2012-05-04', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('795', 'Ponce', 'Luke Dominic', 'M', '2012-11-14', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('797', 'Perolino', 'Keirstin Venice', 'F', '2012-09-19', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('798', 'Bohol', 'Shanelle', 'F', '2013-03-21', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('799', 'Ventura', 'John Kim', 'M', '2014-02-06', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('800', 'Aguillon', 'Bridgette Job', 'F', '2014-03-18', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('801', 'Dicdican', 'Michael Lawrence', 'M', '2013-12-12', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('802', 'Petalcorin', 'John Niel', 'M', '2013-06-10', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('803', 'Gallardo', 'Tristan James', 'M', '2012-06-17', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('804', 'Diaz', 'Savannah Reign', 'F', '2012-11-28', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('805', 'Sanchez', 'Macy Sofia', 'F', '2012-10-07', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('806', 'Dicdican', 'Dharwyne Jay', 'M', '2013-02-03', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('808', 'Tanjay', 'Jereanah Mae', 'F', '2013-01-19', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('809', 'Pangilinan', 'Like Leslie', 'F', '2011-07-15', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('810', 'Go', 'Lea Nadine', 'F', '2011-06-30', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('811', 'Fisalbon', 'Reda Kieth Vincent', 'M', '2012-04-05', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('812', 'Plasus', 'John Khoula', 'M', '2012-10-03', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('813', 'Liray', 'Jassien Hayze', 'F', '2013-11-01', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('814', 'Maneha', 'Jelian Rose', 'F', '2014-02-11', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('815', 'Porcia', 'Niña', 'F', '2013-09-10', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('816', 'Roma', 'Jenny Rica', 'F', '2013-08-10', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('817', 'Dolleson', 'Precious Liean', 'F', '2013-08-03', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('819', 'Cabigon', 'Angely', 'F', '2013-08-12', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('820', 'Orbeso', 'Earllen Jay', 'M', '2013-11-03', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('821', 'Ambray', 'Seggie Avier', 'M', '2014-11-26', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('822', 'Sorela', 'Gideon Allen', 'M', '2014-06-05', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('824', 'Sanchez', 'Honey Francine', 'F', '2013-06-20', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('825', 'Villarba', 'Jane Rose', 'F', '2015-03-05', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('826', 'Calambro', 'Brexcil', 'M', '2012-10-30', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('827', 'Laytani', 'Jade Mikhail Aleksandr', 'M', '2013-07-27', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('828', 'Tripoli', 'Andrea Mae', 'F', '2012-05-26', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('829', 'Rita', 'John Del Dela', 'M', '2014-02-05', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('830', 'Dueñas', 'Renzin', 'F', '2014-05-12', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('831', 'Mariquit', 'Eshan Paul', 'M', '2014-11-23', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('832', 'Bocboc', 'Jan Glendel', 'F', '2013-12-05', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('833', 'Tundag', 'Zac Francis', 'M', '2013-03-15', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('834', 'Cruz', 'Xyztzi Edmarl', 'M', '2012-07-30', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('835', 'Christoff', 'Asocro Zeke', 'M', '2015-01-03', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('836', 'Barry', 'Ventura Gierge', 'M', '2014-10-04', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('837', 'Siaton', 'Paul Justine', 'M', '2012-10-14', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('838', 'Sollano', 'Jessie Jr', 'M', '2012-09-22', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('840', 'Chavez', 'Niña Faith', 'F', '2015-01-18', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('841', 'Remelite', 'Jericho', 'M', '2013-07-08', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('842', 'Olmillo', 'Whylm', 'M', '2014-08-31', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('843', 'Inacleto', 'Gin', 'F', '2014-12-26', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('844', 'Silao', 'Hyacinth Mae', 'F', '2012-05-24', 14, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('845', 'Selim', 'Lex Clark', 'M', '2014-10-08', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('846', 'Lucar', 'Anaira Bless', 'F', '2012-10-01', 13, 'TBA', 'John', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('847', 'Sulapas', 'Harven Joseph', 'M', '2013-11-30', 12, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('848', 'Espaltero', 'Frank Kobe', 'M', '2014-10-16', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('849', 'Roz', 'Jie Fyra', 'F', '2015-05-03', 11, 'TBA', 'Andrey', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('850', 'Batiquin', 'Cyrel Gabriel', 'M', '2015-03-08', 11, 'TBA', 'Andrey', '', '', '', 'Sitio San Vicente', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `ph906` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `deadline` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `ph906`, `name`, `address`, `type`, `deadline`, `status`) VALUES
(34, '701', 'john', 'barangay luz', 'Reply lettess', '2025-09-11', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `student_history`
--

CREATE TABLE `student_history` (
  `id` int(11) NOT NULL,
  `ph906` varchar(50) NOT NULL,
  `history_text` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `admin_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_history`
--

INSERT INTO `student_history` (`id`, `ph906`, `history_text`, `timestamp`, `admin_id`) VALUES
(21, '701', 'YEYEYEYEYE', '2025-09-09 01:11:25', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ph906`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masterlist`
--
ALTER TABLE `masterlist`
  ADD PRIMARY KEY (`ph906`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_history`
--
ALTER TABLE `student_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ph906` (`ph906`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `student_history`
--
ALTER TABLE `student_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_history`
--
ALTER TABLE `student_history`
  ADD CONSTRAINT `student_history_ibfk_1` FOREIGN KEY (`ph906`) REFERENCES `masterlist` (`ph906`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
