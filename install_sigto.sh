if [[ $EUID -ne 0 ]]; then
   echo "Este script debe ejecutarse como administrador" >&2
   exit 1
fi

composer install

echo "Creando archivo de configuracion de apache..."

sleep 1

read -p "Ingresa el correo de administrador: " admin_email

if [ -z "$admin_email" ]; then
    echo "El correo de administrador es requerido."
    return
fi

if [[ ! "$admin_email" =~ ^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$ ]]; then
    echo "El correo electrónico ingresado no es válido."
    return
fi

project_dir="/var/www/proyectoeme"

# Ajusta los permisos por si no estaban
chown -R $SUDO_USER:apache "$project_dir"
chown -R $SUDO_USER:apache "$project_dir/public"

echo "<VirtualHost *:80>
ServerAdmin $admin_email
DocumentRoot /var/www/proyectoeme/public

<Directory /var/www/proyectoeme/public>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>

ErrorLog /var/log/httpd/proyectoeme-error.log
CustomLog /var/log/httpd/proyectoeme-access.log combined
</VirtualHost>" | tee /etc/httpd/conf.d/proyectoeme.conf > /dev/null

echo "127.0.0.1 proyectoeme.test" | tee -a /etc/hosts > /dev/null

systemctl restart httpd
echo "Apache configurado"
sleep 1
echo "Puede acceder a proyectoeme.test"