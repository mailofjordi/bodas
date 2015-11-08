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
echo "Installing git..."
echo "///////////////////////////////////////////////"
apt-get install --assume-yes git

echo "///////////////////////////////////////////////"
echo "Installing symfony installer..."
echo "///////////////////////////////////////////////"
curl -LsS http://symfony.com/installer -o /usr/local/bin/symfony
chmod a+x /usr/local/bin/symfony

echo "///////////////////////////////////////////////"
echo "Setting php-cli date.timezone to Madrid..."
echo "///////////////////////////////////////////////"
sudo sed -i "s/^;date.timezone =$/date.timezone = \"Europe\/Madrid\"/" /etc/php5/cli/php.ini |grep "^timezone" /etc/php5/cli/php.ini

echo "///////////////////////////////////////////////"
echo "Explicitly set default client_encoding..."
echo "///////////////////////////////////////////////"
echo "client_encoding = utf8" >> "/etc/postgresql/9.3/main/postgresql.conf"

echo "///////////////////////////////////////////////"
echo "Create a new postgresql user with password..."
echo "///////////////////////////////////////////////"
cat << EOF | su - postgres -c psql
-- Create the database user:
CREATE USER dbuser WITH PASSWORD 'db-user';
ALTER USER dbuser CREATEDB;
EOF
