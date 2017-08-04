TMS Homework
============

A Symfony project created on August 3, 2017, 3:38 pm.

Installation
===========
* Execute 'composer install' command from terminal
* Execute 'php bin/console doctrine:migrations:migrate'
* Execute 'php bin/console doctrine:fixtures:load'
* Copy tmshomework.conf to your web server 
ex. Linux/apache -> copy the file to /etc/apache2/sites-available/. 
* Execute 'sudo a2ensite /etc/apache2/sites-available/tmshomework.conf'
* Execute 'sudo service apache2 reload'

Now when you go to 'http://tmshomework.conf' in yoour browser you should see the login page.

If you have any additional questions please do not hesitate and contact me at meddved@gmail.com
 