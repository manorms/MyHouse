-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: sql203.byetcluster.com
-- Tiempo de generación: 16-04-2015 a las 16:16:59
-- Versión del servidor: 5.6.22-71.0
-- Versión de PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mb260_10889588_myhouse5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Volcado de datos para la tabla `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 160),
(2, 1, NULL, NULL, 'Expenses', 2, 11),
(3, 2, NULL, NULL, 'add', 3, 4),
(4, 2, NULL, NULL, 'index', 5, 6),
(5, 2, NULL, NULL, 'change_template', 7, 8),
(6, 2, NULL, NULL, 'delete', 9, 10),
(7, 1, NULL, NULL, 'Houses', 12, 21),
(8, 7, NULL, NULL, 'add', 13, 14),
(9, 7, NULL, NULL, 'edit', 15, 16),
(10, 7, NULL, NULL, 'index', 17, 18),
(11, 7, NULL, NULL, 'change_house', 19, 20),
(12, 1, NULL, NULL, 'Pages', 22, 25),
(13, 12, NULL, NULL, 'display', 23, 24),
(14, 1, NULL, NULL, 'Profiles', 26, 35),
(15, 14, NULL, NULL, 'add', 27, 28),
(16, 14, NULL, NULL, 'edit', 29, 30),
(17, 14, NULL, NULL, 'index', 31, 32),
(18, 14, NULL, NULL, 'delete', 33, 34),
(19, 1, NULL, NULL, 'Services', 36, 45),
(20, 19, NULL, NULL, 'add', 37, 38),
(21, 19, NULL, NULL, 'edit', 39, 40),
(22, 19, NULL, NULL, 'index', 41, 42),
(23, 19, NULL, NULL, 'delete', 43, 44),
(24, 1, NULL, NULL, 'Users', 46, 69),
(25, 24, NULL, NULL, 'login', 47, 48),
(26, 24, NULL, NULL, 'index', 49, 50),
(27, 24, NULL, NULL, 'home', 51, 52),
(28, 24, NULL, NULL, 'logout', 53, 54),
(29, 24, NULL, NULL, 'add', 55, 56),
(30, 24, NULL, NULL, 'edit', 57, 58),
(31, 24, NULL, NULL, 'edit2', 59, 60),
(32, 24, NULL, NULL, 'delete', 61, 62),
(33, 24, NULL, NULL, 'change_password', 63, 64),
(34, 24, NULL, NULL, 'reset_password', 65, 66),
(35, 1, NULL, NULL, 'Acl', 70, 123),
(36, 35, NULL, NULL, 'Acl', 71, 74),
(37, 36, NULL, NULL, 'index', 72, 73),
(38, 35, NULL, NULL, 'Acos', 75, 86),
(39, 38, NULL, NULL, 'index', 76, 77),
(40, 38, NULL, NULL, 'empty_acos', 78, 79),
(41, 38, NULL, NULL, 'build_acl', 80, 81),
(42, 38, NULL, NULL, 'prune_acos', 82, 83),
(43, 38, NULL, NULL, 'synchronize', 84, 85),
(44, 35, NULL, NULL, 'Aros', 87, 122),
(45, 44, NULL, NULL, 'index', 88, 89),
(46, 44, NULL, NULL, 'check', 90, 91),
(47, 44, NULL, NULL, 'users', 92, 93),
(48, 44, NULL, NULL, 'update_user_role', 94, 95),
(49, 44, NULL, NULL, 'ajax_role_permissions', 96, 97),
(50, 44, NULL, NULL, 'role_permissions', 98, 99),
(51, 44, NULL, NULL, 'user_permissions', 100, 101),
(52, 44, NULL, NULL, 'empty_permissions', 102, 103),
(53, 44, NULL, NULL, 'clear_user_specific_permissions', 104, 105),
(54, 44, NULL, NULL, 'grant_all_controllers', 106, 107),
(55, 44, NULL, NULL, 'deny_all_controllers', 108, 109),
(56, 44, NULL, NULL, 'get_role_controller_permission', 110, 111),
(57, 44, NULL, NULL, 'grant_role_permission', 112, 113),
(58, 44, NULL, NULL, 'deny_role_permission', 114, 115),
(59, 44, NULL, NULL, 'get_user_controller_permission', 116, 117),
(60, 44, NULL, NULL, 'grant_user_permission', 118, 119),
(61, 44, NULL, NULL, 'deny_user_permission', 120, 121),
(62, 1, NULL, NULL, 'BoostCake', 124, 133),
(63, 62, NULL, NULL, 'BoostCake', 125, 132),
(64, 63, NULL, NULL, 'index', 126, 127),
(65, 63, NULL, NULL, 'bootstrap2', 128, 129),
(66, 63, NULL, NULL, 'bootstrap3', 130, 131),
(67, 1, NULL, NULL, 'Loans', 134, 143),
(68, 67, NULL, NULL, 'add', 135, 136),
(69, 67, NULL, NULL, 'index', 137, 138),
(70, 67, NULL, NULL, 'delete', 139, 140),
(71, 67, NULL, NULL, 'view', 141, 142),
(72, 1, NULL, NULL, 'Payments', 144, 151),
(73, 72, NULL, NULL, 'add', 145, 146),
(74, 72, NULL, NULL, 'index', 147, 148),
(75, 72, NULL, NULL, 'delete', 149, 150),
(76, 1, NULL, NULL, 'RestUsers', 152, 159),
(77, 76, NULL, NULL, 'login', 153, 154),
(78, 76, NULL, NULL, 'logout', 155, 156),
(79, 24, NULL, NULL, 'contact', 67, 68),
(80, 76, NULL, NULL, 'loginByDevice', 157, 158);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Profile', 1, NULL, 1, 6),
(2, 1, 'User', 1, NULL, 2, 3),
(3, NULL, 'Profile', 2, NULL, 7, 26),
(4, 3, 'User', 2, NULL, 8, 9),
(5, 3, 'User', 3, NULL, 10, 11),
(6, 3, 'User', 4, NULL, 12, 13),
(7, 3, 'User', 5, NULL, 14, 15),
(8, 3, 'User', 6, NULL, 16, 17),
(9, 1, 'User', 7, NULL, 4, 5),
(10, 3, 'User', 8, NULL, 18, 19),
(11, 3, 'User', 9, NULL, 20, 21),
(12, 3, 'User', 10, NULL, 22, 23),
(13, 3, 'User', 11, NULL, 24, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 3, 3, '1', '1', '1', '1'),
(3, 3, 5, '1', '1', '1', '1'),
(4, 3, 6, '1', '1', '1', '1'),
(5, 3, 4, '1', '1', '1', '1'),
(6, 3, 11, '1', '1', '1', '1'),
(7, 3, 31, '1', '1', '1', '1'),
(8, 3, 27, '1', '1', '1', '1'),
(9, 3, 25, '1', '1', '1', '1'),
(10, 3, 28, '1', '1', '1', '1'),
(11, 3, 34, '1', '1', '1', '1'),
(12, 3, 33, '1', '1', '1', '1'),
(14, 3, 20, '1', '1', '1', '1'),
(15, 3, 23, '1', '1', '1', '1'),
(16, 3, 21, '1', '1', '1', '1'),
(17, 3, 22, '1', '1', '1', '1'),
(19, 3, 68, '1', '1', '1', '1'),
(20, 3, 70, '1', '1', '1', '1'),
(21, 3, 69, '1', '1', '1', '1'),
(22, 3, 71, '1', '1', '1', '1'),
(23, 3, 13, '1', '1', '1', '1'),
(24, 3, 73, '1', '1', '1', '1'),
(25, 3, 75, '1', '1', '1', '1'),
(26, 3, 74, '1', '1', '1', '1'),
(28, 3, 79, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devices_users`
--

CREATE TABLE IF NOT EXISTS `devices_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `device_id` (`device_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `devices_users`
--

INSERT INTO `devices_users` (`id`, `user_id`, `device_id`, `created`) VALUES
(1, 1, '16a2ce9e-695f-422a-aba0-f232ca7ce138', '2014-05-30 19:36:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `house_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `expenses`
--

INSERT INTO `expenses` (`id`, `description`, `date`, `house_id`, `amount`, `user_id`, `created`, `modified`, `comments`, `active`) VALUES
(1, 'Gas', '2014-02-26', 1, '392.00', 1, '2014-02-27 10:37:30', '2014-02-27 10:37:30', '', 1),
(2, 'Gas', '2014-02-26', 1, '392.00', 1, '2014-02-27 10:37:34', '2014-02-27 10:37:34', '', 0),
(3, 'Abono', '2014-02-26', 1, '196.00', 2, '2014-02-27 10:45:35', '2014-02-27 10:45:35', '', 1),
(4, 'TELMEX', '2014-02-28', 1, '349.00', 1, '2014-02-28 14:09:33', '2014-02-28 14:09:33', 'Se cambiÃ³ la fecha limite de pago del 10 para el 3 y no sÃ© el porque imagino que por el cambio de aÃ±o', 1),
(5, 'CFE', '2014-03-07', 1, '119.00', 1, '2014-03-07 20:44:47', '2014-03-07 20:44:47', '', 1),
(6, 'Renta', '2014-03-09', 1, '2800.00', 1, '2014-03-09 22:22:23', '2014-03-09 22:22:23', 'Departamento', 1),
(7, 'Abono', '2014-03-09', 1, '1634.00', 2, '2014-03-09 22:22:56', '2014-03-09 22:22:56', '', 1),
(8, 'TELMEX', '2014-03-21', 1, '349.00', 1, '2014-03-21 13:28:47', '2014-03-21 13:28:47', 'Internet limite de pago 3 de abril', 1),
(9, 'Renta', '2014-04-14', 1, '2800.00', 1, '2014-04-22 16:58:27', '2014-04-22 16:58:27', 'Departamento', 1),
(10, 'Abono', '2014-04-14', 1, '1500.00', 2, '2014-04-22 16:59:23', '2014-04-22 16:59:23', 'renta internet', 1),
(11, 'TELMEX', '2014-04-22', 1, '349.00', 1, '2014-04-22 16:59:48', '2014-04-22 16:59:48', 'Internet', 1),
(12, 'Abono', '2014-04-24', 1, '74.00', 2, '2014-04-25 12:29:39', '2014-04-25 12:29:39', 'de telmex', 1),
(13, 'agua', '2014-04-28', 1, '359.03', 1, '2014-04-28 12:18:18', '2014-04-28 12:18:18', 'desde septiembre a diciembre $321.09 entre tres (se incluye a Grecia) $107.03.\r\nde enero a marzo $504.00 entre dos $252. Aun faltara lo del mes de abril. yo tengo el desglose detallado', 1),
(14, 'agua', '2014-04-29', 1, '359.03', 2, '2014-05-06 23:43:38', '2014-05-06 23:43:38', '', 1),
(15, 'Renta', '2014-05-07', 1, '2800.00', 1, '2014-05-07 19:12:07', '2014-05-07 19:12:07', 'Departamento', 1),
(16, 'Abono', '2014-05-07', 1, '1575.00', 2, '2014-05-07 19:12:48', '2014-05-07 19:12:48', '', 1),
(17, 'TELMEX', '2014-05-29', 1, '349.00', 1, '2014-05-29 16:29:17', '2014-05-29 16:29:17', 'Internet', 1),
(18, 'agua', '2014-05-30', 1, '237.00', 1, '2014-05-30 14:01:35', '2014-05-30 14:01:35', '229 + 8 de comisiÃ³n', 1),
(19, 'pago de agua', '2014-05-30', 1, '118.50', 2, '2014-06-04 12:53:12', '2014-06-04 12:53:12', '', 1),
(20, 'Renta', '2014-06-12', 1, '2800.00', 1, '2014-06-13 11:03:37', '2014-06-13 11:03:37', 'Departamento', 1),
(21, 'Abono', '2014-06-13', 1, '1574.50', 2, '2014-06-13 11:04:40', '2014-06-13 11:04:40', 'renta + internet', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expenses_users`
--

CREATE TABLE IF NOT EXISTS `expenses_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_expenses_users_expenses1_idx` (`expense_id`),
  KEY `fk_expenses_users_users1_idx` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `expenses_users`
--

INSERT INTO `expenses_users` (`id`, `expense_id`, `user_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 4, 1),
(7, 4, 2),
(8, 5, 1),
(9, 5, 2),
(10, 6, 1),
(11, 6, 2),
(12, 7, 1),
(13, 8, 1),
(14, 8, 2),
(15, 9, 1),
(16, 9, 2),
(17, 10, 1),
(18, 11, 1),
(19, 11, 2),
(20, 12, 1),
(21, 13, 2),
(22, 14, 1),
(23, 15, 1),
(24, 15, 2),
(25, 16, 1),
(26, 17, 1),
(27, 17, 2),
(28, 18, 1),
(29, 18, 2),
(30, 19, 1),
(31, 20, 1),
(32, 20, 2),
(33, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `houses`
--

CREATE TABLE IF NOT EXISTS `houses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `houses`
--

INSERT INTO `houses` (`id`, `name`, `created`, `modified`, `comments`, `active`) VALUES
(1, 'Pza Gpe 3C-13', '2014-02-26 20:32:21', '2014-02-26 21:52:47', 'MisiÃ³n San Eduardo 3C 13 Residencial Plaza Guadalupe, Zapopan, Jalisco. CP 45030', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `houses_users`
--

CREATE TABLE IF NOT EXISTS `houses_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_houses_users_houses_idx` (`house_id`),
  KEY `fk_houses_users_users1_idx` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `houses_users`
--

INSERT INTO `houses_users` (`id`, `house_id`, `user_id`) VALUES
(3, 1, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `lender_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_loans_users1_idx` (`lender_id`),
  KEY `fk_loans_users2_idx` (`borrower_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `loans`
--

INSERT INTO `loans` (`id`, `description`, `date`, `lender_id`, `borrower_id`, `amount`, `created`, `modified`, `comments`, `active`) VALUES
(1, 'TelÃ©fono', '2013-12-04', 1, 3, '2999.00', '2014-03-11 12:35:14', '2014-03-11 12:35:14', 'BestBuy', 1),
(2, 'Lentes', '2014-01-08', 1, 4, '3630.00', '2014-03-21 14:53:59', '2014-03-21 14:53:59', 'fecha aproximada', 1),
(3, 'Regulador', '2014-05-01', 1, 5, '269.00', '2014-05-01 19:52:40', '2014-05-01 19:52:40', 'bestbuy', 1),
(4, 'Regulador', '2014-05-01', 1, 5, '269.00', '2014-05-01 19:52:41', '2014-05-01 19:52:41', 'bestbuy', 0),
(5, 'surface', '2014-05-03', 1, 6, '4599.00', '2014-05-03 19:09:35', '2014-05-03 19:09:35', '', 1),
(6, 'Quemador bluray', '2014-05-03', 1, 5, '1999.00', '2014-05-03 19:10:39', '2014-05-03 19:10:39', '', 1),
(7, 'Laptop Kristal', '2014-07-23', 1, 8, '5400.00', '2014-07-23 17:57:37', '2014-07-23 17:57:37', 'Bestbuy', 1),
(8, 'iPad', '2014-07-24', 1, 9, '4699.00', '2014-08-01 12:22:24', '2014-08-01 12:22:24', 'BestBuy Online', 1),
(9, 'Moto G', '2014-09-20', 1, 6, '2819.00', '2014-09-23 01:42:45', '2014-09-23 01:42:45', '12 meses BestBuy', 1),
(10, 'PrÃ©stamo', '2014-08-07', 9, 1, '19000.00', '2014-10-16 18:45:40', '2014-10-16 18:45:40', 'PrÃ©stamo para reponer lo de conacyt', 1),
(11, 'Banamex CP', '2014-10-18', 1, 9, '60000.00', '2014-10-18 18:37:57', '2014-10-18 18:37:57', 'aprox', 1),
(12, 'Smart TV 47" LG', '2014-12-27', 1, 10, '9499.00', '2014-12-29 14:27:26', '2014-12-29 14:27:26', 'Wallmart a 18 msi', 1),
(13, 'dportenis', '2015-01-04', 1, 11, '2594.49', '2015-01-05 14:34:47', '2015-01-05 14:34:47', '', 1),
(14, 'Prestamo Banamex', '2015-04-04', 9, 1, '12737.00', '2015-04-04 15:27:50', '2015-04-04 15:27:50', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification` text COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `read_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_notifications_users1_idx` (`user_id`),
  KEY `fk_notifications_users2_idx` (`sender_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `loan_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_payments_loans1_idx` (`loan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`id`, `date`, `loan_id`, `amount`, `created`, `modified`, `comments`, `active`) VALUES
(1, '2014-01-04', 1, '300.00', '2014-03-11 12:36:19', '2014-03-11 12:36:19', '', 1),
(2, '2014-02-04', 1, '500.00', '2014-03-11 12:39:27', '2014-03-11 12:39:27', '', 1),
(3, '2014-03-17', 1, '500.00', '2014-03-18 12:16:56', '2014-03-18 12:16:56', '', 1),
(4, '2014-01-28', 2, '605.00', '2014-03-21 14:54:25', '2014-03-21 14:54:25', 'fecha aproximada', 1),
(5, '2014-04-28', 2, '610.00', '2014-03-21 14:55:00', '2014-03-21 14:55:00', 'fecha aproximada', 1),
(6, '2014-03-22', 2, '605.00', '2014-03-22 16:01:43', '2014-03-22 16:01:43', '', 1),
(7, '2014-04-28', 2, '605.00', '2014-04-28 17:06:08', '2014-04-28 17:06:08', 'abono', 1),
(8, '2014-05-03', 5, '51.00', '2014-05-03 19:11:32', '2014-05-03 19:11:32', 'lo que sobro de los cupones 400 menos la funda 349', 1),
(9, '2014-05-04', 5, '2300.00', '2014-05-05 12:22:38', '2014-05-05 12:22:38', 'abono', 1),
(10, '2014-05-23', 2, '605.00', '2014-05-29 16:22:57', '2014-05-29 16:22:57', '', 1),
(11, '2014-06-03', 3, '269.00', '2014-06-03 17:58:16', '2014-06-03 17:58:16', 'pagado', 1),
(12, '2014-06-03', 6, '111.00', '2014-06-03 17:58:53', '2014-06-03 17:58:53', 'primer abono', 1),
(13, '2014-06-03', 5, '2248.00', '2014-06-04 12:24:12', '2014-06-04 12:24:12', 'pagado', 1),
(14, '2014-06-08', 1, '300.00', '2014-06-09 10:43:34', '2014-06-09 10:43:34', '', 1),
(15, '2014-06-28', 6, '111.00', '2014-07-23 17:55:22', '2014-07-23 17:55:22', '', 1),
(16, '2014-07-23', 6, '111.00', '2014-07-23 17:55:40', '2014-07-23 17:55:40', '', 1),
(17, '2014-07-23', 7, '300.00', '2014-07-23 17:58:07', '2014-07-23 17:58:07', 'Cuando se llevaron la tv', 1),
(18, '2014-06-28', 2, '600.00', '2014-08-01 12:30:02', '2014-08-01 12:30:02', 'Ultimo abono', 1),
(19, '2014-08-05', 6, '111.00', '2014-09-23 01:38:26', '2014-09-23 01:38:26', '', 1),
(20, '2014-09-23', 6, '111.00', '2014-09-23 01:38:52', '2014-09-23 01:38:52', '', 1),
(21, '2014-08-01', 8, '4699.00', '2014-09-23 01:39:42', '2014-09-23 01:39:42', 'no procedio la compra', 1),
(22, '2014-09-28', 7, '600.00', '2014-10-04 16:59:05', '2014-10-04 16:59:05', 'dos meses', 1),
(23, '2014-10-03', 6, '111.00', '2014-10-04 17:00:49', '2014-10-04 17:00:49', 'octubre', 1),
(24, '2014-10-16', 10, '12000.00', '2014-10-16 18:46:15', '2014-10-16 18:46:15', 'Primer abono', 1),
(25, '2014-07-03', 11, '4925.00', '2014-10-18 18:55:48', '2014-10-18 18:55:48', '2000', 1),
(26, '2014-08-05', 11, '4875.00', '2014-10-18 18:58:28', '2014-10-18 18:58:28', '2000', 1),
(27, '2014-09-06', 11, '5500.00', '2014-10-18 18:59:22', '2014-10-18 18:59:22', '2000', 1),
(28, '2014-10-07', 11, '4925.00', '2014-10-18 19:00:13', '2014-10-18 19:00:13', '2000', 1),
(29, '2014-10-25', 7, '300.00', '2014-10-26 11:24:22', '2014-10-26 11:24:22', '', 1),
(30, '2014-10-01', 9, '235.00', '2014-10-29 21:14:38', '2014-10-29 21:14:38', 'Corte de septiembre ', 1),
(31, '2014-11-03', 9, '235.00', '2014-11-03 17:13:42', '2014-11-03 17:13:42', 'camino a varbaca', 1),
(32, '2014-11-03', 6, '111.00', '2014-11-03 17:14:04', '2014-11-03 17:14:04', '', 1),
(33, '2014-11-04', 11, '4925.00', '2014-11-04 16:25:31', '2014-11-04 16:25:31', '', 1),
(34, '2014-11-05', 10, '4000.00', '2014-11-05 19:58:40', '2014-11-05 19:58:40', '', 1),
(35, '2014-11-16', 7, '300.00', '2014-11-17 15:25:53', '2014-11-17 15:25:53', 'puente del 20 de nov', 1),
(36, '2014-12-02', 9, '235.00', '2014-12-02 17:17:14', '2014-12-02 17:17:14', '', 1),
(37, '2014-12-02', 6, '100.00', '2014-12-02 17:18:04', '2014-12-02 17:18:04', '', 1),
(38, '2014-12-05', 11, '4925.00', '2014-12-05 11:25:44', '2014-12-05 11:25:44', 'falta pagar mi parte a Rolando', 1),
(39, '2015-01-05', 11, '5000.00', '2015-01-05 14:31:56', '2015-01-05 14:31:56', '', 1),
(40, '2015-01-04', 13, '500.00', '2015-01-05 14:35:45', '2015-01-05 14:35:45', '', 1),
(41, '2015-01-09', 9, '235.00', '2015-01-10 18:10:18', '2015-01-10 18:10:18', 'vacaciones', 1),
(42, '2015-01-11', 7, '600.00', '2015-01-12 16:50:43', '2015-01-12 16:50:43', 'dos abonos', 1),
(43, '2015-01-12', 6, '123.00', '2015-01-12 16:52:31', '2015-01-12 16:52:31', 'primer dia del segundo cuatri', 1),
(44, '2015-02-01', 12, '528.00', '2015-02-04 19:07:28', '2015-02-04 19:07:28', 'primer abono de 18', 1),
(45, '2015-02-11', 9, '235.00', '2015-02-11 18:06:42', '2015-02-11 18:06:42', '', 1),
(46, '2015-02-06', 11, '5000.00', '2015-02-11 18:07:55', '2015-02-11 18:07:55', '2000', 1),
(47, '2015-02-20', 6, '111.00', '2015-02-24 20:17:59', '2015-02-24 20:17:59', '', 1),
(48, '2015-03-04', 6, '111.00', '2015-03-07 13:05:01', '2015-03-07 13:05:01', 'tomate', 1),
(49, '2015-03-03', 9, '470.00', '2015-03-07 13:05:53', '2015-03-07 13:05:53', 'dos meses', 1),
(50, '2015-03-04', 7, '300.00', '2015-03-07 13:07:09', '2015-03-07 13:07:09', '', 1),
(51, '2015-03-16', 12, '528.00', '2015-03-17 01:05:21', '2015-03-17 01:05:21', 'la paz', 1),
(52, '2015-03-06', 11, '5000.00', '2015-03-17 01:07:27', '2015-03-17 01:07:27', '', 1),
(53, '2015-03-30', 7, '300.00', '2015-03-31 16:26:55', '2015-03-31 16:26:55', 'Antes de vacaciones de semana santa', 1),
(54, '2015-04-04', 11, '11842.12', '2015-04-04 15:24:04', '2015-04-04 15:24:04', 'pago final, falta mi parte 4,738', 1),
(55, '2015-04-04', 11, '3082.88', '2015-04-04 15:26:10', '2015-04-04 15:26:10', 'Cerrrado', 1),
(56, '2015-04-07', 9, '222.00', '2015-04-07 14:55:46', '2015-04-07 14:55:46', 'Pizza ', 0),
(57, '2015-04-07', 6, '222.00', '2015-04-07 14:56:57', '2015-04-07 14:56:57', 'Pizza', 1),
(58, '2015-04-07', 9, '470.00', '2015-04-07 14:58:15', '2015-04-07 14:58:15', 'Pizza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `created`, `modified`, `comments`, `active`) VALUES
(1, 'Administrador', '2014-02-26 20:29:12', '2014-02-26 20:29:12', '', 1),
(2, 'Operador', '2014-02-26 20:34:46', '2014-02-26 20:34:46', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id`, `name`, `amount`, `created`, `modified`, `comments`, `active`) VALUES
(1, 'TELMEX', '349.00', '2014-02-26 20:42:13', '2014-02-26 20:42:13', 'Internet', 1),
(2, 'Renta', '2800.00', '2014-02-26 20:55:17', '2014-02-26 22:07:58', 'Departamento', 1),
(3, 'Abono', '0.00', '2014-02-27 10:40:32', '2014-02-27 10:40:32', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profile_id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `session_time` int(11) NOT NULL,
  `session_counter` int(11) NOT NULL DEFAULT '0',
  `notifications` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `first_last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `second_last_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_users_profiles_idx` (`profile_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profile_id`, `email`, `session_time`, `session_counter`, `notifications`, `name`, `first_last_name`, `second_last_name`, `created`, `modified`, `comments`, `active`) VALUES
(1, 'manor', '9e8c9de67610ee7270a05a75a0639f5eedddc216', 1, 'manorms24@gmail.com', 999999999, 223, 1, 'Manuel Orlando', 'MuÃ±oz', 'Sandoval', '2014-02-26 20:29:44', '2014-05-06 18:22:12', 'Administrador', 1),
(2, 'leonardo', 'fda8a2b6c1d99250417863182681652934194e46', 2, 'leo_10_oro@yahoo.com.mx', 600, 2, 1, 'Leo', 'Orozco', '', '2014-02-26 21:52:25', '2014-03-06 17:23:55', '', 1),
(3, 'maria', '2cfd5500fa43959f59d9fb0e8173bb34961eb325', 2, 'manorms24@gmail.com', 420, 8, 1, 'Luz', 'Sandoval', '', '2014-03-11 12:30:57', '2014-07-03 23:08:11', '', 1),
(4, 'gress', '7159428193445f900ed0b0709705db4df83c97b0', 2, 'grecia_510@hotmail.com', 700, 2, 1, 'Grecia', 'Almeyda', '', '2014-03-21 14:09:34', '2014-03-21 14:09:34', '', 1),
(5, 'gerardo', 'ef3f7612c048e0ac31df8d5a492167148dda9bef', 2, 'manorms24@gmail.com', 420, 1, 1, 'Gerardo', 'Ramirez', '', '2014-05-01 19:51:33', '2014-10-13 00:39:07', '', 1),
(6, 'pedro', 'f1f25c17391934abe4a087e1119ba8247114ba2d', 2, 'manorms24@gmail.com', 420, 1, 1, 'Pedro', 'Perez', '', '2014-05-03 19:08:23', '2014-10-13 00:39:44', '', 1),
(7, 'felruiz', '2c2acd557550c64b0f1813cc82ccafb28545b6a5', 1, 'jelipe629@gmail.com', 600, 0, 1, 'Felipe', 'Ruiz', '', '2014-07-03 22:47:03', '2014-07-03 22:57:40', '', 1),
(8, 'heleodoro', 'e40b7f6c28887cad323cd39c587730b03c1c22ce', 2, 'manorms24@gmail.com', 420, 0, 1, 'Heleodoro', 'Betancourt', '', '2014-07-23 17:56:54', '2014-07-23 17:57:47', '', 1),
(9, 'rolando', '68989274c58d5ecf42bf52cbab24c5d40e0e8d76', 2, 'manorms24@gmail.com', 420, 0, 1, 'Rolando', 'MuÃ±oz', '', '2014-08-01 12:21:35', '2014-08-01 12:21:35', '', 1),
(10, 'fernando', '13fd209933da864f9f203b0a5009f56cd2c5e8ed', 2, 'ferkastro77@gmail.com', 738, 0, 1, 'Fernando', 'Castro', '', '2014-12-29 14:24:33', '2014-12-29 14:24:33', '', 1),
(11, 'dalving', '52bfafa00329be9ed7570e84cbe81f238f9f6812', 2, 'manorms24@gmail.com', 420, 0, 1, 'Dalving Fernando', 'MuÃ±oz', 'Sandoval', '2015-01-05 14:33:26', '2015-01-05 14:33:26', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
