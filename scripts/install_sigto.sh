#!/bin/bash
if [[ $EUID -ne 0 ]]; then
   echo "Este script debe ejecutarse como administrador" >&2
   exit 1
fi

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

if [[ -z "$APP_ROOT" || -z "$ADMIN_EMAIL" ]]; then
  echo "Error: Faltan algunas variables de entorno necesarias (APP_ROOT o ADMIN_EMAIL)."
  exit 1
fi

composer install

echo "Creando archivo de configuracion de apache..."
sleep 1

find $APP_ROOT -type d -exec chmod 775 {} \;
find $APP_ROOT -type f -exec chmod 664 {} \;
chown -R $SUDO_USER:apache "$APP_ROOT"

if [[ ! -f /etc/httpd/conf.d/proyectoeme.conf ]]; then
  echo "<VirtualHost *:80>
ServerAdmin $ADMIN_EMAIL
DocumentRoot $APP_ROOT/public

<Directory $APP_ROOT/public>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>

ErrorLog /var/log/httpd/proyectoeme-error.log
CustomLog /var/log/httpd/proyectoeme-access.log combined
</VirtualHost>" | sudo tee /etc/httpd/conf.d/proyectoeme.conf > /dev/null

  echo "127.0.0.1 proyectoeme.test" | sudo tee -a /etc/hosts > /dev/null
else
  echo "El archivo de configuración de Apache ya existe. No se realizaron cambios."
fi

systemctl restart httpd
echo "Puede acceder al proyecto en http://proyectoeme.test o http://127.0.0.1"