SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `sf_guard_permission` (`name`, `description`, `creater_id`, `updater_id`, `created_at`, `updated_at`, `deleted_at`, `version`) VALUES
('WorkingHours: Add My Hours', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL),
('WorkingHours: Add Employee Hours', NULL, 0, 0, '2012-01-11 18:21:29', '2012-01-11 18:21:29', NULL, NULL);


/* UPDATING Employee Entrance dates according to #27 */

/*UPDATE `sf_guard_user` SET `employment_start`="2012-11-01" WHERE `id`=1; /*Altin Kavadarli*/
UPDATE `sf_guard_user` SET `employment_start`="2014-04-08" WHERE `id`=1; /*Aslan Akguc*/
UPDATE `sf_guard_user` SET `employment_start`="2012-12-03" WHERE `id`=42; /*Ayca Kulac*/
/*UPDATE `sf_guard_user` SET `employment_start`="2011-12-02" WHERE `id`=1; /*Berna Yogurtcugil*/
UPDATE `sf_guard_user` SET `employment_start`="2013-03-20" WHERE `id`=49; /*Beste Buyukyilmaz*/
/*UPDATE `sf_guard_user` SET `employment_start`="2012-02-17" WHERE `id`=1; /*Betul Erdem*/
UPDATE `sf_guard_user` SET `employment_start`="2012-02-20" WHERE `id`=33; /*Binnaz Yalcinkaya*/
UPDATE `sf_guard_user` SET `employment_start`="2012-07-02" WHERE `id`=38; /*Burak Tuna*/
UPDATE `sf_guard_user` SET `employment_start`="2011-02-21" WHERE `id`=2; /*Burcu Gumus*/
UPDATE `sf_guard_user` SET `employment_start`="2013-01-25" WHERE `id`=47; /*Burcin Tortop*/
/*UPDATE `sf_guard_user` SET `employment_start`="2012-06-20" WHERE `id`=1; /*Emin Kasapoglu*/
UPDATE `sf_guard_user` SET `employment_start`="2010-02-17" WHERE `id`=4; /*Emine Ozcelik*/
UPDATE `sf_guard_user` SET `employment_start`="2011-03-01" WHERE `id`=5; /*Emrah Ulku*/
UPDATE `sf_guard_user` SET `employment_start`="2012-09-19" WHERE `id`=39; /*Gulay Bagci*/
UPDATE `sf_guard_user` SET `employment_start`="2012-06-01" WHERE `id`=36; /*Guliz Celik*/
UPDATE `sf_guard_user` SET `employment_start`="2010-08-01" WHERE `id`=10; /*Hande Bilgin*/
UPDATE `sf_guard_user` SET `employment_start`="2013-03-11" WHERE `id`=50; /*Koray Cindik*/
UPDATE `sf_guard_user` SET `employment_start`="2012-12-10" WHERE `id`=41; /*Mursel Demir*/
UPDATE `sf_guard_user` SET `employment_start`="2011-03-02" WHERE `id`=30; /*Osman Yildiz*/
UPDATE `sf_guard_user` SET `employment_start`="2013-03-01" WHERE `id`=48; /*Oya Dincoglu*/
UPDATE `sf_guard_user` SET `employment_start`="2011-05-03" WHERE `id`=14; /*Ozlem Ilica*/
UPDATE `sf_guard_user` SET `employment_start`="2006-03-01" WHERE `id`=44; /*Peter Heidinger*/
/*UPDATE `sf_guard_user` SET `employment_start`="2012-07-09" WHERE `id`=1; /*Sema Meric*/
UPDATE `sf_guard_user` SET `employment_start`="2011-04-20" WHERE `id`=16; /*Sevda Sanlier*/
UPDATE `sf_guard_user` SET `employment_start`="2012-03-02" WHERE `id`=31; /*Sevil Eskicioglu*/
UPDATE `sf_guard_user` SET `employment_start`="2012-12-03" WHERE `id`=43; /*Sezin Ata*/
UPDATE `sf_guard_user` SET `employment_start`="2010-09-06" WHERE `id`=17; /*Sidika Bilen*/
UPDATE `sf_guard_user` SET `employment_start`="2012-03-14" WHERE `id`=32; /*Sinem Cakir*/
UPDATE `sf_guard_user` SET `employment_start`="2010-08-17" WHERE `id`=18; /*Sultan Kahraman*/
/*UPDATE `sf_guard_user` SET `employment_start`="2003-10-09" WHERE `id`=1; /*Sehriban Kablan*/
UPDATE `sf_guard_user` SET `employment_start`="2008-02-05" WHERE `id`=19; /*Tulay Tastan*/
UPDATE `sf_guard_user` SET `employment_start`="2013-01-21" WHERE `id`=46; /*Yasemin Aydemir*/
/*UPDATE `sf_guard_user` SET `employment_start`="2012-11-01" WHERE `id`=1; /*Yasemin Yildiz*/
UPDATE `sf_guard_user` SET `employment_start`="2011-01-13" WHERE `id`=21; /*Yasemin Ozturk*/


SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
