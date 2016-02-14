-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Φεβ 2016 στις 20:42:44
-- Έκδοση διακομιστή: 5.6.17
-- Έκδοση PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `medrec`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postalcode` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `alternate` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `addresses`
--

INSERT INTO `addresses` (`id`, `medrecid`, `country`, `city`, `postalcode`, `address`, `alternate`, `users_id`) VALUES
(1, 'jlqhmnxjdz', '', '', '', '', 0, 108),
(2, 'jlqhmnxjdz', '', '', '', '', 1, 108),
(3, 'cfiptiljtk', '', '', '', '', 0, 108),
(4, 'cfiptiljtk', '', '', '', '', 1, 108),
(5, 'fltevpzwfh', '', '', '', '', 0, 108),
(6, 'fltevpzwfh', '', '', '', '', 1, 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `currentstatus`
--

CREATE TABLE `currentstatus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `mtreatment` varchar(255) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `currentstatus`
--

INSERT INTO `currentstatus` (`id`, `medrecid`, `diagnosis`, `mtreatment`, `start`, `end`, `users_id`) VALUES
(1, 'jlqhmnxjdz', '', '', '0000-00-00', '0000-00-00', 108),
(2, 'cfiptiljtk', '', '', '0000-00-00', '0000-00-00', 108),
(3, 'fltevpzwfh', '', '', '0000-00-00', '0000-00-00', 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `dis_options`
--

CREATE TABLE `dis_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `dis_options`
--

INSERT INTO `dis_options` (`id`, `name`) VALUES
(1, 'Chicken Pox'),
(2, 'Hepatitis'),
(3, 'Measles'),
(4, 'Mumps'),
(5, 'Pertussis /Whooping Cough'),
(6, 'Pneumonia'),
(7, 'Polio'),
(8, 'Rubella'),
(9, 'Scarlet Fever');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `fmhistory`
--

CREATE TABLE `fmhistory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) DEFAULT NULL,
  `mother` varchar(255) DEFAULT NULL,
  `father` varchar(255) DEFAULT NULL,
  `siblings` varchar(255) DEFAULT NULL,
  `grandparents` varchar(255) DEFAULT NULL,
  `children` varchar(255) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL,
  `fmh_options_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `fmhistory`
--

INSERT INTO `fmhistory` (`id`, `medrecid`, `mother`, `father`, `siblings`, `grandparents`, `children`, `users_id`, `fmh_options_id`) VALUES
(1, 'jlqhmnxjdz', '', '', '', '', '', 108, 1),
(2, 'jlqhmnxjdz', '', '', '', '', '', 108, 2),
(3, 'jlqhmnxjdz', '', '', '', '', '', 108, 3),
(4, 'jlqhmnxjdz', '', '', '', '', '', 108, 4),
(5, 'jlqhmnxjdz', '', '', '', '', '', 108, 5),
(6, 'jlqhmnxjdz', '', '', '', '', '', 108, 6),
(7, 'jlqhmnxjdz', '', '', '', '', '', 108, 7),
(8, 'jlqhmnxjdz', '', '', '', '', '', 108, 8),
(9, 'jlqhmnxjdz', '', '', '', '', '', 108, 9),
(10, 'jlqhmnxjdz', '', '', '', '', '', 108, 10),
(11, 'jlqhmnxjdz', '', '', '', '', '', 108, 11),
(12, 'jlqhmnxjdz', '', '', '', '', '', 108, 12),
(13, 'jlqhmnxjdz', '', '', '', '', '', 108, 13),
(14, 'jlqhmnxjdz', '', '', '', '', '', 108, 14),
(15, 'jlqhmnxjdz', '', '', '', '', '', 108, 15),
(16, 'jlqhmnxjdz', '', '', '', '', '', 108, 16),
(17, 'jlqhmnxjdz', '', '', '', '', '', 108, 17),
(18, 'jlqhmnxjdz', '', '', '', '', '', 108, 18),
(19, 'jlqhmnxjdz', '', '', '', '', '', 108, 19),
(20, 'jlqhmnxjdz', '', '', '', '', '', 108, 20),
(21, 'jlqhmnxjdz', '', '', '', '', '', 108, 21),
(22, 'jlqhmnxjdz', '', '', '', '', '', 108, 22),
(23, 'jlqhmnxjdz', '', '', '', '', '', 108, 23),
(24, 'jlqhmnxjdz', '', '', '', '', '', 108, 24),
(25, 'cfiptiljtk', '', '', '', '', '', 108, 1),
(26, 'cfiptiljtk', '', '', '', '', '', 108, 2),
(27, 'cfiptiljtk', '', '', '', '', '', 108, 3),
(28, 'cfiptiljtk', '', '', '', '', '', 108, 4),
(29, 'cfiptiljtk', '', '', '', '', '', 108, 5),
(30, 'cfiptiljtk', '', '', '', '', '', 108, 6),
(31, 'cfiptiljtk', '', '', '', '', '', 108, 7),
(32, 'cfiptiljtk', '', '', '', '', '', 108, 8),
(33, 'cfiptiljtk', '', '', '', '', '', 108, 9),
(34, 'cfiptiljtk', '', '', '', '', '', 108, 10),
(35, 'cfiptiljtk', '', '', '', '', '', 108, 11),
(36, 'cfiptiljtk', '', '', '', '', '', 108, 12),
(37, 'cfiptiljtk', '', '', '', '', '', 108, 13),
(38, 'cfiptiljtk', '', '', '', '', '', 108, 14),
(39, 'cfiptiljtk', '', '', '', '', '', 108, 15),
(40, 'cfiptiljtk', '', '', '', '', '', 108, 16),
(41, 'cfiptiljtk', '', '', '', '', '', 108, 17),
(42, 'cfiptiljtk', '', '', '', '', '', 108, 18),
(43, 'cfiptiljtk', '', '', '', '', '', 108, 19),
(44, 'cfiptiljtk', '', '', '', '', '', 108, 20),
(45, 'cfiptiljtk', '', '', '', '', '', 108, 21),
(46, 'cfiptiljtk', '', '', '', '', '', 108, 22),
(47, 'cfiptiljtk', '', '', '', '', '', 108, 23),
(48, 'cfiptiljtk', '', '', '', '', '', 108, 24),
(49, 'fltevpzwfh', '', '', '', '', '', 108, 1),
(50, 'fltevpzwfh', '', '', '', '', '', 108, 2),
(51, 'fltevpzwfh', '', '', '', '', '', 108, 3),
(52, 'fltevpzwfh', '', '', '', '', '', 108, 4),
(53, 'fltevpzwfh', '', '', '', '', '', 108, 5),
(54, 'fltevpzwfh', '', '', '', '', '', 108, 6),
(55, 'fltevpzwfh', '', '', '', '', '', 108, 7),
(56, 'fltevpzwfh', '', '', '', '', '', 108, 8),
(57, 'fltevpzwfh', '', '', '', '', '', 108, 9),
(58, 'fltevpzwfh', '', '', '', '', '', 108, 10),
(59, 'fltevpzwfh', '', '', '', '', '', 108, 11),
(60, 'fltevpzwfh', '', '', '', '', '', 108, 12),
(61, 'fltevpzwfh', '', '', '', '', '', 108, 13),
(62, 'fltevpzwfh', '', '', '', '', '', 108, 14),
(63, 'fltevpzwfh', '', '', '', '', '', 108, 15),
(64, 'fltevpzwfh', '', '', '', '', '', 108, 16),
(65, 'fltevpzwfh', '', '', '', '', '', 108, 17),
(66, 'fltevpzwfh', '', '', '', '', '', 108, 18),
(67, 'fltevpzwfh', '', '', '', '', '', 108, 19),
(68, 'fltevpzwfh', '', '', '', '', '', 108, 20),
(69, 'fltevpzwfh', '', '', '', '', '', 108, 21),
(70, 'fltevpzwfh', '', '', '', '', '', 108, 22),
(71, 'fltevpzwfh', '', '', '', '', '', 108, 23),
(72, 'fltevpzwfh', '', '', '', '', '', 108, 24);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `fmh_options`
--

CREATE TABLE `fmh_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `fmh_options`
--

INSERT INTO `fmh_options` (`id`, `name`) VALUES
(1, 'Enter ages of relatives'),
(2, 'If deceased, indicate age and cause of death'),
(3, 'Alcoholism'),
(4, 'Arthritis '),
(5, 'Asthma'),
(6, 'Cancer'),
(7, 'Diabetes'),
(8, 'Emphysema'),
(9, 'Glaucoma'),
(10, 'Heart Condition'),
(11, 'Hemodialysis'),
(12, 'Hepatitis'),
(13, 'High Blood Cholestrol'),
(14, 'High Blood Pressure'),
(15, 'Kidney Disease'),
(16, 'Mental Retardation'),
(17, 'Rheumatic Fever'),
(18, 'Seizures'),
(19, 'Smoking'),
(20, 'Stomach Liver or Intestinal Problems'),
(21, 'Stroke'),
(22, 'Thyroid Disorders'),
(23, 'Tuberculosis'),
(24, 'Tumor');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) NOT NULL,
  `patient_id` bigint(20) NOT NULL,
  `doctor_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `icontacts`
--

CREATE TABLE `icontacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `hphone` varchar(255) DEFAULT NULL,
  `cphone` varchar(255) DEFAULT NULL,
  `wphone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alternate` tinyint(1) NOT NULL DEFAULT '0',
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `icontacts`
--

INSERT INTO `icontacts` (`id`, `medrecid`, `hphone`, `cphone`, `wphone`, `fax`, `email`, `alternate`, `users_id`) VALUES
(1, 'jlqhmnxjdz', '', '', '', '', '', 0, 108),
(2, 'jlqhmnxjdz', '', '', '', '', '', 1, 108),
(3, 'cfiptiljtk', '', '', '', '', '', 0, 108),
(4, 'cfiptiljtk', '', '', '', '', '', 1, 108),
(5, 'fltevpzwfh', '', '', '', '', '', 0, 108),
(6, 'fltevpzwfh', '', '', '', '', '', 1, 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `identifications`
--

CREATE TABLE `identifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `btype` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `weight` decimal(10,0) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `identifications`
--

INSERT INTO `identifications` (`id`, `medrecid`, `fname`, `occupation`, `language`, `dob`, `btype`, `sex`, `height`, `weight`, `users_id`) VALUES
(1, 'jlqhmnxjdz', 'Î“ÎµÏ‰ÏÎ³Î¹Î±Î´Î·Ï‚ ÎÎ¯ÎºÎ¿Ï‚', '', '', '0000-01-19', '', 'Male', 0.1, '1', 108),
(2, 'fltevpzwfh', 'George Panagiwtou', '', '', '0000-00-00', '', '', 0.1, '1', 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `immunizations`
--

CREATE TABLE `immunizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `agea` int(11) DEFAULT NULL,
  `datea` date DEFAULT NULL,
  `ageb` int(11) DEFAULT NULL,
  `dateb` date DEFAULT NULL,
  `agec` int(11) DEFAULT NULL,
  `datec` date DEFAULT NULL,
  `users_id` bigint(20) NOT NULL,
  `im_options_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `immunizations`
--

INSERT INTO `immunizations` (`id`, `medrecid`, `agea`, `datea`, `ageb`, `dateb`, `agec`, `datec`, `users_id`, `im_options_id`) VALUES
(1, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 1),
(2, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 2),
(3, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 3),
(4, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 4),
(5, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 5),
(6, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 6),
(7, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 7),
(8, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 8),
(9, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 9),
(10, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 10),
(11, 'jlqhmnxjdz', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 11),
(12, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 1),
(13, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 2),
(14, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 3),
(15, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 4),
(16, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 5),
(17, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 6),
(18, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 7),
(19, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 8),
(20, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 9),
(21, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 10),
(22, 'cfiptiljtk', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 11),
(23, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 1),
(24, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 2),
(25, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 3),
(26, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 4),
(27, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 5),
(28, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 6),
(29, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 7),
(30, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 8),
(31, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 9),
(32, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 10),
(33, 'fltevpzwfh', 0, '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 108, 11);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `im_options`
--

CREATE TABLE `im_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `im_options`
--

INSERT INTO `im_options` (`id`, `name`) VALUES
(1, 'Diptheria'),
(2, 'Hepatitis B '),
(3, 'Measles'),
(4, 'Mumps'),
(5, 'Pertussis/Whooping Cough'),
(6, 'Polio'),
(7, 'Rubella'),
(8, 'Smallpox'),
(9, 'Tetanus'),
(10, 'Tuberculosis'),
(11, 'Typhoid');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `indiseases`
--

CREATE TABLE `indiseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `indate` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL,
  `dis_options_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `indiseases`
--

INSERT INTO `indiseases` (`id`, `medrecid`, `age`, `indate`, `remarks`, `users_id`, `dis_options_id`) VALUES
(1, 'jlqhmnxjdz', 2, '0000-00-00', '', 108, 1),
(2, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 2),
(3, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 3),
(4, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 4),
(5, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 5),
(6, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 6),
(7, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 7),
(8, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 8),
(9, 'jlqhmnxjdz', 0, '0000-00-00', '', 108, 9),
(10, 'cfiptiljtk', 0, '0000-00-00', '', 108, 1),
(11, 'cfiptiljtk', 0, '0000-00-00', '', 108, 2),
(12, 'cfiptiljtk', 0, '0000-00-00', '', 108, 3),
(13, 'cfiptiljtk', 0, '0000-00-00', '', 108, 4),
(14, 'cfiptiljtk', 0, '0000-00-00', '', 108, 5),
(15, 'cfiptiljtk', 0, '0000-00-00', '', 108, 6),
(16, 'cfiptiljtk', 0, '0000-00-00', '', 108, 7),
(17, 'cfiptiljtk', 0, '0000-00-00', '', 108, 8),
(18, 'cfiptiljtk', 0, '0000-00-00', '', 108, 9),
(19, 'fltevpzwfh', 0, '0000-00-00', '', 108, 1),
(20, 'fltevpzwfh', 0, '0000-00-00', '', 108, 2),
(21, 'fltevpzwfh', 0, '0000-00-00', '', 108, 3),
(22, 'fltevpzwfh', 0, '0000-00-00', '', 108, 4),
(23, 'fltevpzwfh', 0, '0000-00-00', '', 108, 5),
(24, 'fltevpzwfh', 0, '0000-00-00', '', 108, 6),
(25, 'fltevpzwfh', 0, '0000-00-00', '', 108, 7),
(26, 'fltevpzwfh', 0, '0000-00-00', '', 108, 8),
(27, 'fltevpzwfh', 0, '0000-00-00', '', 108, 9);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `insurances`
--

CREATE TABLE `insurances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medrecid` varchar(255) NOT NULL,
  `iptype` varchar(255) DEFAULT NULL,
  `ipcname` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(255) DEFAULT NULL,
  `ipcity` varchar(255) DEFAULT NULL,
  `ipzcode` varchar(255) DEFAULT NULL,
  `ipcountry` varchar(255) DEFAULT NULL,
  `ipphone` varchar(255) DEFAULT NULL,
  `ipemail` varchar(255) DEFAULT NULL,
  `ipfax` varchar(255) DEFAULT NULL,
  `ipwaddress` varchar(255) DEFAULT NULL,
  `ipmnumber` varchar(255) DEFAULT NULL,
  `ipssnumber` varchar(255) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `insurances`
--

INSERT INTO `insurances` (`id`, `medrecid`, `iptype`, `ipcname`, `ipaddress`, `ipcity`, `ipzcode`, `ipcountry`, `ipphone`, `ipemail`, `ipfax`, `ipwaddress`, `ipmnumber`, `ipssnumber`, `users_id`) VALUES
(1, 'jlqhmnxjdz', '', '', '', '', '', '', '', '', '', '', '', '', 108),
(2, 'fltevpzwfh', '', '', '', '', '', '', '', '', '', '', '', '', 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `markers`
--

CREATE TABLE `markers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) CHARACTER SET latin1 NOT NULL,
  `address` varchar(80) CHARACTER SET latin1 NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`, `users_id`) VALUES
(38, 'Teeth Center', 'Everything About Your Teeth', 41.088539, 23.548904, 'office', 108),
(39, 'adas', 'asd', 47.614750, -122.341705, 'office', 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sender` bigint(20) NOT NULL,
  `reciever` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `mhistory`
--

CREATE TABLE `mhistory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donset` date DEFAULT NULL,
  `medrecid` varchar(255) NOT NULL,
  `users_id` bigint(20) NOT NULL,
  `mh_options_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `mhistory`
--

INSERT INTO `mhistory` (`id`, `donset`, `medrecid`, `users_id`, `mh_options_id`) VALUES
(1, '0000-00-00', 'jlqhmnxjdz', 108, 1),
(2, '2016-01-26', 'jlqhmnxjdz', 108, 2),
(3, '2016-01-19', 'jlqhmnxjdz', 108, 3),
(4, '0000-00-00', 'jlqhmnxjdz', 108, 4),
(5, '0000-00-00', 'jlqhmnxjdz', 108, 5),
(6, '2016-06-07', 'jlqhmnxjdz', 108, 6),
(7, '0000-00-00', 'jlqhmnxjdz', 108, 7),
(8, '2016-07-21', 'jlqhmnxjdz', 108, 8),
(9, '0000-00-00', 'jlqhmnxjdz', 108, 9),
(10, '0000-00-00', 'jlqhmnxjdz', 108, 10),
(11, '0000-00-00', 'jlqhmnxjdz', 108, 11),
(12, '0000-00-00', 'jlqhmnxjdz', 108, 12),
(13, '0000-00-00', 'jlqhmnxjdz', 108, 13),
(14, '0000-00-00', 'jlqhmnxjdz', 108, 14),
(15, '0000-00-00', 'jlqhmnxjdz', 108, 15),
(16, '0000-00-00', 'jlqhmnxjdz', 108, 16),
(17, '0000-00-00', 'jlqhmnxjdz', 108, 17),
(18, '0000-00-00', 'jlqhmnxjdz', 108, 18),
(19, '0000-00-00', 'jlqhmnxjdz', 108, 19),
(20, '0000-00-00', 'jlqhmnxjdz', 108, 20),
(21, '0000-00-00', 'jlqhmnxjdz', 108, 21),
(22, '0000-00-00', 'jlqhmnxjdz', 108, 22),
(23, '0000-00-00', 'jlqhmnxjdz', 108, 23),
(24, '0000-00-00', 'jlqhmnxjdz', 108, 24),
(25, '0000-00-00', 'jlqhmnxjdz', 108, 25),
(26, '0000-00-00', 'jlqhmnxjdz', 108, 26),
(27, '0000-00-00', 'jlqhmnxjdz', 108, 27),
(28, '0000-00-00', 'jlqhmnxjdz', 108, 28),
(29, '0000-00-00', 'jlqhmnxjdz', 108, 29),
(30, '0000-00-00', 'jlqhmnxjdz', 108, 30),
(31, '0000-00-00', 'jlqhmnxjdz', 108, 31),
(32, '0000-00-00', 'jlqhmnxjdz', 108, 32),
(33, '0000-00-00', 'jlqhmnxjdz', 108, 33),
(34, '0000-00-00', 'jlqhmnxjdz', 108, 34),
(35, '0000-00-00', 'jlqhmnxjdz', 108, 35),
(36, '0000-00-00', 'jlqhmnxjdz', 108, 36),
(37, '0000-00-00', 'jlqhmnxjdz', 108, 37),
(38, '0000-00-00', 'jlqhmnxjdz', 108, 38),
(39, '0000-00-00', 'cfiptiljtk', 108, 1),
(40, '0000-00-00', 'cfiptiljtk', 108, 2),
(41, '0000-00-00', 'cfiptiljtk', 108, 3),
(42, '0000-00-00', 'cfiptiljtk', 108, 4),
(43, '0000-00-00', 'cfiptiljtk', 108, 5),
(44, '0000-00-00', 'cfiptiljtk', 108, 6),
(45, '0000-00-00', 'cfiptiljtk', 108, 7),
(46, '0000-00-00', 'cfiptiljtk', 108, 8),
(47, '0000-00-00', 'cfiptiljtk', 108, 9),
(48, '0000-00-00', 'cfiptiljtk', 108, 10),
(49, '0000-00-00', 'cfiptiljtk', 108, 11),
(50, '0000-00-00', 'cfiptiljtk', 108, 12),
(51, '0000-00-00', 'cfiptiljtk', 108, 13),
(52, '0000-00-00', 'cfiptiljtk', 108, 14),
(53, '0000-00-00', 'cfiptiljtk', 108, 15),
(54, '0000-00-00', 'cfiptiljtk', 108, 16),
(55, '0000-00-00', 'cfiptiljtk', 108, 17),
(56, '0000-00-00', 'cfiptiljtk', 108, 18),
(57, '0000-00-00', 'cfiptiljtk', 108, 19),
(58, '0000-00-00', 'cfiptiljtk', 108, 20),
(59, '0000-00-00', 'cfiptiljtk', 108, 21),
(60, '0000-00-00', 'cfiptiljtk', 108, 22),
(61, '0000-00-00', 'cfiptiljtk', 108, 23),
(62, '0000-00-00', 'cfiptiljtk', 108, 24),
(63, '0000-00-00', 'cfiptiljtk', 108, 25),
(64, '0000-00-00', 'cfiptiljtk', 108, 26),
(65, '0000-00-00', 'cfiptiljtk', 108, 27),
(66, '0000-00-00', 'cfiptiljtk', 108, 28),
(67, '0000-00-00', 'cfiptiljtk', 108, 29),
(68, '0000-00-00', 'cfiptiljtk', 108, 30),
(69, '0000-00-00', 'cfiptiljtk', 108, 31),
(70, '0000-00-00', 'cfiptiljtk', 108, 32),
(71, '0000-00-00', 'cfiptiljtk', 108, 33),
(72, '0000-00-00', 'cfiptiljtk', 108, 34),
(73, '0000-00-00', 'cfiptiljtk', 108, 35),
(74, '0000-00-00', 'cfiptiljtk', 108, 36),
(75, '0000-00-00', 'cfiptiljtk', 108, 37),
(76, '0000-00-00', 'cfiptiljtk', 108, 38),
(77, '0000-00-00', 'fltevpzwfh', 108, 1),
(78, '0000-00-00', 'fltevpzwfh', 108, 2),
(79, '0000-00-00', 'fltevpzwfh', 108, 3),
(80, '0000-00-00', 'fltevpzwfh', 108, 4),
(81, '0000-00-00', 'fltevpzwfh', 108, 5),
(82, '0000-00-00', 'fltevpzwfh', 108, 6),
(83, '0000-00-00', 'fltevpzwfh', 108, 7),
(84, '0000-00-00', 'fltevpzwfh', 108, 8),
(85, '0000-00-00', 'fltevpzwfh', 108, 9),
(86, '0000-00-00', 'fltevpzwfh', 108, 10),
(87, '0000-00-00', 'fltevpzwfh', 108, 11),
(88, '0000-00-00', 'fltevpzwfh', 108, 12),
(89, '0000-00-00', 'fltevpzwfh', 108, 13),
(90, '0000-00-00', 'fltevpzwfh', 108, 14),
(91, '0000-00-00', 'fltevpzwfh', 108, 15),
(92, '0000-00-00', 'fltevpzwfh', 108, 16),
(93, '0000-00-00', 'fltevpzwfh', 108, 17),
(94, '0000-00-00', 'fltevpzwfh', 108, 18),
(95, '0000-00-00', 'fltevpzwfh', 108, 19),
(96, '0000-00-00', 'fltevpzwfh', 108, 20),
(97, '0000-00-00', 'fltevpzwfh', 108, 21),
(98, '0000-00-00', 'fltevpzwfh', 108, 22),
(99, '0000-00-00', 'fltevpzwfh', 108, 23),
(100, '0000-00-00', 'fltevpzwfh', 108, 24),
(101, '0000-00-00', 'fltevpzwfh', 108, 25),
(102, '0000-00-00', 'fltevpzwfh', 108, 26),
(103, '0000-00-00', 'fltevpzwfh', 108, 27),
(104, '0000-00-00', 'fltevpzwfh', 108, 28),
(105, '0000-00-00', 'fltevpzwfh', 108, 29),
(106, '0000-00-00', 'fltevpzwfh', 108, 30),
(107, '0000-00-00', 'fltevpzwfh', 108, 31),
(108, '0000-00-00', 'fltevpzwfh', 108, 32),
(109, '0000-00-00', 'fltevpzwfh', 108, 33),
(110, '0000-00-00', 'fltevpzwfh', 108, 34),
(111, '0000-00-00', 'fltevpzwfh', 108, 35),
(112, '0000-00-00', 'fltevpzwfh', 108, 36),
(113, '0000-00-00', 'fltevpzwfh', 108, 37),
(114, '0000-00-00', 'fltevpzwfh', 108, 38);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `mh_options`
--

CREATE TABLE `mh_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `mh_options`
--

INSERT INTO `mh_options` (`id`, `name`) VALUES
(1, 'Acquired Immunodeficiency Sindrome(AIDS) or HIV Positive'),
(2, 'Arthritis'),
(3, 'Asthma'),
(4, 'Bronchitis'),
(5, 'Cancer'),
(6, 'Chlamydia'),
(7, 'Diabetes'),
(8, 'Emphysema'),
(9, 'Epilepsy'),
(10, 'Eye Problem'),
(11, 'Fainting'),
(12, 'Frequent or Severe Headaches '),
(13, 'Glaucoma'),
(14, 'Gonorrhea'),
(15, 'Hearing Impairment '),
(16, 'Hemodialysis'),
(17, 'Heart Condition'),
(18, 'Herpes'),
(19, 'High Blood Cholesterol'),
(20, 'High Blood Pressure'),
(21, 'Hypoglycemia'),
(22, 'Jaundice'),
(23, 'Kidney Disease'),
(24, 'Low Blood Pressure'),
(25, 'Mental Retardation'),
(26, 'Pain or Pressure in Chest'),
(27, 'Palpitations'),
(28, 'Periods of unconsciousness '),
(29, 'Rheumatic Fever'),
(30, 'Rheumatism'),
(31, 'Seizures'),
(32, 'Shortness of Breath'),
(33, 'Stomach Liver or Intestinal Problems'),
(34, 'Syphilis'),
(35, 'Thyroid Problems'),
(36, 'Tuberculosis'),
(37, 'Tumor'),
(38, 'Urinary Tract Infection');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `office`
--

CREATE TABLE `office` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oname` varchar(255) DEFAULT NULL,
  `pfservice` varchar(255) DEFAULT NULL,
  `trnumber` varchar(255) DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `oaddress` varchar(255) DEFAULT NULL,
  `ozcode` varchar(255) DEFAULT NULL,
  `ophone` varchar(255) DEFAULT NULL,
  `ofax` varchar(255) DEFAULT NULL,
  `oemail` varchar(255) DEFAULT NULL,
  `amonday` varchar(255) NOT NULL,
  `atuesday` varchar(255) NOT NULL,
  `awednesday` varchar(255) NOT NULL,
  `athursday` varchar(255) NOT NULL,
  `afriday` varchar(255) NOT NULL,
  `asaturday` varchar(255) NOT NULL,
  `asunday` varchar(255) NOT NULL,
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `office`
--

INSERT INTO `office` (`id`, `oname`, `pfservice`, `trnumber`, `director`, `country`, `state`, `oaddress`, `ozcode`, `ophone`, `ofax`, `oemail`, `amonday`, `atuesday`, `awednesday`, `athursday`, `afriday`, `asaturday`, `asunday`, `users_id`) VALUES
(108, 'Teeth Center', 'A'' Î”.ÎŸ.Î¥ Î£ÎµÏÏÏŽÎ½', '5634657465321', 'ÎšÎ±ÏƒÎ¬Ï€Î·Ï‚ Î’Î±Î³Î³Î­Î»Î·Ï‚', 'Greece', 'Serrai', 'ÎœÎµÏÎ±ÏÏ‡Î¯Î±Ï‚ 5', '62100', '2321048564', '2321048565', 'teethcenter@hotmail.gr', '14:08 16:00', ' ', ' ', ' ', ' ', ' ', ' ', 108),
(109, '', '', '', '', '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', 113);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `haddress` varchar(255) DEFAULT NULL,
  `zcode` varchar(255) DEFAULT NULL,
  `hphone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `cphone` varchar(255) DEFAULT NULL,
  `pwebsite` varchar(255) DEFAULT NULL,
  `aochat` varchar(255) DEFAULT NULL,
  `specialities` varchar(255) DEFAULT NULL,
  `ospecialities` varchar(255) DEFAULT NULL,
  `services` varchar(255) DEFAULT NULL,
  `edu` varchar(255) DEFAULT NULL,
  `pe` varchar(255) DEFAULT NULL,
  `users_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `profile`
--

INSERT INTO `profile` (`id`, `fname`, `last_name`, `image`, `country`, `state`, `haddress`, `zcode`, `hphone`, `fax`, `cphone`, `pwebsite`, `aochat`, `specialities`, `ospecialities`, `services`, `edu`, `pe`, `users_id`) VALUES
(108, 'Vaggelis', 'Kasapis', 'uploads/108.jpg', 'Egypt', 'Al Buhayrah', 'sdfsdfsdfsdf', '-', '-', '-', '-', 'https://www.medrec.com', '-', 'Addiction psychiatrist', '-', '-', '-', '-', 108),
(109, 'ewwsrwerwer', 'sdfsfsdf', 'uploads/avatar.png', 'Egypt', 'Al Minufiyah', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', 113);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) NOT NULL,
  `patient` bigint(20) NOT NULL,
  `doctor` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `requests`
--

INSERT INTO `requests` (`id`, `patient`, `doctor`) VALUES
(2, 111, 108);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type`, `status`) VALUES
(108, 'vaggelis2018', 'vaggelis2018@hotmail.gr', '202cb962ac59075b964b07152d234b70', 1, 'online'),
(111, 'panagiwtis', 'panagiwtis@gmail.gr', '202cb962ac59075b964b07152d234b70', 0, 'online'),
(112, 'asdsdfsf', 'p@gmail.gr', 'e10adc3949ba59abbe56e057f20f883e', 1, 'online'),
(113, 'vageeeeeee', 'papas@gmail.gr', 'e10adc3949ba59abbe56e057f20f883e', 1, 'online'),
(114, 'oasdaasd', 'paok@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'online');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_addresses_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `currentstatus`
--
ALTER TABLE `currentstatus`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_currentstatus_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `dis_options`
--
ALTER TABLE `dis_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Ευρετήρια για πίνακα `fmhistory`
--
ALTER TABLE `fmhistory`
  ADD PRIMARY KEY (`id`,`users_id`,`fmh_options_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_fmhistory_users1_idx` (`users_id`),
  ADD KEY `fk_fmhistory_fmh_options1_idx` (`fmh_options_id`);

--
-- Ευρετήρια για πίνακα `fmh_options`
--
ALTER TABLE `fmh_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Ευρετήρια για πίνακα `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`,`patient_id`,`doctor_id`),
  ADD KEY `fk_friends_users1_idx1` (`patient_id`),
  ADD KEY `fk_friends_users1_idx` (`doctor_id`);

--
-- Ευρετήρια για πίνακα `icontacts`
--
ALTER TABLE `icontacts`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_icontacts_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `identifications`
--
ALTER TABLE `identifications`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_identifications_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`,`users_id`,`im_options_id`),
  ADD KEY `fk_immunizations_users1_idx` (`users_id`),
  ADD KEY `fk_immunizations_im_options1_idx` (`im_options_id`);

--
-- Ευρετήρια για πίνακα `im_options`
--
ALTER TABLE `im_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Ευρετήρια για πίνακα `indiseases`
--
ALTER TABLE `indiseases`
  ADD PRIMARY KEY (`id`,`users_id`,`dis_options_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_indiseases_users1_idx` (`users_id`),
  ADD KEY `fk_indiseases_dis_options1_idx` (`dis_options_id`);

--
-- Ευρετήρια για πίνακα `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_insurances_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_markers_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`,`sender`,`reciever`),
  ADD KEY `fk_messages_users3_idx` (`sender`),
  ADD KEY `fk_messages_user3_idx` (`reciever`);

--
-- Ευρετήρια για πίνακα `mhistory`
--
ALTER TABLE `mhistory`
  ADD PRIMARY KEY (`id`,`users_id`,`mh_options_id`),
  ADD KEY `fk_mhistory_users1_idx` (`users_id`),
  ADD KEY `fk_mhistory_mh_options1_idx` (`mh_options_id`);

--
-- Ευρετήρια για πίνακα `mh_options`
--
ALTER TABLE `mh_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Ευρετήρια για πίνακα `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_office_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`,`users_id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_profile_users1_idx` (`users_id`);

--
-- Ευρετήρια για πίνακα `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`,`patient`,`doctor`),
  ADD KEY `fk_requests_users1_idx` (`patient`),
  ADD KEY `fk_requests_users2_idx` (`doctor`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT για πίνακα `currentstatus`
--
ALTER TABLE `currentstatus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT για πίνακα `dis_options`
--
ALTER TABLE `dis_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT για πίνακα `fmhistory`
--
ALTER TABLE `fmhistory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT για πίνακα `fmh_options`
--
ALTER TABLE `fmh_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT για πίνακα `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT για πίνακα `icontacts`
--
ALTER TABLE `icontacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT για πίνακα `identifications`
--
ALTER TABLE `identifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT για πίνακα `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT για πίνακα `im_options`
--
ALTER TABLE `im_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT για πίνακα `indiseases`
--
ALTER TABLE `indiseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT για πίνακα `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT για πίνακα `markers`
--
ALTER TABLE `markers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT για πίνακα `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT για πίνακα `mhistory`
--
ALTER TABLE `mhistory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- AUTO_INCREMENT για πίνακα `mh_options`
--
ALTER TABLE `mh_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT για πίνακα `office`
--
ALTER TABLE `office`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT για πίνακα `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT για πίνακα `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `currentstatus`
--
ALTER TABLE `currentstatus`
  ADD CONSTRAINT `fk_currentstatus_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `fmhistory`
--
ALTER TABLE `fmhistory`
  ADD CONSTRAINT `fk_fmhistory_fmh_options1` FOREIGN KEY (`fmh_options_id`) REFERENCES `fmh_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fmhistory_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `fk_friends_users1` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friends_users2` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `icontacts`
--
ALTER TABLE `icontacts`
  ADD CONSTRAINT `fk_icontacts_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `identifications`
--
ALTER TABLE `identifications`
  ADD CONSTRAINT `fk_identifications_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `fk_immunizations_im_options1` FOREIGN KEY (`im_options_id`) REFERENCES `im_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_immunizations_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `indiseases`
--
ALTER TABLE `indiseases`
  ADD CONSTRAINT `fk_indiseases_dis_options1` FOREIGN KEY (`dis_options_id`) REFERENCES `dis_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_indiseases_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `fk_insurances_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `fk_markers_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users3` FOREIGN KEY (`reciever`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_users4` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `mhistory`
--
ALTER TABLE `mhistory`
  ADD CONSTRAINT `fk_mhistory_mh_options1` FOREIGN KEY (`mh_options_id`) REFERENCES `mh_options` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mhistory_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `office`
--
ALTER TABLE `office`
  ADD CONSTRAINT `fk_office_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Περιορισμοί για πίνακα `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_requests_users1` FOREIGN KEY (`patient`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_requests_users2` FOREIGN KEY (`doctor`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
