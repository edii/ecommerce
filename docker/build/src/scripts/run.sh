#!/bin/bash

sudo mkdir -p /tmp/sessions
sudo chown docker-data.docker-data /tmp/sessions -Rf

if [ ! -d "/var/www/tmp/logs" ]; then
    sudo mkdir /var/www/tmp/logs
    sudo chmod -R 0777 /var/www/tmp/logs
fi

if [ ! -d "/var/www/tmp/run" ]; then
    sudo mkdir /var/www/tmp/run
    sudo chmod -R 0777 /var/www/tmp/run
fi

if [ ! -d "/var/www/tmp/sessions" ]; then
    sudo mkdir /var/www/tmp/sessions
    sudo chmod -R 0777 /var/www/tmp/sessions
fi

# chmod -R 0777 /var/www
sudo chmod -R 0777 /var/www/tmp
sudo chmod -R 0777 /var/run
sudo chmod -R 0777 /var/log

#fix composer
if [ -f "/usr/local/bin/composer" ]; then
    sudo chmod +x /usr/local/bin/composer
fi

# CUSTOM SH SCRIPTS
if [ -f "/scripts/custom.sh" ]; then
    sh /scripts/custom.sh
fi

#RUN system
sudo /usr/bin/supervisord -n -c /etc/supervisord.conf