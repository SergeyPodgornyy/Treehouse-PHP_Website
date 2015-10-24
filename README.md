# Website built on PHP

You need installed Composer to work properly with this project. Please also check composer.json before start work with.

To install the defined dependencies for your project, just run the install command.
```
php composer.phar install
```


To update dependencies run the following command:
```
php composer.phar update
```



If you can't direct visit `http://localhost/contact`, perheps it displays on `http://localhost/index.php/contact`. To avoid this inconvenient link, check the following link [how to enable mod_rewrite](http://www.dev-metal.com/enable-mod_rewrite-ubuntu-14-04-lts/).

Or if the link is not active more, just follow the instruction below:

Activate the mod_rewrite module with:
```
sudo a2enmod rewrite
```
and restart the apache
```
sudo service apache2 restart
```
To use mod_rewrite from within .htaccess files (which is a very common use case), edit the default VirtualHost with
```
sudo nano /etc/apache2/sites-available/000-default.conf
```
Search for “DocumentRoot /var/www/html” and add the following lines directly below:
```
<Directory "/var/www/html">
    AllowOverride All
</Directory>
```
Save and exit the nano editor via CTRL-X, “y” and ENTER.

Restart the server again:
```
sudo service apache2 restart
```
To check if mod_rewrite is installed correctly, check your phpinfo() output. 



**Note:** To remove index.php from the URL, and to redirect the visitor to the non-index.php version of the page: *Move .htaccess file to root directory, where is index.php there.* Check is it looks like:
```
RewriteEngine On

# Some hosts may require you to use the `RewriteBase` directive.
# If you need to use the `RewriteBase` directive, it should be the
# absolute physical path to the directory that contains this htaccess file.
#
# RewriteBase /

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]

```


Before send a message from Contact page, as a root you need to install the following programms (if you use Debian-based GNU/Linux)
```
apt-get install sendmail
```
and then
```
apt-get install mailutils
```

Before send a message from Contact page, as a root you need to install the following programms (if you use RPM-based GNU/Linux)
```
yum install sendmail
```
and then
```
yum install mailutils
```
