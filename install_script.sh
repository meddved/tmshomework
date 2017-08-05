#!/bin/bash
# A TMS Homework install script
echo "Let us install dependencies first"
composer install
echo "Setting up database"
php bin/console doctrine:migrations:migrate
"Loading initial data into database"
php bin/console doctrine:fixtures:load