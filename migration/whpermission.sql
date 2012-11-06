SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DELETE FROM `fmc`.`sf_guard_permission` WHERE `sf_guard_permission`.`id` = 10;
DELETE FROM `fmc`.`sf_guard_permission` WHERE `sf_guard_permission`.`id` = 11;
DELETE FROM `fmc`.`sf_guard_permission` WHERE `sf_guard_permission`.`id` = 12;
DELETE FROM `fmc`.`sf_guard_permission` WHERE `sf_guard_permission`.`id` = 13;
DELETE FROM `fmc`.`sf_guard_permission` WHERE `sf_guard_permission`.`id` = 14;


INSERT IGNORE INTO `sf_guard_permission` (`id`, `name`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(10, 'Working Hours', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(11, 'Working Hours Leave Approve', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(12, 'Working Hours Day Approve', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(13, 'Working Hours Reports', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(14, 'Working Hours Settings', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL);


INSERT IGNORE INTO `working_hour_parameter` (`id`, `param`, `value`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 'WeekendMultiplier', '1.5', 'Multiplier for weekend works', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 5);


INSERT IGNORE INTO `leave_type` (`id`, `name`, `default_limit`, `has_report`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 'Illness with Report', 0, 1, 23, 23, '2012-11-05 22:02:45', '2012-11-06 12:40:12', NULL, 1),
(2, 'Illness without Report', 3, 0, 23, 23, '2012-11-05 22:03:12', '2012-11-06 12:12:48', NULL, 1),
(3, 'Paid Vacation', 0, 0, 23, 23, '2012-11-05 22:22:54', '2012-11-05 22:22:54', NULL, 1),
(4, 'Unpaid Vacation', 0, 0, 23, 23, '2012-11-05 22:23:12', '2012-11-06 09:26:37', NULL, 1);


INSERT IGNORE INTO `holiday` (`id`, `day`, `name`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, '2012-09-29', 'Cumhuriyet Bayramı', 23, 23, '2012-11-06 10:04:13', '2012-11-06 10:04:13', NULL, 1),
(2, '2012-01-01', 'New Year', 23, 23, '2012-11-06 10:04:51', '2012-11-06 10:04:51', NULL, 1),
(3, '2012-04-23', 'Ulusal Egemenlik ve Çocuk Bayramı', 23, 23, '2012-11-06 10:05:28', '2012-11-06 10:05:28', NULL, 1),
(4, '2012-05-01', 'Emek ve Dayanışma Bayramı', 23, 23, '2012-11-06 10:05:43', '2012-11-06 10:05:43', NULL, 1),
(5, '2012-05-19', 'Atatürkü Anma Gençlik ve Spor Bayramı', 23, 23, '2012-11-06 10:06:04', '2012-11-06 10:06:04', NULL, 1),
(6, '2012-08-30', 'Zafer Bayramı', 23, 23, '2012-11-06 10:15:26', '2012-11-06 10:15:26', NULL, 1);


SET FOREIGN_KEY_CHECKS=1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;









