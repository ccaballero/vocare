#!/bin/bash

if test "$1" = "production"
then
    echo insert the data in production server ...;
    php symfony doctrine:data-load --env=production
else
    echo insert the data ...;
    php symfony doctrine:data-load;
fi;

