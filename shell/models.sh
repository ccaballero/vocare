#!/bin/bash

SYMFONY='/opt/symfony/data/bin/symfony'
PROJECT_PATH='/var/www/vocare.local/'

cd $PROJECT_PATH
if test "$1" = "production"
then
    echo '\033[01;33m>>           create the data relations in' \
         'production server\033[00m'
    $SYMFONY doctrine:build --db --no-confirmation --env=production;
else
    echo '\033[01;33m>>           create the data relations in' \
         'development server\033[00m'
    $SYMFONY doctrine:build --db --no-confirmation
fi

