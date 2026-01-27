# 🎵 Exploradores del Pentagrama

![PHP Version](https://img.shields.io/badge/PHP-8.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel Version](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-Proprietary-red?style=for-the-badge)

**Exploradores del Pentagrama** es una plataforma educativa gamificada diseñada para transformar el aprendizaje musical en una aventura interactiva. A través de un sistema de roles, los "Guardianes" (docentes/padres) supervisan el progreso, mientras que los "Exploradores" (alumnos) dominan el lenguaje musical superando desafíos, lecciones y minijuegos en el pentagrama.

---

## 🚀 Funcionalidades Clave

- **🎮 Gamificación Educativa**: 160 niveles totales (80 por mundo) con progresión pedagógica adaptativa, minijuego de velocidad (`Speed Challenge`) y piano inteligente integrado.
- **👥 Gestión de Roles**: Panel de control exclusivo para el **Guardián** y una interfaz de aventura simplificada y optimizada para el **Jugador**.
- **💻 Interfaz Optimizada**: Diseño premium de pantalla completa sin scroll, optimizado específicamente para resoluciones de portátiles como MacBook Pro 13".
- **⚡ Interactividad en Tiempo Real**: Construido con **Livewire** y **Alpine.js** para una experiencia de usuario fluida y reactiva sin recargas de página.
- **📈 Seguimiento de Progreso**: Registro detallado de la evolución de cada jugador, con métricas de desempeño y un Cofre de Tesoros con pistas de desbloqueo.

---

## 💻 Stack Técnico

Este proyecto utiliza las tecnologías más recientes del ecosistema Laravel:

| Tecnología | Versión / Detalle |
|------------|-------------------|
| **Backend** | Laravel 12, PHP 8.4 |
| **Frontend** | Blade, Livewire 3, Tailwind CSS 4 |
| **Base de Datos** | SQLite (Por defecto) / MySQL Compatible |
| **Testing** | Pest PHP |
| **Herramientas** | Laravel Pail (Logs), Vite (Build Tool) |

---

## 📋 Requisitos del Sistema

Antes de comenzar, asegúrate de tener instalado en tu entorno local:

- **PHP** >= 8.4
- **Composer** (Gestor de dependencias PHP)
- **Node.js** & **npm** (Para compilar assets)
- Extensiones PHP requeridas por Laravel (BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML).

---

## 🛠️ Instalación Paso a paso

Sigue estos pasos para levantar el proyecto en tu entorno local:

### 1. Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/exploradores-pentagrama.git
cd exploradores-pentagrama
```

### 2. Instalar dependencias de Backend
```bash
composer install
```

### 3. Configurar entorno
Duplica el archivo de ejemplo y configura tus variables de entorno.
```bash
cp .env.example .env
```

> [!TIP]
> Por defecto, el proyecto está configurado para usar `SQLite`, por lo que no necesitas instalar un servidor de base de datos externo para empezar.

### 4. Generar clave de aplicación
```bash
php artisan key:generate
```

### 5. Preparar la base de datos
Crea el archivo de base de datos (si usas SQLite) y ejecuta las migraciones:
```bash
touch database/database.sqlite
php artisan migrate --seed
```

### 6. Instalar dependencias de Frontend y Compilar
```bash
npm install
npm run build
```

### 7. Enlace simbólico para Storage
Para visualizar imágenes y avatares correctamente:
```bash
php artisan storage:link
```

---

## ⚙️ Configuración de Servicios

### Base de Datos
La configuración se encuentra en el archivo `.env`. Si deseas usar MySQL en lugar de SQLite:

```properties
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mi_base_de_datos
DB_USERNAME=root
DB_PASSWORD=
```

### Colas (Queue Workers)
Para procesar tareas en segundo plano (ej: procesamiento de logros), ejecuta el worker:

```bash
php artisan queue:listen
```

---

## 🖥️ Scripts de Desarrollo

Para iniciar el servidor de desarrollo y la compilación de assets en caliente (HMR), puedes usar los siguientes comandos en terminales separadas:

**Servidor Laravel:**
```bash
php artisan serve
```

**Vite (Assets Frontend):**
```bash
npm run dev
```

> [!NOTE]
> Laravel 12 incluye un script `dev` en `composer.json` que ejecuta todo con `concurrently` (si está configurado), o puedes correrlos manualmente.

---

## 🧪 Testing

El proyecto utiliza **Pest PHP** para pruebas unitarias y de características.

Ejecutar todos los tests:
```bash
php artisan test
# O directamente con el binario de Pest
./vendor/bin/pest
```

---

## 📄 Licencia

Este proyecto es software propietario. Todos los derechos reservados. No se permite la distribución ni modificación sin autorización explícita.
