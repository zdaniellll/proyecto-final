# Portal Institucional INCB

**Instituto Nacional de Ciudad Barrios** — Sitio web institucional oficial.
Bachillerato en Desarrollo de Software · Docente: Allan Romero · Desarrollador: Daniel Sorto

---

## Descripción

Portal web del INCB. Permite a los visitantes conocer la oferta académica, leer noticias, completar una ficha de inscripción en línea y enviar mensajes de contacto. Incluye un panel de administración para gestionar los mensajes recibidos.

---

## Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 8+ (procedural) |
| Base de datos | MySQL / MariaDB (`mysqli`) |
| Frontend | HTML5, CSS3, Bootstrap 5.3.3 |
| Iconos | Bootstrap Icons 1.11.3 |
| Tipografía | Google Fonts — Poppins + Inter |
| Servidor local | XAMPP (Apache + MySQL) |

> Bootstrap y Bootstrap Icons se cargan **localmente** (sin necesidad de internet).
> Las fuentes de Google Fonts se cargan de forma asíncrona como mejora progresiva.

---

## Estructura de archivos

```
Portal/
│
├── index.php                   # Página principal
├── inscripcion.php             # Formulario de inscripción
├── oferta_academica.php        # Página de oferta académica
├── login.php                   # Login del administrador
├── admin.php                   # Panel de administración (requiere sesión)
├── logout.php                  # Cierre de sesión
├── perfil_desarrollador.php    # Perfil del desarrollador
│
├── actions/                    # Controladores de acciones POST
│   ├── guardar.php             # Procesa y guarda la ficha de inscripción en BD
│   └── logout.php              # Cierra la sesión del administrador
│
├── pages/                      # Lógica real de cada página pública
│   ├── index.php               # Carrusel, nosotros, oferta, noticias, contacto
│   ├── inscripcion.php         # Formulario de inscripción con validación PHP
│   ├── login.php               # Autenticación dinámica contra la BD
│   ├── oferta_academica.php    # Redirige al archivo dinámico
│   ├── oferta_academica_dinamica.php  # Oferta con tabs y array de datos
│   └── perfil_desarrollador.php      # Perfil del desarrollador
│
├── admin/                      # Panel de administración (todas requieren sesión)
│   ├── dashboard.php           # Vista de mensajes de contacto + estadísticas
│   ├── eliminar.php            # Elimina un mensaje por ID (POST + CSRF)
│   ├── exportar_excel.php      # Genera y descarga un .xls con los mensajes
│   ├── imagenes.php            # Gestiona las imágenes del carrusel
│   └── publicar_noticia.php    # Publica noticias institucionales en BD
│
├── includes/                   # Archivos reutilizables (cargados con require)
│   ├── config.php              # base_url, app_url(), CSRF, credenciales admin
│   ├── conexion.php            # Conexión mysqli a bd_incb
│   ├── auth.php                # Guardia de sesión (protege rutas admin)
│   ├── header.php              # <head> HTML + Bootstrap local + estilos globales
│   ├── footer.php              # <footer> + WhatsApp + accesibilidad + Bootstrap JS
│   ├── navbar_offcanvas.php    # Navbar pública con menú offcanvas para móvil
│   ├── navbar_admin.php        # Navbar del panel de administración
│   └── aviso_banner.php        # Banner de avisos institucionales
│
├── components/                 # Secciones modulares incluidas desde index.php
│   ├── carrusel_responsive.php # Carrusel con imágenes por breakpoint (<picture>)
│   ├── oferta_seccion.php      # Tarjetas de los 4 bachilleratos
│   ├── pasos_inscripcion.php   # 4 pasos del proceso de inscripción
│   ├── beneficios_seccion.php  # Beneficios de estudiar en el INCB
│   ├── noticias.php            # Cuadrícula de noticias con animación de entrada
│   └── contacto_seccion.php    # Formulario de contacto + directorio + FAQ
│
├── assets/                     # Recursos estáticos locales
│   ├── css/
│   │   ├── bootstrap.min.css
│   │   └── bootstrap-icons.min.css
│   ├── js/
│   │   └── bootstrap.bundle.min.js
│   └── fonts/
│       ├── bootstrap-icons.woff
│       └── bootstrap-icons.woff2
│
├── img/                        # Imágenes del portal
│   ├── fachada.jpg             # Carrusel — slide 1
│   ├── banda.jpg               # Carrusel — slide 2
│   ├── danza.jpg               # Carrusel — slide 3
│   ├── anuncio.jpg             # Modal de anuncio emergente
│   ├── logo_incb.png           # Logo (navbar)
│   └── logo_incb_formatoMejorado.png  # Logo mejorado (footer / login)
│
├── database/
│   └── 127_0_0_1.sql           # Script SQL para recrear bd_incb
│
└── README.md
```

---

## Instalación en XAMPP

**Requisitos:** XAMPP con Apache y MySQL activos, PHP 8.0+

1. Copia la carpeta `Portal/` a:
   ```
   C:\xampp\htdocs\proyecto_final\Portal\
   ```

2. En phpMyAdmin (`http://localhost/phpmyadmin`):
   - Crea la base de datos `bd_incb`
   - Importa `database/127_0_0_1.sql`

3. Abre en el navegador:
   ```
   http://localhost/proyecto_final/Portal/
   ```

---

## Panel de Administración

| Campo | Valor |
|---|---|
| URL | `http://localhost/proyecto_final/Portal/login.php` |
| Usuario | `admin` |
| Contraseña | `incb2026` |

**Seguridad implementada:**
- Autenticación dinámica contra tabla `usuarios` en MySQL
- Contraseña almacenada como hash bcrypt (`password_hash`)
- Tokens CSRF en todos los formularios sensibles
- Bloqueo de 60 segundos tras 5 intentos fallidos
- Guardia de sesión (`auth.php`) en todas las rutas del panel

---

## Base de datos

**Nombre:** `bd_incb`

### Tabla `usuarios`

| Columna | Tipo | Descripción |
|---|---|---|
| `id` | INT PK AUTO_INCREMENT | ID del usuario |
| `usuario` | VARCHAR(50) UNIQUE | Nombre de usuario |
| `password` | VARCHAR(255) | Hash bcrypt de la contraseña |
| `nombre` | VARCHAR(100) | Nombre completo |
| `fecha_creacion` | TIMESTAMP | Fecha de registro |

### Tabla `mensajes_contacto`

| Columna | Tipo | Descripción |
|---|---|---|
| `id` | INT PK AUTO_INCREMENT | ID del mensaje |
| `nombre_remitente` | VARCHAR | Nombre del visitante |
| `correo_remitente` | VARCHAR | Correo electrónico (opcional) |
| `mensaje_texto` | TEXT | Contenido del mensaje |
| `fecha_envio` | DATETIME | Fecha y hora de recepción |

---

## Despliegue en hosting (InfinityFree)

1. Sube todos los archivos al directorio raíz del dominio
2. `config.php` detecta automáticamente la ruta base, no requiere cambio manual
3. Crea `bd_incb` desde el panel del hosting e importa el `.sql`
4. Actualiza usuario y contraseña de BD en `includes/conexion.php`

---

## Funcionalidades principales

- Carrusel hero con imágenes responsivas (`<picture>`) y animaciones de entrada
- Modal de anuncio emergente al cargar (una vez por sesión via `sessionStorage`)
- Sección Nosotros con acordeón (Misión, Visión, Valores) e historia institucional
- Oferta académica en tarjetas y en página detallada con tabs
- Pasos de inscripción con tarjetas numeradas
- Formulario de contacto con validación PHP, guardado en BD y reenvío por correo
- Formulario de inscripción de nuevo ingreso
- Panel admin: mensajes de contacto, estadísticas, exportar Excel, gestionar imágenes
- Botón de accesibilidad para aumentar/reducir tamaño de fuente
- Botón de WhatsApp flotante
- Diseño responsive: móvil, tablet y escritorio

---

## Créditos

| Rol | Nombre |
|---|---|
| Desarrollador | Daniel Sorto |
| Docente encargado | Allan Romero |
| Institución | Instituto Nacional de Ciudad Barrios (INCB) |

---

*© 2026 INCB — Todos los derechos reservados.*
