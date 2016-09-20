#!/bin/bash

# function loger
logger() {
  echo "$@"
}
# check sewrvice runer
check_service(){
  RESULT="$(ps -A|grep $1|wc -l)"
  if [ $RESULT -gt 0 ]; then
    logger "ОШИБКА:"
    logger "-- При проверке обнаружено, что служба $1 была запущена!"
    logger "-- Произведена попытка остановки в $(date +"%d.%m.%y %H:%M:%S")..."
    /etc/init.d/$1 $2
    sleep 1
    logger "ТЕКУЩИЙ СТАТУС:"
    RESULT="$(ps -A|grep $1|wc -l)"
    if [ $RESULT -eq 0 ]; then
      logger "-- служба $1 сейчас НЕ ЗАПУЩЕНА!"
      logger ""
    else
      logger "-- $1 сейчас запущена..."
      logger ""
    fi
  fi
}

if [ $1 ] && [ $1 = "fix-service" ];then
    ## fix system confolict in started service
    ### -- apache2
    check_service "apache2" "stop"
    ### -- php-fpm
    check_service "php-fpm" "stop"
    ### -- php5-fpm
    check_service "php5-fpm" "stop"
    ### -- redis-server
    check_service "redis-server" "stop"
    ### -- nginx
    check_service "nginx" "stop"
    ### -- mysql
    check_service "mysql" "stop"
    ### -- postgresql
    check_service "postgresql" "stop"
    ### -- memcached
    check_service "memcached" "stop"
    ### -- rabbitmq-server
    check_service "rabbitmq-server" "stop"
fi

# variables
UID_VAR="{{ UID_VALUE }}"
UID_VALUE=$(id -u)
if [ $(id -u) -eq 1000 ] || [ $(id -u) -eq 0 ]; then
    UID_VALUE=100010
fi
GID_VAR="{{ GID_VALUE }}"
GID_VALUE=$(id -g)
if [ $(id -g) -eq 1000 ] || [ $(id -g) -eq 0 ]; then
    GID_VALUE=100010
fi

# output
echo ${UID_VAR} = ${UID_VALUE}
echo ${GID_VAR} = ${GID_VALUE}

if [ ! -f "docker-compose-template.yml" ]; then
    logger "Not File existing: docker-compose-template.yml."
    exit 1
fi

# find and replace
sed -e "s/${UID_VAR}/${UID_VALUE}/g" \
    -e "s/${GID_VAR}/${GID_VALUE}/g" \
    < docker-compose-template.yml \
    > docker-compose.yml

# install docker vendor
if [ ! -d "docker" ]; then
    logger "Not used dir: docker."
    exit 1
fi

if [ ! -f "docker/build/src/Dockerfile.yml" ]; then
    logger "Canot install Dockerfile.yml"
    exit 1
else
    if [ ! -f "/usr/bin/docker" ]; then
        logger "Pleas install docker."
        exit 1
    else
        docker-compose up -d
    fi
fi