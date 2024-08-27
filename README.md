# EME Comercio

Sistema de gestión de tiendas online desarrollado como proyecto de egreso de IAE Montevideo 2024 por los estudiantes: Anibal Boggio, Facundo Canclini, Lautaro da Rosa, Luca Gómez y Marcos Muñoz.

## Descripción

EME Comercio es una plataforma para la gestión de tiendas online que permite a los comerciantes administrar sus productos, procesar pedidos y analizar ventas de manera eficiente.

## Instalación

Sigue los pasos correspondientes para instalar el proyecto en tu sistema (tener en cuenta que la Base de Datos no se menciona debido a que todavía se está configurando):

**Nota**: recuerda copiar el archivo de configuración de ejemplo y ajustarlo en base a tu entorno:

Linux: `cp .env.example .env`

Windows: `copy .env.example .env`

**Nota**: recuerda instalar las dependencias de Composer ejecutando: `composer install`

Si no tienes instalado Composer puedes hacerlo mediante el siguiente link y siguiendo las instrucciones correspondientes a tu sistema operativo: [https://getcomposer.org/doc/00-intro.md](https://getcomposer.org/doc/00-intro.md)

### Linux -> Fedora

1. Descargar el script `prepare_fedora.sh` desde el siguiente repositorio: [https://github.com/emecomercio/server_management](https://github.com/emecomercio/server_management)
2. Asignarle permisos de ejecución al script: `chmod +x prepare_fedora.sh`
3. Ejecutar el script con permisos de administrador: `sudo bash prepare_fedora.sh`
4. **Si ya tienes montado el servidor LAMP, ve el paso 5**. Para montar el servidor LAMP, navega por las distintas secciones e instala o configura lo que necesites (si tienes dudas, abre el script con un editor de textos)
5. Entrar en el menú de configuraciones (opción 4)
6. Si necesitas permisos en `/var/www`, elige la opción 2
7. Descarga este repositorio en `/var/www`
8. Para generar un virtual host y un archivo de configuración de apache para el proyecto, elige la opción 3. Ingresa el nombre del repositorio, 'proyectoeme' y el correo [emecomerciooficial@gmail.com](emecomerciooficial@gmail.com)
9. Ejecuta el script SQL `app/database/tienda.sql`, para ello puedes abrir una consola de mysql-server y ejecutar: `source /var/www/proyectoeme/app/database/tienda.sql`
10. Ya puedes ejecutar el proyecto entrando a [http://proyectoeme.test/](http://proyectoeme.test/)

Nota: si tienes problemas, puedes ejecutar `php -S localhost:8000 -t /var/www/proyectoeme/public` y analizar los errores. Si no puedes resolverlos, contáctanos.

### Windows (probado en Windows 10)

0. Extra: recomendamos utilizar Laragon en vez de XAMPP para ahorrarse todos estos pasos.
1. Tener instalado el stack AMP mediante la herramienta XAMPP
2. Descargar el repositorio en la carpeta \xampp\htdocs\
3. Modificar el archivo .env: ROOT=`/xampp/htdocs/proyectoeme`
4. En el directorio /xampp/apache/conf/extra/ crear el archivo "proyectoeme.conf" con el siguiente contenido:

```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName proyectoeme.test
    DocumentRoot /xampp/htdocs/proyectoeme/public

    <Directory /xampp/htdocs/proyectoeme/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/proyectoeme-error.log
    CustomLog ${APACHE_LOG_DIR}/proyectoeme-access.log combined
</VirtualHost>
```

5. Modificar el archivo /xampp/apache/conf/httpd.conf, verificar que la línea que dice "Include conf/extra/httpd-vhosts.conf" no esté comentada y añadir la línea "Include conf/extra/proeyctoeme.conf".
6. Modificar el archivo /Windows/System32/drivers/etc/hosts con permisos de administrador y anadir la siguiente línea: "127.0.0.1 proyectoeme.test".
7. Guardar todos los cambios hechos e iniciar Apache desde la herramienta Xampp (o reiniciarlo si ya estaba encendido).

Ahora ingresando "http://proyectoeme.test/" en tu navegador ya puedes ver el sitio web.

### Linux -> Debian (probado en Ubuntu)

1. Tener instalado el stack AMP (Apache2, MySQL y PHP) [A futuro y si los docentes lo solicitan, se redactará el cómo]
2. Descargar el repositorio en la carpeta /var/www
3. Modificar el archivo .env: ROOT=`/var/www/proyectoeme`
4. Dar permisos a tu usuario sobre esta carpeta mediante los siguientes comandos:

`sudo usermod -a -G www-data [usuario] (ej sudo usermod -a -G www-data emecomercio)`
Reinicia sesión y ejecuta:

```
sudo chown -R [usuario]:data-www /var/www (ej sudo chown emecomercio:data-www /var/www)
sudo chmod -R 777 /var/www
```

4. En el directorio /etc/apache2/sites-available/ crear con permisos de administrador el archivo "proyectoeme.test.conf" (`sudo nano /etc/apache2/sites-available/proyectoeme.test.conf `)con el siguiente contenido:

```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName proyectoeme.test
    DocumentRoot /var/www/proyectoeme/public

    <Directory /var/www/proyectoeme/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/proyectoeme.test-error.log
    CustomLog ${APACHE_LOG_DIR}/proyectoeme.test-access.log combined
</VirtualHost>
```

5. Modificar el archivo /etc/hosts con permisos de administrador (`sudo nano /etc/hosts`) y anadir la línea `127.0.0.1 proyectoeme.test`
6. Reiniciar apache

`sudo systemctl restart apache2`
Ahora ingresando "http://proyectoeme.test/" en tu navegador ya puedes ver el sitio web.
