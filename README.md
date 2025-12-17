
---

# 🛒 KIVIC E-COMMERCE

**Plataforma Multitienda en Laravel**

KIVIC es una plataforma de **e-commerce multitienda** desarrollada en **Laravel**, diseñada para permitir la creación y gestión de múltiples tiendas dentro de un mismo sistema.

---

## 📋 Requisitos del sistema

Antes de clonar el proyecto, asegúrate de tener instalado:

* **PHP** >= 8.2
* **Composer**
* **Node.js** >= 18
* **NPM**
* **MySQL** o **MariaDB**
* **Git**
* **Servidor local** (XAMPP, Laragon o similar)

---

## 📥 Clonar el repositorio

```bash
git clone https://github.com/victorGutyy/kivic_ecommerce.git
cd kivic_ecommerce
```

---

## 📦 Instalación de dependencias

### Backend (Laravel)

```bash
composer install
```

### Frontend (Vite)

```bash
npm install
```

---

## ⚙️ Configuración del entorno

### 1️⃣ Crear archivo `.env`

En **Windows (Git Bash)**:

```bash
cp .env.example .env
```

Si el comando falla, crea el archivo manualmente copiando `.env.example`.

---

### 2️⃣ Configurar variables importantes en `.env`

```env
APP_NAME=KIVIC
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kivic_mvp
DB_USERNAME=root
DB_PASSWORD=
```

---

### 3️⃣ Generar la clave de la aplicación

```bash
php artisan key:generate
```

---

## 🗄️ Base de datos

### Crear la base de datos

Desde **phpMyAdmin** o MySQL:

```sql
CREATE DATABASE kivic_mvp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

### Migraciones

```bash
php artisan migrate
```

> ⚠️ Si el proyecto incluye datos reales o de prueba, el líder del proyecto compartirá el **backup SQL** correspondiente.

---

## 🎨 Compilar assets (Vite)

### Modo desarrollo

```bash
npm run dev
```

### (Opcional) Modo producción

```bash
npm run build
```

> ⚠️ Si aparece el error **ViteManifestNotFoundException**, asegúrate de haber ejecutado `npm run dev` o `npm run build`.

---

## ▶️ Ejecutar el proyecto

```bash
php artisan serve
```

Abrir en el navegador:

```
http://127.0.0.1:8000
```

---

## 🏪 Acceso a tiendas

Las tiendas se acceden por **slug**, por ejemplo:

```
http://127.0.0.1:8000/purpura-store
```

> ⚠️ Si una tienda no existe, verifica la tabla `stores` en la base de datos.

---

## 🧪 Problemas comunes y soluciones

### ❌ Error: `Vite manifest not found`

✔ Ejecutar:

```bash
npm run dev
```

---

### ❌ Error: `Unknown column 'logo_path'`

✔ Ejecutar migraciones actualizadas:

```bash
php artisan migrate
```

---

### ❌ Error: `Table cache doesn't exist`

✔ Ejecutar:

```bash
php artisan cache:table
php artisan migrate
```

---

## 🌿 Flujo de trabajo Git (OBLIGATORIO)

🚫 **NO trabajar directamente en `main`**

### Crear una nueva rama

```bash
git checkout -b feature/nombre-de-la-tarea
```

### Subir cambios

```bash
git add .
git commit -m "feat: descripción clara del cambio"
git push origin feature/nombre-de-la-tarea
```

### Pull Request

* Crear PR en GitHub
* Revisión obligatoria
* Merge a `main`

---

## 🔐 Reglas del repositorio

* `main` está protegida
* Pull Request obligatorio
* Commits claros y descriptivos
* No subir `.env`
* No subir `vendor/` ni `node_modules/`

---

## 👥 Equipo

Proyecto liderado por **Victor Gutyy**
Plataforma desarrollada como **proyecto colaborativo**.

---

## 📄 Licencia

Proyecto privado – uso interno del equipo KIVIC.

---

## 🏁 Estado del proyecto

🚧 En desarrollo activo
✔ Base funcional
✔ Flujo Git profesional
✔ Listo para trabajo en equipo


