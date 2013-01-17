user_id > employee_id
(sfguard_ lar hariç)

departman : default work type : elle gir

leavetype : unlimited için : 9999 gir

employee : elle send email seç (yasin ve yeşim için)

frontend factories.yml > context host gir

cron:
* * * * 0 /usr/bin/php /srv/fmcdata/symfony workingHour:sendWeekly
* * * * * /usr/bin/php /www/fmcdemo.yasinaydin.net/symfony workingHour:sendWeekly

* * * * 0 /www/fmcdemo.yasinaydin.net



her şey bitince:
DELETE FROM `sf_guard_user` WHERE `id` = 23;

ekle:
INSERT IGNORE INTO `sf_guard_user` (`id`, `first_name`, `last_name`, `title`, `email_address`, `username`, `algorithm`, `salt`, `password`, `is_active`, `is_super_admin`, `last_login`, `group_id`, `created_at`, `updated_at`, `version`) VALUES 
(23, 'Yasin', 'Aydın', '', 'yasin@yasinaydin.net', 'yasin', 'sha1', 'e12d942ac806eccc6125b473b7426125', '2465953bd5a76234c121f33d6c748f17ac405529', 1, 0, '2012-11-01 12:00:11', 7, '2012-01-11 18:21:30', '2012-11-01 12:00:11', 15);
