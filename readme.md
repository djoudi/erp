Install notes:
--------------
<to be filled>

Usage notes:
------------
To start WHDB weekly report e-mail task:
> ./symfony workingHour:sendReport

To start the e-mail task daily, with CRON
> 0 0 * * * /usr/bin/php /var/www/erp/symfony workingHour:sendReport

Developer notes (Use with precaution):
--------------------------------------
Send all WHDB weekly e-mails now:
> ./symfony workingHour:sendReport --sendnow="true"

Disable sending e-mail to all users with MySQL:
> UPDATE sf_guard_user SET send_email="0" WHERE 1;
