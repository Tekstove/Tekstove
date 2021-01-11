#!/bin/bash

set -e

export PROJECT_NAME=tekstove

docker network inspect $PROJECT_NAME || docker network create $PROJECT_NAME

# If the script is run with sudo, UID is 0. This is an issue when running
# "usermod -u $WEB_UID www-data" in the web container.
# In this case assign WEB_UID to 1000
[[ $UID == 0 ]] && export WEB_UID=1000 || export WEB_UID=$UID

while getopts u: flag
do
    case "${flag}" in
        u) EXTRA_UP_FILES=${OPTARG};;
    esac
done

echo "Extra up files: $EXTRA_UP_FILES"

cd docker

docker-compose -p $PROJECT_NAME build
docker-compose -p $PROJECT_NAME -f docker-compose.yml ${EXTRA_UP_FILES} up
