# 🏫 Portal Institucional INCB

> **Instituto Nacional de Ciudad Barrios** — Sitio web institucional oficial.
> Bachillerato en Desarrollo de Software · Docente: Allan Romero · Desarrollador: Daniel Sorto

---

## 📋 Descripción

Portal web institucional del **Instituto Nacional de Ciudad Barrios (INCB)**, ubicado en la región oriental de El Salvador. El sistema permite a los visitantes conocer la oferta académica, ver noticias institucionales, completar una ficha de inscripción en línea y enviar mensajes de contacto. Cuenta además con un panel de administración protegido para gestionar los mensajes recibidos.

---

# 🚀 Tecnologías utilizadas

| Capa | Tecnología |
|---|---|
| Backend | PHP 8+ (procedural) |
| Base de datos | MySQL / MariaDB (`mysqli`) |
| Frontend | HTML5, CSS3, Bootstrap 5.3.3 |
| Iconos | Bootstrap Icons 1.11.3 |
| Tipografía | Google Fonts — Poppins + Inter |
| Servidor local | XAMPP (Apache + MySQL) |

> ⚡ Bootstrap y Bootstrap Icons se cargan **localmente** (sin necesidad de internet).
> Las fuentes de Google Fonts se cargan de forma asíncrona como mejora progresiva.

---

## 🗂️ Estructura de archivos

```
Portal/
│
├── index.php                   # Página principal (carrusel, nosotros, oferta, noticias, contacto)
├── inscripcion.php             # Formulario de inscripción para nuevos alumnos
├── oferta_academica.php        # Página completa de oferta académica
├── login.php                   # Inicio de sesión del administrador
├── admin.php                   # Panel de administración (requiere sesión activa)
├── eliminar.php                # Eliminación segura de mensajes (requiere sesión)
├── exportar_excel.php          # Exportación de mensajes a Excel (requiere sesión)
├── logout.php                  # Cierre de sesión
│
├── includes/                   # Componentes reutilizables (parciales PHP)
│   ├── config.php              # Configuración central: $base_url, credenciales admin, CSRF
│   ├── conexion.php            # Conexión centralizada a la base de datos bd_incb
│   ├── auth.php                # Verificación de sesión activa (protege rutas admin)
│   ├── header.php              # <head> HTML, Bootstrap local, estilos globales INCB
│   ├── footer.php              # <footer>, botón WhatsApp, botón accesibilidad, Bootstrap JS
│   ├── navbar.php              # Barra de navegación pública
│   ├── navbar_admin.php        # Barra de navegación del panel de administración
│   └── aviso_banner.php        # Banner de avisos institucionales
│
├── assets/                     # Recursos estáticos locales (Bootstrap offline)
│   ├── css/
│   │   ├── bootstrap.min.css           # Bootstrap 5.3.3 CSS
│   │   └── bootstrap-icons.min.css     # Bootstrap Icons 1.11.3 CSS
│   ├── js/
│   │   └── bootstrap.bundle.min.js     # Bootstrap 5.3.3 JS + Popper integrado
│   └── fonts/
│       ├── bootstrap-icons.woff        # Fuentes de íconos (fallback)
│       └── bootstrap-icons.woff2       # Fuentes de íconos (principal, comprimido)
│
├── img/                        # Imágenes del portal
│   ├── fachada.jpg             # Foto del carrusel principal
│   ├── banda.jpg               # Foto del carrusel — banda musical
│   ├── danza.jpg               # Foto del carrusel — danza folclórica
│   ├── anuncio.jpg             # Imagen del modal de anuncio emergente
│   ├── profesores.jpg          # Foto sección nosotros / beneficios
│   ├── logo_incb.png           # Logotipo institucional
│   └── logo_incb_formatoMejorado.png   # Logotipo mejorado (navbar y footer)
│
├── database/
│   └── 127_0_0_1.sql           # Script SQL para recrear la base de datos bd_incb
│
│   ── Secciones modulares (incluidas desde index.php) ──
├── oferta_seccion.php          # Tarjetas de oferta académica (bachilleratos)
├── pasos_inscripcion.php       # Pasos para inscribirse (línea de tiempo)
├── beneficios_seccion.php      # Beneficios de estudiar en el INCB
├── noticias.php                # Sección de noticias y eventos institucionales
├── contacto_seccion.php        # Formulario de contacto con validación y guardado en BD
│
└── README.md                   # Este archivo
```

---

## ⚙️ Instalación en XAMPP (local)

### Requisitos previos
- [XAMPP](https://www.apachefriends.org/) con **Apache** y **MySQL** activos
- PHP 8.0 o superior

### Pasos

1. **Clonar o copiar el proyecto:**
   ```
   Copiar la carpeta Portal/ a:
   C:\xampp\htdocs\proyecto_final\Portal\
   ```

2. **Crear la base de datos:**
   - Abre `http://localhost/phpmyadmin`
   - Crea una base de datos llamada `bd_incb`
   - Importa el archivo `database/127_0_0_1.sql`

3. **Verificar la configuración:**
   - Abre `includes/config.php`
   - Asegúrate de que `$base_url` apunte correctamente:
     ```php
     $base_url = '/proyecto_final/Portal/';
     ```

4. **Abrir en el navegador:**
   ```
   http://localhost/proyecto_final/Portal/index.php
   ```

---

## 🔐 Panel de Administración

El panel permite ver, gestionar y exportar los mensajes del formulario de contacto.

| Campo | Valor |
|---|---|
| URL de acceso | `http://localhost/proyecto_final/Portal/login.php` |
| Usuario | `admin` |
| Contraseña | `incb2026` |

> **Seguridad implementada:**
> - Autenticación dinámica conectada a la base de datos MySQL (tabla `usuarios`)
> - Contraseña almacenada como hash `bcrypt` (`password_hash`)
> - Protección CSRF en formularios sensibles
> - Límite de 5 intentos de inicio de sesión (bloqueo de 60 segundos)
> - Verificación de sesión activa en todas las rutas protegidas

---

## 🗃️ Base de datos

- **Nombre:** `bd_incb`
- **Motor:** MySQL / MariaDB

### Tabla: `usuarios` (Autenticación del panel)

| Columna | Tipo | Descripción |
|---|---|---|
| `id` | INT (PK, AUTO_INCREMENT) | Identificador único del usuario |
| `usuario` | VARCHAR(50) (UNIQUE) | Nombre de usuario (ej. `admin`) |
| `password` | VARCHAR(255) | Hash seguro de la contraseña (`bcrypt`) |
| `nombre` | VARCHAR(100) | Nombre completo del usuario |
| `fecha_creacion` | TIMESTAMP | Fecha de registro del usuario |

### Tabla: `mensajes_contacto`

| Columna | Tipo | Descripción |
|---|---|---|
| `id` | INT (PK, AUTO_INCREMENT) | Identificador único del mensaje |
| `nombre_remitente` | VARCHAR | Nombre del visitante |
| `correo_remitente` | VARCHAR | Correo electrónico |
| `mensaje_texto` | TEXT | Contenido del mensaje |
| `fecha_envio` | DATETIME | Fecha y hora de recepción |

---

## 📦 Modo offline (Bootstrap local)

El proyecto usa Bootstrap de forma **completamente local**, lo que garantiza que el diseño
y la interactividad funcionen **sin conexión a internet**.

Los archivos se encuentran en `assets/` y fueron descargados desde los CDN oficiales:
- `bootstrap.min.css` · `bootstrap.bundle.min.js` — Bootstrap v5.3.3
- `bootstrap-icons.min.css` · `fonts/*.woff2` — Bootstrap Icons v1.11.3

Para despliegue en producción, simplemente sube la carpeta `assets/` junto con el resto
del proyecto y actualiza `$base_url` en `includes/config.php`.

---

## 🌐 Despliegue en hosting (InfinityFree)

1. Subir todos los archivos al directorio raíz del dominio (`htdocs/`)
2. En `includes/config.php`, cambiar:
   ```php
   // Local (XAMPP)
   $base_url = '/proyecto_final/Portal/';

   // Hosting (producción)
   $base_url = '/';
   ```
3. Crear la base de datos desde el panel del hosting e importar el `.sql`
4. Actualizar credenciales en `includes/conexion.php` con los datos del hosting

---

## ✨ Funcionalidades principales

- **Carrusel hero** con imágenes institucionales y transición automática
- **Modal de anuncio emergente** al cargar la página (una vez por sesión)
- **Sección Nosotros** con acordeón (Misión, Visión, Valores) y enlaces rápidos a PDFs
- **Oferta académica** en tarjetas con efecto hover animado
- **Pasos de inscripción** con línea de tiempo visual
- **Formulario de contacto** con validación PHP y guardado en BD
- **Formulario de inscripción** de nuevo ingreso con múltiples secciones
- **Panel admin** con tabla de mensajes, vista detallada y exportación a Excel
- **Botón de accesibilidad** para aumentar el tamaño de fuente
- **Botón de WhatsApp** flotante para contacto directo
- **Diseño 100% responsive** optimizado para móvil, tablet y escritorio

---

## 👨‍💻 Créditos

| Rol | Nombre |
|---|---|
| Desarrollador | Daniel Sorto |
| Docente encargado | Allan Romero |
| Institución | Instituto Nacional de Ciudad Barrios (INCB) |

---

*© 2026 INCB — Todos los derechos reservados.*
