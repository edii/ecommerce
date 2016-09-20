#!/usr/bin/env bash

## CHMODS
sudo chmod -R 0777 /var/www/bin
sudo chmod -R 0777 /var/www/vendor

##CHOWNS
chown docker-data.docker-data /var/www/bin -Rf
chown docker-data.docker-data /var/www/vendor -Rf

# install postgresql-client
yum install -y postgresql-client

### --bower
sudo npm install bower -g
### --gulp
sudo npm install gulp -g
### --webpack
#sudo npm install webpack -g
### --webpack-dev-server
#sudo npm install webpack-dev-server -g
### --karma
#sudo npm install karma -g