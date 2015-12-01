SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `zablose_navbars` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `filter` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bootstrap_link_internal',
  `body` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `href` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `permission` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `zablose_navbars` (`id`, `pid`, `filter`, `type`, `body`, `title`, `href`, `class`, `icon`, `role`, `permission`, `position`, `created_at`, `updated_at`) VALUES
(1, 0, 'main', 'bootstrap_navbar', '', '', '', 'nav navbar-nav', '', 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(2, 1, 'main', 'bootstrap_link_internal', 'Index', NULL, '/', NULL, NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(3, 1, 'main', 'bootstrap_link_internal', 'Home', NULL, '/home', NULL, 'fa fa-home fa-lg', 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(4, 0, 'main', 'bootstrap_navbar', NULL, NULL, NULL, 'nav navbar-nav navbar-right', NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(5, 4, 'main', 'bootstrap_dropdown', 'Dropdown', NULL, NULL, NULL, 'fa fa-bars fa-lg', 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(6, 5, 'main', 'bootstrap_link_internal', 'Login', NULL, '/auth/login', NULL, NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(7, 5, 'main', 'bootstrap_link_internal', 'Register', NULL, '/auth/register', NULL, NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(8, 5, 'main', 'bootstrap_link_internal', 'Logout', NULL, '/auth/logout', NULL, NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(9, 5, 'main', 'bootstrap_separator', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(10, 5, 'main', 'bootstrap_header', 'Links to explore', NULL, NULL, NULL, NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(11, 5, 'main', 'bootstrap_link_internal', 'Dashboard', 'Admin area', NULL, NULL, 'fa fa-dashboard', 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(12, 0, 'dashboard', 'bootstrap_navbar', NULL, NULL, NULL, 'nav nav-sidebar', NULL, 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(13, 12, 'dashboard', 'bootstrap_link_internal', 'Users', NULL, NULL, NULL, 'fa fa-book fa-fw', 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21'),
(14, 12, 'dashboard', 'bootstrap_link_external', 'Laravel', NULL, 'http://laravel.com/', NULL, 'fa fa-external-link fa-fw', 0, 0, 0, '2015-12-01 15:09:21', '2015-12-01 15:09:21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
