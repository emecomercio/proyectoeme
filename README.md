# EME Comercio

EME Comercio es una empresa desarrolladora de soluciones tecnológicas para el comercio electrónico. Su producto estrella es un Sistema de Gestión de Tiendas Online, diseñado para facilitar la administración integral de tiendas virtuales. Este sistema permite a los comerciantes gestionar sus productos, procesar pedidos y obtener análisis detallados de ventas en una única plataforma.

Este proyecto fue desarrollado como trabajo de egreso de los estudiantes Anibal Boggio, Facundo Canclini, Lautaro da Rosa, Luca Gómez y Marcos Muñoz para el IAE Montevideo, clase de 2024.

## Instalación

### Requisitos

Antes de comenzar la instalación del sistema, asegúrese de cumplir con los siguientes requisitos:

- Servidor **LAMP** (Linux, Apache, MySQL, PHP) correctamente configurado.
- **Fedora Server 40** o superior.
- **PHP 8.0** o superior
- **MySQL Server 5.7** o superior
- **Composer** para la gestión de dependencias de PHP
- **Git** para clonar el repositorio del proyecto
- **Redis** o **Valekey** para utilizar la caché

### Instalación del Sistema

**Nota**: Si ya cumple con todos los requisitos, puede proceder a la instalación del sistema, pero si necesita configurar su servidor, vaya a la sección [Configuración del Servidor Lamp](#configuración-del-servidor-lamp).

**Nota**: Para facilitar la instalación, se han creado dos scripts que montan automáticamente el proyecto. Estos scripts estarán en el directorio `/var/www/proyectoeme/scripts`.

0. **Dirigirse al directorio raíz de documentos web**:

Ejecutar:

```bash
 cd /var/www
```

1. **Clonar el repositorio del proyecto**:

**Con SSH** (requiere clave SSH configurada):

```bash
git clone git@github.com:emecomercio/proyectoeme.git
```

**Con HTTPS**:

```bash
git clone https://github.com/emecomercio/proyectoeme.git
```

Una vez clonado el repositorio, moverse al directorio del proyecto:

```bash
cd proyectoeme
```

2. **Copiar el archivo de variables de entorno y ajustarlo**:

```bash
cp .env.example .env
```

Una vez copiado el archivo, abrirlo en un editor de texto y ajustar las variables de entorno según sea necesario.

3. **Montar el Proyecto**:

Ejecutar el script `install_sigto.sh` con permisos de superusuario:

```bash
sudo bash scripts/install_sigto.sh
```

4. **Montar la Base de Datos**:

Ejecutar el scrip `run_db.sh`:

```bash
bash scripts/run_db.sh
```

### Configuración del Servidor Lamp

**Nota**: Una vez instalado git, la configuración se realizará utilizando el script `prepare_fedora.sh` del repositorio [Server Management](https://github.com/emecomercio/server_management).

**Nota**: Se necesita un editor de texto para realizar determinadas configuraciones. Por defecto, Fedora Server viene con `vim`, pero si lo deseas puedes instalar `nano` con el siguiente comando: `sudo dnf install nano`. Luego puedes editar un archivo con el comando `nano ejemplo.txt`.

Para configurar un servidor LAMP en Fedora Server y poder montar el proyecto más tarde, debes seguir los siguientes pasos:

0. **Conectarse a internet y actualizar el sistema**:

En caso de que el servidor no esté conectado por cable, puedes conectarte vía Wi-Fi:

```bash
# Listar redes:
nmcli dev wifi list
# Conectar a una red (sustituir SSID por el nombre de la red):
nmcli dev wifi connect "SSID" password "contraseña"
```

Una vez establecida la conexión, actualizar el sistema:

```bash
sudo dnf update -y
```

1. **Instalar Git y clonar el repositorio de Server Management**:

```bash
# Instalar Git:
sudo dnf install git -y
# Clonar el repositorio de Server Management:
git clone https://github.com/emecomercio/server_management.git
# Moverse dentro:
cd server_management
```

2. **Instalar y Configurar Apache**:

Primero ejecuta el script `prepare_fedora.sh`:

```bash
sudo bash prepare_fedora.sh
```

En el submenú `Instalaciones` (2), seleccionar la opción `Instalar Apache` (1).

En el submenú `Configuraciones` (3), seleccionar la opción `Configurar Apache` (1). Esta opción configura el firewall para permitir el conexiones http y https, además de ajustar los permisos necesario sobre `/var/www`.

3. **Instalar y Configurar MySQL**:

En el submenú `Instalaciones` (2), seleccionar la opción `Instalar MySQL Server` (2).

En el submenú `Configuraciones` (3), seleccionar la opción `Configurar MySQL Server (mysql_secure_installation)` (2). Siguiendo las instrucciones, realizar las configuraciones de preferencia. Se recomienda:

- Would you like to set up VALIDATE PASSWORD component? -> `y`
- levels of password validation -> `2`
- Ejemplo de contraseña: `P@ssw0rd`
- Remove anonymous users? -> `y`
- Dissalow root login remotely? -> `y`
- Remove test database and access to it? -> `y`
- Reload privilege tables now? -> `y`

4. **Instalar PHP**:

En el submenú `Instalaciones` (2), seleccionar la opción `Instalar PHP` (3). Ingresa `y` cuando lo solicite.

5. **Instalar Composer**:

En el submenú `Instalaciones` (2), seleccionar la opción `Instalar Composer` (4).

6. **Instalar Redis**:

En el submenú `Instalaciones` (2), seleccionar la opción `Instalar Redis (Valkey)` (5).

Ya tienes todo lo necesario para instalar el sistema, puedes continuar en: [Instalación del Sistema](#instalación-del-sistema).
