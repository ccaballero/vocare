#!/bin/bash

cd /srv/convocatorias.cs.umss.edu.bo/vocare/
php symfony vocare:crontab --debug 60 >> log/crontab.log

