-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 18, 2018 at 10:03 AM
-- Server version: 10.0.36-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rifattsk_primesms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'mutasim.ewu@gmail.com', 'admin', '$2y$10$soCYh.vYFi/ArZNtrmD2hOxAgSfAeixgnA.i.PAaUykXX4T9FKbwu', 'c6DdwyQyXUkpJgkOtt0TxepZndEPpKT2GeUmXEBbDZTE3vwZ7je2VihawAyU', NULL, '2018-06-04 04:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `coverages`
--

CREATE TABLE `coverages` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `len` int(11) DEFAULT NULL,
  `sms_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coverages`
--

INSERT INTO `coverages` (`id`, `country`, `code`, `len`, `sms_charge`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', '+93', 3, '0.70', 1, '2018-09-06 07:15:40', '2018-09-18 18:03:07'),
(2, 'Aland Islands', '+358', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(3, 'Albania', '+355', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(4, 'Algeria', '+213', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(5, 'AmericanSamoa', '+1684', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(6, 'Andorra', '+376', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(7, 'Angola', '+244', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(8, 'Anguilla', '+1264', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(9, 'Antarctica', '+672', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(10, 'Antigua and Barbuda', '+1268', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(11, 'Argentina', '+54', 3, '1', 1, '2018-09-06 07:15:40', '2018-09-10 07:21:21'),
(12, 'Armenia', '+374', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(13, 'Aruba', '+297', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(14, 'Australia', '+61', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(15, 'Austria', '+43', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(16, 'Azerbaijan', '+994', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(17, 'Bahamas', '+1242', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(18, 'Bahrain', '+973', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(19, 'Bangladesh', '+880', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(20, 'Barbados', '+1246', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(21, 'Belarus', '+375', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(22, 'Belgium', '+32', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(23, 'Belize', '+501', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(24, 'Benin', '+229', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(25, 'Bermuda', '+1441', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(26, 'Bhutan', '+975', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(27, 'Bolivia, Plurinational State of', '+591', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(28, 'Bosnia and Herzegovina', '+387', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(29, 'Botswana', '+267', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(30, 'Brazil', '+55', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(31, 'British Indian Ocean Territory', '+246', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(32, 'Brunei Darussalam', '+673', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(33, 'Bulgaria', '+359', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(34, 'Burkina Faso', '+226', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(35, 'Burundi', '+257', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(36, 'Cambodia', '+855', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(37, 'Cameroon', '+237', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(38, 'Canada', '+1', 2, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(39, 'Cape Verde', '+238', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(40, 'Cayman Islands', '+ 345', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(41, 'Central African Republic', '+236', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(42, 'Chad', '+235', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(43, 'Chile', '+56', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(44, 'China', '+86', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(45, 'Christmas Island', '+61', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(46, 'Cocos (Keeling) Islands', '+61', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(47, 'Colombia', '+57', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(48, 'Comoros', '+269', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(49, 'Congo', '+242', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(50, 'Congo, The Democratic Republic of the Congo', '+243', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(51, 'Cook Islands', '+682', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(52, 'Costa Rica', '+506', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(53, 'Cote d\'Ivoire', '+225', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(54, 'Croatia', '+385', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(55, 'Cuba', '+53', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(56, 'Cyprus', '+357', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(57, 'Czech Republic', '+420', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(58, 'Denmark', '+45', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(59, 'Djibouti', '+253', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(60, 'Dominica', '+1767', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(61, 'Dominican Republic', '+1849', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(62, 'Ecuador', '+593', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(63, 'Egypt', '+20', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(64, 'El Salvador', '+503', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(65, 'Equatorial Guinea', '+240', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(66, 'Eritrea', '+291', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(67, 'Estonia', '+372', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(68, 'Ethiopia', '+251', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(69, 'Falkland Islands (Malvinas)', '+500', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(70, 'Faroe Islands', '+298', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(71, 'Fiji', '+679', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(72, 'Finland', '+358', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(73, 'France', '+33', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(74, 'French Guiana', '+594', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(75, 'French Polynesia', '+689', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(76, 'Gabon', '+241', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(77, 'Gambia', '+220', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(78, 'Georgia', '+995', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(79, 'Germany', '+49', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(80, 'Ghana', '+233', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(81, 'Gibraltar', '+350', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(82, 'Greece', '+30', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(83, 'Greenland', '+299', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(84, 'Grenada', '+1473', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(85, 'Guadeloupe', '+590', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(86, 'Guam', '+1671', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(87, 'Guatemala', '+502', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(88, 'Guernsey', '+44', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(89, 'Guinea', '+224', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(90, 'Guinea-Bissau', '+245', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(91, 'Guyana', '+595', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(92, 'Haiti', '+509', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(93, 'Holy See (Vatican City State)', '+379', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(94, 'Honduras', '+504', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(95, 'Hong Kong', '+852', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(96, 'Hungary', '+36', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(97, 'Iceland', '+354', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(98, 'India', '+91', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(99, 'Indonesia', '+62', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(100, 'Iran, Islamic Republic of Persian Gulf', '+98', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:00'),
(101, 'Iraq', '+964', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(102, 'Ireland', '+353', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(103, 'Isle of Man', '+44', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(104, 'Israel', '+972', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(105, 'Italy', '+39', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(106, 'Jamaica', '+1876', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(107, 'Japan', '+81', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(108, 'Jersey', '+44', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(109, 'Jordan', '+962', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(110, 'Kazakhstan', '+77', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(111, 'Kenya', '+254', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(112, 'Kiribati', '+686', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(113, 'Korea, Democratic People\'s Republic of Korea', '+850', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(114, 'Korea, Republic of South Korea', '+82', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(115, 'Kuwait', '+965', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(116, 'Kyrgyzstan', '+996', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(117, 'Laos', '+856', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(118, 'Latvia', '+371', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(119, 'Lebanon', '+961', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(120, 'Lesotho', '+266', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(121, 'Liberia', '+231', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(122, 'Libyan Arab Jamahiriya', '+218', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(123, 'Liechtenstein', '+423', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(124, 'Lithuania', '+370', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(125, 'Luxembourg', '+352', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(126, 'Macao', '+853', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(127, 'Macedonia', '+389', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(128, 'Madagascar', '+261', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(129, 'Malawi', '+265', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(130, 'Malaysia', '+60', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(131, 'Maldives', '+960', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(132, 'Mali', '+223', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(133, 'Malta', '+356', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(134, 'Marshall Islands', '+692', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(135, 'Martinique', '+596', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(136, 'Mauritania', '+222', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(137, 'Mauritius', '+230', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(138, 'Mayotte', '+262', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(139, 'Mexico', '+52', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(140, 'Micronesia, Federated States of Micronesia', '+691', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(141, 'Moldova', '+373', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(142, 'Monaco', '+377', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(143, 'Mongolia', '+976', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(144, 'Montenegro', '+382', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(145, 'Montserrat', '+1664', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(146, 'Morocco', '+212', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(147, 'Mozambique', '+258', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(148, 'Myanmar', '+95', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(149, 'Namibia', '+264', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(150, 'Nauru', '+674', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(151, 'Nepal', '+977', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(152, 'Netherlands', '+31', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(153, 'Netherlands Antilles', '+599', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(154, 'New Caledonia', '+687', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(155, 'New Zealand', '+64', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(156, 'Nicaragua', '+505', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(157, 'Niger', '+227', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(158, 'Nigeria', '+234', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(159, 'Niue', '+683', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(160, 'Norfolk Island', '+672', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(161, 'Northern Mariana Islands', '+1670', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(162, 'Norway', '+47', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(163, 'Oman', '+968', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(164, 'Pakistan', '+92', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(165, 'Palau', '+680', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(166, 'Palestinian Territory, Occupied', '+970', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(167, 'Panama', '+507', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(168, 'Papua New Guinea', '+675', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(169, 'Paraguay', '+595', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(170, 'Peru', '+51', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(171, 'Philippines', '+63', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(172, 'Pitcairn', '+872', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(173, 'Poland', '+48', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(174, 'Portugal', '+351', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(175, 'Puerto Rico', '+1939', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(176, 'Qatar', '+974', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(177, 'Romania', '+40', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(178, 'Russia', '+7', 2, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(179, 'Rwanda', '+250', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(180, 'Reunion', '+262', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(181, 'Saint Barthelemy', '+590', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(182, 'Saint Helena, Ascension and Tristan Da Cunha', '+290', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(183, 'Saint Kitts and Nevis', '+1869', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(184, 'Saint Lucia', '+1758', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(185, 'Saint Martin', '+590', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(186, 'Saint Pierre and Miquelon', '+508', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(187, 'Saint Vincent and the Grenadines', '+1784', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(188, 'Samoa', '+685', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(189, 'San Marino', '+378', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(190, 'Sao Tome and Principe', '+239', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(191, 'Saudi Arabia', '+966', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(192, 'Senegal', '+221', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(193, 'Serbia', '+381', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(194, 'Seychelles', '+248', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(195, 'Sierra Leone', '+232', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(196, 'Singapore', '+65', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(197, 'Slovakia', '+421', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(198, 'Slovenia', '+386', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(199, 'Solomon Islands', '+677', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(200, 'Somalia', '+252', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(201, 'South Africa', '+27', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(202, 'South Sudan', '+211', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(203, 'South Georgia and the South Sandwich Islands', '+500', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(204, 'Spain', '+34', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(205, 'Sri Lanka', '+94', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(206, 'Sudan', '+249', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(207, 'Suriname', '+597', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(208, 'Svalbard and Jan Mayen', '+47', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(209, 'Swaziland', '+268', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(210, 'Sweden', '+46', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(211, 'Switzerland', '+41', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(212, 'Syrian Arab Republic', '+963', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(213, 'Taiwan', '+886', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(214, 'Tajikistan', '+992', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(215, 'Tanzania, United Republic of Tanzania', '+255', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(216, 'Thailand', '+66', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(217, 'Timor-Leste', '+670', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(218, 'Togo', '+228', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(219, 'Tokelau', '+690', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(220, 'Tonga', '+676', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(221, 'Trinidad and Tobago', '+1868', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(222, 'Tunisia', '+216', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(223, 'Turkey', '+90', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(224, 'Turkmenistan', '+993', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(225, 'Turks and Caicos Islands', '+1649', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(226, 'Tuvalu', '+688', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(227, 'Uganda', '+256', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(228, 'Ukraine', '+380', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(229, 'United Arab Emirates', '+971', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(230, 'United Kingdom', '+44', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(231, 'United States', '+1', 2, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(232, 'Uruguay', '+598', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(233, 'Uzbekistan', '+998', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(234, 'Vanuatu', '+678', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(235, 'Venezuela, Bolivarian Republic of Venezuela', '+58', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(236, 'Vietnam', '+84', 3, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(237, 'Virgin Islands, British', '+1284', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(238, 'Virgin Islands, U.S.', '+1340', 5, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(239, 'Wallis and Futuna', '+681', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(240, 'Yemen', '+967', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(241, 'Zambia', '+260', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01'),
(242, 'Zimbabwe', '+263', 4, NULL, 1, '2018-09-06 07:15:40', '2018-09-10 04:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verification` tinyint(4) DEFAULT NULL,
  `sms_verification` tinyint(4) NOT NULL DEFAULT '0',
  `email_notification` tinyint(4) DEFAULT NULL,
  `sms_notification` tinyint(4) DEFAULT NULL,
  `recaptcha` tinyint(4) NOT NULL DEFAULT '1',
  `site_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_sender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `e_message` longtext COLLATE utf8mb4_unicode_ci,
  `sms_api` text COLLATE utf8mb4_unicode_ci,
  `contact_address` longtext COLLATE utf8mb4_unicode_ci,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `base_color`, `currency_symbol`, `email_verification`, `sms_verification`, `email_notification`, `sms_notification`, `recaptcha`, `site_key`, `secret_key`, `sms_charge`, `default_gateway`, `e_sender`, `e_message`, `sms_api`, `contact_address`, `contact_phone`, `contact_email`, `created_at`, `updated_at`) VALUES
(1, 'PrimeSMS', '7d5fff', '$', 0, 0, 1, 0, 0, NULL, NULL, '0.50', '14', 'do-not-reply@thesoftking.com', '<p>&nbsp;</p>\r\n<div class=\"wrapper\" style=\"background-color: #f2f2f2;\">\r\n<table style=\"border-collapse: collapse; table-layout: fixed; color: #b8b8b8; font-family: Ubuntu,sans-serif;\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td class=\"preheader__snippet\" style=\"padding: 10px 0 5px 0; vertical-align: top; width: 280px;\">&nbsp;</td>\r\n<td class=\"preheader__webversion\" style=\"text-align: right; padding: 10px 0 5px 0; vertical-align: top; width: 280px;\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table id=\"emb-email-header-container\" class=\"header\" style=\"border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto;\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding: 0; width: 600px;\">\r\n<div class=\"header__logo emb-logo-margin-box\" style=\"font-size: 26px; line-height: 32px; color: #c3ced9; font-family: Roboto,Tahoma,sans-serif; margin: 6px 20px 20px 20px;\">\r\n<div id=\"emb-email-header\" class=\"logo-left\" style=\"font-size: 0px !important; line-height: 0 !important;\" align=\"left\"><img style=\"height: auto; width: 100%; border: 0; max-width: 312px;\" src=\"http://i.imgur.com/nNCNPZT.png\" alt=\"\" width=\"312\" height=\"44\"></div>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"layout layout--no-gutter\" style=\"border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td class=\"column\" style=\"padding: 0; text-align: left; vertical-align: top; color: #60666d; font-size: 14px; line-height: 21px; font-family: sans-serif; width: 600px;\">\r\n<div style=\"margin-left: 20px; margin-right: 20px; margin-top: 24px;\">\r\n<div style=\"line-height: 10px; font-size: 1px;\">&nbsp;</div>\r\n</div>\r\n<div style=\"margin-left: 20px; margin-right: 20px;\">\r\n<h2>Hi {{name}},</h2>\r\n<p><strong>{{message}}</strong></p>\r\n</div>\r\n<div style=\"margin-left: 20px; margin-right: 20px;\"><br></div>\r\n<div style=\"margin-left: 20px; margin-right: 20px; margin-bottom: 24px;\">\r\n<p class=\"size-14\" style=\"margin-top: 0; margin-bottom: 0; font-size: 14px; line-height: 21px;\">Thanks,<br>&nbsp; <strong>SMS Team</strong></p>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', 'https://api.infobip.com/api/v3/sendsms/plain?user=****&password=*****&sender=SMS&SMSText={{message}}&GSM={{number}}&type=longSMS', 'Company Location, City, Country', '880 123 456 7890', 'do-not-reply@thesoftking.com', '2018-06-04 00:06:40', '2018-09-18 18:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_05_30_062126_admins', 1),
(5, '2018_06_03_102739_create_general_settings_table', 3),
(10, '2018_06_13_053323_create_transections_table', 8),
(19, '2018_07_30_071159_create_support_messages_table', 15),
(20, '2018_07_30_071206_create_support_tickets_table', 15),
(29, '2018_08_13_072342_create_plans_table', 22),
(30, '2018_09_03_103653_create_sms_gateways_table', 23),
(31, '2018_09_06_131238_create_coverages_table', 24),
(32, '2018_09_10_115206_create_sms_logs_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `status`, `created_at`, `updated_at`) VALUES
('mutasim.ewu@gmail.com', '$2y$10$WMf3FMgI.oQK/Rm0bbWc7O.npp.s0KyrOHtV4QFVYdw8OEVIz4ogq', 0, '2018-06-11 05:13:34', NULL),
('mutasim.ewu@gmail.com', 'H5IGvs0X98Dw10MCtr7SFuAYRGm3bL', 0, '2018-06-11 05:18:37', '2018-06-11 05:18:37'),
('mutasim.ewu@gmail.com', 'tH0EVnmNLnBlpSgrOSV40mYLZWfdTZ', 0, '2018-06-11 05:18:53', '2018-06-11 05:18:53'),
('mutasim.ewu@gmail.com', 'ICZdg9Hb9QpHZOUqkKA7OEsmew6QIR', 0, '2018-06-11 05:21:21', '2018-06-11 05:21:21'),
('mutasim.ewu@gmail.com', 'nQ7S6hUBF7kTedJpKxwOzjAuEcUCHE', 0, '2018-06-11 05:21:33', '2018-06-11 05:21:33'),
('mutasim.ewu@gmail.com', 'Bwbr4JvqFMIkNAQpUk2qgcQEk7iN8d', 0, '2018-06-11 05:22:14', '2018-06-11 05:22:14'),
('mutasim.ewu@gmail.com', 'Cu4QesVVHSGrdIellpQcoAZ0NHJ5Ie', 1, '2018-06-11 05:26:38', '2018-06-11 05:37:54'),
('mutasim.ewu@gmail.com', 'vgqhiLjHdKKJqnFHDxOUPhpmOyChvk', 0, '2018-06-12 01:03:54', '2018-06-12 01:03:54'),
('mutasim.ewu@gmail.com', '8NviiEOYHnIYOKEtrdXbdQ5ZcuPPSd', 0, '2018-06-12 01:24:36', '2018-06-12 01:24:36'),
('mutasim.ewu@gmail.com', 'VB7hNn8Ghi66PfdT2AWEj6nd6t7BMR', 1, '2018-07-31 08:12:28', '2018-07-31 08:17:19'),
('mutasim.ewu@gmail.com', '83KsOqmZU0kBRBuSOrPRxITRDuSEB4', 0, '2018-08-05 04:37:18', '2018-08-05 04:37:18'),
('mutasim.ewu@gmail.com', 'y6RUS70bDMwctjEcPZDJcr9VhMQEYx', 0, '2018-08-11 23:49:00', '2018-08-11 23:49:00'),
('mutasim.ewu@gmail.com', 'gucZs3ek65qXZW5noQXLN9uQUR4XkJ', 0, '2018-08-11 23:50:03', '2018-08-11 23:50:03'),
('mutasim.ewu@gmail.com', 'ToZLZhutxn0n78w11f3utjF9fFbbfE', 0, '2018-08-11 23:51:44', '2018-08-11 23:51:44'),
('mutasim.ewu@gmail.com', '9LlMbfBjtwjjV9vUJvAURXVOG8d7mZ', 0, '2018-08-11 23:52:26', '2018-08-11 23:52:26'),
('mutasim.ewu@gmail.com', '8XufSpZt8yMLuyuSsl1njaIXmRLOUG', 0, '2018-08-11 23:52:57', '2018-08-11 23:52:57'),
('mutasim.ewu@gmail.com', '9UEWGk9nulbHKtdQLkFBF4OcST3aiQ', 0, '2018-08-11 23:54:46', '2018-08-11 23:54:46'),
('mutasim.ewu@gmail.com', 'XhjvKmZkrClJE9qsOV05QFQhX23HFU', 1, '2018-08-11 23:58:10', '2018-08-11 23:58:30');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `support` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reseller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `min`, `max`, `price`, `validity`, `support`, `reseller`, `others`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '100', '500', '0.60', '30 days', '24x7 support', 'No', 'Cheap Rate', 1, '2018-08-13 01:28:31', '2018-09-18 02:41:25'),
(2, 'Starter', '500', '1500', '0.50', '60 days', '24x7 support', 'yes', 'Cheap Rate', 1, '2018-08-13 01:29:51', '2018-09-18 02:41:39'),
(3, 'Standard', '1500', '3000', '0.40', '70 days', '24x7 support', 'yes', 'Cheap Rate', 1, '2018-09-18 02:42:25', '2018-09-18 02:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateways`
--

CREATE TABLE `sms_gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_gateways`
--

INSERT INTO `sms_gateways` (`id`, `name`, `val1`, `val2`, `val3`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Twilio', 'Account_sid', 'auth_token', 'Form Number/ShortCode', 1, NULL, '2018-09-06 07:57:15'),
(2, 'Infobip', 'username', 'password', NULL, 1, NULL, '2018-09-06 07:56:00'),
(3, 'Text Local', 'API Key', NULL, NULL, 1, NULL, '2018-09-06 07:57:07'),
(4, 'Msg91', 'Your Auth Key', 'sender Id', NULL, 1, NULL, '2018-09-06 07:56:20'),
(5, 'Plivo', 'Auth_Id', 'Auth_token', 'Sender_Number', 1, NULL, '2018-09-06 07:56:35'),
(6, 'Nexmo', 'API_KEY', 'API_SECRET', 'NEXMO_FROM', 1, NULL, '2018-09-06 07:56:25'),
(7, 'Orange', 'client_id', 'client_secret', 'From Number', 1, NULL, '2018-09-06 07:56:31'),
(8, 'SemySMS', 'Secret Token', 'Device Id', 'Sender_Number', 1, NULL, '2018-09-06 07:56:41'),
(9, 'Chikka', 'your-chikka-client-id', 'your-chikka-secret-key', 'your-chikka-shortcode', 1, NULL, '2018-09-06 07:55:33'),
(10, 'NusaSMS', 'USERNAME', 'PASSWORD', NULL, 1, NULL, '2018-09-06 07:56:28'),
(11, 'TeleSign', 'customer_id', 'api_key', NULL, 1, NULL, '2018-09-06 07:57:01'),
(12, 'Moreify', 'your_project_identifier', 'your_token', NULL, 1, NULL, '2018-09-06 07:56:15'),
(13, 'TextMagic', 'USERNAME', 'APIV2_TOKEN', NULL, 1, NULL, '2018-09-06 07:57:11'),
(14, 'ViaNett', 'USERNAME', 'PASSWORD', NULL, 1, NULL, '2018-09-08 07:32:22'),
(15, 'SMSApi', 'USERNAME', 'your api password in md5', NULL, 1, NULL, '2018-09-06 07:56:46'),
(16, 'SMSBump', 'API_KEY', NULL, NULL, 1, NULL, '2018-09-06 07:56:54'),
(17, 'SmsBroadcast', 'USERNAME', 'PASSWORD', NULL, 1, NULL, '2018-09-06 07:56:50'),
(18, 'Descom', 'your_username', 'your_password', NULL, 1, NULL, '2018-09-06 07:55:53'),
(19, 'Clockwork', 'API_KEY', NULL, NULL, 1, NULL, '2018-09-06 07:55:41'),
(20, 'Smsgatewayhub', 'API_KEY', 'SENDER_ID', NULL, 1, NULL, '2018-09-06 07:56:57'),
(21, 'LifeTimeSMS', 'username', 'password', NULL, 1, NULL, '2018-09-06 07:56:03'),
(22, 'ConnectMedia', 'username', 'password', 'Sender ID of the message', 1, NULL, '2018-09-06 07:55:48'),
(23, 'Clickatell', 'api_key', NULL, NULL, 1, NULL, '2018-09-06 07:55:20'),
(24, 'MessageBird', 'API access key', NULL, NULL, 1, NULL, '2018-09-06 07:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_logs`
--

INSERT INTO `sms_logs` (`id`, `user_id`, `number`, `status`, `created_at`, `updated_at`) VALUES
(3, '1', '+1231232312', 'success', '2018-08-10 06:06:02', '2018-09-10 06:06:02'),
(4, '1', '+8312321213123', 'success', '2018-09-10 06:06:02', '2018-09-10 06:06:02');

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `supportticket_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_messages`
--

INSERT INTO `support_messages` (`id`, `supportticket_id`, `type`, `message`, `created_at`, `updated_at`) VALUES
(5, '5', 1, 'hello SMM', '2018-07-30 01:36:45', '2018-07-30 01:36:45'),
(6, '5', 2, 'hello', '2018-07-30 06:43:46', '2018-07-30 06:43:46'),
(7, '5', 1, 'ok', '2018-08-09 04:39:27', '2018-08-09 04:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `user_id`, `ticket`, `subject`, `status`, `created_at`, `updated_at`) VALUES
(5, '1', 'S-118639', 'SMM', 2, '2018-07-30 01:36:45', '2018-08-09 04:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `transections`
--

CREATE TABLE `transections` (
  `id` int(10) UNSIGNED NOT NULL,
  `to_add` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_bal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_add` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_bal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `trx` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transections`
--

INSERT INTO `transections` (`id`, `to_add`, `to_bal`, `from_add`, `from_bal`, `amount`, `type`, `trx`, `created_at`, `updated_at`) VALUES
(23, '11', '100', '0', '0', '100', 1, 'mQFTuRqyNQUo', '2018-09-08 05:55:44', '2018-09-08 05:55:44'),
(24, '10', '100', '1', '450', '25', 2, 'AteQC9M25b0m', '2018-09-08 07:44:07', '2018-09-08 07:44:07'),
(25, '0', '0', '1', '449.5', '0.50', 3, 'hN04KfQJaLzG', '2018-09-09 00:32:22', '2018-09-09 00:32:22'),
(26, '0', '0', '1', '449', '0.50', 3, 'rmS3ueeVY0ju', '2018-09-09 05:48:01', '2018-09-09 05:48:01'),
(27, '0', '0', '1', '448.5', '0.50', 3, 'sbZ36SMuHASX', '2018-09-10 05:26:39', '2018-09-10 05:26:39'),
(28, '0', '0', '1', '448', '0.50', 3, 'gsBlcfYGVtAI', '2018-09-10 06:02:21', '2018-09-10 06:02:21'),
(29, '0', '0', '1', '447.5', '0.50', 3, 'MqHENB9pOpEC', '2018-09-10 06:04:57', '2018-09-10 06:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `verification_time` datetime DEFAULT NULL,
  `verification_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify` tinyint(4) NOT NULL DEFAULT '1',
  `sms_verify` tinyint(4) NOT NULL DEFAULT '1',
  `two_step_verify` tinyint(4) NOT NULL DEFAULT '0',
  `two_step_verification` tinyint(1) NOT NULL DEFAULT '1',
  `two_step_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `refer_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `roll` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `username`, `password`, `image`, `country`, `city`, `post_code`, `address`, `remember_token`, `status`, `verification_time`, `verification_code`, `email_verify`, `sms_verify`, `two_step_verify`, `two_step_verification`, `two_step_code`, `balance`, `refer_by`, `api_key`, `sms`, `gateway`, `roll`, `created_at`, `updated_at`) VALUES
(1, 'BitCoin', 'mutasim.ewu@gmail.com', '12334567', 'uncanny', '$2y$10$xkUx6NXXZZSoTXAhUvjVHOPbIiSw7vb6wmtvM/lsCcalDQ4vsX6C.', '5b6fed3373523.jpg', 'Bangladesh', 'Dhaka', '1230', 'Uttara, Dhaka', 'URoRFYKaQPWS7sOKuK6exwI9Zs8Xl4bhD6yD7ebrlZGYtBENSisKz77aYRYl', 1, '2018-07-31 14:34:54', 'g3nRzE', 1, 1, 0, 1, 'RULJU67DQWTUUBNB', '4221000.149999999', '0', 'guqVl5XIoCY3nnPzI4PFBmhoZsigZ2', '447.5', '14', 1, '2018-06-12 02:02:01', '2018-09-10 06:04:57'),
(10, 'Mutasim Billah', 'mullobodh@gmail.com', '8801719469346', 'ewu', '$2y$10$DqKuGCbiQu.2cC057ayUPev1O7dR.wdVPJKaijTu/VrOk6bi5eoSS', NULL, 'Bangladesh', 'Dhaka', '1230', 'Dhaka', 'riEkCzx8jgpPo801m2ae637oak1cJWgL2Q8xVE4y8luQ51KxPc3LhnbscizZ', 1, '2018-08-05 09:17:13', 'kexy6x', 1, 1, 0, 1, NULL, '0', '1', NULL, '100', '14', 1, '2018-08-05 03:17:13', '2018-09-08 07:44:07'),
(11, 'Zahangir Pial', 'pialneel@gmail.com', '01521108941', 'pial', '$2y$10$PJVEOwN2IvSFmg1FPN.OKOtzC8/jHr092lRMKI3VGy/B8w3Il.qE.', 'default.png', 'Bangladesh', NULL, NULL, NULL, 'EVoCz3331OLefGH51JJcTeeRpxHT8X8gnaZfCL6jcQ5Fvz0ln9ZbnkXCYBwU', 1, NULL, NULL, 1, 1, 0, 1, NULL, '0', '0', NULL, '100', '14', 0, '2018-09-02 01:04:41', '2018-09-18 00:37:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `coverages`
--
ALTER TABLE `coverages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_gateways`
--
ALTER TABLE `sms_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transections`
--
ALTER TABLE `transections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coverages`
--
ALTER TABLE `coverages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sms_gateways`
--
ALTER TABLE `sms_gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transections`
--
ALTER TABLE `transections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
