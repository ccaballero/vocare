#!/bin/bash

bash shell/models.sh production
bash shell/data.sh production
./symfony vocare:loadCSV --env=production data/csv/01_postulantes.csv
./symfony vocare:loadCSV --env=production data/csv/02_postulantes.csv
./symfony vocare:loadCSV --env=production data/csv/02_recepcion.csv
./symfony vocare:loadCSV --env=production data/csv/02_habilitacion.csv

