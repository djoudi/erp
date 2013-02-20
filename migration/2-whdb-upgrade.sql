SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DELETE FROM `fmc`.`working_hour_parameter` WHERE `working_hour_parameter`.`id` = 1;


INSERT IGNORE INTO `working_hour_parameter` (`id`, `param`, `value`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 'HolidayMultiplier', '1.5', 'Multiplier for holiday works', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(2, 'DailyWorkHours', '540', 'Daily work hours (in minutes)', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(3, 'DefaultDailyBreaks', '30', 'Default daily breaks (in minutes)', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(4, 'ReportEmailFrequency', '7', 'Weekly WHDB report frequency (in days)', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(5, 'OfficeDayEntranceEarliest', '08:00', 'Office day earliest entrance', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(6, 'OfficeDayEntranceLatest', '09:30', 'Office day latest entrance', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(7, 'OfficeDayExitEarliest', '17:00', 'Office day earliest exit', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(8, 'OfficeDayExitLatest', '19:00', 'Office day latest exit', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1);


INSERT INTO `leave_type` (`name`, `default_limit`, `has_report`, `will_be_paid`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
('Marriage Leave', 0, 0, 0, 23, 23, '2012-11-05 22:02:45', '2012-11-06 12:40:12', NULL, 1),
('Maternity/Parental Leave', 0, 0, 0, 23, 23, '2012-11-05 22:02:45', '2012-11-06 12:40:12', NULL, 1);


INSERT IGNORE INTO `holiday` (`day`, `name`, `holiday_type`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
('2013-08-07', 'Ramazan Bayramı Arifesi', 'Half-day', 23, 23, '2013-02-06 19:21:47', '2013-02-06 19:21:47', NULL, 1),
('2013-08-08', 'Ramazan Bayramı 1. Gün', 'Full-day', 23, 23, '2013-02-06 19:10:03', '2013-02-06 19:10:11', NULL, 1),
('2013-08-09', 'Ramazan Bayramı 2. Gün', 'Full-day', 23, 23, '2013-02-06 19:10:24', '2013-02-06 19:10:24', NULL, 1),
('2013-08-10', 'Ramazan Bayramı 3. Gün', 'Full-day', 23, 23, '2013-02-06 19:10:32', '2013-02-06 19:10:32', NULL, 1),
('2013-10-15', 'Kurban Bayramı 1. Gün', 'Full-day', 23, 23, '2013-02-06 19:11:02', '2013-02-06 19:11:02', NULL, 1),
('2013-10-16', 'Kurban Bayramı 2. Gün', 'Full-day', 23, 23, '2013-02-06 19:11:10', '2013-02-06 19:11:10', NULL, 1),
('2013-10-17', 'Kurban Bayramı 3. Gün', 'Full-day', 23, 23, '2013-02-06 19:11:16', '2013-02-06 19:11:16', NULL, 1),
('2013-10-18', 'Kurban Bayramı 4. Gün', 'Full-day', 23, 23, '2013-02-06 19:11:22', '2013-02-06 19:11:22', NULL, 1),
('2013-10-14', 'Kurban Bayramı Arifesi', 'Half-day', 23, 23, '2013-02-06 19:21:47', '2013-02-06 19:21:47', NULL, 1),
('2013-10-28', 'Cumhuriyet Bayramı', 'Half-day', 23, 23, '2013-02-06 19:24:21', '2013-02-06 19:24:21', NULL, 1);


UPDATE `sf_guard_user` SET `monthly_working_hours`=NULL WHERE 1;


UPDATE `leave_type` SET `will_be_paid`=NULL WHERE `id`=4;


INSERT INTO `sf_guard_permission` (`name`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
('Working Hours Management', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL);


INSERT INTO `sf_guard_user_permission` (`user_id`, `permission_id`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(22, 16, 23, 23, '2013-02-12 16:24:30', '2013-02-12 16:24:30', NULL, 1),
(23, 16, 23, 23, '2013-02-12 16:24:30', '2013-02-12 16:24:30', NULL, 1);


SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
