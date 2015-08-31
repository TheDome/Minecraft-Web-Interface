#!/bin/bash

# Updating repository
 
#sudo apt-get -y update
 
# Installing Apache
 
sudo apt-get -y install apache2
 
# Installing MySQL and it's dependencies, Also, setting up root password for MySQL as it will prompt to enter the password during installation
 
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password vagrant'
sudo debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password vagrant'
sudo apt-get -y install mysql-server libapache2-mod-auth-mysql php5-mysql php5-xdebug
 
# Installing PHP and it's dependencies
sudo apt-get -y install php5 libapache2-mod-php5 php5-mcrypt

# xdebug Config
cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF

# PHP Config
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

sudo service apache2 restart

sudo usermod -a -G www-data vagrant
sudo chmod 777 /var/www/html/
sudo rm /var/www/html/index.html

sudo apt-get upgrade -y