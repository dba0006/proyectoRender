# Proyecto Laravel - Deployment en Render

## Configuración en Render

### 1. Crear nuevo Web Service
- Ve a [Render Dashboard](https://dashboard.render.com/)
- Click en "New" > "Web Service"
- Conecta tu repositorio de GitHub

### 2. Configuración del Servicio

#### Build & Deploy
- **Environment**: `PHP`
- **Build Command**: 
  ```bash
  bash build.sh
  ```
- **Start Command**: 
  ```bash
  php artisan serve --host=0.0.0.0 --port=$PORT --env=production
  ```

### 3. Variables de Entorno Requeridas

Configura estas variables en Render Dashboard > Environment:

```
APP_NAME=ProyectoRender
APP_ENV=production
APP_KEY=base64:TU_CLAVE_GENERADA_AQUI
APP_DEBUG=false
APP_URL=https://tu-app.onrender.com

LOG_CHANNEL=stderr
LOG_LEVEL=error

DB_CONNECTION=sqlite

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=local
```

### 4. Generar APP_KEY

Para generar el APP_KEY, ejecuta localmente:
```bash
php artisan key:generate --show
```

Copia el resultado y pégalo en la variable `APP_KEY` en Render.

### 5. Base de Datos

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
