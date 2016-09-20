#! /usr/bin/env bash

SCRIPT_DIR=$( cd ${0%/*} && pwd -P )
DIR_PROJECT=$(dirname "$SCRIPT_DIR")
PATH_MYSQL_BACKUP="/../../../../mysql/backup"
PATH_SYSTEM_SAVE_BACKUP="${DIR_PROJECT}${PATH_MYSQL_BACKUP}"
DOCKER_EXEC=portal_mysql
DOCKER_HOST=mysql

if [ $1 ];then
    DOCKER_EXEC=$1
fi

if [ $2 ];then
    DOCKER_HOST=$2
fi

if [ ! -d "$PATH_SYSTEM_SAVE_BACKUP" ]; then
    echo "Is not use DIR ${PATH_SYSTEM_SAVE_BACKUP}";
    exit 1
fi

echo "#----------------------- LOAD DUMP IN PROJECTS -------------------------------#";
find $PATH_SYSTEM_SAVE_BACKUP -type f -iname "*.sql" | while read -r FILE
do
    filename=$(basename "$FILE")
    filename="${filename%.*}"

    echo "do something with $FILE"
    echo "CREATE DATABASE IF NOT EXISTS $filename" | docker exec -i $DOCKER_EXEC $DOCKER_HOST -uroot -proot
    docker exec -i $DOCKER_EXEC $DOCKER_HOST -uroot -proot $filename < $FILE
    echo "load done."
done
echo "#--------------------------------- END ---------------------------------------#";