#!/bin/bash

set -e

usermod -u $WEB_UID www-data

chown www-data -R /var/www
apachectl -D FOREGROUND
