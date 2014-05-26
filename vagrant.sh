#!/usr/bin/env bash

echo '--- Installing gcc screen vim unzip curl wget man ---'
yum install -y gcc screen vim unzip curl wget man
echo '...done'


echo '--- Installing git ---'
yum install -y git
echo '...done'


echo '--- Installing php ---'
yum install -y php
yum install -y php-cli
yum install -y php-devel
yum install -y php-pdo
yum install -y php-mysql
yum install -y php-curl
yum install -y php-xml
yum install -y php-soap
# yum install -y php-mcrypt ## CentOS 6 does not have mcrypt
yum install -y php-pecl-apc

# http://www.rackspace.com/knowledge_center/article/installing-rhel-epel-repo-on-centos-5x-or-6x

echo '...done'


echo '--- Installing php-pear ---'
yum install -y php-pear
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


echo '--- Installing apache ---'
yum install -y httpd
echo '...done'


echo '--- Installing mod_ssl ---'
yum install -y mod_ssl
echo '...done'


echo '--- Creating vHost ---'
VHOST=$(cat <<EOF
NameVirtualHost *:80

#mashtag
<VirtualHost *:80>
    ServerName mashtag
    DocumentRoot /var/www/mashtag/public
    RewriteOptions inherit

    ErrorLog logs/mashtag-error_log
    CustomLog logs/mashtag-access_log
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/httpd/conf.d/vhost.conf
echo '...done'


echo '--- Replacing Apache Config ---'
APACHECONF=$(cat <<EOF
ServerTokens Prod
ServerSignature Off
ServerRoot "/etc/httpd"
ServerName localhost
ServerAdmin root@localhost

PidFile run/httpd.pid

Timeout 60

KeepAlive On
MaxKeepAliveRequests 1000
KeepAliveTimeout 30

<IfModule prefork.c>
StartServers       4
MinSpareServers    4
MaxSpareServers   20
ServerLimit      256
MaxClients       256
MaxRequestsPerChild  500
</IfModule>

<IfModule worker.c>
StartServers         4
MaxClients         300
MinSpareThreads     25
MaxSpareThreads     75 
ThreadsPerChild     25
MaxRequestsPerChild  0
</IfModule>

Listen 80

LoadModule auth_basic_module modules/mod_auth_basic.so
LoadModule auth_digest_module modules/mod_auth_digest.so
LoadModule authn_file_module modules/mod_authn_file.so
LoadModule authn_alias_module modules/mod_authn_alias.so
LoadModule authn_dbm_module modules/mod_authn_dbm.so
LoadModule authn_default_module modules/mod_authn_default.so
LoadModule authz_host_module modules/mod_authz_host.so
LoadModule authz_user_module modules/mod_authz_user.so
LoadModule authz_default_module modules/mod_authz_default.so
LoadModule include_module modules/mod_include.so
LoadModule log_config_module modules/mod_log_config.so
LoadModule logio_module modules/mod_logio.so
LoadModule env_module modules/mod_env.so
LoadModule mime_magic_module modules/mod_mime_magic.so
LoadModule expires_module modules/mod_expires.so
LoadModule deflate_module modules/mod_deflate.so
LoadModule headers_module modules/mod_headers.so
LoadModule usertrack_module modules/mod_usertrack.so
LoadModule setenvif_module modules/mod_setenvif.so
LoadModule mime_module modules/mod_mime.so
LoadModule status_module modules/mod_status.so
LoadModule info_module modules/mod_info.so
LoadModule vhost_alias_module modules/mod_vhost_alias.so
LoadModule negotiation_module modules/mod_negotiation.so
LoadModule dir_module modules/mod_dir.so
LoadModule userdir_module modules/mod_userdir.so
LoadModule alias_module modules/mod_alias.so
LoadModule rewrite_module modules/mod_rewrite.so
LoadModule cache_module modules/mod_cache.so
LoadModule suexec_module modules/mod_suexec.so
LoadModule disk_cache_module modules/mod_disk_cache.so

Include conf.d/*.conf

User vagrant
Group vagrant

UseCanonicalName Off

DocumentRoot "/var/www/vhost"

<Directory />
    Options FollowSymLinks
    AllowOverride All
</Directory>

<Directory "/var/www/vhost">
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>

<IfModule mod_userdir.c>
    UserDir disabled
</IfModule>

DirectoryIndex index.html index.html.var

AccessFileName .htaccess

<Files ~ "^\.ht">
    Order allow,deny
    Deny from all
    Satisfy All
</Files>

TypesConfig /etc/mime.types
DefaultType text/plain

<IfModule mod_mime_magic.c>
    MIMEMagicFile conf/magic
</IfModule>

HostnameLookups Off

ErrorLog logs/error_log
LogLevel warn
LogFormat "%h %l %u %t \"%r\" %>s %b \"%{Referer}i\" \"%{User-Agent}i\"" combined
LogFormat "%h %l %u %t \"%r\" %>s %b" common
LogFormat "%{Referer}i -> %U" referer
LogFormat "%{User-agent}i" agent
CustomLog logs/access_log combined

AddLanguage en .en
LanguagePriority en
ForceLanguagePriority Prefer Fallback
AddDefaultCharset UTF-8

AddType application/x-compress .Z
AddType application/x-gzip .gz .tgz
AddHandler type-map var
AddType text/html .shtml
AddOutputFilter INCLUDES .shtml
EOF
)
echo "${APACHECONF}" > /etc/httpd/conf/httpd.conf
echo '...done'


echo '--- Restarting Services ---'
service httpd restart
echo '...done'
