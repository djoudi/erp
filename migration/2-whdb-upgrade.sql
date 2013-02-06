SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT IGNORE INTO `working_hour_parameter` (`id`, `param`, `value`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(2, 'DailyWorkHours', '540', 'Daily work hours (in minutes)', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(3, 'DefaultDailyBreaks', '30', 'Default daily breaks (in minutes)', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(4, 'ReportEmailFrequency', '7', 'Weekly WHDB report frequency (in days)', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(5, 'OfficeDayEntranceEarliest', '08:00', 'Office day earliest entrance', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(6, 'OfficeDayEntranceLatest', '09:30', 'Office day latest entrance', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(7, 'OfficeDayExitEarliest', '17:00', 'Office day earliest exit', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1),
(8, 'OfficeDayLatestEarliest', '19:00', 'Office day latest exit', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 1);

UPDATE `sf_guard_user` SET `monthly_working_hours`=NULL WHERE 1;


SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
