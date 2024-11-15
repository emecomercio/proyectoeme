#!/bin/bash

read -p "Introduce el nombre del nuevo usuario (por defecto 'ecommerceAdmin'): " username
username="${username:-ecommerceAdmin}"

read -sp "Introduce la contraseña del nuevo usuario: " password
echo

read -p "Introduce el nombre de usuario administrador de MySQL (por defecto 'root'): " admin_user
admin_user="${admin_user:-root}"

read -sp "Introduce la contraseña del administrador de MySQL: " admin_password
echo

user_exists=$(mysql -u "$admin_user" -p"$admin_password" -e "SELECT EXISTS(SELECT 1 FROM mysql.user WHERE user = '$username');" -s -N)

if [ "$user_exists" -eq 1 ]; then
    echo "El usuario '$username' ya existe. No se creará nuevamente."
else

    mysql -u "$admin_user" -p"$admin_password" -e "CREATE USER IF NOT EXISTS '$username'@'%' IDENTIFIED BY '$password';"
    mysql -u "$admin_user" -p"$admin_password" -e "GRANT ALL PRIVILEGES ON ecommerce.* TO '$username'@'%';"
    mysql -u "$admin_user" -p"$admin_password" -e "FLUSH PRIVILEGES;"

    echo "Usuario '$username' creado y con permisos sobre la base de datos 'ecommerce'."
fi
