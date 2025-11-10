# Proyecto Laravel - Deployment en Render

## Configuración en Render (Usando Docker)

### 1. Crear nuevo Web Service
- Ve a [Render Dashboard](https://dashboard.render.com/)
- Click en "New" > "Web Service"
- Conecta tu repositorio de GitHub: `dba0006/proyectoRender`

### 2. Configuración del Servicio

#### Build & Deploy Settings
- **Name**: `proyectorender` (o el que prefieras)
- **Environment**: `Docker`
- **Region**: Oregon (o el más cercano)
- **Branch**: `main`
- **Root Directory**: (dejar vacío)
- **Dockerfile Path**: `Dockerfile`

⚠️ **IMPORTANTE**: Render debe detectar automáticamente el Dockerfile. Si no lo detecta, asegúrate de que esté en la raíz del proyecto.

### 3. Variables de Entorno Requeridas

Configura estas variables en Render Dashboard > Environment:

**Variables Obligatorias:**
```
APP_NAME=ProyectoRender
APP_ENV=production
APP_KEY=base64:ffn4XFh9uJaCwaMR+eiN3MAvh0hmYH7yniLB6U3DPZo=
APP_DEBUG=false
APP_URL=https://proyectorender.onrender.com

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=sqlite

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=local
```

**IMPORTANTE**: 
- Cambia `APP_URL` por tu URL real de Render después del primer deploy
- El `APP_KEY` debe ser único. Genera uno nuevo con: `php artisan key:generate --show`

### 4. Configuración del Puerto

El Dockerfile está configurado para usar el puerto **8080**, pero Render necesita que uses el puerto que él asigna vía la variable `$PORT`.

El Dockerfile ya está configurado correctamente para esto.

### 5. Deploy

Una vez configurado todo:
1. Haz push a tu repositorio (ya hecho ✅)
2. En Render, click en **"Create Web Service"**
3. Render detectará el Dockerfile y comenzará el build automáticamente
4. El proceso puede tardar 5-10 minutos la primera vez
5. Las migraciones se ejecutarán automáticamente al iniciar

### 6. Verificar el Deploy

Una vez completado el deploy:
- Render te dará una URL como: `https://proyectorender.onrender.com`
- Actualiza la variable `APP_URL` con esta URL
- Haz un nuevo deploy si es necesario

## Archivos de Configuración Docker

- `Dockerfile`: Configuración del contenedor con PHP 8.2 y todas las dependencias
- `.dockerignore`: Archivos que no se copian al contenedor
- `render.yaml`: Configuración de infraestructura como código (opcional)

## Base de Datos

El proyecto está configurado para usar SQLite por defecto. Si necesitas PostgreSQL o MySQL:

#### Para PostgreSQL en Render:
1. Crea un PostgreSQL Database en Render
2. Actualiza las variables de entorno:
```
DB_CONNECTION=pgsql
DB_HOST=[internal_database_url]
DB_PORT=5432
DB_DATABASE=[database_name]
DB_USERNAME=[username]
DB_PASSWORD=[password]
```

### 6. Deploy

Una vez configurado todo:
1. Haz push a tu repositorio
2. Render detectará los cambios y comenzará el deploy automáticamente
3. Las migraciones se ejecutarán automáticamente durante el build

### Archivos de Configuración

- `build.sh`: Script de construcción
- `start.sh`: Script de inicio (alternativo)
- `Procfile`: Configuración de procesos
- `render.yaml`: Configuración de infraestructura como código

### Troubleshooting

#### Error 500 - Internal Server Error

Si ves un error 500, verifica lo siguiente:

1. **Revisa los logs en Render**:
   - Ve a tu servicio en Render
   - Click en "Logs" en el menú lateral
   - Busca mensajes de error específicos

2. **Verifica las variables de entorno**:
   - Asegúrate de que `APP_KEY` esté configurado correctamente
   - Debe empezar con `base64:`
   - Ejemplo: `base64:ffn4XFh9uJaCwaMR+eiN3MAvh0hmYH7yniLB6U3DPZo=`

3. **Verifica que todas las variables estén configuradas**:
   ```
   APP_NAME=ProyectoRender
   APP_ENV=production
   APP_KEY=base64:TU_CLAVE_AQUI
   APP_DEBUG=false (no true!)
   APP_URL=https://tu-url.onrender.com
   LOG_CHANNEL=stderr
   DB_CONNECTION=sqlite
   SESSION_DRIVER=file
   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   ```

4. **Habilita temporalmente el debug**:
   - Cambia `APP_DEBUG=true` para ver el error exacto
   - **NO OLVIDES** volver a ponerlo en `false` después

5. **Forzar un nuevo deploy**:
   - Ve a "Manual Deploy"
   - Click en "Clear build cache & deploy"

#### Error de permisos
Si hay errores de permisos, asegúrate de que `build.sh` tiene permisos de ejecución:
```bash
chmod +x build.sh
chmod +x start.sh
```

#### Error de APP_KEY
Asegúrate de haber configurado la variable `APP_KEY` en las variables de entorno de Render.

#### Errores de base de datos
Verifica que la variable `DB_CONNECTION` esté correctamente configurada y que las migraciones se ejecuten durante el build.

### Comandos Útiles

```bash
# Ver logs en tiempo real (localmente)
php artisan pail

# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ejecutar migraciones
php artisan migrate --force

# Ver rutas disponibles
php artisan route:list
```

## Desarrollo Local

```bash
# Instalar dependencias
composer install
npm install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Compilar assets
npm run build

# Iniciar servidor
php artisan serve
```
