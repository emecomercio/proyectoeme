#!/bin/bash
while true; do
  read -p "Antes de ejecutar este script, asegúrate de haber configurado correctamente las variables de entorno. ¿Has verificado esto? (s/n): " respuesta

  if [[ "$respuesta" = "s" ]]; then
    break
  elif [[ "$respuesta" = "n" ]]; then
    echo "Por favor, ajusta las variables de entorno y vuelve a ejecutar el script."
    exit 1
  fi
done

set -a
source .env
set +a

if [[ -z "$DB_USER" || -z "$DB_PASSWORD" || -z "$DB_HOST" ]]; then
  echo "Error: Faltan algunas variables de entorno necesarias (DB_USER, DB_PASSWORD o DB_HOST)."
  exit 1
fi

SQL_SCRIPTS_PATH="./app/database"

echo "Iniciando ejecución de scripts SQL..."
sleep 1

mysql -u$DB_USER -p$DB_PASSWORD -h$DB_HOST <<EOF >/dev/null 2>&1
SOURCE $SQL_SCRIPTS_PATH/ecommerce.sql;
SOURCE $SQL_SCRIPTS_PATH/default_data.sql;
EOF

echo "--------------------------------"
echo "Los scripts SQL se han ejecutado correctamente"
echo "--------------------------------"

while true; do
  read -p "¿Desea generar datos de prueba? (s para sí, n para no): " respuesta

  if [[ "$respuesta" = "s" ]]; then
    echo ""
    echo "Generando datos de prueba..."
    echo "------------------------------------------"

    mysql -u$DB_USER -p$DB_PASSWORD -h$DB_HOST <<EOF >/dev/null 2>&1
    SOURCE $SQL_SCRIPTS_PATH/triggers.sql;
EOF

    env -i php "$SQL_SCRIPTS_PATH/test_data.php"
    break
  elif [[ "$respuesta" = "n" ]]; then
    break
  fi
done

echo "--------------------------------"
echo "Se creó un usuario admin con las siguientes credenciales:"
echo "Correo electrónico: admin@gmail.com"
echo "Contraseña: 12345678"
