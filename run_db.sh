#!/bin/bash

# Variables de entorno
DB_USER="root"       
DB_PASSWORD="root"
DB_HOST="localhost"   
DB_NAME="ecommerce" 
SQL_SCRIPTS_PATH="./app/database"

echo "Iniciando ejecución de scripts SQL..."
echo "-------------------------------------"

mysql -u$DB_USER -p$DB_PASSWORD -h$DB_HOST <<EOF
SOURCE $SQL_SCRIPTS_PATH/ecommerce.sql;
SOURCE $SQL_SCRIPTS_PATH/roles.sql;
SOURCE $SQL_SCRIPTS_PATH/triggers.sql;
SOURCE $SQL_SCRIPTS_PATH/default_data.sql;
EOF
echo "--------------------------------"
echo "Scripts SQL ejecutados con éxito"
echo "--------------------------------"
echo ""
echo "Ejecutando script PHP para datos de prueba"
echo "------------------------------------------"

php $SQL_SCRIPTS_PATH/test_data.php