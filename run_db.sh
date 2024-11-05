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

echo -e "\033[33mStarting execution of SQL scripts...\033[0m"
sleep 1

mysql -u$DB_USER -p$DB_PASSWORD -h$DB_HOST <<EOF > /dev/null 2>&1
SOURCE $SQL_SCRIPTS_PATH/ecommerce.sql;
SOURCE $SQL_SCRIPTS_PATH/roles.sql;
SOURCE $SQL_SCRIPTS_PATH/triggers.sql;
SOURCE $SQL_SCRIPTS_PATH/default_data.sql;
EOF

echo "--------------------------------"
echo -e "\033[32mSQL scripts executed successfully\033[0m"
echo "--------------------------------"

read -p "¿Desea ejecutar el script PHP para datos de prueba? (1 para sí, cualquier otro valor para no): " respuesta

if [ "$respuesta" -eq 1 ]; then
  echo ""
  echo -e "\033[32mExecuting PHP script for test data\033[0m"
  echo "------------------------------------------"
  php -d max_execution_time=0 $SQL_SCRIPTS_PATH/test_data.php
fi
