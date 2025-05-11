# Fase de análisis del proyecto
[Enlace a la fase de análisis](https://docs.google.com/document/d/1GkexEH7eRECTtTPw5ov1jCAnPJO-yGoMe0A2pKMoVUo/edit?usp=sharing)

# Fase de diseño

## Diagrama de clases
[Ver diagrama de clases](x_documentacion/diagrama_de_clases.jpeg)

## Diagrama Entidad-Relación
[Ver diagrama de entidad-relación](x_documentacion/database_diagrams.md)

## Estructura de nuestra BBDD
[Ver estructura de la BBDD](x_documentacion/mysql-schema.sql)

## Diseño base de la página
[Enlace al mockup](https://miro.com/welcomeonboard/cjVzUzlMcHR4NnF3SWxUL3lKbk91V2NjU0FwSEdtNmNMYWNJTlNybkNMQjUzSjdyNHk3Nm9vblcxNjJ1ZE5aU1RiNk1kWnYrNyszem01c2RwenpZdzR2UXZveU5jS2JPbjdXbFZieGRkYXk2SUZaenZmQnRqbWFUREJpdkNLZHpNakdSWkpBejJWRjJhRnhhb1UwcS9BPT0hdjE=?share_link_id=256490327332)

## Documentación de pruebas
[Ver documentación de pruebas](x_documentacion/testing.md)

# Video de youtube
[Ver video de youtube](https://www.youtube.com/watch?v=1BjsWZuWhDA)
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
git clone https://github.com/AlumnoDamian/webgestor.demo.git
cd webgestor.demo
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

### 🛠 Establecer permisos (Linux)
```bash
sudo chown -R $USER:$USER /var/www/html/webgestor.demo
```

### 🌐 Levantar el servidor integrado de Laravel
```bash
php artisan serve
```

### 📦 Instalación de paquetes útiles (OBLIGATORIO)
```bash
npm install flatpickr
composer require spatie/laravel-permission
npm install @tailwindcss/postcss --save-dev
composer require livewire/livewire
```

### 🌱 🧱 Ejecutar migraciones y seeders
```bash
php artisan db:wipe
php artisan migrate
php artisan db:seed
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