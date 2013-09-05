#!/bin/bash

bash shell/models.sh
bash shell/data.sh
./symfony vocare:loadCSV data/csv/01_postulantes.csv
./symfony vocare:loadCSV data/csv/02_postulantes.csv
./symfony vocare:loadCSV data/csv/02_recepcion.csv
./symfony vocare:loadCSV data/csv/02_habilitacion.csv
