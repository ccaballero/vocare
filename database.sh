#!/bin/bash

#php symfony configure:database --name=doctrine --class=sfDoctrineDatabase "mysql:host=localhost;dbname=dbname" user secret
php symfony configure:database --name=doctrine --class=sfDoctrineDatabase "mysql:host=localhost;dbname=convocatorias" convocatorias convocatorias

