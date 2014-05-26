#!/usr/bin/env bash

echo '--- Update repositories with apt ---'
apt-get update
echo '...done'


echo '--- Installing gcc screen vim unzip curl wget man ---'
apt-get install -y build-essential screen vim nano unzip curl wget man
echo '...done'


echo '--- Installing git ---'
apt-get install -y git
echo '...done'


echo '--- Installing MySQL and PHP5 ---'
apt-get install mysql-server php5 php5-cli
echo '...done'


echo '--- Installing apache2 ---'
apt-get install -y apache2
echo '...done'


echo '--- Installing php-pear ---'
apt-get install -y php-pear
pear channel-discover pear.phpunit.de
pear channel-discover pear.symfony-project.com
echo '...done'


echo '--- Installing PHPUnit ---'
pear install -a phpunit/PHPUnit
echo '...done'


echo '--- Installing composer ---'
if [[ ! -f /usr/local/bin/composer ]]; then
    curl -s https://getcomposer.org/installer | php
    # Make Composer available globally
    mv composer.phar /usr/local/bin/composer
else
    echo '[composer already installed]'
fi
echo '...done'


echo '--- Installing OpenSSL ---'
apt-get install -y openssl
echo '...done'


echo '--- Activating mod_rewrite and mod_ssl ---'
a2enmod rewrite
a2enmod ssl
echo '...done'


echo '--- Creating vHost ---'
mkdir -p /var/www/mashtag/{public_html,logs}

VHOST=$(cat <<EOF
NameVirtualHost *:80

#mashtag
<VirtualHost *:80>
    ServerName mashtag
    DocumentRoot /var/www/mashtag/public
    RewriteOptions inherit

    ErrorLog /var/www/mashtag/logs/error.log
    CustomLog /var/www/mashtag/logs/access.log
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/default
echo '...done'


echo '--- Restarting Apache ---'
service apache2 restart
echo '...done'

