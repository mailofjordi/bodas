#!/usr/bin/env bash

echo "///////////////////////////////////////////////"
echo "Updating canonical repositories..."
echo "///////////////////////////////////////////////"
apt-get update > /dev/null

echo "///////////////////////////////////////////////"
echo "Installing php..."
echo "///////////////////////////////////////////////"
apt-get install --assume-yes php5-cli
apt-get install --assume-yes php5-mcrypt php5-intl php5-mysql php5-curl

echo "///////////////////////////////////////////////"
echo "Installing Mysql..."
echo "///////////////////////////////////////////////"
export DEBIAN_FRONTEND=noninteractive
apt-get -q -y install mysql-server

echo "///////////////////////////////////////////////"
echo "Installing curl..."
echo "///////////////////////////////////////////////"
apt-get install --assume-yes curl

echo "///////////////////////////////////////////////"
echo "Setting php-cli date.timezone to Madrid..."
echo "///////////////////////////////////////////////"
sudo sed -i "s/^;date.timezone =$/date.timezone = \"Europe\/Madrid\"/" /etc/php5/cli/php.ini |grep "^timezone" /etc/php5/cli/php.ini

echo "///////////////////////////////////////////////"
echo "Installing composer..."
echo "///////////////////////////////////////////////"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

echo "///////////////////////////////////////////////"
echo "Configuring project..."
echo "///////////////////////////////////////////////"
sudo sed -i "s/^    database_host: 127.0.0.1$/    database_host: 127.0.0.1\n    database_driver: pdo_pgsql/" /vagrant/app/config/parameters.yml
