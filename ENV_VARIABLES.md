## IMPORTANTE: Configuración de Variables de Entorno en Render

Asegúrate de configurar TODAS estas variables en Render Dashboard > Environment:

### Variables Críticas (REQUERIDAS):
```
APP_NAME=ProyectoRender
APP_ENV=production
APP_KEY=base64:ffn4XFh9uJaCwaMR+eiN3MAvh0hmYH7yniLB6U3DPZo=
APP_DEBUG=false
APP_URL=https://tu-url.onrender.com
```

### Base de Datos:
```
DB_CONNECTION=sqlite
```

### Logging:
```
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

### Session (IMPORTANTE - debe ser file, NO database):
```
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
```

### Cache (IMPORTANTE - debe ser file, NO database):
```
CACHE_DRIVER=file
CACHE_STORE=file
```

### Queue:
```
QUEUE_CONNECTION=sync
```

### Filesystem:
```
FILESYSTEM_DISK=local
BROADCAST_CONNECTION=log
```

---

## ⚠️ Errores Comunes

### Error: "no such table: cache"
**Causa**: `CACHE_DRIVER` o `SESSION_DRIVER` están configurados como `database`
**Solución**: Asegúrate de que ambos estén en `file`

### Error: "no such table: sessions"
**Causa**: `SESSION_DRIVER` está configurado como `database`
**Solución**: Cambia `SESSION_DRIVER=file`

---

## 📋 Checklist Antes de Deploy

- [ ] Todas las variables de arriba están configuradas en Render
- [ ] `CACHE_DRIVER=file` (NO database)
- [ ] `SESSION_DRIVER=file` (NO database)
- [ ] `APP_KEY` tiene el formato correcto con `base64:`
- [ ] `APP_URL` tiene tu URL real de Render
