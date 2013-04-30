#!/bin/bash

if test "$1" = "production"
then
    echo create the data relations in production server ...;
    php symfony doctrine:build --db --no-confirmation --env=production;
else
    echo create models, and database relations ...;
    php symfony doctrine:build --db --no-confirmation
fi

