Prequisites:
------------
- Create your empty database on your database server and have your access information ready.
- Required packages: apache2 (+mod_rewrite), php5, php5-xsl, php-pear, mysql-server, php5-mysql
- Optional packages: apc, php5-gd


Install notes:
--------------
Change to your web directory:
> cd /var/www/

Clone project:
> git://github.com/yasinaydin/erp.git

Go to project folder:
> cd erp

Create required symfony cache and log folders:
> mkdir -p cache log web/uploads/images

Update required permissions:
> ./symfony project:permissions

Publish plugin files to web folder:
> ./symfony plugin:publish-assets

Copy database config file from draft:
> cp config/databases.yml.sample config/databases.yml

Edit database file and fill with your own database info:
> vim config/databases.yml

Update model, filter, classes and write to database:
> ./symfony doctrine:build --all --and-load

Clear symfony cache:
> ./symfony cc


Apache settings:
----------------
Put these settings on your Apache host/vhost file to access to the program:
> &lt;VirtualHost *:80&gt;  
> ServerName  cms.local  
> DirectoryIndex index.php  
> DocumentRoot /var/www/erp/web/  
>   
> &lt;Directory "/var/www/erp/web/"&gt;  
> AllowOverride All  
> Allow from All  
> &lt;/Directory&gt;  
>   
> &lt;/VirtualHost&gt;  


Extra settings:
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
