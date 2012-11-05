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
(10, 'Working Hours', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(11, 'Working Hours Leave Approve', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(12, 'Working Hours Day Approve', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(13, 'Working Hours Reports', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(14, 'Working Hours Settings', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
