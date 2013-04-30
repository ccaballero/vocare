#!/bin/bash

# $1 => hostname from database
# $2 => database name
# $3 => database user
# $4 => password user

php symfony configure:database\
    --name=doctrine\
    --class=sfDoctrineDatabase\
    "mysql:host=$1;dbname=$2"\
    $3\
    $4

