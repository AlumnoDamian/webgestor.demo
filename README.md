# 🏢 Webgestor - Sistema de Gestión Empresarial

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

</div>

## 📑 Tabla de Contenidos

- [📋 Documentación del Proyecto](#-documentación-del-proyecto)
- [✨ Características](#-características)
- [🚀 Guía de Instalación](#-guía-de-instalación)
  - [🐧 Linux](#-linux)
  - [🪟 Windows](#-windows)
- [🔧 Configuración](#-configuración)
- [📝 Documentación de Pruebas](#-documentación-de-pruebas)

## 📋 Documentación del Proyecto

- [📊 Fase de Análisis](https://docs.google.com/document/d/1GkexEH7eRECTtTPw5ov1jCAnPJO-yGoMe0A2pKMoVUo/edit?usp=sharing)
- [📐 Diagrama de Clases](x_documentacion/diagrama_de_clases.jpeg)
- [🗄️ Diagrama Entidad-Relación](x_documentacion/database_diagrams.md)
- [💾 Estructura de la BBDD](x_documentacion/mysql-schema.sql)
- [🎨 Mockup del Diseño](https://miro.com/welcomeonboard/cjVzUzlMcHR4NnF3SWxUL3lKbk91V2NjU0FwSEdtNmNMYWNJTlNybkNMQjUzSjdyNHk3Nm9vblcxNjJ1ZE5aU1RiNk1kWnYrNyszem01c2RwenpZdzR2UXZveU5jS2JPbjdXbFZieGRkYXk2SUZaenZmQnRqbWFUREJpdkNLZHpNakdSWkpBejJWRjJhRnhhb1UwcS9BPT0hdjE=?share_link_id=256490327332)
- [🎥 Video Demo](#-video-demo)
- 
## ✨ Características

- 👥 Gestión de empleados y departamentos
- 📅 Sistema de horarios y turnos
- 📝 Gestión de memorandos
- 🔐 Sistema de roles y permisos
- 🎨 Interfaz moderna con Tailwind CSS
- 📱 Diseño responsive

# 🚀 Guía de instalación y configuración de Webgestor

## Versión LINUX

### 🛠 Actualización del sistema
```bash
sudo apt update && sudo apt upgrade -y
```

### 💻 Instalación de PHP y extensiones necesarias
```bash
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-bcmath php-curl php-zip unzip curl -y
```

### 📌 Verificar versión de PHP
```bash
php -v
```

### 🏆 Instalación de Composer
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 📌 Verificar versión de Composer
```bash
composer --version
```

### 💼 Instalación y configuración de MySQL
```bash
sudo apt install mysql-server php-mysql -y
sudo mysql
```

#### 🔧 Dentro del cliente MySQL:
```sql
CREATE DATABASE laravel;
CREATE USER 'laraveluser'@'localhost' IDENTIFIED BY 'Password*1234!';
GRANT ALL PRIVILEGES ON laravel.* TO 'laraveluser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 🔧 Clonar el repositorio de GitHub
```bash
cd /var/www/html
sudo git clone https://github.com/AlumnoDamian/webgestor.demo.git
cd webgestor.demo
```

### 📌 Permitir que Git trabajae con ese directorio
```bash
git config --global --add safe.directory /var/www/html/webgestor.demo
```

### 🛠 Establecer permisos (Linux)
```bash
sudo chown -R $USER:$USER /var/www/html/webgestor.demo
```

### 📌 Instalar dependencias del proyecto
```bash
composer install
```

### 📌 Configuración del entorno Laravel (.env)
```bash
cp .env.example .env
nano .env
```

### 📌 Ajustar las variables:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=Password*1234!
```

### 🔐 Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 📦 Descargar NPM
```bash
sudo apt install npm
npm install
npm run build
```

### 🌱 🧱 Ejecutar migraciones y seeders
```bash
php artisan db:wipe (Para borrar todas las migraciones)
php artisan migrate
php artisan db:seed
```

### 🌐 Levantar el servidor integrado de Laravel
```bash
php artisan serve
```

---

## 🪟 Guía de instalación y configuración de Webgestor en Windows

### ✅ Requisitos previos

#### 🟠 Instalar Git
[https://git-scm.com/download/win](https://git-scm.com/download/win)

Verificar instalación:
```bash
git --version
```

#### 💻 Instalación de PHP y extensiones necesarias
[https://windows.php.net/download](https://windows.php.net/download)

- Descargar la versión más reciente (Non Thread Safe, x64) ZIP
- Extraer en `C:\php`

#### ➕ Agregar PHP al PATH:
1. Panel de control → Sistema → Configuración avanzada del sistema  
2. Variables de entorno → Editar `Path` → Nuevo → `C:\php`

Verificar:
```bash
php -v
```

#### 🏆 Instalación de Composer
[https://getcomposer.org/download](https://getcomposer.org/download)

Verificar:
```bash
composer --version
```

#### 💼 Instalación y configuración de MySQL
[https://dev.mysql.com/downloads/installer/](https://dev.mysql.com/downloads/installer/)

- Instalar MySQL Server (y opcionalmente Workbench)
- Configurar usuario `root`

Dentro del cliente de MySQL:
```sql
CREATE DATABASE laravel;
CREATE USER 'laraveluser'@'localhost' IDENTIFIED BY 'Password*1234!';
GRANT ALL PRIVILEGES ON laravel.* TO 'laraveluser'@'localhost';
FLUSH PRIVILEGES;
```

---

## 🚀 Instalación del proyecto Webgestor

### 🔧 Clonar el repositorio de GitHub
```bash
cd ruta\de	u\carpeta\de\proyectos
git clone https://github.com/AlumnoDamian/webgestor.demo.git
cd webgestor.demo
```

### 💻 Instalar dependencias PHP
```bash
composer install
```

### 📦 Configurar archivo .env
```bash
copy .env.example .env
```

### 📌 Editar las variables de entorno:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=Password*1234!
```

### 🔐 Generar la clave de la app
```bash
php artisan key:generate
```

### 🛠 Ejecutar migraciones
```bash
php artisan migrate
```

### 📦 Instalación de paquetes útiles (OBLIGATORIO)
```bash
npm install flatpickr
npm install @tailwindcss/postcss --save-dev
composer require spatie/laravel-permission
composer require livewire/livewire
```

### 🌱 🧱 Ejecutar migraciones y seeders
```bash
php artisan db:wipe
php artisan migrate
php artisan db:seed
```

### 🟢 Iniciar el servidor
```bash
php artisan serve
```

Acceder en el navegador:  
[http://127.0.0.1:8000](http://127.0.0.1:8000)
