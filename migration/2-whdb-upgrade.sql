SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


UPDATE `cost_form_item` SET `invoice_date` = null WHERE `invoice_date` = "0000-00-00";
UPDATE `cost_form_item` SET `invoice_no` = null WHERE  `invoice_no` =  "";


DELETE FROM `sf_guard_permission` WHERE `sf_guard_permission`.`id` = 10;
DELETE FROM `sf_guard_permission` WHERE `sf_guard_permission`.`id` = 11;
DELETE FROM `sf_guard_permission` WHERE `sf_guard_permission`.`id` = 12;
DELETE FROM `sf_guard_permission` WHERE `sf_guard_permission`.`id` = 13;
DELETE FROM `sf_guard_permission` WHERE `sf_guard_permission`.`id` = 14;
DELETE FROM `sf_guard_permission` WHERE `sf_guard_permission`.`id` = 15;


INSERT IGNORE INTO `sf_guard_permission` (`id`, `name`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(10, 'Working Hours', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(11, 'Working Hours Leave Approve', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(12, 'Working Hours Day Approve', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(13, 'Working Hours Reports', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(14, 'Working Hours Settings', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
(15, 'Admin: Holiday Management', NULL, 23, 23, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL);


INSERT IGNORE INTO `sf_guard_user_permission` (`user_id`, `permission_id`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(23, 10, 0, 0, '2012-04-16 17:23:07', '2012-04-16 17:23:07', NULL, 1),
(23, 11, 23, 23, '2012-11-08 17:01:14', '2012-11-08 17:01:14', NULL, 1),
(23, 12, 0, 0, '2012-04-16 17:23:07', '2012-04-16 17:23:07', NULL, 1),
(23, 13, 23, 23, '2012-11-08 17:01:14', '2012-11-08 17:01:14', NULL, 1),
(23, 14, 23, 23, '2012-11-08 17:01:15', '2012-11-08 17:01:15', NULL, 1),
(23, 15, 23, 23, '2012-11-08 17:01:15', '2012-11-08 17:01:15', NULL, 1);


INSERT IGNORE INTO `working_hour_parameter` (`id`, `param`, `value`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 'WeekendMultiplier', '1.5', 'Multiplier for weekend works', 23, 23, '2012-11-05 10:17:57', '2012-11-05 10:24:16', NULL, 5);


INSERT IGNORE INTO `leave_type` (`id`, `name`, `default_limit`, `has_report`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 'Illness with Report', 3, 1, 23, 23, '2012-11-05 22:02:45', '2012-11-06 12:40:12', NULL, 1),
(2, 'Illness without Report', 3, 0, 23, 23, '2012-11-05 22:03:12', '2012-11-06 12:12:48', NULL, 1),
(3, 'Paid Vacation', 0, 0, 23, 23, '2012-11-05 22:22:54', '2012-11-05 22:22:54', NULL, 1),
(4, 'Unpaid Vacation', 0, 0, 23, 23, '2012-11-05 22:23:12', '2012-11-06 09:26:37', NULL, 1);


INSERT IGNORE INTO `holiday` (`id`, `day`, `name`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, '2012-10-29', 'Cumhuriyet Bayramı', 23, 23, '2012-11-06 10:04:13', '2012-11-06 10:04:13', NULL, 1),
(2, '2012-01-01', 'New Year', 23, 23, '2012-11-06 10:04:51', '2012-11-06 10:04:51', NULL, 1),
(3, '2012-04-23', 'Ulusal Egemenlik ve Çocuk Bayramı', 23, 23, '2012-11-06 10:05:28', '2012-11-06 10:05:28', NULL, 1),
(4, '2012-05-01', 'Emek ve Dayanışma Bayramı', 23, 23, '2012-11-06 10:05:43', '2012-11-06 10:05:43', NULL, 1),
(5, '2012-05-19', 'Atatürkü Anma Gençlik ve Spor Bayramı', 23, 23, '2012-11-06 10:06:04', '2012-11-06 10:06:04', NULL, 1),
(6, '2012-08-30', 'Zafer Bayramı', 23, 23, '2012-11-06 10:15:26', '2012-11-06 10:15:26', NULL, 1);


INSERT IGNORE INTO `working_hour_work_type` (`id`, `name`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 'A0 - General Admin Works', 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(2, 'A1 - Inbox', 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(3, 'A2 - Meetings internal', 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(4, 'A3 - IT and Phone System Works', 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(5, 'A4 - Assistance to the Management', 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(6, 'A5 - Driver Services', 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(7, 'F0 - General Finance Works', 23, 23, '2012-11-07 12:02:50', '2012-11-07 12:02:50', NULL, 1),
(8, 'F1 - Accounting  & Payroll Services', 23, 23, '2012-11-07 12:03:16', '2012-11-07 12:03:16', NULL, 1),
(9, 'F2 - Payment Services', 23, 23, '2012-11-07 12:03:26', '2012-11-07 12:03:26', NULL, 1),
(10, 'F3 - Reporting Services', 23, 23, '2012-11-07 12:04:10', '2012-11-07 12:04:10', NULL, 1),
(11, 'F4 - Formation Services', 23, 23, '2012-11-07 12:04:20', '2012-11-07 12:04:20', NULL, 1),
(12, 'F5 - Consulting Services', 23, 23, '2012-11-07 12:04:31', '2012-11-07 12:04:31', NULL, 1),
(13, 'F6 - Invoicing Works', 23, 23, '2012-11-07 12:04:41', '2012-11-07 12:04:41', NULL, 1),
(14, 'F9 - EXTRA Finance Works', 23, 23, '2012-11-07 12:04:52', '2012-11-07 12:04:52', NULL, 1),
(15, 'H0 - Advertisement preparation', 23, 23, '2012-11-07 12:06:07', '2012-11-07 12:06:07', NULL, 1),
(16, 'H1 - CV evaluation', 23, 23, '2012-11-07 12:06:15', '2012-11-07 12:06:15', NULL, 1),
(17, 'H2 - Phone interviews', 23, 23, '2012-11-07 12:06:22', '2012-11-07 12:06:22', NULL, 1),
(18, 'H3 - Face-to.face interviews', 23, 23, '2012-11-07 12:07:00', '2012-11-07 12:07:00', NULL, 1),
(19, 'H4 - Head Hunting', 23, 23, '2012-11-07 12:07:45', '2012-11-07 12:07:45', NULL, 1),
(20, 'H5 - Reporting', 23, 23, '2012-11-07 12:07:53', '2012-11-07 12:07:53', NULL, 1),
(21, 'H6 - Reference Check', 23, 23, '2012-11-07 12:08:05', '2012-11-07 12:08:05', NULL, 1),
(22, 'H7 - Communication with customers', 23, 23, '2012-11-07 12:08:20', '2012-11-07 12:08:20', NULL, 1),
(23, 'H8 - Contract Preparation', 23, 23, '2012-11-07 12:08:33', '2012-11-07 12:08:33', NULL, 1),
(24, 'P0 - Project Coordination', 23, 23, '2012-11-07 12:09:04', '2012-11-07 12:09:04', NULL, 1),
(25, 'P1 - Desk research, inlcuding long list prep.', 23, 23, '2012-11-07 12:09:12', '2012-11-07 12:09:12', NULL, 1),
(26, 'P2 - Phone interviews (including reports)', 23, 23, '2012-11-07 12:09:17', '2012-11-07 12:09:17', NULL, 1),
(27, 'P3 - Face-toface interviews (including reports)', 23, 23, '2012-11-07 12:09:25', '2012-11-07 12:09:25', NULL, 1),
(28, 'P4 - Statistics (including analysing them)', 23, 23, '2012-11-07 12:09:33', '2012-11-07 12:09:33', NULL, 1),
(29, 'P5 - Mailing', 23, 23, '2012-11-07 12:09:39', '2012-11-07 12:09:39', NULL, 1),
(30, 'P6 - Communication/meetings with clients', 23, 23, '2012-11-07 12:09:48', '2012-11-07 12:09:48', NULL, 1),
(31, 'P7 - Analysis and reporting', 23, 23, '2012-11-07 12:10:14', '2012-11-07 12:10:14', NULL, 1),
(32, 'P8 - Customer visits in Turkey', 23, 23, '2012-11-07 12:10:23', '2012-11-07 12:10:23', NULL, 1),
(33, 'S0 - Travel Organization', 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(34, 'S1 - Sales Meetings', 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(35, 'S2 - Sales Correspondence', 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(36, 'S3 - Quotations', 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(37, 'S4 - Networking', 23, 23, '2012-11-07 12:11:31', '2012-11-07 12:11:31', NULL, 1),
(38, 'S5 - Newsletter', 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(39, 'S6 - Database management', 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(40, 'S7 - Other', 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(41, 'X0 - Illness', 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(42, 'P9 - Other', 23, 23, '2012-11-07 12:10:23', '2012-11-07 12:10:23', NULL, 1);



INSERT INTO `working_hour_work_type_group` (`worktype_id`, `group_id`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
(1, 2, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(1, 3, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(1, 4, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(1, 5, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(1, 6, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(1, 7, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(1, 8, 23, 23, '2012-11-07 11:58:05', '2012-11-07 11:58:05', NULL, 1),
(2, 2, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(2, 3, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(2, 4, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(2, 5, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(2, 6, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(2, 7, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(2, 8, 23, 23, '2012-11-07 11:58:59', '2012-11-07 11:58:59', NULL, 1),
(3, 2, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(3, 3, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(3, 4, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(3, 5, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(3, 6, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(3, 7, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(3, 8, 23, 23, '2012-11-07 12:00:46', '2012-11-07 12:00:46', NULL, 1),
(4, 2, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(4, 3, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(4, 4, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(4, 5, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(4, 6, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(4, 7, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(4, 8, 23, 23, '2012-11-07 12:00:59', '2012-11-07 12:00:59', NULL, 1),
(5, 2, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(5, 3, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(5, 4, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(5, 5, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(5, 6, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(5, 7, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(5, 8, 23, 23, '2012-11-07 12:01:22', '2012-11-07 12:01:22', NULL, 1),
(6, 2, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(6, 3, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(6, 4, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(6, 5, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(6, 6, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(6, 7, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(6, 8, 23, 23, '2012-11-07 12:01:32', '2012-11-07 12:01:32', NULL, 1),
(7, 4, 23, 23, '2012-11-07 12:02:56', '2012-11-07 12:02:56', NULL, 1),
(8, 4, 23, 23, '2012-11-07 12:03:16', '2012-11-07 12:03:16', NULL, 1),
(9, 4, 23, 23, '2012-11-07 12:03:26', '2012-11-07 12:03:26', NULL, 1),
(10, 4, 23, 23, '2012-11-07 12:04:10', '2012-11-07 12:04:10', NULL, 1),
(11, 4, 23, 23, '2012-11-07 12:04:20', '2012-11-07 12:04:20', NULL, 1),
(12, 4, 23, 23, '2012-11-07 12:04:31', '2012-11-07 12:04:31', NULL, 1),
(13, 4, 23, 23, '2012-11-07 12:04:41', '2012-11-07 12:04:41', NULL, 1),
(14, 4, 23, 23, '2012-11-07 12:04:52', '2012-11-07 12:04:52', NULL, 1),
(15, 5, 23, 23, '2012-11-07 12:06:07', '2012-11-07 12:06:07', NULL, 1),
(16, 5, 23, 23, '2012-11-07 12:06:15', '2012-11-07 12:06:15', NULL, 1),
(17, 5, 23, 23, '2012-11-07 12:06:22', '2012-11-07 12:06:22', NULL, 1),
(18, 5, 23, 23, '2012-11-07 12:07:08', '2012-11-07 12:07:08', NULL, 1),
(19, 5, 23, 23, '2012-11-07 12:07:45', '2012-11-07 12:07:45', NULL, 1),
(20, 5, 23, 23, '2012-11-07 12:07:53', '2012-11-07 12:07:53', NULL, 1),
(21, 5, 23, 23, '2012-11-07 12:08:05', '2012-11-07 12:08:05', NULL, 1),
(22, 5, 23, 23, '2012-11-07 12:08:20', '2012-11-07 12:08:20', NULL, 1),
(23, 5, 23, 23, '2012-11-07 12:08:33', '2012-11-07 12:08:33', NULL, 1),
(33, 2, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(33, 3, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(33, 4, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(33, 5, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(33, 6, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(33, 7, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(33, 8, 23, 23, '2012-11-07 12:11:00', '2012-11-07 12:11:00', NULL, 1),
(34, 2, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(34, 3, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(34, 4, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(34, 5, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(34, 6, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(34, 7, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(34, 8, 23, 23, '2012-11-07 12:11:07', '2012-11-07 12:11:07', NULL, 1),
(35, 2, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(35, 3, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(35, 4, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(35, 5, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(35, 6, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(35, 7, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(35, 8, 23, 23, '2012-11-07 12:11:14', '2012-11-07 12:11:14', NULL, 1),
(36, 2, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(36, 3, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(36, 4, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(36, 5, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(36, 6, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(36, 7, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(36, 8, 23, 23, '2012-11-07 12:11:22', '2012-11-07 12:11:22', NULL, 1),
(37, 2, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(37, 3, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(37, 4, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(37, 5, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(37, 6, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(37, 7, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(37, 8, 23, 23, '2012-11-07 12:11:32', '2012-11-07 12:11:32', NULL, 1),
(38, 2, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(38, 3, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(38, 4, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(38, 5, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(38, 6, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(38, 7, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(38, 8, 23, 23, '2012-11-07 12:11:40', '2012-11-07 12:11:40', NULL, 1),
(39, 2, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(39, 3, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(39, 4, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(39, 5, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(39, 6, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(39, 7, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(39, 8, 23, 23, '2012-11-07 12:11:47', '2012-11-07 12:11:47', NULL, 1),
(40, 2, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(40, 3, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(40, 4, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(40, 5, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(40, 6, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(40, 7, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(40, 8, 23, 23, '2012-11-07 12:11:55', '2012-11-07 12:11:55', NULL, 1),
(41, 2, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(41, 3, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(41, 4, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(41, 5, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(41, 6, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(41, 7, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1),
(41, 8, 23, 23, '2012-11-07 12:12:07', '2012-11-07 12:12:07', NULL, 1);


SET FOREIGN_KEY_CHECKS=1;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;








