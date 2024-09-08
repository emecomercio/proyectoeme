#!/bin/bash

# Eliminar límites de tiempo de ejecución y de recursos
ulimit -t unlimited  # Sin límite de tiempo de CPU
ulimit -v unlimited  # Sin límite de uso de memoria virtual
ulimit -f unlimited  # Sin límite en el tamaño de archivos
ulimit -n 65535      # Aumentar el límite de archivos abiertos (si es necesario)

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

# Ejecución del script PHP sin límite de tiempo
php -d max_execution_time=0 $SQL_SCRIPTS_PATH/test_data.php
