#!/bin/bash

cd /var/www/vocare.local/
php symfony vocare:crontab --debug 1 >> log/crontab.log
