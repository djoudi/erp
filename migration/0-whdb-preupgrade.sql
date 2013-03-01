SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE leave_request_limit_version (id BIGINT, employee_id BIGINT NOT NULL, type_id BIGINT NOT NULL, leavelimit BIGINT NOT NULL, creater_id INT NOT NULL, updater_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, version BIGINT, PRIMARY KEY(id, version)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;

CREATE TABLE leave_request_limit (id BIGINT AUTO_INCREMENT, employee_id BIGINT NOT NULL, type_id BIGINT NOT NULL, leavelimit BIGINT NOT NULL, creater_id INT NOT NULL, updater_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, version BIGINT, INDEX employee_id_idx (employee_id), INDEX type_id_idx (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = INNODB;


DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE IF NOT EXISTS `leave_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `default_limit` bigint(20) NOT NULL DEFAULT '0',
  `has_report` tinyint(1) NOT NULL DEFAULT '0',
  `will_be_paid` tinyint(1) NOT NULL DEFAULT '1',
  `creater_id` int(11) NOT NULL,
  `updater_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `version` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `leave_type_version`;
CREATE TABLE IF NOT EXISTS `leave_type_version` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `default_limit` bigint(20) NOT NULL DEFAULT '0',
  `has_report` tinyint(1) NOT NULL DEFAULT '0',
  `will_be_paid` tinyint(1) NOT NULL DEFAULT '1',
  `creater_id` int(11) NOT NULL,
  `updater_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `version` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
