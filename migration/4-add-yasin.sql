SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

INSERT IGNORE INTO `sf_guard_user` (`id`, `first_name`, `last_name`, `title`, `email_address`, `username`, `algorithm`, `salt`, `password`, `is_active`, `is_super_admin`, `last_login`, `group_id`, `created_at`, `updated_at`, `version`) VALUES 
(23, 'Yasin', 'Aydın', '', 'yasin@yasinaydin.net', 'yasin', 'sha1', 'e12d942ac806eccc6125b473b7426125', '2465953bd5a76234c121f33d6c748f17ac405529', 1, 0, '2012-11-01 12:00:11', 7, '2012-01-11 18:21:30', '2012-11-01 12:00:11', 15);

SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
