# Laraeduca

Este proyecto es un sistema educativo desarrollado en Laravel.

## Requisitos previos

- PHP >= 8.*
- Composer
- Node.js >= 20.*
- npm
- Git

## Instalación

1. Clona este repositorio en tu máquina local:

<pre><code>git clone https://github.com/alvaro-jurado/Laraeduca.git
</code></pre>

2. Instala las dependencias PHP utilizando Composer:

<pre><code>composer install
</code></pre>

3. Instala las dependencias de JavaScript utilizando npm:

<pre><code>npm install
</code></pre>

4. Copia el archivo de entorno `.env.example` y crea un nuevo archivo `.env`:

<pre><code>cp .env.example .env
</code></pre>

5. Genera una nueva clave de aplicación:

<pre><code>php artisan key:generate
</code></pre>

6. Ejecuta las migraciones de la base de datos para crear las tablas necesarias:

<pre><code>php artisan migrate
</code></pre>

7. Ejecuta el seeder para crear los roles por defecto:

<pre><code>php artisan seed:default-roles
</code></pre>

## Uso

1. Inicia el servidor de desarrollo de Laravel:

<pre><code>php artisan serve
</code></pre>

2. Compila los assets utilizando npm:

<pre><code>npm run dev
</code></pre>

3. Visita `http://127.0.0.1:8000` en tu navegador web.

4. Regístrate en el sistema para empezar a usarlo.
